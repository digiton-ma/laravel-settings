<?php

declare(strict_types=1);

use Digitonma\LaravelSettings\Contracts\Manager;

if ( ! function_exists('settings')) {
    /**
     * Get the settings manager instance.
     *
     * @param  string|null  $driver
     *
     * @return \Digitonma\LaravelSettings\Contracts\Manager|\Digitonma\LaravelSettings\Contracts\Store
     */
    function settings($driver = null) {
        /** @var  \Digitonma\LaravelSettings\Contracts\Manager  $manager */
        $manager = app(Manager::class);

        return $driver ? $manager->driver($driver) : $manager;
    }
}
