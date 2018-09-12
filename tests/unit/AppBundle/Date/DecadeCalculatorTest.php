<?php

declare(strict_types=1);

namespace AppBundle\Date;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class DecadeCalculatorTest extends KernelTestCase
{
    /** @var DecadeCalculator */
    private $decadeCalculator;

    public function setUp(): void
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();

        $this->decadeCalculator = $container->get(DecadeCalculator::class);
    }

    /**
     * @param int $year
     * @param int $expectedYearTo
     * @dataProvider provideYearTo
     */
    public function testCalculateLastYearOfDecade(int $year, int $expectedYearTo): void
    {
        $actualYearTo = $this->decadeCalculator->calculateLastYearOfDecade($year);

        self::assertEquals($expectedYearTo, $actualYearTo);
    }

    /**
     * @param int $year
     * @param int $expectedYearFrom
     * @dataProvider provideYearFrom
     */
    public function testCalculateFirstYearOfDecade(int $year, int $expectedYearFrom): void
    {
        $actualYearFrom = $this->decadeCalculator->calculateFirstYearOfDecade($year);

        self::assertEquals($expectedYearFrom, $actualYearFrom);
    }

    public function testGetDecade(): void
    {
        $actualDecade = $this->decadeCalculator->getDecade(new PeriodEnum(PeriodEnum::PERIOD_THIRTIES));

        self::assertEquals(new Decade(1930, 1939), $actualDecade);
    }

    public function provideYearTo(): array
    {
        return [
            [-550, -541],
            [-549, -541],
            [-545, -541],
            [-540, -531],
            [-539, -531],
            [-20, -11],
            [-11, -11],
            [-10, -1],
            [-9, -1],
            [-2, -1],
            [-1, -1],
            [0, 9],
            [1, 9],
            [8, 9],
            [9, 9],
            [10, 19],
            [1900, 1909],
            [1930, 1939],
            [1990, 1999],
            [1999, 1999],
            [2000, 2009],
            [2001, 2009],
        ];
    }

    public function provideYearFrom(): array
    {
        return [
            [-550, -550],
            [-549, -550],
            [-545, -550],
            [-540, -540],
            [-539, -540],
            [-20, -20],
            [-11, -20],
            [-10, -10],
            [-9, -10],
            [-2, -10],
            [-1, -10],
            [0, 0],
            [1, 0],
            [8, 0],
            [9, 0],
            [10, 10],
            [1900, 1900],
            [1930, 1930],
            [1990, 1990],
            [1999, 1990],
            [2000, 2000],
            [2001, 2000],
        ];
    }
}
