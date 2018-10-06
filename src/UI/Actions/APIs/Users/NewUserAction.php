<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\Create\Handlers\Interfaces\NewUserHandlerInterface;
use App\Application\APIs\Users\Create\Saver\Interfaces\UserSaverInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
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
     * Adds one user to a client.
     *
     * @Route(
     *     path="/clients/{client}/users",
     *     name="User_new",
     *     requirements={"client": "[a-zA-Z0-9-]+"},
     *     methods={"POST"}
     * )
     *
     * @SWG\Response(
     *     response="201",
     *     description="The new user is created.",
     *     @SWG\Schema(ref=@Model(type=App\Application\APIs\Users\OutputItems\UserOutput::class))
     * )
     * @SWG\Response(
     *     response="404",
     *     description="No user found in the database, please check your input parameters."
     * )
     * @SWG\Parameter(
     *     name="client",
     *     in="path",
     *     type="string",
     *     description="The client ID."
     * )
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     required=true,
     *     @SWG\Schema(
     *          ref=@Model(type=App\Application\APIs\Users\Create\InputItems\UserInputItem::class)
     *     )
     * )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
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
