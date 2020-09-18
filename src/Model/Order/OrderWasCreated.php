<?php

namespace App\Model\Order;

use App\Shared\AggregateId;
use App\Shared\DomainEvent;

class OrderWasCreated implements DomainEvent
{
    /**
     * @var OrderId
     */
    private $orderId;
    private $plateId;
    private $customerName;

    public function __construct($orderId, $plateId, $customerName)
    {
        $this->orderId = $orderId;
        $this->plateId = $plateId;
        $this->customerName = $customerName;
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

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }
}
