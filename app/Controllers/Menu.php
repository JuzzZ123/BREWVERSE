<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\CartModel;

class Menu extends BaseController
{
    protected $productModel;
    protected $cartModel;
    protected $session;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->cartModel = new CartModel();
        $this->session = session();
    }

    public function index()
    {
        $data['products'] = $this->productModel->where('status', 'in_stock')
                                              ->orderBy('category', 'ASC')
                                              ->orderBy('product_name', 'ASC')
                                              ->findAll();
        
        // Group products by category
        $data['productsByCategory'] = [];
        foreach ($data['products'] as $product) {
            $data['productsByCategory'][$product['category']][] = $product;
        }

        // Get user's cart if logged in
        $userId = $this->session->get('user_id');
        if ($userId) {
            $cartItems = $this->cartModel->getCartWithProducts($userId);
            $data['cart'] = [];
            foreach ($cartItems as $item) {
                $data['cart'][$item['product_id']] = [
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ];
            }
        } else {
            // If not logged in, show message to login
            $data['cart'] = [];
            if ($this->request->getMethod() === 'get') {
                session()->setFlashdata('error', 'Please login to start adding items to your cart.');
            }
        }
        
        return view('menu_view', $data);
    }

    public function addToCart($id)
    {
        $userId = $this->session->get('user_id');
        
        // Check if it's an AJAX request
        if ($this->request->isAJAX()) {
            if (!$userId) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Please login to add items to cart.'
                ])->setStatusCode(401);
            }

            try {
                $product = $this->productModel->find($id);
                
                if (!$product) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Product not found.'
                    ])->setStatusCode(404);
                }

                // Add to database cart
                $this->cartModel->addToCart($userId, $id);
                
                // Get updated cart data
                $cartItems = $this->cartModel->getCartWithProducts($userId);
                $cart = [];
                foreach ($cartItems as $item) {
                    $cart[$item['product_id']] = [
                        'product_name' => $item['product_name'],
                        'price' => $item['price'],
                        'quantity' => $item['quantity']
                    ];
                }

                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Item added to cart!',
                    'cart' => $cart
                ]);
            } catch (\Exception $e) {
                log_message('error', 'Cart error: ' . $e->getMessage());
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to add item to cart: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
        }

        // For non-AJAX requests
        if (!$userId) {
            return redirect()->to('/auth/login')->with('error', 'Please login to add items to cart.');
        }

        try {
            // Add to database cart
            $this->cartModel->addToCart($userId, $id);
            return redirect()->to('/menu')->with('message', 'Item added to cart!');
        } catch (\Exception $e) {
            log_message('error', 'Cart error: ' . $e->getMessage());
            return redirect()->to('/menu')->with('error', 'Failed to add item to cart: ' . $e->getMessage());
        }
    }

    public function clearCart()
    {
        $userId = $this->session->get('user_id');
        if ($userId) {
            $this->cartModel->clearUserCart($userId);
        }
        return redirect()->to('/menu')->with('message', 'Cart cleared!');
    }

    public function viewing_cart()
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login')->with('error', 'Please login to view your cart.');
        }

        $cartItems = $this->cartModel->getCartWithProducts($userId);
        $data['cart'] = [];
        foreach ($cartItems as $item) {
            $data['cart'][$item['product_id']] = [
                'product_name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ];
        }

        return view('viewing_cart', $data);
    }

    public function increaseQuantity($id)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Please login to manage your cart.'
                ])->setStatusCode(401);
            }
            return redirect()->to('/auth/login');
        }

        try {
            $cartItem = $this->cartModel->where('user_id', $userId)
                                      ->where('product_id', $id)
                                      ->first();

            if ($cartItem) {
                $this->cartModel->updateQuantity($userId, $id, $cartItem['quantity'] + 1);
                
                if ($this->request->isAJAX()) {
                    $cartItems = $this->cartModel->getCartWithProducts($userId);
                    $cart = [];
                    foreach ($cartItems as $item) {
                        $cart[$item['product_id']] = [
                            'product_name' => $item['product_name'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity']
                        ];
                    }
                    
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Quantity updated!',
                        'cart' => $cart
                    ]);
                }
            }

            return redirect()->to('/menu/viewing_cart');
        } catch (\Exception $e) {
            log_message('error', 'Cart error: ' . $e->getMessage());
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update quantity: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
            
            return redirect()->to('/menu/viewing_cart')->with('error', 'Failed to update quantity: ' . $e->getMessage());
        }
    }

    public function decreaseQuantity($id)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Please login to manage your cart.'
                ])->setStatusCode(401);
            }
            return redirect()->to('/auth/login');
        }

        try {
            $cartItem = $this->cartModel->where('user_id', $userId)
                                      ->where('product_id', $id)
                                      ->first();

            if ($cartItem) {
                if ($cartItem['quantity'] > 1) {
                    $this->cartModel->updateQuantity($userId, $id, $cartItem['quantity'] - 1);
                } else {
                    $this->cartModel->removeFromCart($userId, $id);
                }
                
                if ($this->request->isAJAX()) {
                    $cartItems = $this->cartModel->getCartWithProducts($userId);
                    $cart = [];
                    foreach ($cartItems as $item) {
                        $cart[$item['product_id']] = [
                            'product_name' => $item['product_name'],
                            'price' => $item['price'],
                            'quantity' => $item['quantity']
                        ];
                    }
                    
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Quantity updated!',
                        'cart' => $cart
                    ]);
                }
            }

            return redirect()->to('/menu/viewing_cart');
        } catch (\Exception $e) {
            log_message('error', 'Cart error: ' . $e->getMessage());
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update quantity: ' . $e->getMessage()
                ])->setStatusCode(500);
            }
            
            return redirect()->to('/menu/viewing_cart')->with('error', 'Failed to update quantity: ' . $e->getMessage());
        }
    }

    public function removeItem($id)
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login');
        }

        $this->cartModel->removeFromCart($userId, $id);
        return redirect()->to('/menu/viewing_cart')->with('message', 'Item removed from cart successfully!');
    }

    public function getCartSidebar()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        // Pass cart to a small view partial for the sidebar content only
        return view('partials/cart_sidebar_content', ['cart' => $cart]);
    }

    public function viewMenu()
    {
        $ci4_tb = $this->productModel->findAll(); // Or however you're loading products
        $cart = $this->cartModel->getCart(session()->get('username')); // If using session-based cart

        return view('menu_view', [
            'ci4_tb' => $ci4_tb,
            'cart' => $cart
        ]);
    }

    public function completeOrder()
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login');
        }

        // Get cart items and calculate total
        $cartItems = $this->cartModel->getCartWithProducts($userId);
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

        // Create new order for walk-in payment
        $orderModel = new \App\Models\OrderModel();
        $orderData = [
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'payment_method' => 'Walk-in',
            'delivery_method' => 'Pick-up', // Walk-in orders are always pick-up
            'status' => 'Pending'
        ];

        if ($orderId = $orderModel->insert($orderData)) {
            // Save order items
            $orderItemModel = new \App\Models\OrderItemModel();
            $orderItems = array_map(function($item) {
                return [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ];
            }, $cartItems);
            
            $orderItemModel->saveOrderItems($orderId, $orderItems);

            // Clear the user's cart
            $this->cartModel->clearUserCart($userId);
            return redirect()->to('/menu/viewing_cart')->with('message', 'Order submitted successfully! Please wait for admin validation.');
        }

        return redirect()->back()->with('error', 'Failed to submit order. Please try again.');
    }

    public function uploadReceipt()
    {
        $userId = $this->session->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login');
        }

        // Get form data
        $paymentMethod = $this->request->getPost('payment_method');
        $deliveryMethod = $this->request->getPost('delivery_method');
        $address = $this->request->getPost('address');

        // Get cart items and calculate total
        $cartItems = $this->cartModel->getCartWithProducts($userId);
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));

        // Handle file upload for GCash receipts
        $receiptImage = null;
        if ($paymentMethod === 'GCash') {
            $file = $this->request->getFile('receipt');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(WRITEPATH . 'uploads', $newName);
                $receiptImage = $newName;
            } else {
                return redirect()->back()->with('error', 'Please upload a valid receipt for GCash payment.');
            }
        }

        // Create new order
        $orderModel = new \App\Models\OrderModel();
        $orderData = [
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'payment_method' => $paymentMethod,
            'delivery_method' => $deliveryMethod,
            'address' => $deliveryMethod === 'Delivery' ? $address : null,
            'receipt_image' => $receiptImage,
            'status' => 'Pending'
        ];

        if ($orderId = $orderModel->insert($orderData)) {
            // Save order items
            $orderItemModel = new \App\Models\OrderItemModel();
            $orderItems = array_map(function($item) {
                return [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ];
            }, $cartItems);
            
            $orderItemModel->saveOrderItems($orderId, $orderItems);

            // Clear the user's cart
            $this->cartModel->clearUserCart($userId);
            return redirect()->to('/menu/viewing_cart')->with('message', 'Order submitted successfully! Please wait for admin validation.');
        }

        return redirect()->back()->with('error', 'Failed to submit order. Please try again.');
    }
}
