<?php

namespace App\Application\APIs\Security\Subscribers;

use App\Application\APIs\Events\Events;
use App\Application\APIs\Security\Events\TokenEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class TokenExpiredSubscriber extends BadTokenSubscriber implements EventSubscriberInterface
{
    const MESSAGE = "La durée de validité de votre Token est dépassée, veuillez vous reconnecter.";

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            Events::TOKEN_EXPIRED => 'onTokenIsExpired',
        ];
    }

    /**
     * @param TokenEvent $event
     */
    public function onTokenIsExpired(TokenEvent $event)
    {
        $event->setResponse(
            $this->JSONResponder->response(
                $this->contentResponse,
                null,
                Response::HTTP_UNAUTHORIZED
            )
        );
    }
}
