<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/dt/naykel/authit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/v/naykel/authit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/l/naykel/authit" alt="License"></a>


# NAYKEL Authit

Authentication, permissions and user package for Naykel applications built on Laravel Fortify and Spatie Permissions.

## Things to Know

- the dashboard view is published and managed locally Good?? Bad??
- the install process will adds an updated `FortifyServiceProvider.php` including the views in the `boot` method.
- The logout link should not be included in the `nav-user.json` file, use the `<x-authit::logout-link />` component. ????

## Installation

To get started, install Authit using the Composer package manager:

    composer require naykel/authit

Next, install Authit's resources using the authit:install command:

    php artisan authit:install

The `authit:install` command discussed above will also publish any required assets to use Fortify and Spatie Permissions as well as add the `App\Providers\FortifyServiceProvider` class within the providers array of your application's config/app.php configuration file.

## Finishing up and making it work

Run the migration to install and update database tables:

    php artisan migrate

Add avatar url to user model

    public function avatarUrl() {
        return $this->avatar ? Storage::disk('avatars')->url($this->avatar) : "/images/avatar.jpg";
    }

Add storage driver to `disks` in `config\filesystems.php`;

    'avatars' => [
        'driver' => 'local',
        'root' => storage_path('app/public/avatars'),
        'url' => '/storage/avatars',
        'visibility' => 'public',
    ],

## Publish Views (optional)

Initially all views will be served from the package however for more control you can publish the views locally


```bash
php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider" --force
# php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
# php artisan vendor:publish --provider="Naykel\Authit\AuthitServiceProvider" --force
```



## Other Resources

https://talltips.novate.co.uk/laravel/laravel-8-conditional-login-redirects
