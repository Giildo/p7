<?php

namespace App\Application\APIs\Users\OutputList;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Users\OutputItems\UserOutput;
use App\Application\APIs\Users\OutputList\Interfaces\UserOutputListInterface;
use App\Domain\Models\User;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

class UserOutputList implements UserOutputListInterface, OutputItemInterface
{
    /**
     * @SWG\Property(
     *     type="array",
     *     @SWG\Items(ref=@Model(type=App\Application\APIs\Users\OutputItems\UserOutput::class))
     * )
     *
     * @var UserOutput[]
     */
    private $users = [];

    /**
     * UserOutputList constructor.
     * @param User[]|array|null $users
     */
    public function __construct(?array $users = [])
    {
        $this->users = $users;
    }

    /**
     * @param OutputItemInterface $outputItem
     *
     * @return void
     */
    public function add(OutputItemInterface $outputItem): void
    {
        $this->users[] = $outputItem;
    }

    /**
     * @return UserOutput[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
