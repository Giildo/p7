<?php

namespace App\Domain\Models\Interfaces;

use Ramsey\Uuid\Uuid;

/**
 * Class Brand
 * @package App\Domain\Models
 */
interface BrandInterface
{
    /**
     * @return Uuid
     */
    public function getId(): Uuid;

    /**
     * @return string
     */
    public function getName(): string;
}
