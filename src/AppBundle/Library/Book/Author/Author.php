<?php

declare(strict_types=1);

namespace AppBundle\Library\Book\Author;

class Author implements AuthorInterface
{
    private $name;
    private $surname;
    private $bornInYear;

    public function __construct(string $name, string $surname, int $bornInYear)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->bornInYear = $bornInYear;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getBornInYear(): int
    {
        return $this->bornInYear;
    }

    public function getDisplayName(): string
    {
        return implode(' ', [$this->getName(), $this->getSurname()]);
    }
}
