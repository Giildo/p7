<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\Create\Handlers\Interfaces\NewUserHandlerInterface;
use App\Application\APIs\Users\Create\Saver\Interfaces\UserSaverInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewUserAction
{
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;
    /**
     * @var NewUserHandlerInterface
     */
    private $newUserHandler;
    /**
     * @var UserSaverInterface
     */
    private $userSaver;

    /**
     * NewUserAction constructor.
     * @param OutputJSONResponderInterface $JSONResponder
     * @param NewUserHandlerInterface $newUserHandler
     * @param UserSaverInterface $userSaver
     */
    public function __construct(
        OutputJSONResponderInterface $JSONResponder,
        NewUserHandlerInterface $newUserHandler,
        UserSaverInterface $userSaver
    ) {
        $this->JSONResponder = $JSONResponder;
        $this->newUserHandler = $newUserHandler;
        $this->userSaver = $userSaver;
    }

    /**
     * @Route(
     *     path="/{client}/user/new",
     *     name="User_new",
     *     requirements={"client": "\w+"},
     *     methods={"POST"}
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $userInputItem = $this->newUserHandler->handle($request);

        $output = $this->userSaver->save($userInputItem);

        return $this->JSONResponder->response($output, 201);
    }
}
