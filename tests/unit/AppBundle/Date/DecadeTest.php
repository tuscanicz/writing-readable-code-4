<?php

declare(strict_types=1);

namespace AppBundle\Date;

use AppBundle\Date\Decade;
use PHPUnit\Framework\TestCase;

class DecadeTest extends TestCase
{
    public function testGetters(): void
    {
        $decade = new Decade(1000, 1001);

        self::assertEquals(1000, $decade->getYearFrom());
        self::assertEquals(1001, $decade->getYearTo());
    }
}
