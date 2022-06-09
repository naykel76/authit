<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/dt/naykel/authit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/v/naykel/authit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/l/naykel/authit" alt="License"></a>


# NAYKEL Authit

Authentication and permissions package for Naykel Laravel applications.

## Things to Know

- Registration form uses Spatie Permissions and Spatie Honeypot
- Certain files can be installed and used locally (see local overrides)
- The logout link should not be included in the `nav-user.json` file, use the `<x-authit::logout-link />` component
- User model implements `MustVerifyEmail` after the install command is run

## Installation

**Requires Naykel Gotime Package**

To get started, install Authit using the Composer package manager:

    composer require naykel/authit

After installing the Authit package, you should execute the `authit:install` Artisan command. This command will;

- \* install any necessary files
- \* implement `MustVerifyEmail` on the User model
- \* update the `RouteServiceProvider` home path
- \* create the avatar storage disk in `config\filesystems.php`;

```php
'avatars' => [
    'driver' => 'local',
    'root' => storage_path('app/public/avatars'),
    'url' => env('APP_URL') . '/storage/avatars',
    'visibility' => 'public',
],
```

### Finalizing The Installation

After installing Authit, you should migrate your database and make the necessary changes to the User model:

    php artisan migrate

Depending on your taste update user models `$fillable` array to accept the newly create user table fields or change to `$guarded`.

Add storage support and avatar url

    use Illuminate\Support\Facades\Storage;

    public function avatarUrl() {
        return $this->avatar
            ? Storage::disk('avatars')->url($this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }


**Refer to documentation for additional information**
