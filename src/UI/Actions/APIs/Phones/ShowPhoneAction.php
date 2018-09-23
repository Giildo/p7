<?php

namespace App\UI\Actions\APIs\Phones;

use App\Application\APIs\Phones\Show\Helpers\Interfaces\LoaderInterface;
use App\UI\Responders\Interfaces\OutputJSONResponderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route(
     *     path="/phone/{id}",
     *     name="Phone_show",
     *     requirements={"id": "[a-zA-Z0-9-]+"},
     *     methods={"GET"}
     * )
     *
     * @param string $id
     *
     * @return Response
     */
    public function show(string $id): Response
    {
        $output = $this->loader->load($id);

        return $this->JSONResponder->response($output);
    }
}