<?php

namespace App\Application\Query\Handler;

use App\Application\Query\OrderQuery;
use App\Application\Query\Handler\AbstractQueryHandler;

class OrderQueryHandler extends AbstractQueryHandler
{
    public function __invoke(OrderQuery $query)
    {
        return $this->repository->get($query->getId());
    }
}
