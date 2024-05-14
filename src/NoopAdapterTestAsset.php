<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter;

use Laminas\Cache\Storage\Adapter\AbstractAdapter;
use Laminas\Cache\Storage\Adapter\AdapterOptions;

/**
 * @template-extends AbstractAdapter<AdapterOptions>
 */
final class NoopAdapterTestAsset extends AbstractAdapter
{
    protected function internalGetItem(string $normalizedKey, ?bool &$success = null, mixed &$casToken = null): mixed
    {
        $success = false;
        return null;
    }

    protected function internalSetItem(string $normalizedKey, mixed $value): bool
    {
        return true;
    }

    protected function internalRemoveItem(string $normalizedKey): bool
    {
        return true;
    }
}
