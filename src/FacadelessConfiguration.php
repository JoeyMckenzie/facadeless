<?php

declare(strict_types=1);

namespace Facadeless;

use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Psr\Log\LoggerInterface;

final readonly class FacadelessConfiguration
{
    /**
     * @var array<class-string, class-string>
     */
    private array $correspondingFacadeContracts;

    /**
     * @param  class-string[]  $allowedFacades
     */
    public function __construct(
        private array $allowedFacades = [],
    ) {
        $this->correspondingFacadeContracts = $this->getFacadeMapping();
    }

    public function isAllowed(string $className): bool
    {
        return count($this->allowedFacades) > 0 && in_array($className, $this->allowedFacades, true);
    }

    /**
     * @return class-string|null
     */
    public function getSuggestedContract(string $className): ?string
    {
        return $this->correspondingFacadeContracts[$className] ?? null;
    }

    /**
     * @return array<class-string, class-string>
     */
    private function getFacadeMapping(): array
    {
        return [
            App::class => Application::class,
            Artisan::class => Kernel::class,
            Auth::class => AuthFactory::class,
            Cache::class => CacheFactory::class,
            Config::class => Repository::class,
            DB::class => ConnectionInterface::class,
            Event::class => Dispatcher::class,
            File::class => Filesystem::class,
            Log::class => LoggerInterface::class,
            Route::class => Registrar::class,
        ];
    }
}
