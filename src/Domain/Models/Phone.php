<?php

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\PhoneInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Class Phone
 * @package App\Domain\Model
 *
 * @ORM\Table(name="p7_phone")
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\PhoneRepository")
 */
class Phone implements PhoneInterface
{
    /**
     * @var Uuid
     *
     * @ORM\Id()
     * @ORM\Column(type="uuid")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    private $os;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Domain\Models\Memory", cascade={"persist"})
     * @ORM\JoinTable(name="p7_phone_memory",
     *     joinColumns={@ORM\JoinColumn(referencedColumnName="id", name="phone_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(referencedColumnName="size", name="memory_size")}
     *     )
     */
    private $memories;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=2)
     */
    private $ram;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $battery;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5)
     */
    private $sim;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $screenResolutionH;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $screenResolutionW;

    /**
     * @var float
     *
     * @ORM\Column(type="float", length=5)
     */
    private $screen;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=2)
     */
    private $cameraFront;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=2)
     */
    private $cameraBack;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $g4;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $g5;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $wifi;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $removableBattery;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $weight;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $thickness;

    /**
     * Phone constructor.
     * @param string $brand
     * @param string $os
     * @param int $ram
     * @param int $battery
     * @param string $sim
     * @param int $screenResolutionH
     * @param int $screenResolutionW
     * @param float $screen
     * @param int $cameraFront
     * @param int $cameraBack
     * @param string $name
     * @param bool $g4
     * @param bool $g5
     * @param bool $wifi
     * @param bool $removableBattery
     * @param int $width
     * @param int $height
     * @param int $weight
     * @param int $thickness
     */
    public function __construct(
        string $brand,
        string $os,
        int $ram,
        int $battery,
        string $sim,
        int $screenResolutionH,
        int $screenResolutionW,
        float $screen,
        int $cameraFront,
        int $cameraBack,
        string $name,
        bool $g4,
        bool $g5,
        bool $wifi,
        bool $removableBattery,
        int $width,
        int $height,
        int $weight,
        int $thickness
    ) {
        $this->brand = $brand;
        $this->os = $os;
        $this->ram = $ram;
        $this->battery = $battery;
        $this->sim = $sim;
        $this->screenResolutionH = $screenResolutionH;
        $this->screenResolutionW = $screenResolutionW;
        $this->screen = $screen;
        $this->cameraFront = $cameraFront;
        $this->cameraBack = $cameraBack;
        $this->name = $name;
        $this->g4 = $g4;
        $this->g5 = $g5;
        $this->wifi = $wifi;
        $this->removableBattery = $removableBattery;
        $this->width = $width;
        $this->height = $height;
        $this->weight = $weight;
        $this->thickness = $thickness;
        $this->memories = new ArrayCollection();
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getOs(): string
    {
        return $this->os;
    }

    /**
     * @return Collection
     */
    public function getMemories(): Collection
    {
        return $this->memories;
    }

    /**
     * @return int
     */
    public function getRam(): int
    {
        return $this->ram;
    }

    /**
     * @return int
     */
    public function getBattery(): int
    {
        return $this->battery;
    }

    /**
     * @return string
     */
    public function getSim(): string
    {
        return $this->sim;
    }

    /**
     * @return int
     */
    public function getScreenResolutionH(): int
    {
        return $this->screenResolutionH;
    }

    /**
     * @return int
     */
    public function getScreenResolutionW(): int
    {
        return $this->screenResolutionW;
    }

    /**
     * @return float
     */
    public function getScreen(): float
    {
        return $this->screen;
    }

    /**
     * @return int
     */
    public function getCameraFront(): int
    {
        return $this->cameraFront;
    }

    /**
     * @return int
     */
    public function getCameraBack(): int
    {
        return $this->cameraBack;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function hasG4(): bool
    {
        return $this->g4;
    }

    /**
     * @return bool
     */
    public function hasG5(): bool
    {
        return $this->g5;
    }

    /**
     * @return bool
     */
    public function hasWifi(): bool
    {
        return $this->wifi;
    }

    /**
     * @return bool
     */
    public function hasRemovableBattery(): bool
    {
        return $this->removableBattery;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @return int
     */
    public function getThickness(): int
    {
        return $this->thickness;
    }
}
