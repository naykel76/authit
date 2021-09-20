<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/dt/naykel/authit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/v/naykel/authit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/l/naykel/authit" alt="License"></a>


# NAYKEL Authit

NayKel authentication package

`authit` will publish/override `RouteServiceProvider.php`, which is used to change the redirect after login path.

`authit` will publish/override the `FortifyServiceProvider.php` which is used to instruct Fortify how to return views.

`authit` will publish/override an updated `fortify` configuration file contains a `features` configuration array. This array defines the backend routes / features Fortify will expose by default. Laravel recommends that you only enable certain Fortify features, which are the basic authentication features provided by most Laravel applications. [more information](https://laravel.com/docs/8.x/fortify#fortify-features)


**Note** This package has a copy of the `FortifyServiceProvider.php` with alterations to load views, ***make sure `laravel/fortify` has already been installed, added to `app.php` and assets published before installing***


<!-- MarkdownTOC -->

- [Installation](#installation)
    - [Publish Resources](#publish-resources)
- [Spatie Permissions](#spatie-permissions)
- [Components](#components)
    - [Logout Link](#logout-link)
- [Change log](#change-log)

<!-- /MarkdownTOC -->

<a id="installation"></a>
## Installation

Require the package via composer:

```bash
composer require naykel/authit
```



<a id="publish-resources"></a>
### Publish Resources

**IMPORTANT:** When publishing resources for the first time make sure they are published in the correct order as written below using the `--force` flag where indicated to override key files. **Publish one at a time!**

```bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --provider="Naykel\Authit\AuthitServiceProvider" --force

php artisan migrate
```

**WARNING:** the Authit package will publish modified Laravel files that include code to make Spatie Permissions and Fortify work correctly.

- `config/app.php` file, registers `App\Providers\FortifyServiceProvider::class,`
- `app/Http/Kernel.php` file, registers middleware for Spatie Permissions. [more information](https://spatie.be/docs/laravel-permission/v4/basic-usage/middleware#package-middleware)
- `RouteServiceProvider.php` file, which is used to change the redirect after login path.
- `FortifyServiceProvider.php` file, which is used to instruct Fortify how to return views.
- `fortify` configuration file contains a `features` configuration array. This array defines the backend routes / features Fortify will expose by default. Laravel recommends that you only enable certain Fortify features, which are the basic authentication features provided by most Laravel applications. [more information](https://laravel.com/docs/8.x/fortify#fortify-features)




<a id="spatie-permissions"></a>
## Spatie Permissions

It is generally best to code your app around permissions only. That way you can always use the native Laravel @can and can() directives everywhere in your app.

    <!-- Assign Permision via Roles -->
    $user->assignRole('writer');
    $user->assignRole('writer', 'admin');


    $user = User::find('1');
    // assign role
    $user->assignRole('super');
    // assign permission
    $user->givePermissionTo('access admin');
    

    Route::group(['middleware' => ['can:publish articles']], function () { });

    Route::group(['middleware' => ['role:super-admin|writer']], function () { });

    public function __construct() {
        $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
    }

<a id="components"></a>
## Components

| ID  | Type | Default | Description |
| --- | ---- | ------- | ----------- |




<a id="logout-link"></a>
### Logout Link

    <x-authit-logout />

Display exit icon by setting the `$icon` parameter equal to true
    
    <x-authit-logout :icon=true />

    
    <x-authit::login-register />



<a id="change-log"></a>
## Change log

See the [changelog](changelog.md) for more information on what has changed recently.

[link-author]: https://github.com/naykel76
[link-email]: nathan@naykel.com.au
