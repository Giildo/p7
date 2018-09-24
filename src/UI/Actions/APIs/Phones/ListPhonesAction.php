<?php

namespace App\UI\Actions\APIs\Phones;

use App\Application\APIs\Phones\All\Handlers\Interfaces\HandlerPhonesInterface;
use App\Application\APIs\Phones\All\Loaders\Interfaces\LoaderPhoneInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListPhonesAction
{
    /**
     * @var HandlerPhonesInterface
     */
    private $phoneHandler;
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;
    /**
     * @var LoaderPhoneInterface
     */
    private $loader;

    /**
     * ListPhonesAction constructor.
     * @param HandlerPhonesInterface $phoneHandler
     * @param OutputJSONResponderInterface $JSONResponder
     * @param LoaderPhoneInterface $loader
     */
    public function __construct(
        HandlerPhonesInterface $phoneHandler,
        OutputJSONResponderInterface $JSONResponder,
        LoaderPhoneInterface $loader
    ) {
        $this->phoneHandler = $phoneHandler;
        $this->JSONResponder = $JSONResponder;
        $this->loader = $loader;
    }

    /**
     * @Route(path="/phones", name="Phone_list", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        $input = $this->phoneHandler->handle($request, ['category' => 'brand']);

        $outputList = $this->loader->load($input);

        return $this->JSONResponder->response($outputList);
    }
}
