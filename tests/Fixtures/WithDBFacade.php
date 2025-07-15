<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Support\Facades\DB;
use Tests\FacadelessAbstractTestFixture;

final class WithDBFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly ConnectionResolverInterface $db,
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        DB::table('users')->get();

        // No error
        $this->db->connection('default')->table('users')->get();
    }
}
