<?php

declare(strict_types=1);

namespace AppBundle\Library;

use AppBundle\Date\PeriodEnum;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LibraryStatisticsTest extends KernelTestCase
{
    /** @var LibraryStatistics */
    private $libraryStatistics;

    public function setUp(): void
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();

        $this->libraryStatistics = $container->get(LibraryStatistics::class);
    }

    /**
     * @param PeriodEnum $period
     * @param $expectedAverage
     * @dataProvider providePeriodsAndAverages
     */
    public function testGetAverageNumberOfPagesInPeriod(PeriodEnum $period, $expectedAverage): void
    {
        $actualAverage = $this->libraryStatistics->getAverageNumberOfPagesInPeriod($period);
        self::assertEquals($expectedAverage, $actualAverage);
    }

    public function testGetAverageNumberOfPagesInPeriodWillFailForNoBooksGiven(): void
    {
        $this->expectException(CannotCalculateStatisticsException::class);
        $this->expectExceptionMessage('Cannot get number of book pages; none given');

        $period = new PeriodEnum(PeriodEnum::PERIOD_FORTIES);
        $this->libraryStatistics->getAverageNumberOfPagesInPeriod($period);
    }

    public function providePeriodsAndAverages(): array
    {
        return [
            [new PeriodEnum(PeriodEnum::PERIOD_THIRTIES), 1.5],
            [new PeriodEnum(PeriodEnum::PERIOD_SIXTIES), 3.6666666666666665],
        ];
    }
}
