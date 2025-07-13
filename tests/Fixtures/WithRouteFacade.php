<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Support\Facades\Route;
use Tests\FacadelessAbstractTestFixture;

final class WithRouteFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Route::get('/users', 'UserController@index');
    }
}
