<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <?php if (empty($cartItems)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($cartItems as $item): ?>
                <li><?= esc($item['name']) ?> - ₱<?= esc($item['price']) ?> x <?= esc($item['qty']) ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="<?= base_url('menu/clear-cart') ?>">Clear Cart</a>
    <?php endif; ?>

    <br>
    <a href="<?= base_url('menu') ?>">Back to Menu</a>
</body>
</html>
