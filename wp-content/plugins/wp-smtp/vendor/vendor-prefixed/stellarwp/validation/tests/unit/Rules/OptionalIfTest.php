<?php

namespace SolidWP\Mail\unit\Rules;

use SolidWP\Mail\StellarWP\FieldConditions\Contracts\ConditionSet;
use SolidWP\Mail\StellarWP\Validation\Commands\SkipValidationRules;
use SolidWP\Mail\StellarWP\Validation\Rules\OptionalIf;
use SolidWP\Mail\StellarWP\Validation\Tests\TestCase;

class OptionalIfTest extends TestCase
{
    /**
     * @since 1.2.0
     */
    public function testShouldReturnSkipValidationRulesWhenConditionPasses()
    {
        $mockConditionSet = $this->generatePassingConditionSet();

        $optional = new OptionalIf($mockConditionSet);

        self::assertValidationRuleDoesReturnCommandInstance($optional, SkipValidationRules::class, null);
    }

    /**
     * @since 1.2.0
     */
    public function testShouldSkipWhenConditionsPassAndValueIsEmptyString()
    {
        $mockConditionSet = $this->generatePassingConditionSet();

        $optional = new OptionalIf($mockConditionSet);

        self::assertValidationRuleDoesReturnCommandInstance($optional, SkipValidationRules::class, '');
    }

    /**
     * @since 1.2.0
     */
    public function testShouldNotSkipWhenConditionsPassAndValueIsNotEmpty()
    {
        $mockConditionSet = $this->generatePassingConditionSet();

        $optional = new OptionalIf($mockConditionSet);

        self::assertValidationRuleDoesNotReturnCommandInstance($optional, SkipValidationRules::class, 'nope');
    }

    /**
     * @since 1.2.0
     */
    public function testShouldNotReturnSkipValidationRulesWhenConditionFails()
    {
        $mockConditionSet = $this->createMock(ConditionSet::class);
        $mockConditionSet->method('passes')->willReturn(false);

        $optional = new OptionalIf($mockConditionSet);

        self::assertValidationRuleDoesNotReturnCommandInstance($optional, SkipValidationRules::class);
    }

    /**
     * @since 1.2.0
     */
    private function generatePassingConditionSet()
    {
        $mockConditionSet = $this->createMock(ConditionSet::class);
        $mockConditionSet->method('passes')->willReturn(true);

        return $mockConditionSet;
    }
}
