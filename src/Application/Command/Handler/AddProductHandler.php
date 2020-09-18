<?php

namespace App\Application\Command\Handler;

use App\Application\Command\AddOrderCommand;
use App\Model\Order\Order;

class AddOrderHandler extends AbstractCommandHandler
{
    public function __invoke(AddOrderCommand $command)
    {
        $newOrder = Order::create(
            $command->getOrderId(),
            $command->getPlateId(),
            $command->getCustomerName()
        );

        $this->orderRepository->add($newOrder);
    }
}
