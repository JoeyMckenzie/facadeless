<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;
use Tests\FacadelessAbstractTestFixture;

final class WithLoggingFacade extends FacadelessAbstractTestFixture
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
        //
    }

    public function sample(): void
    {
        // Error
        Log::info('Rule failed!');
        Log::warning('Rule failed!');
        Log::error('Rule failed!');

        // No error
        $this->logger->info('Rule passed!');
        $this->logger->warning('Rule passed!');
        $this->logger->error('Rule passed!');
    }
}
