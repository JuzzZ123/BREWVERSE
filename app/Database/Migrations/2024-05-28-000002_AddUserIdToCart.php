<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToCart extends Migration
{
    public function up()
    {
        // Add user_id column to cart table
        $this->forge->addColumn('cart', [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'id'
            ]
        ]);

        // Add foreign key
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->processIndexes('cart');
    }

    public function down()
    {
        // Remove foreign key first
        $this->db->query('ALTER TABLE cart DROP FOREIGN KEY cart_user_id_foreign');
        
        // Then remove the column
        $this->forge->dropColumn('cart', 'user_id');
    }
} 