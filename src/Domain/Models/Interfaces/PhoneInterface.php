<?php

namespace App\Domain\Models\Interfaces;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

interface PhoneInterface
{
    /**
     * @return Uuid
     */
    public function getId(): Uuid;

    /**
     * @return string
     */
    public function getBrand(): string;

    /**
     * @return string
     */
    public function getOs(): string;

    /**
     * @return Collection
     */
    public function getMemories(): Collection;

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

}
