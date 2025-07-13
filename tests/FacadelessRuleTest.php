<?php

declare(strict_types=1);

use Facadeless\FacadelessConfiguration;
use Facadeless\FacadelessRule;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\LoggerInterface;

/**
 * @extends RuleTestCase<FacadelessRule>
 */
#[CoversClass(FacadelessRule::class)]
#[CoversClass(FacadelessConfiguration::class)]
final class FacadelessRuleTest extends RuleTestCase
{
    #[Test]
    public function returns_error_when_log_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithLoggingFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Log" is not allowed.',
                14,
                'Consider using dependency injection via the "Psr\Log\LoggerInterface" interface.',
            ],
            [
                'Use of facade "Illuminate\Support\Facades\Log" is not allowed.',
                15,
                'Consider using dependency injection via the "Psr\Log\LoggerInterface" interface.',
            ],
            [
                'Use of facade "Illuminate\Support\Facades\Log" is not allowed.',
                16,
                'Consider using dependency injection via the "Psr\Log\LoggerInterface" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_auth_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithAuthFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Auth" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Auth\Factory" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_db_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithDBFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\DB" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Database\ConnectionInterface" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_cache_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithCacheFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Cache" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Cache\Factory" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_config_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithConfigFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Config" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Config\Repository" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_route_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithRouteFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Route" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Routing\Router" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_event_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithEventFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Event" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Events\Dispatcher" interface.',
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        $bannedFacades = [
            Log::class,
            Auth::class,
            DB::class,
            Cache::class,
            Config::class,
            Route::class,
            Event::class,
        ];

        $facadeMap = [
            Log::class => LoggerInterface::class,
            Auth::class => AuthFactory::class,
            DB::class => ConnectionInterface::class,
            Cache::class => CacheFactory::class,
            Config::class => ConfigRepository::class,
            Route::class => Router::class,
            Event::class => Dispatcher::class,
        ];

        $config = new FacadelessConfiguration($bannedFacades, $facadeMap);

        return new FacadelessRule($config);
    }
}
