<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Cart as CartEntity;
use App\Enum\CartStatus;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    public function __construct(private RequestStack $stack, private Mailer $mailer)
    {
    }

    public function getCartInstance(): CartEntity
    {
        $session = $this->stack->getSession();
        if ($session->has('cart')) {
            return $this->getCartInstanceFromSession($session);
        } else {
           return $this->initializeCartInstance();
        }
    }

    public function initialize(): void
    {
        // @TODO create an instance of Cart.
    }

    public function clear(): void
    {
        $session = $this->stack->getSession();
        $session->remove('cart');
        // @TODO clear others entries if necessary
    }

    public function addToCart(): void
    {
        // @TODO add a product ot the Cart
    }

    public function changeStatus(): void
    {
        // @TODO changes the cart status
    }

    public function updateCart(): void
    {
        // @TODO updates the content of the Cart
    }

    public function remove(): void
    {
        // @TODO removes a product from the Cart
    }

    public function checkoutCart(CartEntity $cart): void
    {
        // @TODO status of the $cart
        $cart->setStatus(CartStatus::PENDING);
        // @TODO send mail to  the admin & a copy to the customer
        $this->mailer->notifyUserAfterCheckout();
    }

    private function initializeCartInstance(): CartEntity
    {
        $session = $this->stack->getSession();
        $cart = new CartEntity();
        $cart->setCreatedAt(new \DateTimeImmutable())
            ->setStatus(CartStatus::OPENED);
        $session->set('cart', $cart);

        return $cart;
    }

    private function getCartInstanceFromSession(SessionInterface $session): CartEntity
    {
       return $session->get('cart');
    }
}
