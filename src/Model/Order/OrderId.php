<?php

namespace App\Model\Order;

use App\Shared\AggregateId;
use App\Shared\UuidGenerator;

class OrderId implements AggregateId
{
    private $orderId;

    public static function generate(): OrderId
    {
        return new OrderId(UuidGenerator::generate());
    }

    public static function fromString(string $orderId): OrderId
    {
        return new OrderId($orderId);
    }

    public function __toString()
    {
        return (string) $this->orderId;
    }

    public function equals(AggregateId $other)
    {
        return $other instanceof OrderId && $other->orderId === $this->orderId;
    }

    public function __construct(string $orderId)
    {
        $this->orderId = $orderId;
    }
}
