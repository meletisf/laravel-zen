# Laravel Zen

[![Latest Stable Version](https://poser.pugx.org/meletisf/laravel-zen/v)](//packagist.org/packages/meletisf/laravel-zen) [![Total Downloads](https://poser.pugx.org/meletisf/laravel-zen/downloads)](//packagist.org/packages/meletisf/laravel-zen) [![Latest Unstable Version](https://poser.pugx.org/meletisf/laravel-zen/v/unstable)](//packagist.org/packages/meletisf/laravel-zen) [![License](https://poser.pugx.org/phpunit/phpunit/license)](//packagist.org/packages/meletisf/laravel-zen)

Laravel Zen is a package that is used in conjunction with a load balancer's 
health check feature in order to ensure that no dysfunctional node attempts to serve
the user.

## Installation

```bash
composer require meletisf/laravel-zen
```

The package will automatically register itself. If you are using an older version of Laravel
which does not support automatic registration then please add the following to your `config/app.php`:

```php
    'providers' => [
        ...

        /*
         * Package Service Providers...
         */
        Meletisf\Zen\ZenServiceProvider::class,

        ...
    ];

    'aliases' => [
        ...

        Meletisf\Zen\Facades\Zen::class,

        ...
    ];
```

## Issues

If something doesn't work as indented, or you want to suggest a change, please open an issue and i will do my best to respond as soon as possible.

## TODO

+ Improve the test coverage
+ Add the ability to pass custom values to the check from the config file

---

Read the **[Wiki](https://github.com/meletisf/laravel-zen/wiki)** for more information on how to setup the package, use it along with a load balancer, and write your own checks.
