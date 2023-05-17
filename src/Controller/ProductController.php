<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\Type\CartItemType;
use App\Service\Order\OrderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product')]
    public function index(Product $product, Request $request, OrderInterface $order): Response
    {
        $cartItem = new CartItem();
        $cartItem->setProduct($product)->setQuantity(1);
        $form = $this->createForm(CartItemType::class, $cartItem);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $order->addToCart($cartItem);

            return $this->redirectToRoute('app_product', ['id' => $product->getId()]);
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
