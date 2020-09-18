<?php

namespace App\Infrastructure\Controller;

use App\Infrastructure\UI\Form\OrderFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\Command\AddOrderCommand;
use App\Model\Order\OrderId;
use App\Model\Order\Order;

class OrderController extends AbstractController
{
    /**
     * @Route("/neworder", name="New Order")
     * @param Request $request
     * @return Response
     */
    public function newOrder(Request $request)
    {
        $game = new Order();
        $form = $this->createFormBuilder($game)
            ->add('plateId', integerType::class)
            ->add('customerName', textType::class)
            ->add('validation', submitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isValid()) {

            $data = $form->getData();
            $orderId = OrderId::generate();

            $orderCommand = new AddOrderCommand(
                $orderId,
                $data[OrderFormType::PLATE],
                $data[OrderFormType::CUSTOMER_NAME]
            );

            $this->handleMessage($orderCommand);
            $data = $form->getData();
            dump($data);
        }

        return $this->render('new_order.html.twig', array(
            'form' => $form->createView()
        ));
    }

}