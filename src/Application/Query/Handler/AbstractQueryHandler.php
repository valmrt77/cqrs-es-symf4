<?php

namespace App\Application\Query\Handler;

use App\Model\Order\OrderQueryRepository;

abstract class AbstractQueryHandler
{
    protected $repository;

    public function __construct(OrderQueryRepository $orderRepository)
    {
        $this->repository = $orderRepository;
    }
}
