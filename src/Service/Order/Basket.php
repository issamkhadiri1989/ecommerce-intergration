<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class Basket implements OrderInterface
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    /**
     * @inheritDoc
     */
    public function addToCart(CartItem $item): void
    {
        $session = $this->requestStack->getSession();
        if ($session->has('cart')) {
            $cart = $session->get('cart');
        } else {
            $cart = $this->initiateCart();
        }
        $cart = $this->updateQuantity($cart, $item);
        $session->set('cart', $cart);
    }

    /**
     * @inheritDoc
     */
    public function initiateCart(): mixed
    {
        return [
            'created_at' => new \DateTimeImmutable(),
            'items' => [],
        ];
    }

    /**
     * Updates the quantity of a given product in the cart and returns the new cart.
     *
     * @param array    $cart
     * @param CartItem $item
     *
     * @return array
     */
    private function updateQuantity(array $cart, CartItem $item): array
    {
        $productId = $item->getProduct()->getId();
        $oldQuantity = $cart['items'][$productId] ?? 0;
        $cart['items'][$productId] = $oldQuantity + $item->getQuantity();

        return $cart;
    }
}
