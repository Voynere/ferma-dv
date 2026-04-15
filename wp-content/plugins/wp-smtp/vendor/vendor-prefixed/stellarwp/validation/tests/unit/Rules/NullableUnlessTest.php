<?php

namespace SolidWP\Mail\unit\Rules;

use SolidWP\Mail\StellarWP\FieldConditions\Contracts\ConditionSet;
use SolidWP\Mail\StellarWP\Validation\Commands\SkipValidationRules;
use SolidWP\Mail\StellarWP\Validation\Rules\NullableUnless;
use SolidWP\Mail\StellarWP\Validation\Tests\TestCase;

class NullableUnlessTest extends TestCase
{
    /**
     * @since 1.2.0
     */
    public function testShouldReturnSkipValidationRulesWhenConditionFails()
    {
        $mockConditionSet = $this->createMock(ConditionSet::class);
        $mockConditionSet->method('fails')->willReturn(true);

        $nullable = new NullableUnless($mockConditionSet);

        self::assertValidationRuleDoesReturnCommandInstance($nullable, SkipValidationRules::class);
    }

    /**
     * @since 1.2.0
     */
    public function testShouldNotReturnSkipValidationRulesWhenConditionsPass()
    {
        $mockConditionSet = $this->createMock(ConditionSet::class);
        $mockConditionSet->method('fails')->willReturn(false);

        $nullable = new NullableUnless($mockConditionSet);

        self::assertValidationRuleDoesNotReturnCommandInstance($nullable, SkipValidationRules::class);
    }
}
