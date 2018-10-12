<?php

namespace App\Application\APIs\Phones\OutputItems;

use App\Application\APIs\Interfaces\SubObjectInterface;
use App\Application\APIs\Phones\OutputItems\Interfaces\BrandOutputInterface;
use App\Domain\Models\Interfaces\BrandInterface;

class BrandOutput implements BrandOutputInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param BrandInterface $object
     *
     * @return SubObjectInterface
     */
    public function create($object): SubObjectInterface
    {
        $this->id = $object->getId()->toString();
        $this->name = $object->getName();

        return $this;
    }
}
