<?php

declare(strict_types=1);

namespace SolidWP\Mail\StellarWP\Validation\Tests\Unit\Rules;

use SolidWP\Mail\StellarWP\Validation\Commands\ExcludeValue;
use SolidWP\Mail\StellarWP\Validation\Rules\Exclude;
use SolidWP\Mail\StellarWP\Validation\Tests\TestCase;

class ExcludeTest extends TestCase
{
    /**
     * @since 1.2.0
     */
    public function testShouldReturnExcludedValueWhenUsed()
    {
        $exclude = new Exclude();

        self::assertInstanceOf(ExcludeValue::class, $exclude(null, function() {}, 'foo', []));
    }
}
