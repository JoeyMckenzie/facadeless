<?php

declare(strict_types=1);

namespace Tests\Concerns;

use Facadeless\FacadelessConfiguration;
use Facadeless\FacadelessRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @mixin RuleTestCase<FacadelessRule>
 */
trait TestsFacadelessRule
{
    private FacadelessRule $rule {
        get {
            $config = new FacadelessConfiguration;
            $this->rule = new FacadelessRule($config);

            return $this->rule;
        }
        set {
            $this->rule = $value;
        }
    }

    protected function getRule(): Rule
    {
        return $this->rule;
    }
}
