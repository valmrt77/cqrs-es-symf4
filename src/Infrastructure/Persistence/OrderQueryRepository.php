<?php

namespace App\Infrastructure\Persistence;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\ParameterType;
use App\Model\Order\OrderQueryRepository as OrderQueryPort;
use App\Model\Order\OrderView;

class OrderQueryRepository implements OrderQueryPort
{
    protected $connection;
    protected $orderViewMapper;

    public function __construct(Connection $connection, OrderViewMapper $orderViewMapper)
    {
        $this->connection = $connection;
        $this->orderViewMapper = $orderViewMapper;
    }

    public function get(int $id): OrderView
    {
        $stmt = $this->connection->prepare('SELECT * FROM `orders` WHERE id=:id');
        $stmt->execute([':id' => $id]);

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $this->orderViewMapper->map($data);
    }

    public function fetchAll(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;

        $stmt = $this->connection->prepare('SELECT * FROM `orders` LIMIT :offset,:perPage');
        $stmt->bindValue(':perPage', $perPage, ParameterType::INTEGER);
        $stmt->bindValue(':offset', $offset, ParameterType::INTEGER);
        $stmt->execute();

        $orders = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $orders[] = $this->orderViewMapper->map($row);
        }

        $stmt->closeCursor();

        return $orders;
    }

    /**
     * TODO: implement caching
     *
     * @return int
     */
    public function count(): int
    {
        return (int) $this->connection->fetchColumn('SELECT COUNT(id) AS total from `orders`');
    }
}
