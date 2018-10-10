<?php

namespace App\Domain\Models\Interfaces;


/**
 * Class Memory
 * @package App\Domain\Model
 *
 * @ORM\Table(name="p7_memory")
 * @ORM\Entity()
 */
interface MemoryInterface
{
    /**
     * @return int
     */
    public function getSize(): int;
}