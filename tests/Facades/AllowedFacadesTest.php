<?php

declare(strict_types=1);

namespace Facades;

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
final class AllowedFacadesTest extends RuleTestCase
{
    #[Test]
    public function returns_no_errors_for_allowed_facades(): void
    {
        $this->analyse([__DIR__.'/../Fixtures/WithAllowedFacades.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\DB" is not allowed.',
                21,
                'Consider using dependency injection via the "Illuminate\Database\ConnectionResolverInterface" interface.',
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        $config = new FacadelessConfiguration([
            Log::class,
            Config::class,
        ]);

        return new FacadelessRule($config);
    }
}
