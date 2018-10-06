<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\Delete\Handlers\Interfaces\DeleteUserHandlerInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserAction
{
    /**
     * @var DeleteUserHandlerInterface
     */
    private $userHandler;
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;

    /**
     * DeleteUserAction constructor.
     * @param DeleteUserHandlerInterface $userHandler
     * @param OutputJSONResponderInterface $JSONResponder
     */
    public function __construct(
        DeleteUserHandlerInterface $userHandler,
        OutputJSONResponderInterface $JSONResponder
    ) {
        $this->userHandler = $userHandler;
        $this->JSONResponder = $JSONResponder;
    }

    /**
     * Deletes the user from a client.
     *
     * @Route(
     *     path="/clients/{client}/users/{id}",
     *     name="User_delete",
     *     requirements={"client": "\w+", "id": "[a-zA-Z0-9-]+"},
     *     methods={"DELETE"}
     * )
     *
     * @SWG\Response(
     *     response="204",
     *     description="The user is deleted."
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
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The user ID."
     * )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function delete(Request $request): Response
    {
        $this->userHandler->handle($request);

        return $this->JSONResponder->response(null, Response::HTTP_NO_CONTENT);
    }
}
