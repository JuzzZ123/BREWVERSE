<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'user_id',
        'total_amount',
        'payment_method',
        'delivery_method',
        'address',
        'status',
        'receipt_image',
        'admin_validated',
        'validation_date',
        'validation_notes',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'user_id' => 'required|numeric',
        'total_amount' => 'required|numeric',
        'payment_method' => 'required|in_list[Cash,GCash,Walk-in]',
        'delivery_method' => 'required|in_list[Delivery,Pick-up]',
        'status' => 'required|in_list[Pending,Validated,Rejected,Completed]'
    ];

    protected $validationMessages = [
        'user_id' => [
            'required' => 'User ID is required',
            'numeric' => 'User ID must be numeric'
        ],
        'total_amount' => [
            'required' => 'Total amount is required',
            'numeric' => 'Total amount must be numeric'
        ],
        'payment_method' => [
            'required' => 'Payment method is required',
            'in_list' => 'Invalid payment method'
        ],
        'delivery_method' => [
            'required' => 'Delivery method is required',
            'in_list' => 'Invalid delivery method'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Invalid status'
        ]
    ];

    // Get all pending orders
    public function getPendingOrders()
    {
        return $this->where('status', 'Pending')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Get orders by user ID
    public function getUserOrders($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Validate order
    public function validateOrder($orderId, $adminId, $status, $notes = '')
    {
        return $this->update($orderId, [
            'status' => $status,
            'admin_validated' => $adminId,
            'validation_date' => date('Y-m-d H:i:s'),
            'validation_notes' => $notes
        ]);
    }

    // Get order items with product details
    public function getOrderItems($orderId)
    {
        $db = \Config\Database::connect();
        return $db->table('order_items')
                 ->select('order_items.*, products.product_name, products.price')
                 ->join('products', 'products.id = order_items.product_id')
                 ->where('order_items.order_id', $orderId)
                 ->get()
                 ->getResultArray();
    }
} 