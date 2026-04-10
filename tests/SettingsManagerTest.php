<?php

declare(strict_types=1);

namespace Digitonma\LaravelSettings\Tests;

/**
 * Class     SettingsManagerTest
 *
 * @author   digiton-ma <contact@digiton.ma>
 */
class SettingsManagerTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Digitonma\LaravelSettings\Contracts\Manager */
    protected $manager;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = $this->getSettingsManager();
    }

    protected function tearDown(): void
    {
        unset($this->manager);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            \Digitonma\LaravelSettings\Contracts\Manager::class,
            \Digitonma\LaravelSettings\SettingsManager::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->manager);
        }
    }

    /** @test */
    public function it_can_be_instantiated_with_helper(): void
    {
        $expectations = [
            \Digitonma\LaravelSettings\Contracts\Manager::class,
            \Digitonma\LaravelSettings\SettingsManager::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, settings());
        }
    }

    /** @test */
    public function it_can_get_default_store_name(): void
    {
        static::assertSame('json', $this->manager->getDefaultDriver());
    }

    /** @test */
    public function it_can_get_default_store_by_contract(): void
    {
        $store = $this->app->make(\Digitonma\LaravelSettings\Contracts\Store::class);

        $expectations = [
            \Digitonma\LaravelSettings\Contracts\Store::class,
            \Digitonma\LaravelSettings\Stores\JsonStore::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $store);
        }
    }

    /** @test */
    public function it_can_get_store_by_name(): void
    {
        $expectations = [
            'array'    => \Digitonma\LaravelSettings\Stores\ArrayStore::class,
            'database' => \Digitonma\LaravelSettings\Stores\DatabaseStore::class,
            'json'     => \Digitonma\LaravelSettings\Stores\JsonStore::class,
        ];

        foreach ($expectations as $name => $expected) {
            $store = $this->manager->driver($name);

            static::assertInstanceOf(\Digitonma\LaravelSettings\Contracts\Store::class, $store);
            static::assertInstanceOf($expected, $store);
        }
    }

    /** @test */
    public function it_can_get_store_by_name_via_helper(): void
    {
        $expectations = [
            'array'    => \Digitonma\LaravelSettings\Stores\ArrayStore::class,
            'database' => \Digitonma\LaravelSettings\Stores\DatabaseStore::class,
            'json'     => \Digitonma\LaravelSettings\Stores\JsonStore::class,
        ];

        foreach ($expectations as $name => $expected) {
            $store = settings($name);

            static::assertInstanceOf(\Digitonma\LaravelSettings\Contracts\Store::class, $store);
            static::assertInstanceOf($expected, $store);
        }
    }
}
