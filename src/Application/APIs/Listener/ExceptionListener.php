<?php

namespace App\Application\APIs\Listener;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Exceptions\Interfaces\ExceptionContentBuilderInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    const OK = 200;
    const NO_CONTENT = 204;
    const NOT_FOUND = 404;

    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;
    /**
     * @var ExceptionContentBuilderInterface
     */
    private $exceptionBuilder;

    /**
     * ExceptionListener constructor.
     * @param OutputJSONResponderInterface $JSONResponder
     * @param ExceptionContentBuilderInterface $exceptionBuilder
     */
    public function __construct(
        OutputJSONResponderInterface $JSONResponder,
        ExceptionContentBuilderInterface $exceptionBuilder
    ) {
        $this->JSONResponder = $JSONResponder;
        $this->exceptionBuilder = $exceptionBuilder;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof ItemNotFoundException) {
            $content = $this->exceptionBuilder->build(
                $exception->getMessage(),
                $exception->getCode()
            );

            $statusCode = ($exception->getCode() === ItemNotFoundException::PHONE_NOT_FOUND) ?
                $statusCode = self::NOT_FOUND :
                $statusCode = self::OK;

            $response = $this->JSONResponder->response(
                $content,
                $statusCode
            );

            $event->setResponse($response);
            return;
        }
    }
}
