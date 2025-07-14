<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tests\FacadelessAbstractTestFixture;

final class WithAllowedFacades extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        // Allowed
        Log::info('Foo');
        Config::all();

        // Not allowed
        DB::selectOne('SELECT * FROM users');
    }
}
