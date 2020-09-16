<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Order;

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
            $productId = ProductId::generate();

            $productCommand = new AddProductCommand(
                $productId,
                $data[OrderFormType::NAME],
                $data[OrderFormType::PRICE],
                $data[OrderFormType::DESCRIPTION]
            );

            $this->handleMessage($productCommand);
            $data = $form->getData();
            dump($data);
        }

        return $this->render('new_order.html.twig', array(
            'form' => $form->createView()
        ));
    }

}