<?php

namespace App\Application\APIs\Security\Output;

use App\Application\APIs\Interfaces\OutputItemInterface;

class TokenErrorOutput implements OutputItemInterface
{
    /**
     * @var array
     */
    private $error;

    /**
     * TokenErrorOutput constructor.
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
