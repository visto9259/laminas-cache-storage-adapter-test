<?php

declare(strict_types=1);

namespace LaminasTest\Cache\Storage\Adapter;

use DateInterval;
use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;

use function assert;
use function sprintf;

/**
 * @psalm-api
 */
final class ModifiableClock implements ClockInterface
{
    private DateTimeImmutable $frozenTime;

    /** @var non-negative-int */
    private int $secondsToAdd = 0;

    public function __construct(DateTimeZone $timeZone)
    {
        $this->frozenTime = new DateTimeImmutable(timezone: $timeZone);
    }

    public function now(): DateTimeImmutable
    {
        $interval = DateInterval::createFromDateString(sprintf('%d seconds', $this->secondsToAdd));
        assert($interval !== false);
        return $this->frozenTime->add($interval);
    }

    /**
     * @param non-negative-int $seconds
     */
    public function addSeconds(int $seconds): void
    {
        $this->secondsToAdd += $seconds;
    }
}
