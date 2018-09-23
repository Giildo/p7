<?php

namespace App\Application\APIs\Helpers\Exceptions;

use App\Application\APIs\Interfaces\OutputItemInterface;

class ExceptionContent implements OutputItemInterface
{
    /**
     * @var array
     */
    private $error;

    /**
     * ExceptionContent constructor.
     * @param array $error
     */
    public function __construct(array $error)
    {
        $this->error = $error;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }
}
