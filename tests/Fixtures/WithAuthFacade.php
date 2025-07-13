<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Auth;
use Tests\FacadelessAbstractTestFixture;

final class WithAuthFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Auth::id();
    }
}
