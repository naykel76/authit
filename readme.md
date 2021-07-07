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

## Installation

Require the package via composer:

```bash
composer require naykel/authit
```


## Components

| ID  | Type | Default | Description |
| --- | ---- | ------- | ----------- |




### Logout Link

    <x-authit-logout />

Display exit icon by setting the `$icon` parameter equal to true
    
    <x-authit-logout :icon=true />

    
    <x-authit::login-register />



## Change log

See the [changelog](changelog.md) for more information on what has changed recently.

[link-author]: https://github.com/naykel76
[link-email]: nathan@naykel.com.au
