<?php

declare(strict_types=1);

namespace SolidWP\Mail\StellarWP\Validation\Tests\Unit\Rules;

use SolidWP\Mail\StellarWP\FieldConditions\Contracts\ConditionSet;
use SolidWP\Mail\StellarWP\Validation\Commands\ExcludeValue;
use SolidWP\Mail\StellarWP\Validation\Rules\ExcludeIf;
use SolidWP\Mail\StellarWP\Validation\Tests\TestCase;

class ExcludeIfTest extends TestCase
{
    /**
     * @since 1.2.0
     */
    public function testShouldReturnExcludedValueWhenConditionPasses()
    {
        $mockConditionSet = $this->createMock(ConditionSet::class);
        $mockConditionSet->method('passes')->willReturn(true);

        $exclude = new ExcludeIf($mockConditionSet);

        self::assertValidationRuleDoesReturnCommandInstance($exclude, ExcludeValue::class);
    }

    /**
     * @since 1.2.0
     */
    public function testShouldNotReturnExcludeValueWhenConditionsFail()
    {
        $mockConditionSet = $this->createMock(ConditionSet::class);
        $mockConditionSet->method('passes')->willReturn(false);

        $exclude = new ExcludeIf($mockConditionSet);

        self::assertValidationRuleDoesNotReturnCommandInstance($exclude, ExcludeValue::class);
    }
}
