<?php

namespace App\Application\APIs\Users\All\OutputList;

use App\Application\APIs\Interfaces\OutputItemInterface;
use App\Application\APIs\Users\All\OutputList\Interfaces\UserOutputListInterface;
use App\Domain\Models\User;

class UserOutputList implements UserOutputListInterface, OutputItemInterface
{
    /**
     * @var User[]|array|null
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
    public function addOutputItem(OutputItemInterface $outputItem): void
    {
        $this->users[] = $outputItem;
    }

    /**
     * @return OutputItemInterface[]|array
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
