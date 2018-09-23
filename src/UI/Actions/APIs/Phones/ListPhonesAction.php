<?php

namespace App\UI\Actions\APIs\Phones;

use App\Application\APIs\Handlers\Handler;
use App\Application\APIs\Phones\All\Helpers\Interfaces\LoaderInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListPhonesAction
{
    /**
     * @var Handler
     */
    private $phoneHandler;
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;
    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * ListPhonesAction constructor.
     * @param Handler $phoneHandler
     * @param OutputJSONResponderInterface $JSONResponder
     * @param LoaderInterface $loader
     */
    public function __construct(
        Handler $phoneHandler,
        OutputJSONResponderInterface $JSONResponder,
        LoaderInterface $loader
    ) {
        $this->phoneHandler = $phoneHandler;
        $this->JSONResponder = $JSONResponder;
        $this->loader = $loader;
    }

    /**
     * @Route(path="/phones", name="Phone_list")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        $input = $this->phoneHandler->handle($request, 'brand');

        $outputList = $this->loader->load($input);

        return $this->JSONResponder->response($outputList);
    }
}
