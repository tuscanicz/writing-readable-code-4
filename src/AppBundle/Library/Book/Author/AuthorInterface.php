<?php

declare(strict_types=1);

namespace AppBundle\Library\Book\Author;

interface AuthorInterface
{
    public function getDisplayName(): string;
}
