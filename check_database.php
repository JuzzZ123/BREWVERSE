<?php

// Load CodeIgniter environment
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/app/Config/Paths.php';
$app->systemDirectory = __DIR__ . '/system';
$app->appDirectory = __DIR__ . '/app';
$app->writableDirectory = __DIR__ . '/writable';
$app->testsDirectory = __DIR__ . '/tests';

// Initialize CodeIgniter
$app->initialize();

// Get database connection
$db = \Config\Database::connect();

echo "Checking database connection...\n";

try {
    // Check if we can connect
    $db->connect();
    echo "Database connection successful!\n\n";

    // Check if products table exists
    $tables = $db->listTables();
    echo "Available tables:\n";
    foreach ($tables as $table) {
        echo "- $table\n";
    }
    echo "\n";

    if (in_array('products', $tables)) {
        echo "Products table exists!\n";
        
        // Get table structure
        $fields = $db->getFieldData('products');
        echo "\nProducts table structure:\n";
        foreach ($fields as $field) {
            echo "- {$field->name}: {$field->type}\n";
        }
        
        // Count products
        $count = $db->table('products')->countAllResults();
        echo "\nNumber of products in database: $count\n";
    } else {
        echo "Products table does not exist!\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 