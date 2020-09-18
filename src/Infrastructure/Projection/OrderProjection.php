<?php

namespace App\Infrastructure\Projection;

use Doctrine\DBAL\Connection;
use App\Model\Order\OrderPlateIdWasChanged;
use App\Model\Order\OrderCustomerNameWasChanged;
use App\Model\Order\OrderProjection as OrderProjectionPort;
use App\Model\Order\OrderWasCreated;
use App\Shared\AbstractProjection;
use Doctrine\DBAL\DBALException;

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

    public function projectWhenOrderWasCreated(OrderWasCreated $event)
    {
        try {
            $stmt = $this->connection->prepare(
                'INSERT INTO `orders` (`id`, `plateId`, `customerName`) 
                 VALUES (:id, :plateId, :customerName)'
            );
        } catch (DBALException $e) {
            dump($e);
            return;
        }

        try {
            $stmt->execute([
                ':id' => (string)$event->getAggregateId(),
                ':plateId' => $event->getPlateId(),
                ':customerName' => $event->getCustomerName(),
            ]);
        } catch (DBALException $e) {
            dump($e);
        }
    }

    public function projectWhenPlateIdWasChanged(OrderPlateIdWasChanged $event)
    {
        try {
            $this->connection->executeQuery(
                'UPDATE `orders` SET `plateId`=? WHERE id=?',
                [
                    $event->getPlateId(),
                    (string)$event->getAggregateId(),
                ]
            );
        } catch (DBALException $e) {
            dump($e);
        }
    }

    public function projectWhenCustomerNameWasChanged(OrderCustomerNameWasChanged $event)
    {
        try {
            $this->connection->executeQuery(
                'UPDATE `orders` SET `customerName`=? WHERE id=?',
                [
                    $event->getCustomerName(),
                    (string)$event->getAggregateId(),
                ]
            );
        } catch (DBALException $e) {
            dump($e);
        }
    }
}
