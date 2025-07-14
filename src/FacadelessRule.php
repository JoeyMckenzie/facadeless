<?php

declare(strict_types=1);

namespace Facadeless;

use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\IdentifierRuleError;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;

/**
 * @implements Rule<StaticCall>
 */
final readonly class FacadelessRule implements Rule
{
    public function __construct(
        private FacadelessConfiguration $config
    ) {
        //
    }

    public function getNodeType(): string
    {
        return StaticCall::class;
    }

    /**
     * @return list<IdentifierRuleError>
     *
     * @throws FacadelessException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node->class instanceof Node\Name) {
            return [];
        }

        /** @var class-string $className */
        $className = $scope->resolveName($node->class);

        if ($this->config->isAllowed($className)) {
            return [];
        }

        $tip = 'Use a corresponding contract interface instead.';
        $suggested = $this->config->getSuggestedContract($className);

        if ($suggested !== null) {
            $tip = sprintf('Consider using dependency injection via the "%s" interface.', $suggested);
        }

        try {
            return [
                RuleErrorBuilder::message(
                    sprintf('Use of facade "%s" is not allowed.', $className),
                )
                    ->tip($tip)
                    ->identifier('facade.banned')
                    ->build(),
            ];
        } catch (ShouldNotHappenException $e) {
            throw FacadelessException::withFacade($className, $e);
        }
    }
}
