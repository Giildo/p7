<?php

namespace App\Application\APIs\Helpers\Hateoas\Links;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Helpers\Hateoas\Link;

class LinkDeleteShow extends Link implements LinkInterface
{
    protected $rel = 'DELETE';
    protected $type = 'self';
}
