<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateProductImageToBlob extends Migration
{
    public function up()
    {
        // First, drop the existing image column
        $this->forge->dropColumn('products', 'image');

        // Then add it back as MEDIUMBLOB
        $this->forge->addColumn('products', [
            'image' => [
                'type' => 'MEDIUMBLOB',
                'null' => true,
            ]
        ]);
    }

    public function down()
    {
        // First, drop the MEDIUMBLOB column
        $this->forge->dropColumn('products', 'image');

        // Then add back the original VARCHAR column
        $this->forge->addColumn('products', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ]
        ]);
    }
} 