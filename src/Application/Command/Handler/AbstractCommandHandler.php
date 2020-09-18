<?php

namespace App\Application\Command\Handler;

use App\Model\Order\OrderRepository;

abstract class AbstractCommandHandler
{
    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
}
