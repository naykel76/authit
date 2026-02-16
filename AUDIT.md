# Naykel Authit – Package Audit

Audit date: February 2025. Scope: full package (controllers, routes, config, Livewire, commands, views, migrations).

---

## Critical issues

### 1. Logout route gated by `registration_enabled`

**File:** `src/routes.php` (lines 46–55)

When `authit.registration_enabled` is `false`, the entire `auth` middleware group block is skipped, so **the logout route is not registered**. Authenticated users (including admins) cannot log out.

**Fix:** Register logout (and any other auth routes that must always exist) outside the `if (config('authit.registration_enabled'))` block, e.g.:

```php
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    if (config('authit.registration_enabled')) {
        // verify-email, confirm-password, password.update, etc.
    }
});
```

### 2. App coupling in package code

**Files:** All controllers, Livewire components, and the migration.

The package assumes `App\Http\Controllers\Controller`, `App\Models\User`, and (in Livewire) `App\Models\User`. That ties the package to the application namespace and breaks reuse in other vendor/app namespaces.

**Recommendation:** Either document that the consuming app must provide `App\Models\User` and extend `App\Http\Controllers\Controller`, or make the package configurable (e.g. `authit.user_model`, `authit.controller_base`) and use those values in controllers and Livewire components. The migration already uses `config('authit.split_name_fields')`, which is good.

### 3. NewPasswordController ignores app view override

**File:** `src/Http/Controllers/Auth/NewPasswordController.php` (line 21)

Other auth controllers use:

```php
return view()->exists('auth.reset-password')
    ? view('auth.reset-password', ['request' => $request])
    : view('authit::auth.reset-password', ['request' => $request]);
```

`NewPasswordController::create()` only uses:

```php
return view('authit::auth.reset-password', ['request' => $request]);
```

So the app cannot override the reset-password view. Align with the pattern used in `RegisteredUserController`, `AuthenticatedSessionController`, and `PasswordResetLinkController`.

### 4. ConfirmablePasswordController has no app view override

**File:** `src/Http/Controllers/Auth/ConfirmablePasswordController.php` (line 19)

Uses only `view('authit::auth.confirm-password')`. For consistency and customization, support an app override (e.g. `auth.confirm-password`) like the other auth views.

---

## Medium issues

### 5. Class name typo: `UpdateProfileFrom`

**File:** `src/Livewire/User/UpdateProfileFrom.php`

Class is `UpdateProfileFrom`; the view and tag use “update-profile-form”. The component works because Livewire is registered as `user.update-profile-form`, but the class name is misleading.

**Fix:** Rename to `UpdateProfileForm` and update `AuthitServiceProvider` (and any references) accordingly.

### 6. Livewire component registration (TODO / CHECK)

**File:** `src/AuthitServiceProvider.php`

- Comment: “TODO: Check where the correct place to register the Livewire components is…”
- Comment: “CHECK: WTF” for `account-dropdown` registration.

Worth resolving: register Livewire components in the recommended way for Livewire 4 and remove or clarify the “WTF” so future maintainers aren’t confused.

### 7. Login view typo and registration link when registration disabled

**File:** `resources/views/auth/login.blade.php` (line 29)

- Typo: “Need **and** account?” → “Need **an** account?”
- When `registration_enabled` is false, `route('register')` may not exist; the link can 404.

**Fix:** Use the same pattern as `login-buttons.blade.php`: only show “Sign up here” when `config('authit.registration_enabled') && Route::has('register')`.

### 8. ConfigCommand return value

**File:** `src/Commands/ConfigCommand.php`

`handle()` calls `$this->call(...)` but does not return its result. Artisan expects the exit code from `handle()`.

**Fix:** `return $this->call('vendor:publish', ['--tag' => 'authit-config', '--force' => true]);`

### 9. Migration has no `down()` method

**File:** `src/database/migrations/2026_01_01_000000_split_users_name_field.php`

Only `up()` is implemented. Rollback is not possible and may cause issues in environments that run `migrate:rollback`.

