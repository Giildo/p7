<?php

namespace App\UI\Actions\APIs\Users;

use App\Application\APIs\Users\Show\Handlers\Interfaces\HandlerUserInterface;
use App\Application\APIs\Users\Show\Loaders\Interfaces\LoaderOneUserInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route(
     *     path="/{client}/user/{id}",
     *     name="User_show",
     *     requirements={"client": "\w+", "id": "[a-zA-Z0-9-]+"},
     *     methods={"GET"}
     * )
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
