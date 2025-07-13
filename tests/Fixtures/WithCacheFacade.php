<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Cache;
use Tests\FacadelessAbstractTestFixture;

final class WithCacheFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        Cache::get('key');
    }
}
