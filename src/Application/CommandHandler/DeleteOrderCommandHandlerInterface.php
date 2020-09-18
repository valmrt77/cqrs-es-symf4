<?php

namespace App\CommandHandler;

use App\Command\DeleteOrderCommand;

interface DeleteOrderCommandHandlerInterface
{
    public function __invoke(DeleteOrderCommand $deleteOrder);
}