<?php

namespace App\Model\Order;

use App\Shared\Projection;

interface OrderProjection extends Projection
{
    public function projectWhenOrderWasCreated(OrderWasCreated $event);

    public function projectWhenOrderNameWasChanged(OrderPlateIdWasChanged $event);

    public function projectWhenProductPriceWasChanged(OrderCustomerNameWasChanged $event);
}