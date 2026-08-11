<?php

declare(strict_types=1);

namespace Digitonma\LaravelSettings\Tests;

use PHPUnit\Framework\Attributes\Test;

/**
 * Class     SettingsServiceProviderTest
 *
 * @author   digiton-ma <contact@digiton.ma>
 */
class SettingsServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Digitonma\LaravelSettings\SettingsServiceProvider */
    private $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(\Digitonma\LaravelSettings\SettingsServiceProvider::class);
    }

    protected function tearDown(): void
    {
        unset($this->provider);

        parent::tearDown();
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    #[Test]
    public function it_can_be_instantiated(): void
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Illuminate\Contracts\Support\DeferrableProvider::class,
            \Digitonma\LaravelSettings\SettingsServiceProvider::class
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }

    #[Test]
    public function it_can_provides(): void
    {
        $expected = [
            \Digitonma\LaravelSettings\Contracts\Manager::class,
            \Digitonma\LaravelSettings\Contracts\Store::class,
        ];

        static::assertSame($expected, $this->provider->provides());
    }
}
