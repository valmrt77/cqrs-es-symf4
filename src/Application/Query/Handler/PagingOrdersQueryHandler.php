<?php
namespace App\Application\Query\Handler;

use App\Application\Query\PagingOrdersQuery;

class PagingOrdersQueryHandler extends AbstractQueryHandler
{
    public function __invoke(PagingOrdersQuery $query)
    {
        return $this->repository->fetchAll($query->getPage(), $query->getPerPage());
    }
}
