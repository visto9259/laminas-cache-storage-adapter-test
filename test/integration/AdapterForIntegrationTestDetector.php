<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use Composer\InstalledVersions;
use Laminas\Cache\Exception\RuntimeException;
use Laminas\Cache\Storage\Adapter\Apcu;
use Laminas\Cache\Storage\Adapter\Memory;
use Laminas\Cache\Storage\StorageInterface;

use function assert;
use function class_exists;
use function is_a;

final class AdapterForIntegrationTestDetector
{
    /**
     * @psalm-suppress MixedInferredReturnType Due to recursive dependencies, we can not have APCu installed as during
     *                                         development. Will be installed during CI via `.laminas-ci.json`.
     */
    public static function detect(): StorageInterface
    {
        if (InstalledVersions::isInstalled('laminas/laminas-cache-storage-adapter-apcu')) {
            assert(class_exists(Apcu::class));
            assert(is_a(Apcu::class, StorageInterface::class));
            /**
             * @psalm-suppress MixedReturnStatement Due to recursive dependencies, we can not have APCu installed as
             *                                        during development. Will be installed during CI via
             *                                        `.laminas-ci.json`.
             */
            return new Apcu();
        }

        if (InstalledVersions::isInstalled('laminas/laminas-cache-storage-adapter-memory')) {
            assert(class_exists(Memory::class));
            assert(is_a(Memory::class, StorageInterface::class));
            /**
             * @psalm-suppress MixedReturnStatement Due to recursive dependencies, we can not have Memory installed as
             *                                        during development. Will be installed during CI via
             *                                        `.laminas-ci.json`.
             */
            return new Memory();
        }

        throw new RuntimeException('Unable to detect storage adapter for integration tests.');
    }
}
