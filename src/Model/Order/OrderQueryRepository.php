<?php

namespace App\Model\Order;

use App\Entity\Order;

interface OrderQueryRepository
{
    public function get(string $id): Order;

    /**
     * @param int $page
     * @param int $perPage
     *
     * @return Order[]
     */
    public function fetchAll(int $page, int $perPage): array;

    public function count(): int;
}
