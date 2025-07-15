<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\App;
use Tests\FacadelessAbstractTestFixture;

final class WithAppFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Application $app,
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        App::isProduction();

        // No error
        $this->app->environment('production');
    }
}
