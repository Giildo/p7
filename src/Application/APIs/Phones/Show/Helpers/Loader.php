<?php

namespace App\Application\APIs\Phones\Show\Helpers;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Phones\Show\Helpers\Interfaces\LoaderInterface;
use App\Application\APIs\Phones\Show\OutputItems\PhoneOutput;
use App\Domain\Repositories\PhoneRepository;
use Doctrine\ORM\NonUniqueResultException;

class Loader implements LoaderInterface
{
    /**
     * @var PhoneRepository
     */
    private $phoneRepository;
    /**
     * @var HateoasBuilderInterface
     */
    private $hateoasBuilder;

    /**
     * Loader constructor.
     * @param PhoneRepository $phoneRepository
     * @param HateoasBuilderInterface $hateoasBuilder
     */
    public function __construct(
        PhoneRepository $phoneRepository,
        HateoasBuilderInterface $hateoasBuilder
    ) {
        $this->phoneRepository = $phoneRepository;
        $this->hateoasBuilder = $hateoasBuilder;
    }

    /**
     * @param string $id
     *
     * @return OutputItemInterface
     *
     * @throws NonUniqueResultException
     * @throws ItemNotFoundException
     */
    public function load(string $id): OutputItemInterface
    {
        $phone = $this->phoneRepository->loadOnePhoneById($id);

        if (is_null($phone)) {
            throw new ItemNotFoundException(ItemNotFoundException::PHONE_NOT_FOUND_WITH_THIS_ID);
        }

        $output = new PhoneOutput(
            $phone,
            $this->hateoasBuilder->build('Phone_list', [], 'list', 'GET')
        );

        return $output;
    }
}
