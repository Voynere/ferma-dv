<?php

/**
 * The API implemented by all subscribers.
 *
 * @package SolidWP\Mail\StellarWP\Telemetry\Contracts
 */
namespace SolidWP\Mail\StellarWP\Telemetry\Contracts;

/**
 * Interface Subscriber_Interface
 *
 * @package \SolidWP\Mail\StellarWP\Telemetry\Contracts
 */
interface Subscriber_Interface
{
    /**
     * Register action/filter listeners to hook into WordPress
     *
     * @return void
     */
    public function register();
}