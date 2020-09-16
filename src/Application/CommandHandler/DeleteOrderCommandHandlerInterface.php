<?php

namespace App\CommandHandler;

use App\Command\DeleteOrder;

interface DeleteOrderCommandHandlerInterface
{
    public function __invoke(DeleteOrder $deleteOrder);
}