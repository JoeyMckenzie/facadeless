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
final class FileFacadeTest extends RuleTestCase
{
    use TestsFacadelessRule;

    #[Test]
    public function returns_error_when_file_facade_detected(): void
    {
        $this->analyse([__DIR__.'/../Fixtures/WithFileFacade.php'], [
            [
                'Use of facade "Illuminate\Support\Facades\File" is not allowed.',
                22,
                'Consider using dependency injection via the "Illuminate\Contracts\Filesystem\Filesystem" interface.',
            ],
        ]);
    }
}
