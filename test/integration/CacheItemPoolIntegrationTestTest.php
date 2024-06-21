<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use Laminas\Cache\Storage\Adapter\AdapterOptions;
use Laminas\Cache\Storage\Adapter\Memory;
use Laminas\Cache\Storage\FlushableInterface;
use Laminas\Cache\Storage\StorageInterface;
use LaminasTest\Cache\Storage\Adapter\AbstractCacheItemPoolIntegrationTest;

/**
 * @uses FlushableInterface
 *
 * @template-extends AbstractCacheItemPoolIntegrationTest<AdapterOptions>
 */
final class CacheItemPoolIntegrationTestTest extends AbstractCacheItemPoolIntegrationTest
{
    private const MEMORY_ADAPTER_PERSISTENCE = 'Memory adapter does not support deferred save without commit.';

    protected function setUp(): void
    {
        parent::setUp();
        /** @psalm-suppress UndefinedClass Memory adapter is not loaded during development. */
        if ($this->createStorage() instanceof Memory) {
            $this->skippedTests['testDeferredSaveWithoutCommit'] = self::MEMORY_ADAPTER_PERSISTENCE;
        }
    }

    protected function createStorage(): StorageInterface&FlushableInterface
    {
        return AdapterForIntegrationTestDetector::detect();
    }
}
