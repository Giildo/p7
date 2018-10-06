<?php

namespace App\Application\APIs\Phones\All\Loaders;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Phones\All\InputFilters\Interfaces\InputFiltersPhoneInterface;
use App\Application\APIs\Phones\All\Loaders\Interfaces\LoaderPhoneInterface;
use App\Application\APIs\Phones\All\OutputItems\PhoneOutput;
use App\Application\APIs\Phones\All\OutputList\PhonesOutputList;
use App\Domain\Repositories\PhoneRepository;

class Loader implements LoaderPhoneInterface
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
     * @param InputFiltersPhoneInterface|InputFiltersInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     *
     * @throws ItemNotFoundException
     */
    public function load(?InputFiltersInterface $inputFilters = null): ?OutputListInterface
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

        $outputItem = new PhonesOutputList();

        foreach ($phones as $phone) {
            $outputItem->add(
                new PhoneOutput(
                    $phone,
                    $this->hateoasBuilder->build('Phone_show', ['id' => $phone['id']], 'self', 'GET')
                )
            );
        }

        return $outputItem;
    }
}
