<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddArchivedToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'is_archived' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'after' => 'is_admin'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'is_archived');
    }
} 