<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Support\Facades\Event;
use Tests\FacadelessAbstractTestFixture;

final class WithEventFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Event::dispatch('user.created');
    }
}
