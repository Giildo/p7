<?php

namespace App\Application\APIs\Helpers\Hateoas;

use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
use App\Application\APIs\Helpers\Hateoas\Links\LinkDeleteShow;
use App\Application\APIs\Helpers\Hateoas\Links\LinkGetList;
use App\Application\APIs\Helpers\Hateoas\Links\LinkGetShow;
use App\Application\APIs\Helpers\Hateoas\Links\LinkPostShow;

class LinkFactory
{
    const GET_SHOW = 1;
    const GET_LIST = 2;
    const DELETE_SHOW = 3;
    const POST_SHOW = 4;

    /**
     * @param string $type
     * @param string $href
     *
     * @return LinkInterface|null
     */
    public static function create(string $type, string $href): ?LinkInterface
    {
        switch ($type) {
            case self::GET_SHOW:
                return new LinkGetShow($href);
                break;

            case self::GET_LIST:
                return new LinkGetList($href);
                break;

            case self::DELETE_SHOW:
                return new LinkDeleteShow($href);
                break;

            case self::POST_SHOW:
                return new LinkPostShow($href);
                break;
        };

        return null;
    }
}
