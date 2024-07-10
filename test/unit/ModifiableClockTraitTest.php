<?php

declare(strict_types=1);

namespace LaminasTestTest\Cache\Storage\Adapter;

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
}
