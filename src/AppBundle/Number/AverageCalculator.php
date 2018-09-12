<?php

declare(strict_types=1);

namespace AppBundle\Number;

use InvalidArgumentException;

class AverageCalculator
{
    public function calculateAverage(IntegerList $numbers): float
    {
        $sum = 0;
        if ($numbers->getIntegersCount() > 0) {
            foreach ($numbers->getIntegers() as $number) {
                $sum += $number;
            }

            return $sum / $numbers->getIntegersCount();
        }

        throw new InvalidArgumentException('Cannot calculate average: empty array given');
    }
}
