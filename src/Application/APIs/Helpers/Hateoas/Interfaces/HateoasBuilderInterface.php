<?php

namespace App\Application\APIs\Helpers\Hateoas\Interfaces;

interface HateoasBuilderInterface
{
    /**
     * @param null|string $linkName
     * @param array|null $params
     * @param null|string $rel
     * @param null|string $verb
     *
     * @return array
     */
    public function build(
        ?string $linkName = null,
        ?array $params = [],
        ?string $rel = null,
        ?string $verb = null
    ): array;
}
