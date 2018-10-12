<?php

namespace App\UI\Actions\APIs\Phones;

use App\Application\APIs\Phones\All\Handlers\Interfaces\HandlerPhonesInterface;
use App\Application\APIs\Phones\All\Loaders\Interfaces\LoaderPhoneInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
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
     * Returns the list of phones.
     *
     * @Route(path="/phones", name="Phone_list", methods={"GET"})
     *
     * @SWG\Response(
     *     response="200",
     *     description="Returns the list of phones.",
     *     @SWG\Schema(ref=@Model(type=App\Application\APIs\Phones\All\OutputList\PhonesOutputList::class))
     * )
     * @SWG\Response(
     *     response="404",
     *     description="No phone found in the database, please check your input parameters."
     * )
     * @SWG\Parameter(
     *     name="limit",
     *     in="query",
     *     type="integer",
     *     description="Limit required for the list phone."
     * )
     * @SWG\Parameter(
     *     name="offset",
     *     in="query",
     *     type="integer",
     *     description="Start for the list phone."
     * )
     * @SWG\Parameter(
     *     name="brand",
     *     in="query",
     *     type="string",
     *     description="Brand of the phone."
     * )
     * @SWG\Tag(name="Phone")
     * @Security(name="Bearer")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function list(Request $request): Response
    {
        $input = $this->phoneHandler->handle($request, ['category' => 'brand']);

        $outputList = $this->loader->load($input);

        return $this->JSONResponder->response($outputList, $request);
    }
}
