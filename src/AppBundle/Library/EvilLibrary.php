<?php

declare(strict_types=1);

namespace AppBundle\Library;

use AppBundle\Date\DecadeCalculator;
use AppBundle\Date\PeriodEnum;
use AppBundle\Library\Book\EvilBook;
use AppBundle\Library\Book\GoodBook;
use AppBundle\Library\Book\GoodBookList;
use AppBundle\Library\Book\Repository\BookRepository;
use AppBundle\Number\AverageCalculator;

class EvilLibrary
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

    /**
     * @param PeriodEnum|null $period
     * @return EvilBook[]
     */
    public function getBooks(?PeriodEnum $period): array
    {
        $allBooks = $this->bookRepository->getEvilBooks();
        if ($period === null) {
            return $allBooks;
        }

        $floor = floor($period->getValue() / 10) * 10;
        $return = [];
        foreach ($allBooks as $book) {
            if ($book->getPublishedInYear() >= $floor && $book->getPublishedInYear() <= $floor + 9) {
                $return[] = $book;
            }
        }

        return $return;
    }

    /**
     * @param string|null $authorName
     * @return EvilBook[]|null
     */
    public function getBooksByAuthorName(?string $authorName): ?array
    {
        $allBooks = $this->bookRepository->getEvilBooks();
        $return = [];
        foreach ($allBooks as $book) {
            if ($book->getAuthor() === $authorName) {
                $return[] = $book;
            }

            return $return;
        }

        return null;
    }

    public function getBookById(string $bookId): ?EvilBook
    {
        $return = null;
        $allBooks = $this->bookRepository->getEvilBooks();
        foreach ($allBooks as $book) {
            if ($book->getId() === $bookId) {
                return $book;
            }
        }

        return null;
    }
}
