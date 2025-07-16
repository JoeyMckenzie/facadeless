<?php

declare(strict_types=1);

namespace Facadeless;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Broadcasting\Broadcaster;
use Illuminate\Contracts\Bus\Dispatcher as BusDispatcher;
use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Cookie\QueueingFactory;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Log\Context\Repository as ContextRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Compilers\CompilerInterface;
use Psr\Log\LoggerInterface;

final readonly class FacadelessConfiguration
{
    /**
     * @var array<class-string, class-string>
     */
    private array $correspondingFacadeContracts;

    /**
     * @param  class-string[]  $allow
     */
    public function __construct(
        private array $allow = [],
    ) {
        $this->correspondingFacadeContracts = $this->getFacadeToContractMapping();
    }

    public function isAllowed(string $className): bool
    {
        return count($this->allow) > 0 && in_array($className, $this->allow, true);
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
    private function getFacadeToContractMapping(): array
    {
        return [
            App::class => Application::class,
            Artisan::class => Kernel::class,
            Auth::class => AuthManager::class,
            Blade::class => CompilerInterface::class,
            Broadcast::class => Broadcaster::class,
            Bus::class => BusDispatcher::class,
            Cache::class => CacheFactory::class,
            Config::class => ConfigRepository::class,
            Context::class => ContextRepository::class,
            Cookie::class => QueueingFactory::class,
            DB::class => ConnectionResolverInterface::class,
            Event::class => EventDispatcher::class,
            File::class => Filesystem::class,
            Log::class => LoggerInterface::class,
            Route::class => Registrar::class,
        ];
    }
}
