<?php namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'quantity', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getUserCart($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function addToCart($userId, $productId, $quantity = 1)
    {
        $existing = $this->where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($existing) {
            return $this->update($existing['id'], [
                'quantity' => $existing['quantity'] + $quantity
            ]);
        }

        return $this->insert([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    public function updateQuantity($userId, $productId, $quantity)
    {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->set(['quantity' => $quantity])
                    ->update();
    }

    public function removeFromCart($userId, $productId)
    {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->delete();
    }

    public function clearUserCart($userId)
    {
        return $this->where('user_id', $userId)->delete();
    }

    public function getCartWithProducts($userId)
    {
        $db = \Config\Database::connect();
        return $db->table('cart c')
                 ->select('c.*, p.product_name, p.price, p.image')
                 ->join('products p', 'p.id = c.product_id')
                 ->where('c.user_id', $userId)
                 ->get()
                 ->getResultArray();
    }
}