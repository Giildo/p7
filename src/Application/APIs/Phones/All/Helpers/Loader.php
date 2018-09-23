<?php

namespace App\Application\APIs\Phones\All\Helpers;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Phones\All\Helpers\Interfaces\LoaderInterface;
use App\Application\APIs\Phones\All\OutputItems\PhoneOutput;
use App\Application\APIs\Phones\All\OutputList\PhonesOutputList;
use App\Domain\Repositories\PhoneRepository;

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
     * @param InputInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     *
     * @throws ItemNotFoundException
     */
    public function load(?InputInterface $inputFilters = null): ?OutputListInterface
    {
        $phones = $this->phoneRepository->loadPhonesWithFilters($inputFilters);

        if (empty($phones)) {
            if (
                is_null($inputFilters->getCategory()) &&
                $inputFilters->getOffset() === 0 &&
                $inputFilters->getLimit() === 0
            ) {
                throw new ItemNotFoundException(ItemNotFoundException::PHONE_NOT_FOUND);
            }

            if (!is_null($inputFilters->getCategory())) {
                throw new ItemNotFoundException(ItemNotFoundException::PHONE_NOT_FOUND_WITH_THIS_BRAND);
            }

            throw new ItemNotFoundException(ItemNotFoundException::PHONE_NOT_FOUND_WITH_PARAM);
        }

        $list = [];

        foreach ($phones as $phone) {
            $list[] = new PhoneOutput(
                $phone,
                $this->hateoasBuilder->build('Phone_show', ['id' => $phone['id']], 'self', 'GET')
            );
        }

        return new PhonesOutputList($list);
    }
}
