<?php

namespace App\Model\Order;

interface OrderQueryRepository
{
    public function get(int $id): OrderView;

    /**
     * @param int $page
     * @param int $perPage
     *
     * @return OrderView[]
     */
    public function fetchAll(int $page, int $perPage): array;

    public function count(): int;
}
