<?php

namespace App\Application\Command;

use App\Model\Order\OrderId;

class AddOrderCommand
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
     * @var string
     */
    private $customerName;

    /**
     * @param OrderId   $orderId
     * @param int       $plateId
     * @param string    $customerName
     */
    public function __construct(OrderId $orderId, int $plateId, string $customerName)
    {
        $this->orderId      = $orderId;
        $this->plateId      = $plateId;
        $this->customerName = $customerName;
    }

    /**
     * @return OrderId
     */
    public function getOrderId(): OrderId
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
