<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $validationRules = [
        'order_id' => 'required|numeric',
        'product_id' => 'required|numeric',
        'quantity' => 'required|numeric|greater_than[0]',
        'price' => 'required|numeric|greater_than[0]'
    ];

    // Save multiple order items at once
    public function saveOrderItems($orderId, $items)
    {
        foreach ($items as $item) {
            $this->insert([
                'order_id' => $orderId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }
        return true;
    }
} 