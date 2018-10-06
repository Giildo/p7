<?php

namespace App\Application\APIs\Helpers\Hateoas\Interfaces;

interface HateoasBuilderInterface
{
    /**
     * @param string $type
     * @param string $linkName
     * @param array|null $params
     *
     * @return LinkInterface
     */
    public function build(
        string $type,
        string $linkName,
        ?array $params = []
    ): LinkInterface;
}
