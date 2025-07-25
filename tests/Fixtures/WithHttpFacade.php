<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use Tests\FacadelessAbstractTestFixture;

final class WithAppFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Factory $http,
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Http::get('https://reddit.com/r/laravel');

        // No error
        $this->http->get('https:/reddit.com/r/laravel');
    }
}
