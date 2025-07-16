<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Contracts\Cookie\QueueingFactory;
use Illuminate\Support\Facades\Cookie;
use Tests\FacadelessAbstractTestFixture;

final class WithCookieFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly QueueingFactory $cookie
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Cookie::make('foo', 'bar');

        // No error
        $this->cookie->make('foo', 'bar');
    }
}
