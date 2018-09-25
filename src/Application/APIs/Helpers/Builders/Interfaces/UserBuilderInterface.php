<?php

namespace App\Application\APIs\Helpers\Builders\Interfaces;

use App\Application\APIs\Interfaces\InputItemInterface;
use App\Domain\Models\Interfaces\ClientInterface;
use App\Domain\Models\Interfaces\UserInterface;

interface UserBuilderInterface extends BuilderInterface
{
    /**
     * @param InputItemInterface $inputItem
     * @param ClientInterface $client
     *
     * @return UserBuilderInterface
     */
    public function build(InputItemInterface $inputItem, ClientInterface $client): self;

    /**
     * @return UserInterface
     */
    public function getEntity(): UserInterface;
}
