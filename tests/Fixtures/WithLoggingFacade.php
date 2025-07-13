<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Support\Facades\Log;
use Tests\FacadelessAbstractTestFixture;

final class WithLoggingFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Log::info('Rule failed!');
        Log::warning('Rule failed!');
        Log::error('Rule failed!');
    }
}
