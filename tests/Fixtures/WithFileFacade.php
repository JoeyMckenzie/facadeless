<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Tests\FacadelessAbstractTestFixture;

final class WithFileFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Filesystem $file,
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        File::exists(__DIR__.'/foo.php');

        // No error
        $this->file->exists(__DIR__.'/foo.php');
    }
}
