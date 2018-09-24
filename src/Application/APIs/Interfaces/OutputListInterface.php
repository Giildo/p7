<?php

namespace App\Application\APIs\Interfaces;

interface OutputListInterface
{
    /**
     * @param OutputItemInterface $outputItem
     *
     * @return void
     */
    public function addOutputItem(OutputItemInterface $outputItem): void;
}
