<?php


namespace App\Model\Order;

use App\Shared\Projection;

class OrderProjection extends Projection
{

    public function projectWhenProductWasCreated(ProductWasCreated $event);

    public function projectWhenProductNameWasChanged(ProductNameWasChanged $event);

    public function projectWhenProductPriceWasChanged(ProductPriceWasChanged $event);

    public function projectWhenProductDescriptionWasChanged(ProductDescriptionWasChanged $event);

    public function projectWhenImageWasAdded(ImageWasAdded $event);
}