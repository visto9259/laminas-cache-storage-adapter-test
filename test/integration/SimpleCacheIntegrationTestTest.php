<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use Laminas\Cache\Storage\StorageInterface;
use LaminasTest\Cache\Storage\Adapter\AbstractSimpleCacheIntegrationTest;

final class SimpleCacheIntegrationTestTest extends AbstractSimpleCacheIntegrationTest
{
    protected function createStorage(): StorageInterface
    {
        return AdapterForIntegrationTestDetector::detect();
    }
}
