<?php

namespace App\Domain\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Memory
 * @package App\Domain\Model
 *
 * @ORM\Table(name="p7_memory")
 * @ORM\Entity()
 */
class Memory
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\Column(type="smallint", length=3)
     */
    private $size;

    /**
     * Memory constructor.
     * @param int $size
     */
    public function __construct(int $size)
    {
        $this->size = $size;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
