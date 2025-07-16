<?php

declare(strict_types=1);

namespace Fixtures;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Tests\FacadelessAbstractTestFixture;

final class WithCryptFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly Encrypter $encrypter
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Crypt::encrypt('foo');

        // No error
        $this->encrypter->encrypt('foo');
    }
}
