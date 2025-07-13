<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Support\Facades\Artisan;
use Tests\FacadelessAbstractTestFixture;

final class WithArtisanFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Artisan::call('foo:bar');
    }
}
