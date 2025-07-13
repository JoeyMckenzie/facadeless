<?php

declare(strict_types=1);

namespace Facadeless;

use Exception;
use Throwable;

final class FacadelessException extends Exception
{
    private function __construct(string $message, Throwable $previous)
    {
        parent::__construct($message, previous: $previous);
    }

    /**
     * @param  class-string  $classString
     */
    public static function withFacade(string $classString, Throwable $previous): self
    {
        return new self('An error occurred while running rule for facade '.$classString, $previous);
    }
}
