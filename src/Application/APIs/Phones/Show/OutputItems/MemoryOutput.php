<?php

namespace App\Application\APIs\Phones\Show\OutputItems;

use App\Application\APIs\Interfaces\SubObjectInterface;
use App\Application\APIs\Phones\Show\OutputItems\Interfaces\MemoryOutputInterface;
use App\Domain\Models\Interfaces\MemoryInterface;

class MemoryOutput implements MemoryOutputInterface
{
    /**
     * @var int
     */
    private $size;

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param MemoryInterface $object
     *
     * @return SubObjectInterface
     */
    public function create($object): SubObjectInterface
    {
        $this->size = $object->getSize();

        return $this;
    }
}
