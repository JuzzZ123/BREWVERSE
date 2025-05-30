<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Cart extends BaseController
{
    public function addToCart()
    {
        $productId = $this->request->getPost('product_id');
        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        // Check if product is out of stock
        if ($product['status'] === 'out_of_stock') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sorry, this product is out of stock'
            ]);
        }

        // Get current cart from session
        $cart = session()->get('cart') ?? [];

        // Add/update product in cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product['id'],
                'name' => $product['product_name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }

        // Update cart in session
        session()->set('cart', $cart);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Product added to cart',
            'cart_count' => count($cart)
        ]);
    }

    public function viewCart()
    {
        $cart = session()->get('cart') ?? [];
        $productModel = new ProductModel();
        
        // Check stock status for all cart items
        foreach ($cart as $productId => &$item) {
            $product = $productModel->find($productId);
            if ($product['status'] === 'out_of_stock') {
                $item['out_of_stock'] = true;
            }
        }

        return view('cart', [
            'cart' => $cart
        ]);
    }
} 