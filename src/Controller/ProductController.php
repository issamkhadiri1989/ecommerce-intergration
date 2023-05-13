<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\Type\CartItemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product')]
    public function index(Product $product): Response
    {
        $cartItem = new CartItem();
        $cartItem->setProduct($product)->setQuantity(1);
        $form = $this->createForm(CartItemType::class, $cartItem);

        return $this->render('product/index.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
