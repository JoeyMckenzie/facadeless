<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;
use Tests\FacadelessAbstractTestFixture;

final class WithRouteFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Registrar $route
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Route::get('/users', 'UserController@index');

        // No error
        $this->route->get('/users', 'UserController@index');
    }
}
