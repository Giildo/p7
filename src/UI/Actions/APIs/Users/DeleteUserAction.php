<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\Delete\Handlers\Interfaces\DeleteUserHandlerInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route(
     *     path="/{client}/user/delete/{id}",
     *     name="User_delete",
     *     requirements={"client": "\w+", "id": "[a-zA-Z0-9-]+"},
     *     methods={"DELETE"}
     * )
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
