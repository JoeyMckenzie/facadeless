<?php

declare(strict_types=1);

namespace Facades;

use Facadeless\FacadelessConfiguration;
use Facadeless\FacadelessRule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Tests\Concerns\TestsFacadelessRule;

/**
 * @extends RuleTestCase<FacadelessRule>
 */
#[CoversClass(FacadelessRule::class)]
#[CoversClass(FacadelessConfiguration::class)]
final class BroadcastFacadeTest extends RuleTestCase
{
    use TestsFacadelessRule;

    #[Test]
    public function returns_error_when_blade_facade_detected(): void
    {
        $this->analyse([__DIR__.'/../Fixtures/WithBroadcastFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Broadcast" is not allowed.',
                23,
                'Consider using dependency injection via the "Illuminate\Contracts\Broadcasting\Broadcaster" interface.',
            ],
            [
                'Use of facade "Illuminate\Support\Facades\DB" is not allowed.',
                25,
                'Consider using dependency injection via the "Illuminate\Database\ConnectionResolverInterface" interface.',
            ],
        ]);
    }
}
