<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter;

use DateTimeZone;

use function date_default_timezone_get;

trait ModifiableClockTrait
{
    private ?ModifiableClock $modifiableClock = null;

    /**
     * Advance time perceived by the cache for the purposes of testing TTL.
     * This method uses the modifiable clock to internally add seconds to a frozen timestamp.
     *
     * @param non-negative-int $seconds
     */
    protected function advanceTime(int $seconds): void
    {
        $this->modifiableClock?->addSeconds($seconds);
    }

    protected function getClock(): ModifiableClock
    {
        if ($this->modifiableClock !== null) {
            return $this->modifiableClock;
        }
        return $this->modifiableClock = new ModifiableClock(new DateTimeZone(date_default_timezone_get()));
    }
}
