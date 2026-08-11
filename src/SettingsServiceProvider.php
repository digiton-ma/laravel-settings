<?php

declare(strict_types=1);

namespace Digitonma\LaravelSettings;

use Digitonma\LaravelSettings\Contracts\Manager as ManagerContract;
use Digitonma\LaravelSettings\Contracts\Store as StoreContract;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class     SettingsServiceProvider
 *
 * @author   digiton-ma <contact@digiton.ma>
 */
class SettingsServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'settings';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->registerSettingsManager();
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        SettingsManager::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();

        if ($this->app->runningInConsole()) {
            $this->publishConfig();
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            ManagerContract::class,
            StoreContract::class,
        ];
    }

    /* -----------------------------------------------------------------
     |  Config Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the package config.
     */
    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            $this->getBasePath().'/config/'.$this->package.'.php', $this->package
        );
    }

    /**
     * Publish the package config.
     */
    private function publishConfig(): void
    {
        $this->publishes([
            $this->getBasePath().'/config/'.$this->package.'.php' => config_path($this->package.'.php'),
        ], 'config');
    }

    /* -----------------------------------------------------------------
     |  Migration Methods
     | -----------------------------------------------------------------
     */

    /**
     * Publish the package migrations.
     */
    private function publishMigrations(): void
    {
        $this->publishes([
            $this->getBasePath().'/database/migrations' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Load the package migrations.
     */
    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom($this->getBasePath().'/database/migrations');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the Settings Manager & Store drivers.
     */
    private function registerSettingsManager(): void
    {
        $this->app->singleton(ManagerContract::class, SettingsManager::class);

        $this->app->extend(ManagerContract::class, function (ManagerContract $manager, $app) {
            foreach ($app['config']->get('settings.drivers', []) as $driver => $params) {
                $manager->registerStore($driver, $params);
            }

            return $manager;
        });

        $this->app->singleton(StoreContract::class, function ($app): StoreContract {
            return $app[ManagerContract::class]->driver();
        });
    }

    /**
     * Get the package base path.
     *
     * @return string
     */
    private function getBasePath(): string
    {
        return dirname(__DIR__);
    }
}
