<?php

namespace App\Application\Command\Handler;

use App\Model\Order\OrderId;
use App\Model\Order\OrderRepository;
use App\Application\Command\DeleteOrderCommand;
use App\Application\Command\Handler\AbstractCommandHandler;

class DeleteOrderHandler extends AbstractCommandHandler
{

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        parent::__construct($orderRepository);
    }

    public function __invoke(DeleteOrderCommand $command)
    {
        dump($command);
    }
}




