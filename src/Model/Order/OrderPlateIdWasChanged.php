<?php

namespace App\Model\Order;

use App\Shared\AggregateId;
use App\Shared\DomainEvent;

class OrderPlateIdWasChanged implements DomainEvent
{
    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * @var int
     */
    private $plateId;

    /**
     * @param OrderId $orderId
     * @param int     $plateId
     */
    public function __construct(OrderId $orderId, int $plateId)
    {
        $this->orderId = $orderId;
        $this->plateId = $plateId;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->orderId;
    }

    /**
     * @return int
     */
    public function getPlateId(): int
    {
        return $this->plateId;
    }
}
