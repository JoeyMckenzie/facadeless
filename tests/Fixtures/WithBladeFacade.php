<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Tests\FacadelessAbstractTestFixture;

final class WithBladeFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly BladeCompiler $compiler
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Blade::compile('foo.bar');

        // No error
        $this->compiler->compile('foo.bar');
    }
}
