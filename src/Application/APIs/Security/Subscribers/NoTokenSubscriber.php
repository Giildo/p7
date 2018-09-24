<?php

namespace App\Application\APIs\Security\Subscribers;

use App\Application\APIs\Events\Events;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class NoTokenSubscriber extends BadTokenSubscriber implements EventSubscriberInterface
{
    const MESSAGE = "Aucun Token de connexion n'a été trouvé, veuillez vous connecter.";

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
            Events::NO_TOKEN => 'onNoToken',
        ];
    }

    /**
     * @param JWTNotFoundEvent $event
     */
    public function onNoToken(JWTNotFoundEvent $event)
    {
        $event->setResponse(
            $this->JSONResponder->response(
                $this->contentResponse,
                Response::HTTP_UNAUTHORIZED
            )
        );
    }
}
