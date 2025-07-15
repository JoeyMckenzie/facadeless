<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Artisan;
use Tests\FacadelessAbstractTestFixture;

final class WithArtisanFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Kernel $artisan
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Artisan::call('foo:bar');

        // No error
        $this->artisan->call('foo:bar');
    }
}
