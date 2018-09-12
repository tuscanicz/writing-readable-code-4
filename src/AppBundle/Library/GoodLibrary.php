<?php

declare(strict_types=1);

namespace AppBundle\Library;

use AppBundle\Date\DecadeCalculator;
use AppBundle\Date\PeriodEnum;
use AppBundle\Library\Book\GoodBook;
use AppBundle\Library\Book\GoodBookList;
use AppBundle\Library\Book\Repository\BookRepository;
use AppBundle\Number\AverageCalculator;

class GoodLibrary
{
    private $bookRepository;
    private $decadeCalculator;
    private $averageCalculator;

    public function __construct(BookRepository $bookRepository, DecadeCalculator $decadeCalculator, AverageCalculator $averageCalculator)
    {
        $this->bookRepository = $bookRepository;
        $this->decadeCalculator = $decadeCalculator;
        $this->averageCalculator = $averageCalculator;
    }

    public function getAllBooks(): GoodBookList
    {
        return $this->bookRepository->getGoodBooks();
    }

    public function getBookById(string $bookId): GoodBook
    {
        $allBooks = $this->bookRepository->getGoodBooks();

        return $allBooks->getBooksById($bookId);
    }

    public function getBooksByAuthorName(string $authorName): GoodBookList
    {
        $allBooks = $this->bookRepository->getGoodBooks();

        return $allBooks->getBooksByAuthorName($authorName);
    }

    public function getBooksFromPeriod(PeriodEnum $period): GoodBookList
    {
        $allBooks = $this->bookRepository->getGoodBooks();
        $decade = $this->decadeCalculator->getDecade($period);

        return $allBooks->getBooksFromPeriod($decade->getYearFrom(), $decade->getYearTo());
    }
}
