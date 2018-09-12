<?php

declare(strict_types=1);

namespace AppBundle\Library\Book;

use AppBundle\Number\IntegerList;
use InvalidArgumentException;

class GoodBookList
{
    private $books;

    /**
     * @param GoodBook[] $books
     */
    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function hasBooks(): bool
    {
        return $this->getBooksCount() > 0;
    }

    public function getBooksCount(): int
    {
        return count($this->books);
    }

    /**
     * @return GoodBook[]
     */
    public function getBooks(): array
    {
        return $this->books;
    }

    public function getBooksById(string $bookId): GoodBook
    {
        if ($this->hasBooks() === true) {
            foreach ($this->getBooks() as $book) {
                if ($book->getId() === $bookId) {
                    return $book;
                }
            }

            throw new InvalidArgumentException('Cannot get books by id:' . $bookId);
        }

        throw new InvalidArgumentException('Cannot get books by id; no given');
    }

    public function getBooksByAuthorName(string $authorName): self
    {
        if ($this->hasBooks() === true) {
            $filteredBooks = [];
            foreach ($this->getBooks() as $book) {
                if ($book->getAuthor()->getDisplayName() === $authorName) {
                    $filteredBooks[] = $book;
                }
            }

            return new self($filteredBooks);
        }

        throw new InvalidArgumentException('Cannot get books by name; no given');
    }

    public function getBooksFromPeriod(int $yearFrom, int $yearTo): self
    {
        if ($this->hasBooks() === true) {
            $filteredBooks = [];
            foreach ($this->getBooks() as $book) {
                if ($book->getPublishedInYear() >= $yearFrom && $book->getPublishedInYear() <= $yearTo) {
                    $filteredBooks[] = $book;
                }
            }

            return new self($filteredBooks);
        }

        throw new InvalidArgumentException('Cannot get books by period; no given');
    }

    public function getBooksPageCount(): IntegerList
    {
        if ($this->hasBooks() === true) {
            $numberOfPages = [];
            foreach ($this->getBooks() as $book) {
                $numberOfPages[] = $book->getNumberOfPages();
            }

            return new IntegerList($numberOfPages);
        }

        throw new InvalidArgumentException('Cannot get number of book pages; none given');
    }
}
