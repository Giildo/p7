<?php

namespace App\Application\APIs\Helpers\Hateoas;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;

abstract class Link implements LinkInterface
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $rel;
    /**
     * @var string
     */
    protected $href;

    /**
     * Link constructor.
     * @param string $href
     */
    public function __construct(string $href)
    {
        $this->href = $href;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getRel(): string
    {
        return $this->rel;
    }

    /**
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
    }
}
