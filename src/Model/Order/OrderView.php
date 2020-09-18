<?php


namespace App\Model\Order;

use Symfony\Component\Validator\Constraints\Date;

class OrderView
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $plateId;

    /**
     * @var string
     */
    private $customerName;

    /**
     * @var date
     */
    private $createdAt;

    /**
     * @var date
     */
    private $updatedAt;

    /**
     * @param int    $id
     * @param int    $plateId
     * @param string $customerName
     * @param date   $createdAt
     * @param date   $updatedAt
     */
    public function __construct(int $id, int $plateId, string $customerName, date $createdAt, date $updatedAt)
    {
        $this->id           = $id;
        $this->plateId      = $plateId;
        $this->customerName = $customerName;
        $this->createdAt    = $createdAt;
        $this->updatedAt    = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    /**
     * @return date
     */
    public function getDescription(): date
    {
        return $this->createdAt;
    }

    /**
     * @return date
     */
    public function getImages(): date
    {
        return $this->updatedAt;
    }
}