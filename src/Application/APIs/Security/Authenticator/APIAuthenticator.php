<?php

namespace App\Application\APIs\Security\Authenticator;

use App\Application\APIs\Events\Events;
use App\Application\APIs\Security\Events\TokenEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\ExpiredTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\MissingTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class APIAuthenticator extends JWTTokenAuthenticator
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * APIAuthenticator constructor.
     * @param JWTTokenManagerInterface $jwtManager
     * @param EventDispatcherInterface $dispatcher
     * @param TokenExtractorInterface $tokenExtractor
     */
    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        TokenExtractorInterface $tokenExtractor
    ) {
        parent::__construct($jwtManager, $dispatcher, $tokenExtractor);
        $this->dispatcher = $dispatcher;
    }

    public function onAuthenticationFailure(
        Request $request,
        AuthenticationException $authException
    ) {
        $response = new JWTAuthenticationFailureResponse($authException->getMessageKey());

        if ($authException instanceof ExpiredTokenException) {
            $event = new TokenEvent($authException, $response);
            $this->dispatcher->dispatch(Events::TOKEN_EXPIRED, $event);
        } else {
            $event = new TokenEvent($authException, $response);
            $this->dispatcher->dispatch(Events::TOKEN_INVALID, $event);
        }

        return $event->getResponse();
    }

    /**
     * {@inheritdoc}
     */
    public function start(
        Request $request,
        AuthenticationException $authException = null
    ) {
        $exception = new MissingTokenException(
            'JWT Token not found',
            0,
            $authException
        );

        $event = new JWTNotFoundEvent(
            $exception,
            new JWTAuthenticationFailureResponse(
                $exception->getMessageKey()
            )
        );

        $this->dispatcher->dispatch(Events::NO_TOKEN, $event);

        return $event->getResponse();
    }
}