**Fix:** Implement `down()` that reverses the schema change (restore `name`, drop `first_name`/`last_name` when applicable), respecting `config('authit.split_name_fields')` if needed for consistency.

### 10. UpdateProfileFrom: validation rule and return type

**File:** `src/Livewire/User/UpdateProfileFrom.php`

- `rules()` has no return type; consider `/** @return array<string, mixed> */` or `: array`.
- Email uniqueness uses `auth()->user()->id`; `$this->user->id` is clearer and avoids an extra guard call.

### 11. InstallCommand DatabaseSeeder regex

**File:** `src/Commands/InstallCommand.php` (line 76)

The regex assumes `public function run(): void`. Laravel’s default is often `public function run(): void`, but some apps use `public function run()` without a return type; the regex would not match and the seeders would not be added.

**Improvement:** Make the regex more tolerant (e.g. optional `: void`) or detect both forms so the command works in more setups.

---

## Low / polish

### 12. Password reset and forgot-password throttling

`post('forgot-password')` and `post('reset-password')` have no throttle. To limit abuse (e.g. reset-link spam), consider adding throttle middleware similar to registration (e.g. `throttle:5,1` or configurable via config).

### 13. Commented-out markup in guest layout

**File:** `resources/views/components/layouts/guest.blade.php` (lines 19–36)

A large commented-out block makes the file noisy. Remove or move to docs if it’s only a historical alternative.

### 14. Inconsistent redirect after logout

**File:** `src/Http/Controllers/Auth/AuthenticatedSessionController.php` (line 51)

`return redirect('/');` hardcodes `/`. Other redirects use `route(...)`. Consider a config option (e.g. `authit.logout_redirect`) or a constant for consistency and to allow apps to send users to a specific page after logout.

### 15. Stub seeders and production safety

**Files:** `stubs/database/seeders/UsersSeeder.php`, `RolesPermissionsSeeder.php`

Seeders use weak default passwords (e.g. `bcrypt('1')`) and example emails. Fine for demos; dangerous if run in production. Consider:

- Documenting that these are for local/demo only, and/or
- Adding a safety check (e.g. refuse to run or warn when `APP_ENV=production` unless a flag is set).

### 16. No package-level tests

`composer.json` lists Pest and pest-plugin-laravel, but there is no `tests/` directory in the package. Adding feature/unit tests for registration, login, password reset, and role-based redirects would improve reliability and refactoring safety.

---

## What’s working well

- **Registration:** Honeypot + throttle (after your recent change), validation, and optional split name fields are clear and config-driven.
- **Login:** Uses a dedicated `LoginRequest` with rate limiting (5 attempts by email|ip), session regeneration, and role-based redirect (admin vs user).
- **Config:** `authit.php` is small and clear; env-based options and the spam/honeypot note are helpful.
- **View fallback pattern:** Most controllers correctly prefer app views (`auth.*`) over package views (`authit::auth.*`).
- **Email verification:** Uses Laravel’s built-in verification, signed URLs, and throttling (6,1).
- **Password update:** Uses `current_password` rule and a dedicated validation bag.
- **Install command:** Handles permissions, dashboards, seeders, and User model (MustVerifyEmail, HasRoles) in a structured way.
- **Middleware install:** Alias injection into `bootstrap/app.php` is explicit and readable (and matches Laravel 11 style).
- **Blade components:** Registered under `authit::` and used consistently in views.
- **Routes:** Grouped by middleware (guest, auth, verified, role), with clear comments.

---

## Summary table

| Severity   | Count | Action |
|-----------|-------|--------|
| Critical  | 4     | Fix logout gate, reduce app coupling, align reset-password and confirm-password view override |
| Medium    | 7     | Typo rename, Livewire registration, login view, ConfigCommand return, migration down, validation/return type, InstallCommand regex |
| Low/Polish| 5     | Throttle forgot/reset, remove comment block, logout redirect config, seeder safety, add tests |

Overall the package is structured well and fits Laravel conventions. Addressing the critical items (especially logout when registration is disabled and view override consistency) will make it safer and easier to reuse across projects.
