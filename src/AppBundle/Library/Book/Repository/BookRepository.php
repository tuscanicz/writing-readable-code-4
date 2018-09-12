<?php

declare(strict_types=1);

namespace AppBundle\Library\Book\Repository;

use AppBundle\Library\Book\Author\AnonymousAuthor;
use AppBundle\Library\Book\Author\Author;
use AppBundle\Library\Book\EvilBook;
use AppBundle\Library\Book\GoodBook;
use AppBundle\Library\Book\GoodBookList;

class BookRepository
{
    public function getGoodBooks(): GoodBookList
    {
        $fakeAuthor = new Author('John', 'Fake', 1965);
        $randomAuthor = new Author('George', 'Random', 1965);
        $driverAuthor = new Author('Jane', 'Driver', 1965);

        return new GoodBookList([
            new GoodBook('1234-567-8901', 'Test book', 'Lorem ipsum', $fakeAuthor, 1930, 1),
            new GoodBook('1234-567-8902', 'Test book II', 'Lorem ipsum - almost the same book', $fakeAuthor, 1931, 2),
            new GoodBook('1949-777-0001', 'Random', 'Lorem ipsum - I have copied the book from John Fake', $randomAuthor, 1960, 3),
            new GoodBook('1967-666-0252', 'Moon landing', 'Moon landing Recipe. It is easy! 1. You need a space shuttle, a few astronauts as crew and gallons of fuel.', $driverAuthor, 1966, 4),
            new GoodBook('1968-745-0004', 'Book of truth', 'Return null is evil. I do not really know why, but you will find out', $randomAuthor, 1968, 4),
            new GoodBook('4321-765-0000', 'Bible', 'In the beginning God created the heavens and the earth', new AnonymousAuthor(), 2004, 1200),
        ]);
    }

    /**
     * @return EvilBook[]
     */
    public function getEvilBooks(): array
    {
        $fakeAuthor = new Author('John', 'Fake', 1965);
        $randomAuthor = new Author('George', 'Random', 1965);
        $driverAuthor = new Author('Jane', 'Driver', 1965);

        return [
            new EvilBook('1234-567-8901', 'Test book', 'Lorem ipsum', $fakeAuthor, 1930, 1),
            new EvilBook('1234-567-8902', 'Test book II', 'Lorem ipsum - almost the same book', $fakeAuthor, 1931, 2),
            new EvilBook('1949-777-0001', 'Random', 'Lorem ipsum - I have copied the book from John Fake', $randomAuthor, 1960, 3),
            new EvilBook('1967-666-0252', 'Moon landing', 'Moon landing Recipe. It is easy! 1. You need a space shuttle, a few astronauts as crew and gallons of fuel.', $driverAuthor, 1966, 4),
            new EvilBook('1968-745-0004', 'Book of truth', 'Return null is evil. I do not really know why, but you will find out', $randomAuthor, 1968, 4),
            new EvilBook('4321-765-0000', 'Bible', 'In the beginning God created the heavens and the earth', null, 2004, 1200),
        ];
    }
}
