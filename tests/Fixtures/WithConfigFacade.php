<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\Config;
use Tests\FacadelessAbstractTestFixture;

final class WithConfigFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Repository $config
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Config::get('app.name');

        // No error
        $this->config->get('foo.bar');
    }
}
