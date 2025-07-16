<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Contracts\Broadcasting\Broadcaster;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Tests\FacadelessAbstractTestFixture;

final class WithBroadcastFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Broadcaster $broadcast
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Broadcast::channel('orders.{order}', fn () =>
            // Error
            DB::table('orders')->insert([
                'foo' => 'bar',
            ]));

        // No error
        $this->broadcast->broadcast(['orders.{order}'], 'event');
    }
}
