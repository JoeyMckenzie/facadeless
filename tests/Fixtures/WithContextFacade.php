<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Log\Context\Repository;
use Illuminate\Support\Facades\Context;
use Tests\FacadelessAbstractTestFixture;

final class WithContextFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Repository $context
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Context::add('foo', 'bar');

        // No error
        $this->context->add('foo', 'bar');
    }
}
