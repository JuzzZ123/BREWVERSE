<?php

namespace App\Libraries;

class CartService
{
    public function add($item)
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        // If item already exists, increase quantity
        foreach ($cart as &$cartItem) {
            if ($cartItem['id'] === $item['id']) {
                $cartItem['qty'] += $item['qty'];
                $session->set('cart', $cart);
                return;
            }
        }

        $cart[] = $item;
        $session->set('cart', $cart);
    }

    public function getItems()
    {
        return session()->get('cart') ?? [];
    }

    public function clear()
    {
        session()->remove('cart');
    }
}
