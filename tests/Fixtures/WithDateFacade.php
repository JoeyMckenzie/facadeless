<?php

declare(strict_types=1);

namespace Fixtures;

use Carbon\Factory;
use Illuminate\Support\Facades\Date;
use Tests\FacadelessAbstractTestFixture;

final class WithDateFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Factory $date
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Date::now();

        // No error
        $this->date->now();
    }
}
