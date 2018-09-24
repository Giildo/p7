<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\All\Handlers\Interfaces\HandlerUsersInterface;
use App\Application\APIs\Users\All\Loaders\Interfaces\LoaderUserInterface;
use App\Domain\Repositories\UserRepository;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route(
     *     path="/{client}/users",
     *     name="Users_list",
     *     requirements={"clients": "\w+"},
     *     methods={"GET"}
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        $input = $this->handler->handle($request);

        $outputList = $this->loaderUser->load($input);

        return $this->JSONResponder->response($outputList);
    }
}
