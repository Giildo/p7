<?php

namespace App\Application\APIs\Security\Subscribers;

use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Helpers\Hateoas\LinkFactory;
use App\Application\APIs\Security\Output\TokenErrorOutput;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;

class BadTokenSubscriber
{
    const MESSAGE = '';

    /**
     * @var OutputJSONResponderInterface
     */
    protected $JSONResponder;
    /**
     * @var HateoasBuilderInterface
     */
    protected $hateoasBuilder;
    /**
     * @var array
     */
    protected $contentResponse;

    /**
     * TokenExpiredSubscriber constructor.
     * @param OutputJSONResponderInterface $JSONResponder
     * @param HateoasBuilderInterface $hateoasBuilder
     */
    public function __construct(
        OutputJSONResponderInterface $JSONResponder,
        HateoasBuilderInterface $hateoasBuilder
    ) {
        $this->JSONResponder = $JSONResponder;
        $this->hateoasBuilder = $hateoasBuilder;

        $this->createHateoas();
    }

    public function createHateoas()
    {
        $this->contentResponse = new TokenErrorOutput([
            "code" => 401,
            "message" => static::MESSAGE,
            "links" => $this->hateoasBuilder->build(
                LinkFactory::POST_SHOW,
                'api_login_check'
            ),
        ]);
    }
}
