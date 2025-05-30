-- Use the existing database
USE ci4;

-- Create products table if it doesn't exist
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `product_name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10,2) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `image` VARCHAR(255),
    `rating` DECIMAL(3,2),
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data (only if table is empty)
INSERT INTO `products` (`product_name`, `description`, `price`, `category`, `rating`)
SELECT * FROM (
    SELECT 'Espresso' as product_name, 'Strong Italian coffee brewed by forcing hot water through finely-ground coffee beans' as description, 2.99 as price, 'Hot Coffee' as category, 4.5 as rating
    UNION ALL
    SELECT 'Cappuccino', 'Espresso-based coffee drink prepared with steamed milk foam', 3.99, 'Hot Coffee', 4.7
    UNION ALL
    SELECT 'Iced Latte', 'Chilled drink made with espresso and cold milk', 4.49, 'Iced Coffee', 4.6
    UNION ALL
    SELECT 'Chocolate Muffin', 'Freshly baked chocolate chip muffin', 2.99, 'Pastries', 4.4
    UNION ALL
    SELECT 'Croissant', 'Buttery, flaky French pastry', 2.49, 'Pastries', 4.3
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM `products` LIMIT 1); 