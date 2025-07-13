<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Config;
use Tests\FacadelessAbstractTestFixture;

final class WithConfigFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Config::get('app.name');
    }
}
