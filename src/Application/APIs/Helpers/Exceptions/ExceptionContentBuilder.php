<?php

namespace App\Application\APIs\Helpers\Exceptions;

use App\Application\APIs\Helpers\Exceptions\Interfaces\ExceptionContentBuilderInterface;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;

class ExceptionContentBuilder implements ExceptionContentBuilderInterface
{
    /**
     * @var HateoasBuilderInterface
     */
    private $hateoasBuilder;

    /**
     * ExceptionContentBuilder constructor.
     * @param HateoasBuilderInterface $hateoasBuilder
     */
    public function __construct(HateoasBuilderInterface $hateoasBuilder)
    {
        $this->hateoasBuilder = $hateoasBuilder;
    }

    /**
     * @param string $message
     * @param int $code
     *
     * @return ExceptionContent
     */
    public function build(string $message, int $code): ExceptionContent
    {
        $content = [
            'id'      => $code,
            'message' => $message,
            'links'   => $this->hateoasBuilder->build(
                'Phone_list',
                [],
                'list',
                'GET'
            )
        ];

        return new ExceptionContent($content);
    }
}
