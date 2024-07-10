<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use DateTimeInterface;
use LaminasTest\Cache\Storage\Adapter\ModifiableClockTrait;
use PHPUnit\Framework\TestCase;

final class ModifiableClockTraitTest extends TestCase
{
    use ModifiableClockTrait;

    public function testGetClockReturnsSameClockWhenCallingMultipleTimes(): void
    {
        $clock = $this->getClock();
        self::assertSame($clock, $this->getClock());
    }

    public function testAdvanceTimeCanBeCalledWithoutInitializingClock(): void
    {
        self::assertNull($this->modifiableClock);
        $this->advanceTime(10);
    }

    public function testAdvanceTimePassesSecondsToModifiableClock(): void
    {
        $clock = $this->getClock();
        $time  = $clock->now();

        $this->advanceTime(10);
        self::assertSame(
            $time->modify('10 seconds')->format(DateTimeInterface::ATOM),
            $clock->now()->format(DateTimeInterface::ATOM),
        );
    }
}
