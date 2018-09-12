<?php

declare(strict_types=1);

namespace AppBundle\Number;

class IntegerList
{
    private $integers;

    /**
     * @param int[] $integers
     */
    public function __construct(array $integers)
    {
        $this->integers = $integers;
    }

    public function hasIntegers(): bool
    {
        return $this->getIntegersCount() > 0;
    }

    public function getIntegersCount(): int
    {
        return count($this->integers);
    }

    /**
     * @return int[]
     */
    public function getIntegers(): array
    {
        return $this->integers;
    }
}
