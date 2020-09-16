<?php

use Symfony\Component\Messenger\MessageBusInterface;

class OrderService implements OrderServiceInterface
{
    /** @var MessageBusInterface  */
    private $messageBus;

    public function __construct(
        MessageBusInterface $messageBus
    ){
        $this->messageBus = $messageBus;
    }

    public function getOrder(string $id)
    {
        return $this->messageBus->dispatch(
            new GetOrderQuery($id)
        );
    }

    public function deleteOrder(string $id)
    {
        $this->messageBus->dispatch(
            new DeleteOrderCommand($id)
        );
    }
}