<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\App;
use Tests\FacadelessAbstractTestFixture;

final class WithAppFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        App::isProduction();
    }
}
