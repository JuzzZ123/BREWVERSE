<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateProductsTable extends Migration
{
    public function up()
    {
        // Drop the existing table if it exists
        $this->forge->dropTable('products', true);

        // Create the products table with the correct structure
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'image' => [
                'type'       => 'MEDIUMBLOB',
                'null'       => true,
            ],
            'rating' => [
                'type'       => 'DECIMAL',
                'constraint' => '3,2',
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['in_stock', 'out_of_stock'],
                'default'    => 'in_stock',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('products');

        // Insert sample data
        $seeder = \Config\Database::connect();
        $seeder->table('products')->insertBatch([
            [
                'product_name' => 'Espresso',
                'description' => 'Strong Italian coffee brewed by forcing hot water through finely-ground coffee beans',
                'price' => 2.99,
                'category' => 'Hot Coffee',
                'rating' => 4.5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_name' => 'Cappuccino',
                'description' => 'Espresso-based coffee drink prepared with steamed milk foam',
                'price' => 3.99,
                'category' => 'Hot Coffee',
                'rating' => 4.7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'product_name' => 'Iced Latte',
                'description' => 'Chilled drink made with espresso and cold milk',
                'price' => 4.49,
                'category' => 'Iced Coffee',
                'rating' => 4.6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
} 