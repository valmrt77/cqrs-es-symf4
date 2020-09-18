<?php

namespace App\Infrastructure\Persistence;

use App\Model\Order\Order;
use App\Model\Order\OrderProjection;
use App\Model\Order\OrderRepository as OrderRepositoryPort;
use App\Shared\AggregateId;
use App\Shared\EventStore;
use App\Shared\RecordsEvents;

class OrderRepository implements OrderRepositoryPort
{
    /**
     * @var EventStore
     */
    private $eventStore;

    /**
     * @var OrderProjection
     */
    private $projection;

    public function __construct(EventStore $eventStore, OrderProjection $projection)
    {
        $this->eventStore = $eventStore;
        $this->projection = $projection;
    }

    public function add(RecordsEvents $aggregate)
    {
        $recordedEvents = $aggregate->getRecordedEvents();
        $this->eventStore->append($recordedEvents);
        $this->projection->project($recordedEvents);

        $aggregate->clearRecordedEvents();
    }

    public function get(AggregateId $id): RecordsEvents
    {
        $events = $this->eventStore->get($id);

        return Order::reconstituteFromHistory($events);
    }
}
