<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Tests\FacadelessAbstractTestFixture;

final class WithAuthFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Guard $auth
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Auth::id();

        // No error
        $this->auth->id();
    }
}
