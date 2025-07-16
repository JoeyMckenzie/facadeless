<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Bus;
use Tests\FacadelessAbstractTestFixture;

final class WithBusFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Bus::dispatch('foo');

        // No error
        $this->bus->dispatch('foo');
    }
}
