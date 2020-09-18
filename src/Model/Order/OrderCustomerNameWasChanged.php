<?php

namespace App\Model\Order;

use App\Shared\AggregateId;
use App\Shared\DomainEvent;

class OrderCustomerNameWasChanged implements DomainEvent
{
    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * @var string
     */
    private $customerName;

    /**
     * @param ProductId $orderId
     * @param string    $customerName
     */
    public function __construct(ProductId $orderId, string $customerName)
    {
        $this->orderId = $orderId;
        $this->customerName = $customerName;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }
}
