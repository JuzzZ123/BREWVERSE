<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateCartForeignKey extends Migration
{
    public function up()
    {
        // First, copy the data from ci4_tb to products if needed
        $this->db->query("
            INSERT IGNORE INTO products (id, product_name, price)
            SELECT id, product_name, price FROM ci4_tb
        ");

        // Drop the existing foreign key
        $this->db->query('ALTER TABLE cart DROP FOREIGN KEY fk_ci4_tb');
        
        // Rename the column
        $this->db->query('ALTER TABLE cart CHANGE ci4_tb_id product_id INT(11)');
        
        // Add new foreign key
        $this->db->query('ALTER TABLE cart ADD CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE');
        
        // Update default value for user_id
        $this->db->query('ALTER TABLE cart MODIFY user_id INT(11) NULL DEFAULT NULL');
    }

    public function down()
    {
        // Drop the new foreign key
        $this->db->query('ALTER TABLE cart DROP FOREIGN KEY fk_product');
        
        // Rename the column back
        $this->db->query('ALTER TABLE cart CHANGE product_id ci4_tb_id INT(11)');
        
        // Add back the original foreign key
        $this->db->query('ALTER TABLE cart ADD CONSTRAINT fk_ci4_tb FOREIGN KEY (ci4_tb_id) REFERENCES ci4_tb(id)');
    }
} 