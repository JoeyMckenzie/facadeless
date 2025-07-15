<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use Tests\FacadelessAbstractTestFixture;

final class WithCacheFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Repository $cache
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Cache::get('key');

        // No error
        $this->cache->has('key');
    }
}
