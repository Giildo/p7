<?php

namespace App\Application\APIs\Phones\Show\OutputItems\Interfaces;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Phones\OutputItems\Interfaces\BrandOutputInterface;

interface PhoneOutputInterface extends OutputItemInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return BrandOutputInterface
     */
    public function getBrand(): BrandOutputInterface;

    /**
     * @return string
     */
    public function getOs(): string;

    /**
     * @return array
     */
    public function getMemories(): array;

    /**
     * @return int
     */
    public function getRam(): int;

    /**
     * @return int
     */
    public function getBattery(): int;

    /**
     * @return string
     */
    public function getSim(): string;

    /**
     * @return int
     */
    public function getScreenResolutionH(): int;

    /**
     * @return int
     */
    public function getScreenResolutionW(): int;

    /**
     * @return float
     */
    public function getScreen(): float;

    /**
     * @return int
     */
    public function getCameraFront(): int;

    /**
     * @return int
     */
    public function getCameraBack(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return bool
     */
    public function hasG4(): bool;

    /**
     * @return bool
     */
    public function hasG5(): bool;

    /**
     * @return bool
     */
    public function hasWifi(): bool;

    /**
     * @return bool
     */
    public function hasRemovableBattery(): bool;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @return int
     */
    public function getWeight(): int;

    /**
     * @return int
     */
    public function getThickness(): int;

    /**
     * @return LinkInterface
     */
    public function getLinks(): LinkInterface;
}
