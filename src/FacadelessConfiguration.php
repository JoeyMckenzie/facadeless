<?php

declare(strict_types=1);

namespace Facadeless;

final readonly class FacadelessConfiguration
{
    /**
     * @param  class-string[]  $bannedFacades
     * @param  array<array-key, class-string>  $correspondingFacadeContracts
     */
    public function __construct(
        private array $bannedFacades,
        private array $correspondingFacadeContracts = []
    ) {}

    public function isBanned(string $className): bool
    {
        return in_array($className, $this->bannedFacades, true);
    }

    /**
     * @return class-string|null
     */
    public function getSuggestedContract(string $className): ?string
    {
        return $this->correspondingFacadeContracts[$className] ?? null;
    }
}
