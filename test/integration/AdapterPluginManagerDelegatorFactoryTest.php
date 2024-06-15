<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use Laminas\Cache\Storage\AdapterPluginManager;
use LaminasTest\Cache\Storage\Adapter\PluginManagerDelegatorFactoryTestTrait;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

final class AdapterPluginManagerDelegatorFactoryTest extends TestCase
{
    use PluginManagerDelegatorFactoryTestTrait;

    public static function getCommonAdapterNamesProvider(): iterable
    {
        return [];
    }

    public function getDelegatorFactory(): callable
    {
        return fn (ContainerInterface $container) => new AdapterPluginManager($container);
    }
}
