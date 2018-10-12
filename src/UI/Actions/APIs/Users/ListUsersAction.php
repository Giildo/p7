<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\All\Handlers\Interfaces\HandlerUsersInterface;
use App\Application\APIs\Users\All\Loaders\Interfaces\LoaderUserInterface;
use App\Domain\Repositories\UserRepository;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListUsersAction
{
    /**
     * @var HandlerUsersInterface
     */
    private $handler;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var LoaderUserInterface
     */
    private $loaderUser;
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;

    /**
     * ListUsersAction constructor.
     * @param HandlerUsersInterface $handler
     * @param UserRepository $userRepository
     * @param LoaderUserInterface $loaderUser
     * @param OutputJSONResponderInterface $JSONResponder
     */
    public function __construct(
        HandlerUsersInterface $handler,
        UserRepository $userRepository,
        LoaderUserInterface $loaderUser,
        OutputJSONResponderInterface $JSONResponder
    ) {
        $this->handler = $handler;
        $this->userRepository = $userRepository;
        $this->loaderUser = $loaderUser;
        $this->JSONResponder = $JSONResponder;
    }

    /**
     * Returns the list of users from a client.
     *
     * @Route(
     *     path="/clients/{client}/users",
     *     name="Users_list",
     *     requirements={"client": "[a-zA-Z0-9-]+"},
     *     methods={"GET"}
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Returns the list of users.",
     *     @SWG\Schema(ref=@Model(type=App\Application\APIs\Users\OutputList\UserOutputList::class))
     * )
     * @SWG\Response(
     *     response="404",
     *     description="No user found in the database, please check your input parameters."
     * )
     * @SWG\Parameter(
     *     name="limit",
     *     in="query",
     *     type="integer",
     *     description="Limit required for the list user."
     * )
     * @SWG\Parameter(
     *     name="offset",
     *     in="query",
     *     type="integer",
     *     description="Start for the list user."
     * )
     * @SWG\Parameter(
     *     name="client",
     *     in="path",
     *     type="string",
     *     description="Client ID."
     * )
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        $input = $this->handler->handle($request);

        $outputList = $this->loaderUser->load($input);

        return $this->JSONResponder->response($outputList, $request);
    }
}
