<?php

declare(strict_types=1);

namespace AppBundle\Number;

use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AverageCalculatorTest extends KernelTestCase
{
    /** @var AverageCalculator */
    private $averageCalculator;

    public function setUp(): void
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();

        $this->averageCalculator = $container->get(AverageCalculator::class);
    }

    /**
     * @param IntegerList $numbers
     * @param float $expectedAverage
     * @dataProvider provideAverages
     */
    public function testCalculateAverage(IntegerList $numbers, float $expectedAverage): void
    {
        $actualAverage = $this->averageCalculator->calculateAverage($numbers);

        self::assertEquals($expectedAverage, $actualAverage);
    }

    public function testCalculateAverageWillFailWithEmptyList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot calculate average: empty array given');

        $this->averageCalculator->calculateAverage(new IntegerList([]));
    }

    public function provideAverages(): array
    {
        return [
            [new IntegerList([1, 2, 3, 4, 5]), 3.0],
            [new IntegerList([1]), 1.0],
            [new IntegerList([0, 10, 20, 40, 80, 120]), 45.0],
        ];
    }

}
