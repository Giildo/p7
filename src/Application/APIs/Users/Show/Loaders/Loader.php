<?php

namespace App\Application\APIs\Users\Show\Loaders;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Helpers\Hateoas\LinkFactory;
use App\Application\APIs\Interfaces\InputFiltersInterface;
use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Users\OutputItems\UserOutput;
use App\Application\APIs\Users\OutputList\UserOutputList;
use App\Application\APIs\Users\Show\InputFilters\Interfaces\OneUserInputFiltersInterface;
use App\Application\APIs\Users\Show\Loaders\Interfaces\LoaderOneUserInterface;
use App\Domain\Repositories\UserRepository;
use Doctrine\ORM\NonUniqueResultException;

class Loader implements LoaderOneUserInterface
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
    ) {
        $this->userRepository = $userRepository;
        $this->hateoasBuilder = $hateoasBuilder;
    }

    /**
     * @param OneUserInputFiltersInterface|InputFiltersInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     *
     * @throws ItemNotFoundException
     */
    public function load(?InputFiltersInterface $inputFilters = null): ?OutputListInterface
    {
        try {
            $user = $this->userRepository->loadOneUserByClientIdAndUserId(
                $inputFilters->getUserId(),
                $inputFilters->getClientId()
            );
        } catch (NonUniqueResultException $e) {
            throw new ItemNotFoundException(ItemNotFoundException::USER_NOT_FOUND);
        }

        if (is_null($user)) {
            throw new ItemNotFoundException(ItemNotFoundException::USER_NOT_FOUND);
        }

        return new UserOutputList([
            new UserOutput(
                $user,
                [
                    $this->hateoasBuilder->build(
                        LinkFactory::DELETE_SHOW,
                        'User_delete',
                        [
                            'client' => $inputFilters->getClientId(),
                            'id' => $user->getId()
                        ]
                    ),
                    $this->hateoasBuilder->build(
                        LinkFactory::GET_LIST,
                        'Users_list',
                        ['client' => $inputFilters->getClientId()]
                    )
                ]
            ),
        ]);
    }
}
