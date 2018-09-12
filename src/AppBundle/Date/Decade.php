<?php

declare(strict_types=1);

namespace AppBundle\Date;

class Decade
{
    private $yearFrom;
    private $yearTo;

    public function __construct(int $yearFrom, int $yearTo)
    {
        $this->yearFrom = $yearFrom;
        $this->yearTo = $yearTo;
    }

    public function getYearFrom(): int
    {
        return $this->yearFrom;
    }

    public function getYearTo(): int
    {
        return $this->yearTo;
    }
}
