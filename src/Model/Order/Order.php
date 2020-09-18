<?php

namespace App\Model\Order;

use App\Model\Order\OrderRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use SfCQRSDemo\Model\Product\OrderCustomerNameWasChanged;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $plateId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customerName;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlateId(): ?int
    {
        return $this->plateId;
    }

    public function setPlateId(int $plateId): self
    {
        $this->plateId = $plateId;

        return $this;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function changePlateId(string $newPlate)
    {
        if ($newPlate === $this->plateId){
            return;
        }

        $this->applyAndRecordThat(
            new PlateIdWasChanged($this->id, $newPlate)
        );
    }

    public function changeCustomerName(float $newCustomer)
    {
        if ($newCustomer === $this->customerName) {
            return;

        }
        $this->applyAndRecordThat(
            new OrderCustomerNameWasChanged($this->id, $newCustomer)
        );
    }

    public static function reconstituteFromHistory(DomainEventsHistory $eventsHistory)
    {
        $order = static::createEmptyOrderWithId($eventsHistory->getAggregateId());

        foreach ($eventsHistory as $event) {
            $order->apply($event);
        }

        return $order;
    }

    protected function applyOrderWasCreated(OrderWasCreated $event)
    {
        $this->plateId = $event->getPlateId();
        $this->customerName = $event->getCustomerName();
    }

    protected function applyOrderPlateIdWasChanged(OrderPlateIdWasChanged $event)
    {
        $this->plateId = $event->getPlateId();
    }

    protected function applyOrderCustomerNameWasChanged(OrderCustomerNameWasChanged $event)
    {
        $this->customerName = $event->getCustomerName();
    }
}
