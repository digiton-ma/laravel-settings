<?php

declare(strict_types=1);

namespace Digitonma\LaravelSettings\Contracts;

use Closure;

/**
 * Interface  Manager
 *
 * @author    digiton-ma <contact@digiton.ma>
 */
interface Manager
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver();

    /**
     * Get all of the created "drivers".
     *
     * @return array
     */
    public function getDrivers();

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a driver instance.
     *
     * @param  string|null  $driver
     *
     * @return \Digitonma\LaravelSettings\Contracts\Store
     */
    public function driver($driver = null);

    /**
     * Register a custom driver creator Closure.
     *
     * @param  string    $driver
     * @param  \Closure  $callback
     *
     * @return $this
     */
    public function extend($driver, Closure $callback);

    /**
     * Register a new store.
     *
     * @param  string  $driver
     * @param  array   $params
     *
     * @return $this
     */
    public function registerStore(string $driver, array $params);
}
