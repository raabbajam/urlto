# Laravel Aliases

Adds an `artisan aliases` command to [Laravel 4][1] that lists registered
aliases and the classes they map to, including resolving facades.

This saves you having to [look them up][2], and works with custom aliases and
[facades][3] as well. It's also easier than [calling getFacadeRoot() manually][4]
and gives you more detail about the class hierarchy.

## Installation

### 1. Install with Composer
```bash
composer require davejamesmiller/laravel-aliases dev-master
```

This will update `composer.json` and install it into the `vendor/` directory.

**Note:** `dev-master` is the latest development version.
See the [Packagist website][5] for a list of other versions.

### 2. Add to `app/config/app.php`
```php
    'providers' => array(
        // ...
        'DaveJamesMiller\Aliases\AliasesServiceProvider',
    ),
```

This registers the Artisan task with Laravel.

## Usage
### Show all aliases
```bash
$ php artisan aliases
```

e.g.

```
App
-> Illuminate\Support\Facades\App
-> Illuminate\Foundation\Application
-> Illuminate\Container\Container

Artisan
-> Illuminate\Support\Facades\Artisan
-> Illuminate\Console\Application
-> Symfony\Component\Console\Application

...
```

### Show alisases starting with "re"
```bash
$ php artisan aliases re
```

e.g.

```
Redirect
-> Illuminate\Support\Facades\Redirect
-> Illuminate\Routing\Redirector

Redis
-> Illuminate\Support\Facades\Redis
-> Illuminate\Redis\Database

Request
-> CustomRequest
-> Illuminate\Support\Facades\Request
-> Illuminate\Http\Request
-> Symfony\Component\HttpFoundation\Request

Response
-> Illuminate\Support\Facades\Response
```

### Verbose option shows how classes are resolved
```bash
$ php artisan aliases -v re
```

e.g.

```
Redirect
alias   > Illuminate\Support\Facades\Redirect
facade  > App::make('redirect')
resolve > Illuminate\Routing\Redirector

Redis
alias   > Illuminate\Support\Facades\Redis
facade  > App::make('redis')
resolve > Illuminate\Redis\Database

Request
alias   > CustomRequest
parent  > Illuminate\Support\Facades\Request
facade  > App::make('request')
resolve > Illuminate\Http\Request
parent  > Symfony\Component\HttpFoundation\Request

Response
alias   > Illuminate\Support\Facades\Response
```

## Changelog
### 0.1.0
* Initial release

### 0.2.0
* Show how facades are resolved when using verbose (`-v`) flag (e.g. `App::make('url')`)

### 1.0.0
*Version bump - no changes.*

### 1.0.1
* Compatibility with Laravel 4.1.

## Thanks to
I got the idea from [this Fideloper blog post][4], and worked out how to
implement it by looking at [this phpDoc generator by barryvdh][6].

## License
MIT License. See [LICENSE.txt][7].

[1]: http://four.laravel.com/
[2]: http://forums.laravel.io/viewtopic.php?id=4998
[3]: http://fideloper.com/create-facade-laravel-4
[4]: http://fideloper.com/laravel-facade-root
[5]: https://packagist.org/packages/davejamesmiller/laravel-aliases
[6]: https://github.com/barryvdh/laravel-ide-helper
[7]: LICENSE.txt
