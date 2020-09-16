<?php

namespace App\Shared;

interface AggregateId
{
    public static function fromString(string $orderId);

    public function __toString();

    public function equals(AggregateId $other);
}
