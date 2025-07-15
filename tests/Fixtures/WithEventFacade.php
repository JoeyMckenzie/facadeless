<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Event;
use Tests\FacadelessAbstractTestFixture;

final class WithEventFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Dispatcher $event
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Event::dispatch('user.created');

        // No error
        $this->event->dispatch('user.created');
    }
}
