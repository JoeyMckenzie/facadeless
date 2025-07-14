<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Blade;
use Tests\FacadelessAbstractTestFixture;

final class WithBladeFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Blade::compile('foo.bar');
    }
}
