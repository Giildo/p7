<?php

namespace App\Application\APIs\Helpers\Hateoas;

use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class HateoasBuilder implements HateoasBuilderInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * HateoasBuilder constructor.
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

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
    ): array {
        $links = [];
        $links['type'] = $verb;
        $links['rel'] = $rel;
        $links['href'] = $this->urlGenerator->generate($linkName, $params);

        return $links;
    }
}
