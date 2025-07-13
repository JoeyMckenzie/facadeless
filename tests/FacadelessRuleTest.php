<?php

declare(strict_types=1);

use Facadeless\FacadelessConfiguration;
use Facadeless\FacadelessRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

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

    protected function getRule(): Rule
    {
        $bannedFacades = [
            Illuminate\Support\Facades\Log::class,
        ];

        $facadeMap = [
            Illuminate\Support\Facades\Log::class => Psr\Log\LoggerInterface::class,
        ];

        $config = new FacadelessConfiguration($bannedFacades, $facadeMap);

        return new FacadelessRule($config);
    }
}
