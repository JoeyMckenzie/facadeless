<?php

declare(strict_types=1);

use Facadeless\FacadelessConfiguration;
use Facadeless\FacadelessRule;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Psr\Log\LoggerInterface;

/**
 * @extends RuleTestCase<FacadelessRule>
 */
#[CoversClass(FacadelessRule::class)]
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

    protected function getRule(): Rule
    {
        $bannedFacades = [
            Log::class,
            Auth::class,
        ];

        $facadeMap = [
            Log::class => LoggerInterface::class,
            Auth::class => Factory::class,
        ];

        $config = new FacadelessConfiguration($bannedFacades, $facadeMap);

        return new FacadelessRule($config);
    }
}
