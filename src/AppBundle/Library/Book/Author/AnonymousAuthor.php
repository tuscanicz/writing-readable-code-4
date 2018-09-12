<?php

declare(strict_types=1);

namespace AppBundle\Library\Book\Author;

class AnonymousAuthor implements AuthorInterface
{
    public function getDisplayName(): string
    {
        return 'author.anonymous_name';
    }
}
