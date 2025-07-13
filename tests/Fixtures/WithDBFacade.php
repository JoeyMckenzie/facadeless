<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Support\Facades\DB;
use Tests\FacadelessAbstractTestFixture;

final class WithDBFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        DB::table('users')->get();
    }
}
