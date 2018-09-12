<?php

declare(strict_types=1);

namespace AppBundle\Library;

use AppBundle\Date\PeriodEnum;
use AppBundle\Number\AverageCalculator;
use InvalidArgumentException;

class LibraryStatistics
{
    private $goodLibrary;
    private $evilLibrary;
    private $averageCalculator;

    public function __construct(GoodLibrary $goodLibrary, EvilLibrary $evilLibrary, AverageCalculator $averageCalculator)
    {
        $this->goodLibrary = $goodLibrary;
        $this->evilLibrary = $evilLibrary;
        $this->averageCalculator = $averageCalculator;
    }

    public function getAverageNumberOfPagesInPeriod(PeriodEnum $period): float
    {
        try {
            $allBooksFromPeriod = $this->goodLibrary->getBooksFromPeriod($period);

            return $this->averageCalculator->calculateAverage($allBooksFromPeriod->getBooksPageCount());

        } catch (InvalidArgumentException $e) {
            throw new CannotCalculateStatisticsException($e->getMessage());
        }
    }

    public function getEvilNumberOfPagesInPeriod(?PeriodEnum $periodEnum): float
    {
        $filteredBooks = $this->evilLibrary->getBooks($periodEnum);
        $sum = 0;
        foreach ($filteredBooks as $book) {
            $sum += $book->getNumberOfPages();
        }

        return $sum / count($filteredBooks);
    }

    public function compareLibraryApi(): void
    {
        $this->evilLibrary->getBooksByAuthorName('Franta');
        $this->goodLibrary->getBooksByAuthorName('Franta');
    }
}
