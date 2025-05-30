<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckDatabase extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:check';
    protected $description = 'Check database connection and products table';

    public function run(array $params)
    {
        CLI::write('Checking database connection...', 'yellow');

        try {
            $db = \Config\Database::connect();
            $db->connect();
            CLI::write('Database connection successful!', 'green');

            // Check if products table exists
            $tables = $db->listTables();
            CLI::newLine();
            CLI::write('Available tables:', 'yellow');
            foreach ($tables as $table) {
                CLI::write("- $table");
            }
            CLI::newLine();

            if (in_array('products', $tables)) {
                CLI::write('Products table exists!', 'green');
                
                // Get table structure
                $fields = $db->getFieldData('products');
                CLI::newLine();
                CLI::write('Products table structure:', 'yellow');
                foreach ($fields as $field) {
                    CLI::write("- {$field->name}: {$field->type}");
                }
                
                // Count products
                $count = $db->table('products')->countAllResults();
                CLI::newLine();
                CLI::write("Number of products in database: $count", 'green');
            } else {
                CLI::write('Products table does not exist!', 'red');
            }

        } catch (\Exception $e) {
            CLI::error('Error: ' . $e->getMessage());
        }
    }
} 