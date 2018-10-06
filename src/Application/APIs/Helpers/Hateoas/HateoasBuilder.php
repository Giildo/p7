<?php

namespace App\Application\APIs\Helpers\Hateoas;

use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Helpers\Hateoas\Interfaces\LinkInterface;
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
     * {@inheritdoc}
     */
    public function build(
        string $type,
        string $linkName,
        ?array $params = []
    ): LinkInterface {
        return LinkFactory::create(
            $type,
            $this->urlGenerator->generate($linkName, $params)
        );
    }
}
