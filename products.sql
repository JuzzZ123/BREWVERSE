CREATE TABLE `products` (
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

-- Insert some sample data
INSERT INTO `products` (`product_name`, `description`, `price`, `category`, `rating`) VALUES
('Espresso', 'Strong Italian coffee brewed by forcing hot water through finely-ground coffee beans', 2.99, 'Hot Coffee', 4.5),
('Cappuccino', 'Espresso-based coffee drink prepared with steamed milk foam', 3.99, 'Hot Coffee', 4.7),
('Iced Latte', 'Chilled drink made with espresso and cold milk', 4.49, 'Cold Coffee', 4.6),
('Chocolate Muffin', 'Freshly baked chocolate chip muffin', 2.99, 'Pastries', 4.4),
('Croissant', 'Buttery, flaky French pastry', 2.49, 'Pastries', 4.3); 