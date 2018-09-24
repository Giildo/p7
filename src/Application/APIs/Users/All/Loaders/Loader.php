<?php

namespace App\Application\APIs\Users\All\Loaders;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Users\All\InputItems\Interfaces\InputUserInterface;
use App\Application\APIs\Users\All\Loaders\Interfaces\LoaderUserInterface;
use App\Application\APIs\Users\All\OutputItems\UserOutput;
use App\Application\APIs\Users\All\OutputList\UserOutputList;
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
     * @param InputUserInterface|InputInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     *
     * @throws ItemNotFoundException
     */
    public function load(?InputInterface $inputFilters = null): ?OutputListInterface
    {
        $users = $this->userRepository->loadUserByClientUsername($inputFilters->getClientUsername());

        if (empty($users)) {
            throw new ItemNotFoundException(ItemNotFoundException::USER_NOT_FOUND);
        }

        $outputList = new UserOutputList();
        foreach ($users as $user) {
            $outputList->addOutputItem(
                new UserOutput(
                    $user,
                    $this->hateoasBuilder->build(
                        'User_show',
                        [
                            'client' => $inputFilters->getClientUsername(),
                            'id'     => $user->getId(),
                        ],
                        'self',
                        'GET'
                    )
                )
            );
        }

        return $outputList;
    }
}
