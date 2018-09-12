<?php

declare(strict_types=1);

namespace AppBundle\Library\Book;

use AppBundle\Library\Book\Author\AnonymousAuthor;
use AppBundle\Library\Book\Author\Author;
use AppBundle\Number\IntegerList;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GoodBookListTest extends TestCase
{
    /**
     * @param GoodBookList $goodBookList
     * @param int $yearFrom
     * @param int $yearTo
     * @param GoodBookList $expectedGoodBookListFromPeriod
     * @dataProvider provideListsForPeriods
     */
    public function testGetBooksFromPeriod(GoodBookList $goodBookList, int $yearFrom, int $yearTo, GoodBookList $expectedGoodBookListFromPeriod): void
    {
        $actualGoodBookListFromPeriod = $goodBookList->getBooksFromPeriod($yearFrom, $yearTo);

        self::assertEquals($expectedGoodBookListFromPeriod, $actualGoodBookListFromPeriod);
    }

    public function testGetBooksFromPeriodWillFailOnEmptyList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot get books by period; no given');

        $goodBookList = new GoodBookList([]);
        $goodBookList->getBooksFromPeriod(1, 10000);
    }

    /**
     * @param GoodBookList $goodBookList
     * @param IntegerList $expectedIntegerList
     * @dataProvider provideListsForPageCounts
     */
    public function testGetBooksPageCount(GoodBookList $goodBookList, IntegerList $expectedIntegerList): void
    {
        $actualIntegerList = $goodBookList->getBooksPageCount();

        self::assertEquals($actualIntegerList, $expectedIntegerList);
    }

    public function testGetBooksPageCountWillFailOnEmptyList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot get number of book pages; none given');

        $goodBookList = new GoodBookList([]);
        $goodBookList->getBooksPageCount();
    }

    public function provideListsForPeriods(): array
    {
        $goodBookList = $this->getFullGoodBookList();

        return [
            [$goodBookList, -10, 10, new GoodBookList([])],
            [$goodBookList, 1920, 1920, new GoodBookList([])],
            [$goodBookList, 1961, 1966, new GoodBookList([
                new GoodBook(
                    '1967-666-0252',
                    'Moon landing',
                    'Moon landing Recipe. It is easy! 1. You need a space shuttle, a few astronauts as crew and gallons of fuel.',
                    new Author('Jane', 'Driver', 1965),
                    1966,
                    4
                ),
            ])],
            [$goodBookList, 1930, 2004, $goodBookList],
        ];
    }

    public function provideListsForPageCounts(): array
    {
        $goodBookList = $this->getFullGoodBookList();

        return [
            [$goodBookList, new IntegerList([1, 2, 3, 4, 4, 1200])],
        ];
    }

    private function getFullGoodBookList(): GoodBookList
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
}
