<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use Laminas\Cache\Storage\Adapter\Apcu;
use Laminas\Cache\Storage\StorageInterface;
use LaminasTest\Cache\Storage\Adapter\AbstractCacheItemPoolIntegrationTest;

final class CacheItemPoolIntegrationTestTest extends AbstractCacheItemPoolIntegrationTest
{
    protected function setUp(): void
    {
        $this->skippedTests['testHasItemReturnsFalseWhenDeferredItemIsExpired']
            = 'Skipping since laminas-cache does not yet handle `expiresAt` properly.'
            . ' See https://github.com/laminas/laminas-cache/pull/199';

        parent::setUp();
    }

    /**
     * @psalm-suppress InvalidReturnType Due to recursive dependencies, we can not have APCu installed as during
     *                                   development. Will be installed during CI via `.laminas-ci.json`.
     */
    protected function createStorage(): StorageInterface
    {
        /**
         * @psalm-suppress UndefinedClass Due to recursive dependencies, we can not have APCu installed as during
         *                                development. Will be installed during CI via `.laminas-ci.json`.
         * @psalm-suppress InvalidReturnStatement Due to recursive dependencies, we can not have APCu installed as
         *                                        during development. Will be installed during CI via
         *                                        `.laminas-ci.json`.
         */
        return new Apcu();
    }
}
