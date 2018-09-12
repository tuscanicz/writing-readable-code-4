<?php

declare(strict_types=1);

namespace AppBundle\Date;

class DecadeCalculator
{
    private const DECADE_LENGTH = 10;

    public function getDecade(PeriodEnum $period): Decade
    {
        $yearFrom = $this->calculateFirstYearOfDecade($period->getValue());
        $yearTo = $this->calculateLastYearOfDecade($period->getValue());

        return new Decade($yearFrom, $yearTo);
    }

    public function calculateFirstYearOfDecade(int $year): int
    {
        if ($year % 10 === 0) {
            return $year;
        }

        return (int) floor($year / 10) * 10;
    }

    public function calculateLastYearOfDecade(int $year): int
    {
        return $this->calculateFirstYearOfDecade($year) + self::DECADE_LENGTH - 1;
    }
}
