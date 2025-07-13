<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Artisan;
use Tests\FacadelessAbstractTestFixture;

final class WithArtisanFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Artisan::call('foo:bar');
    }
}
