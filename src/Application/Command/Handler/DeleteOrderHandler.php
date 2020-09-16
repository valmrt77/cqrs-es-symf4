<?php

namespace App\Application\Command\Handler;

use App\Model\Order\OrderRepository;
use SfCQRSDemo\Application\Command\Handler\AbstractCommandHandler;

class DeleteOrderHandler extends AbstractCommandHandler
{

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        parent::__construct($orderRepository);
    }
}




