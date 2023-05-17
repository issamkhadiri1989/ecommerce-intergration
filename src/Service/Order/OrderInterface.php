<?php

namespace App\Service\Order;

use App\Entity\CartItem;

/**
 * Implementation of Adding to cart functionalities.
 */
interface OrderInterface
{
    /**
     * Add the item to the cart.
     *
     * @param CartItem $item
     *
     * @return void
     */
    public function addToCart(CartItem $item): void;

    /**
     * Initiates a new cart.
     *
     * @return mixed
     */
    public function initiateCart(): mixed;
}
