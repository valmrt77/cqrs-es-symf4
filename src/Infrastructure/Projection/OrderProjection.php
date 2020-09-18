<?php

namespace App\Infrastructure\Projection;

use Doctrine\DBAL\Connection;
use App\Model\Order\OrderPlateIdWasChanged;
use App\Model\Order\OrderCustomerNameWasChanged;
use App\Model\Order\OrderProjection as OrderProjectionPort;
use App\Model\Order\OrderWasCreated;
use App\Shared\AbstractProjection;

abstract class OrderProjection extends AbstractProjection implements OrderProjectionPort
{
    protected $connection;

    /**
     * @param $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    abstract public function projectWhenOrderWasCreated(OrderWasCreated $event)
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO `orders` (`id`, `plateId`, `customerName`) 
             VALUES (:id, :plateId, :customerName)'
        );

        $stmt->execute([
            ':id' => (string) $event->getAggregateId(),
            ':plateId' => $event->getPlateId(),
            ':customerName' => $event->getCustomerName(),
        ]);
    }

    public function projectWhenPlateIdWasChanged(OrderPlateIdWasChanged $event)
    {
        $this->connection->executeQuery(
            'UPDATE `orders` SET `plateId`=? WHERE id=?',
            [
                $event->getPlateId(),
                (string) $event->getAggregateId(),
            ]
        );
    }

    public function projectWhenCustomerNameWasChanged(OrderCustomerNameWasChanged $event)
    {
        $this->connection->executeQuery(
            'UPDATE `orders` SET `customerName`=? WHERE id=?',
            [
                $event->getCustomerName(),
                (string) $event->getAggregateId(),
            ]
        );
    }
}
