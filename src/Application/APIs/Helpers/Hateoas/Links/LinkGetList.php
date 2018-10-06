<?php

namespace App\Application\APIs\Helpers\Hateoas\Links;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Helpers\Hateoas\Link;

class LinkGetList extends Link implements LinkInterface
{
    protected $rel = 'GET';
    protected $type = 'list';
}
