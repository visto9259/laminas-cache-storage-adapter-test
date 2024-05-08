<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter\TestAsset;

use Laminas\Cache\Storage\AbstractMetadataCapableAdapter;
use Laminas\Cache\Storage\Adapter\AdapterOptions;

/**
 * @template-extends AbstractMetadataCapableAdapter<AdapterOptions,MockAdapterMetadata>
 */
final class MockAdapter extends AbstractMetadataCapableAdapter
{
    /** @var array<string, mixed> */
    private array $data = [];

    protected function internalGetItem(
        string $normalizedKey,
        bool|null &$success = null,
        mixed &$casToken = null
    ): mixed {
        $ns      = $this->options->getNamespace();
        $success = isset($this->data[$ns][$normalizedKey]) && $this->options->getReadable();

        if (! $success) {
            return null;
        }

        return $casToken = $this->data[$ns][$normalizedKey];
    }

    protected function internalSetItem(string $normalizedKey, mixed $value): bool
    {
        $ns                              = $this->options->getNamespace();
        $this->data[$ns][$normalizedKey] = $value;

        return true;
    }

    protected function internalRemoveItem(string $normalizedKey): bool
    {
        $ns = $this->options->getNamespace();
        if (! isset($this->data[$ns][$normalizedKey])) {
            return false;
        }

        unset($this->data[$ns][$normalizedKey]);

        return true;
    }

    protected function internalGetMetadata(string $normalizedKey): ?object
    {
        $ns = $this->options->getNamespace();

        if (! isset($this->data[$ns][$normalizedKey])) {
            return null;
        }

        return new MockAdapterMetadata();
    }
}
