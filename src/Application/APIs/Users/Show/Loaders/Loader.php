<?php

namespace App\Application\APIs\Users\Show\Loaders;

use App\Application\APIs\Exceptions\ItemNotFoundException;
use App\Application\APIs\Helpers\Hateoas\Interfaces\HateoasBuilderInterface;
use App\Application\APIs\Interfaces\InputInterface;
use App\Application\APIs\Interfaces\OutputListInterface;
use App\Application\APIs\Users\OutputItems\UserOutput;
use App\Application\APIs\Users\OutputList\UserOutputList;
use App\Application\APIs\Users\Show\InputItems\Interfaces\OneUserInputInterface;
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
     * @param OneUserInputInterface|InputInterface|null $inputFilters
     *
     * @return OutputListInterface|null
     *
     * @throws ItemNotFoundException
     */
    public function load(?InputInterface $inputFilters = null): ?OutputListInterface
    {
        try {
            $user = $this->userRepository->loadOneUserByClientUsernameAndUserId(
                $inputFilters->getId(),
                $inputFilters->getUsername()
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
                $this->hateoasBuilder->build(
                    'Users_list',
                    ['client' => $inputFilters->getUsername()],
                    'list',
                    'GET'
                )
            ),
        ]);
    }
}
