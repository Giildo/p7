<?php

namespace App\Application\APIs\Listener;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Exceptions\Interfaces\ExceptionContentBuilderInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ExceptionListener
{
    const NOT_FOUND = 404;
    const CONFLICT = 409;

    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;
    /**
     * @var ExceptionContentBuilderInterface
     */
    private $exceptionBuilder;
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * ExceptionListener constructor.
     * @param OutputJSONResponderInterface $JSONResponder
     * @param ExceptionContentBuilderInterface $exceptionBuilder
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        OutputJSONResponderInterface $JSONResponder,
        ExceptionContentBuilderInterface $exceptionBuilder,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->JSONResponder = $JSONResponder;
        $this->exceptionBuilder = $exceptionBuilder;
        $this->urlGenerator = $urlGenerator;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof ItemNotFoundException) {
            $event->setResponse(
                $this->JSONResponder->response(
                    $this->exceptionBuilder->build(
                        $exception->getMessage(),
                        self::NOT_FOUND
                    ), null, self::NOT_FOUND
                )
            );
        }

        if ($exception instanceof UniqueConstraintViolationException) {
            $event->setResponse(
                $this->JSONResponder->response(
                    $this->exceptionBuilder->build(
                        'Le nom d\'utilisateur existe déjà.',
                        self::CONFLICT
                    ), null, self::CONFLICT
                )
            );
        }
    }
}
