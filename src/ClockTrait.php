<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter;

use Psr\Clock\ClockInterface;

use function sleep;

trait ClockTrait
{
    /**
     * Advance time perceived by the cache for the purposes of testing TTL.
     *
     * The default implementation sleeps for the specified duration,
     * but subclasses are encouraged to override this,
     * adjusting a mocked time possibly speed up the tests.
     *
     * One could use {@see ModifiableClockTrait} for example, but this won't work for all adapters.
     *
     * @param non-negative-int $seconds
     */
    protected function advanceTime(int $seconds): void
    {
        sleep($seconds);
    }

    protected function getClock(): ClockInterface|null
    {
        return null;
    }
}
