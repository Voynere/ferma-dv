<?php

/**
 * Provides an API for all classes that are runnable.
 *
 * @since 1.0.0
 *
 * @package SolidWP\Mail\StellarWP\Telemetry\Contracts
 */
namespace SolidWP\Mail\StellarWP\Telemetry\Contracts;

/**
 * Provides an API for all classes that are runnable.
 *
 * @since 1.0.0
 *
 * @package \SolidWP\Mail\StellarWP\Telemetry\Contracts
 */
interface Runnable
{
    /**
     * Run the intended action.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function run();
}