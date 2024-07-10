<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

use DateTimeInterface;
use DateTimeZone;
use LaminasTest\Cache\Storage\Adapter\ModifiableClock;
use PHPUnit\Framework\TestCase;

use function date_default_timezone_get;

final class ModifiableClockTest extends TestCase
{
    public function testAddSecondsAddsUpSeconds(): void
    {
        $clock = new ModifiableClock(new DateTimeZone(date_default_timezone_get()));
        $time  = $clock->now();

        $clock->addSeconds(2);
        $timeWithAddedSeconds = $clock->now();

        self::assertSame(
            $time->modify('2 seconds')->format(DateTimeInterface::ATOM),
            $timeWithAddedSeconds->format(DateTimeInterface::ATOM),
        );

        $clock->addSeconds(2);
        $timeWithAddedSeconds = $clock->now();

        self::assertSame(
            $time->modify('4 seconds')->format(DateTimeInterface::ATOM),
            $timeWithAddedSeconds->format(DateTimeInterface::ATOM),
        );
    }
}
