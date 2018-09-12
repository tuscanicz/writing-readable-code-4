<?php

declare(strict_types=1);

namespace AppBundle\Library\Book;

use AppBundle\Library\Book\Author\AuthorInterface;

class GoodBook
{
    private $id;
    private $title;
    private $body;
    private $author;
    private $publishedInYear;
    private $numberOfPages;

    public function __construct(string $id, string $title, string $body, AuthorInterface $author, int $publishedInYear, int $numberOfPages)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->author = $author;
        $this->publishedInYear = $publishedInYear;
        $this->numberOfPages = $numberOfPages;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAuthor(): AuthorInterface
    {
        return $this->author;
    }

    public function getPublishedInYear(): int
    {
        return $this->publishedInYear;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }
}
