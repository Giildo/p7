<?php

namespace App\Application\APIs\Helpers\Hateoas\Links;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Helpers\Hateoas\Link;

class LinkPostShow extends Link implements LinkInterface
{
    protected $type = 'POST';
    protected $rel = 'self';
}
