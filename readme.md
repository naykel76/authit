<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/dt/naykel/authit" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/v/naykel/authit" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/naykel/authit"><img src="https://img.shields.io/packagist/l/naykel/authit" alt="License"></a>


# NAYKEL Authit

Authentication and permissions package for Naykel Laravel applications.

## Things to Know

- The logout link should not be included in the `nav-user.json` file, use the `<x-authit::logout-link />` component.
- Uses Spatie Permissions and Spatie Honeypot

## Installation

To get started, install Authit using the Composer package manager:

    composer require naykel/authit

Next, install Authit's resources using the authit:install command:

    php artisan authit:install


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


