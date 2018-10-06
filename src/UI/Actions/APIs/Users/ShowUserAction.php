<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\Show\Handlers\Interfaces\HandlerUserInterface;
use App\Application\APIs\Users\Show\Loaders\Interfaces\LoaderOneUserInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowUserAction
{
    /**
     * @var HandlerUserInterface
     */
    private $handlerUser;
    /**
     * @var LoaderOneUserInterface
     */
    private $loaderOneUser;
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;

    /**
     * ShowUserAction constructor.
     * @param HandlerUserInterface $handlerUser
     * @param LoaderOneUserInterface $loaderOneUser
     * @param OutputJSONResponderInterface $JSONResponder
     */
    public function __construct(
        HandlerUserInterface $handlerUser,
        LoaderOneUserInterface $loaderOneUser,
        OutputJSONResponderInterface $JSONResponder
    )
    {
        $this->handlerUser = $handlerUser;
        $this->loaderOneUser = $loaderOneUser;
        $this->JSONResponder = $JSONResponder;
    }

    /**
     * Returns the details of one user from a client.
     *
     * @Route(
     *     path="/clients/{client}/users/{id}",
     *     name="User_show",
     *     requirements={"client": "\w+", "id": "[a-zA-Z0-9-]+"},
     *     methods={"GET"}
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Returns the details of one user.",
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
     *     description="Client ID."
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="User ID."
     * )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function show(Request $request): Response
    {
        $input = $this->handlerUser->handle($request);

        $output = $this->loaderOneUser->load($input);

        return $this->JSONResponder->response($output);
    }
}
