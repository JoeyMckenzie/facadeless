<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\File;
use Tests\FacadelessAbstractTestFixture;

final class WithFileFacade extends FacadelessAbstractTestFixture
{
    public function sample(): void
    {
        File::exists(__DIR__.'/foo.php');
    }
}
