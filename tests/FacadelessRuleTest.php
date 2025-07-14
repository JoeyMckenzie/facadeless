<?php

declare(strict_types=1);

namespace Tests;

use Facadeless\FacadelessConfiguration;
use Facadeless\FacadelessRule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

/**
 * @extends RuleTestCase<FacadelessRule>
 */
#[CoversClass(FacadelessRule::class)]
#[CoversClass(FacadelessConfiguration::class)]
final class FacadelessRuleTest extends RuleTestCase
{
    private FacadelessRule $rule;

    protected function setUp(): void
    {
        $config = new FacadelessConfiguration;
        $this->rule = new FacadelessRule($config);
    }

    #[Test]
    public function returns_no_errors_for_allowed_facades(): void
    {
        $config = new FacadelessConfiguration([
            Log::class,
            Config::class,
        ]);
        $this->rule = new FacadelessRule($config);

        $this->analyse([__DIR__.'/Fixtures/WithAllowedFacades.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\DB" is not allowed.',
                21,
                'Consider using dependency injection via the "Illuminate\Database\ConnectionInterface" interface.',
            ],
        ]);
    }

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
    public function returns_error_when_file_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithFileFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\File" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Filesystem\Filesystem" interface.',
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
                'Consider using dependency injection via the "Illuminate\Contracts\Routing\Registrar" interface.',
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

    #[Test]
    public function returns_error_when_app_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithAppFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\App" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Foundation\Application" interface.',
            ],
        ]);
    }

    #[Test]
    public function returns_error_when_artisan_facade_detected(): void
    {
        $this->analyse([__DIR__.'/Fixtures/WithArtisanFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Artisan" is not allowed.',
                14,
                'Consider using dependency injection via the "Illuminate\Contracts\Console\Kernel" interface.',
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        return $this->rule;
    }
}
