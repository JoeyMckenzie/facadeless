<div align="center" style="padding-top: 2rem;">
    <img src="art/logo.png" height="300" width="300" alt="logo"/>
    <div style="display: inline-block; margin-top: 2rem">
        <img src="https://img.shields.io/packagist/v/joeymckenzie/facadeless.svg" alt="packgist downloads" />
        <img src="https://img.shields.io/github/actions/workflow/status/joeymckenzie/facadeless/run-ci.yml?branch=main&label=ci" alt="ci" />
        <img src="https://img.shields.io/github/actions/workflow/status/joeymckenzie/facadeless/fix-php-code-style-issues.yml?branch=main&label=code%20style" alt="packgist downloads" />
        <img src="https://img.shields.io/packagist/dt/joeymckenzie/facadeless.svg" alt="packgist downloads" />
        <img src="https://codecov.io/gh/JoeyMckenzie/facadeless/graph/badge.svg?token=9LZK1YDGKG"/> 
    </div>
</div>

------

# 🚫 Facadeless

PHPStan plugin for enforcing facade rules within your Laravel projects.

------

## Table of Contents

- [Getting started](#getting-started)
- [Usage](#usage)
- [Configuration](#configuration)
- [Testing](#testing)

## Getting started

Facadeless is available on [packagist](https://packagist.org/packages/joeymckenzie/facadeless) as a Composer package:

```bash
composer require --dev joeymckenie/facadeless
```

## Usage

If you're using `phpstan/extension-installer`, you're all set!

If not, however, include the extension in your PHPStan configuration:

```yaml
includes:
  - vendor/joeymckenzie/facadeless/extension.neon
```

## Configuration

You may configure facadeless to ignore linting errors for any facade through the `allowedFacades` configuration key
within your `phpstan.neon` file:

```neon
includes:
    - vendor/larastan/larastan/extension.neon
    - vendor/joeymckenzie/facadeless/extension.neon

parameters:
    level: 5
    paths:
        - app/
        - routes/
    facadeless:
        allowedFacades:
            - Illuminate\Support\Facades\Route
            - Illuminate\Support\Facades\Artisan
```

The configuration expects the fully qualified class name (FQCN) to the facade class. As exampled above, now anytime
PHPStan analysis is run, it will bypass linting errors for the `Route` and `Artisan` facades.

## Reference

By default, the plugin will ban the use of **all** facades listed below:

<div class="overflow-auto">

| Facade                | Class                                                                                                                                     | Service Container Binding |
|-----------------------|-------------------------------------------------------------------------------------------------------------------------------------------|---------------------------|
| App                   | [Illuminate\Foundation\Application](https://api.laravel.com/docs/12.x/Illuminate/Foundation/Application.html)                             | `app`                     |
| Artisan               | [Illuminate\Contracts\Console\Kernel](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Console/Kernel.html)                         | `artisan`                 |
| Auth (Instance)       | [Illuminate\Contracts\Auth\Guard](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Auth/Guard.html)                                 | `auth.driver`             |
| Auth                  | [Illuminate\Auth\AuthManager](https://api.laravel.com/docs/12.x/Illuminate/Auth/AuthManager.html)                                         | `auth`                    |
| Blade                 | [Illuminate\View\Compilers\BladeCompiler](https://api.laravel.com/docs/12.x/Illuminate/View/Compilers/BladeCompiler.html)                 | `blade.compiler`          |
| Broadcast (Instance)  | [Illuminate\Contracts\Broadcasting\Broadcaster](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Broadcasting/Broadcaster.html)     | &nbsp;                    |
| Broadcast             | [Illuminate\Contracts\Broadcasting\Factory](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Broadcasting/Factory.html)             | &nbsp;                    |
| Bus                   | [Illuminate\Contracts\Bus\Dispatcher](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Bus/Dispatcher.html)                         | &nbsp;                    |
| Cache (Instance)      | [Illuminate\Cache\Repository](https://api.laravel.com/docs/12.x/Illuminate/Cache/Repository.html)                                         | `cache.store`             |
| Cache                 | [Illuminate\Cache\CacheManager](https://api.laravel.com/docs/12.x/Illuminate/Cache/CacheManager.html)                                     | `cache`                   |
| Config                | [Illuminate\Config\Repository](https://api.laravel.com/docs/12.x/Illuminate/Config/Repository.html)                                       | `config`                  |
| Context               | [Illuminate\Log\Context\Repository](https://api.laravel.com/docs/12.x/Illuminate/Log/Context/Repository.html)                             | &nbsp;                    |
| Cookie                | [Illuminate\Cookie\CookieJar](https://api.laravel.com/docs/12.x/Illuminate/Cookie/CookieJar.html)                                         | `cookie`                  |
| Crypt                 | [Illuminate\Encryption\Encrypter](https://api.laravel.com/docs/12.x/Illuminate/Encryption/Encrypter.html)                                 | `encrypter`               |
| Date                  | [Illuminate\Support\DateFactory](https://api.laravel.com/docs/12.x/Illuminate/Support/DateFactory.html)                                   | `date`                    |
| DB (Instance)         | [Illuminate\Database\Connection](https://api.laravel.com/docs/12.x/Illuminate/Database/Connection.html)                                   | `db.connection`           |
| DB                    | [Illuminate\Database\DatabaseManager](https://api.laravel.com/docs/12.x/Illuminate/Database/DatabaseManager.html)                         | `db`                      |
| Event                 | [Illuminate\Events\Dispatcher](https://api.laravel.com/docs/12.x/Illuminate/Events/Dispatcher.html)                                       | `events`                  |
| Exceptions (Instance) | [Illuminate\Contracts\Debug\ExceptionHandler](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Debug/ExceptionHandler.html)         | &nbsp;                    |
| Exceptions            | [Illuminate\Foundation\Exceptions\Handler](https://api.laravel.com/docs/12.x/Illuminate/Foundation/Exceptions/Handler.html)               | &nbsp;                    |
| File                  | [Illuminate\Filesystem\Filesystem](https://api.laravel.com/docs/12.x/Illuminate/Filesystem/Filesystem.html)                               | `files`                   |
| Gate                  | [Illuminate\Contracts\Auth\Access\Gate](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Auth/Access/Gate.html)                     | &nbsp;                    |
| Hash                  | [Illuminate\Contracts\Hashing\Hasher](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Hashing/Hasher.html)                         | `hash`                    |
| Http                  | [Illuminate\Http\Client\Factory](https://api.laravel.com/docs/12.x/Illuminate/Http/Client/Factory.html)                                   | &nbsp;                    |
| Lang                  | [Illuminate\Translation\Translator](https://api.laravel.com/docs/12.x/Illuminate/Translation/Translator.html)                             | `translator`              |
| Log                   | [Illuminate\Log\LogManager](https://api.laravel.com/docs/12.x/Illuminate/Log/LogManager.html)                                             | `log`                     |
| Mail                  | [Illuminate\Mail\Mailer](https://api.laravel.com/docs/12.x/Illuminate/Mail/Mailer.html)                                                   | `mailer`                  |
| Notification          | [Illuminate\Notifications\ChannelManager](https://api.laravel.com/docs/12.x/Illuminate/Notifications/ChannelManager.html)                 | &nbsp;                    |
| Password (Instance)   | [Illuminate\Auth\Passwords\PasswordBroker](https://api.laravel.com/docs/12.x/Illuminate/Auth/Passwords/PasswordBroker.html)               | `auth.password.broker`    |
| Password              | [Illuminate\Auth\Passwords\PasswordBrokerManager](https://api.laravel.com/docs/12.x/Illuminate/Auth/Passwords/PasswordBrokerManager.html) | `auth.password`           |
| Pipeline (Instance)   | [Illuminate\Pipeline\Pipeline](https://api.laravel.com/docs/12.x/Illuminate/Pipeline/Pipeline.html)                                       | &nbsp;                    |
| Process               | [Illuminate\Process\Factory](https://api.laravel.com/docs/12.x/Illuminate/Process/Factory.html)                                           | &nbsp;                    |
| Queue (Base Class)    | [Illuminate\Queue\Queue](https://api.laravel.com/docs/12.x/Illuminate/Queue/Queue.html)                                                   | &nbsp;                    |
| Queue (Instance)      | [Illuminate\Contracts\Queue\Queue](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Queue/Queue.html)                               | `queue.connection`        |
| Queue                 | [Illuminate\Queue\QueueManager](https://api.laravel.com/docs/12.x/Illuminate/Queue/QueueManager.html)                                     | `queue`                   |
| RateLimiter           | [Illuminate\Cache\RateLimiter](https://api.laravel.com/docs/12.x/Illuminate/Cache/RateLimiter.html)                                       | &nbsp;                    |
| Redirect              | [Illuminate\Routing\Redirector](https://api.laravel.com/docs/12.x/Illuminate/Routing/Redirector.html)                                     | `redirect`                |
| Redis (Instance)      | [Illuminate\Redis\Connections\Connection](https://api.laravel.com/docs/12.x/Illuminate/Redis/Connections/Connection.html)                 | `redis.connection`        |
| Redis                 | [Illuminate\Redis\RedisManager](https://api.laravel.com/docs/12.x/Illuminate/Redis/RedisManager.html)                                     | `redis`                   |
| Request               | [Illuminate\Http\Request](https://api.laravel.com/docs/12.x/Illuminate/Http/Request.html)                                                 | `request`                 |
| Response (Instance)   | [Illuminate\Http\Response](https://api.laravel.com/docs/12.x/Illuminate/Http/Response.html)                                               | &nbsp;                    |
| Response              | [Illuminate\Contracts\Routing\ResponseFactory](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Routing/ResponseFactory.html)       | &nbsp;                    |
| Route                 | [Illuminate\Routing\Router](https://api.laravel.com/docs/12.x/Illuminate/Routing/Router.html)                                             | `router`                  |
| Schedule              | [Illuminate\Console\Scheduling\Schedule](https://api.laravel.com/docs/12.x/Illuminate/Console/Scheduling/Schedule.html)                   | &nbsp;                    |
| Schema                | [Illuminate\Database\Schema\Builder](https://api.laravel.com/docs/12.x/Illuminate/Database/Schema/Builder.html)                           | &nbsp;                    |
| Session (Instance)    | [Illuminate\Session\Store](https://api.laravel.com/docs/12.x/Illuminate/Session/Store.html)                                               | `session.store`           |
| Session               | [Illuminate\Session\SessionManager](https://api.laravel.com/docs/12.x/Illuminate/Session/SessionManager.html)                             | `session`                 |
| Storage (Instance)    | [Illuminate\Contracts\Filesystem\Filesystem](https://api.laravel.com/docs/12.x/Illuminate/Contracts/Filesystem/Filesystem.html)           | `filesystem.disk`         |
| Storage               | [Illuminate\Filesystem\FilesystemManager](https://api.laravel.com/docs/12.x/Illuminate/Filesystem/FilesystemManager.html)                 | `filesystem`              |
| URL                   | [Illuminate\Routing\UrlGenerator](https://api.laravel.com/docs/12.x/Illuminate/Routing/UrlGenerator.html)                                 | `url`                     |
| Validator (Instance)  | [Illuminate\Validation\Validator](https://api.laravel.com/docs/12.x/Illuminate/Validation/Validator.html)                                 | &nbsp;                    |
| Validator             | [Illuminate\Validation\Factory](https://api.laravel.com/docs/12.x/Illuminate/Validation/Factory.html)                                     | `validator`               |
| View (Instance)       | [Illuminate\View\View](https://api.laravel.com/docs/12.x/Illuminate/View/View.html)                                                       | &nbsp;                    |
| View                  | [Illuminate\View\Factory](https://api.laravel.com/docs/12.x/Illuminate/View/Factory.html)                                                 | `view`                    |
| Vite                  | [Illuminate\Foundation\Vite](https://api.laravel.com/docs/12.x/Illuminate/Foundation/Vite.html)                                           | &nbsp;                    |

</div>
