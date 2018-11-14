<?php

namespace App\UI\Actions\APIs\Phones;

use App\Application\APIs\Phones\Show\Helpers\Interfaces\LoaderInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowPhoneAction
{
    /**
     * @var LoaderInterface
     */
    private $loader;
    /**
     * @var OutputJSONResponderInterface
     */
    private $JSONResponder;

    /**
     * ShowPhoneAction constructor.
     * @param LoaderInterface $loader
     * @param OutputJSONResponderInterface $JSONResponder
     */
    public function __construct(
        LoaderInterface $loader,
        OutputJSONResponderInterface $JSONResponder
    ) {
        $this->loader = $loader;
        $this->JSONResponder = $JSONResponder;
    }

    /**
     * Returns the detail of one phone.
     *
     * @Route(
     *     path="/phones/{id}",
     *     name="Phone_show",
     *     requirements={"id": "[a-zA-Z0-9-]+"},
     *     methods={"GET"}
     * )
     *
     * @SWG\Response(
     *     response="200",
     *     description="Return the detail of one phone.",
     *     @SWG\Schema(ref=@Model(type=App\Application\APIs\Phones\Show\OutputItems\PhoneOutput::class))
     * )
     * @SWG\Response(
     *     response="404",
     *     description="No phone found in the database, please check your input parameters."
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="Phone ID."
     * )
     * @SWG\Tag(name="Phone")
     * @Security(name="Bearer")
     *
     * @param string $id
     * @param Request $request
     *
     * @return Response
     */
    public function show(string $id, Request $request): Response
    {
        $output = $this->loader->load($id);

        return $this->JSONResponder->response($output, $request);
    }
}
