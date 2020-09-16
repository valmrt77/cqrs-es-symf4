<?php

namespace App\CommandHandler\Orm;

use App\Command\DeleteOrder;
use App\CommandHandler\DeleteOrderCommandHandlerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repository\OrderRepository;

class DeleteOrderCommandHandler implements DeleteOrderCommandHandlerInterface
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param DeleteOrder $deleteOrder
     *
     * @throws NotFoundHttpException
     */
    public function __invoke(DeleteOrder $deleteOrder)
    {
        $order = $this->orderRepository->findOneBy(['id' => $deleteOrder->getId()]);

        if (!$order) {
            throw new NotFoundHttpException('Order not found');
        }

        $this->orderRepository->remove($order);
    }
}