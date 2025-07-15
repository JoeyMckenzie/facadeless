<?php

declare(strict_types=1);

namespace Facades;

use Facadeless\FacadelessRule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Concerns\TestsFacadelessRule;

/**
 * @extends RuleTestCase<FacadelessRule>
 */
final class CacheFacadeTest extends RuleTestCase
{
    use TestsFacadelessRule;

    #[Test]
    public function returns_error_when_cache_facade_detected(): void
    {
        $this->analyse([__DIR__.'/../Fixtures/WithCacheFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\Cache" is not allowed.',
                22,
                'Consider using dependency injection via the "Illuminate\Contracts\Cache\Factory" interface.',
            ],
        ]);
    }
}
