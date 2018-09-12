<?php

declare(strict_types=1);

namespace AppBundle\Library\Book\Repository;

use AppBundle\Library\Book\GoodBookList;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookRepositoryTest extends KernelTestCase
{
    /** @var BookRepository */
    private $bookRepository;

    public function setUp(): void
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $container = static::$kernel->getContainer();

        $this->bookRepository = $container->get(BookRepository::class);
    }

    public function testGetGoodBooks(): void
    {
        $actualGoodBooks = $this->bookRepository->getGoodBooks();

        self::assertInstanceOf(GoodBookList::class, $actualGoodBooks);
        self::assertSame(6, $actualGoodBooks->getBooksCount());
    }
}
