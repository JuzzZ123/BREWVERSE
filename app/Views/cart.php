<!-- app/Views/cart.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
            padding: 20px;
        }

        .cart {
            max-width: 600px;
            margin: auto;
            background: #f7f7f7;
            padding: 30px;
            border-radius: 10px;
        }

        h2 {
            color: #6f4e37;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="cart">
    <h2>Your Cart</h2>
    <?php if (!empty($cart)): ?>
        <ul>
            <?php foreach ($cart as $item): ?>
                <li><?= esc($item['product_name']) ?> (x<?= esc($item['quantity']) ?>) — ₱<?= number_format($item['price'] * $item['quantity'], 2) ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="total">
            Total: ₱<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?>
        </div>
    <?php else: ?>
        <p>No items in cart.</p>
    <?php endif; ?>
</div>

</body>
</html>
