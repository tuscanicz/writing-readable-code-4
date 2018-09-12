<?php

declare(strict_types=1);

namespace AppBundle\Library;

use Exception;

class CannotCalculateStatisticsException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message, 0);
    }
}
