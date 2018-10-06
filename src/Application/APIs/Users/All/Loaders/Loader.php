<?php

namespace App\Application\APIs\Users\All\Loaders;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Users\All\InputFilters\Interfaces\InputFiltersUserInterface;
use App\Application\APIs\Users\All\Loaders\Interfaces\LoaderUserInterface;
use App\Application\APIs\Users\OutputItems\UserOutput;
use App\Application\APIs\Users\OutputList\UserOutputList;
use App\Domain\Repositories\UserRepository;

class Loader implements LoaderUserInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var HateoasBuilderInterface
     */
    private $hateoasBuilder;

    /**
     * Loader constructor.
     * @param UserRepository $userRepository
     * @param HateoasBuilderInterface $hateoasBuilder
     */
    public function __construct(
        UserRepository $userRepository,
        HateoasBuilderInterface $hateoasBuilder
    )
    {
        $this->userRepository = $userRepository;
        $this->hateoasBuilder = $hateoasBuilder;
    }

    /**
     * @param InputFiltersUserInterface|InputFiltersInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     *
     * @throws ItemNotFoundException
     */
    public function load(?InputFiltersInterface $inputFilters = null): ?OutputListInterface
    {
        $users = $this->userRepository->loadUserByClientUsername($inputFilters->getClientUsername());

        if (empty($users)) {
            throw new ItemNotFoundException(ItemNotFoundException::USER_NOT_FOUND);
        }

        $outputList = new UserOutputList();
        foreach ($users as $user) {
            $outputList->add(
                new UserOutput(
                    $user,
                    [
                        $this->hateoasBuilder->build(
                            'User_show',
                            [
                                'client' => $inputFilters->getClientUsername(),
                                'id'     => $user->getId(),
                            ],
                            'self',
                            'GET'
                        ),
                        $this->hateoasBuilder->build(
                            'User_delete',
                            [
                                'client' => $inputFilters->getClientUsername(),
                                'id'     => $user->getId(),
                            ],
                            'self',
                            'DELETE'
                        )
                    ]
                )
            );
        }

        return $outputList;
    }
}
