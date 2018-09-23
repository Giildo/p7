<?php

namespace App\Application\APIs\Interfaces;

interface InputInterface
{
    /**
     * @return int|null
     */
    public function getLimit(): ?int;

    /**
     * @return int|null
     */
    public function getOffset(): ?int;

    /**
     * @return null|string
     */
    public function getCategory(): ?string;
}
