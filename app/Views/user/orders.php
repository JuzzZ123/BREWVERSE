<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Orders - Brewverse</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Space Grotesk', sans-serif;
    color: #E0E0E0;
    background-color: #0A0F1C;
}

/* Navbar Styling */
.navbar {
    background: rgba(13, 17, 23, 0.95) !important;
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem 2rem;
    transition: all 0.3s ease;
}

.navbar-brand {
    font-size: 1.5rem;
    font-weight: 700;
    color: #7B4CFF !important;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.navbar-logo {
    height: 35px;
    width: auto;
    transition: transform 0.3s ease;
}

.navbar-brand:hover .navbar-logo {
    transform: rotate(10deg);
}

.nav-link {
    color: #E0E0E0 !important;
    font-weight: 500;
    position: relative;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    width: 0;
    height: 2px;
    background: #7B4CFF;
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 100%;
}

.nav-link:hover {
    color: #7B4CFF !important;
}

/* Profile Button Styling */
.profile-button {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    border: none;
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.profile-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
}

/* Profile Image Container */
.profile-image-container {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #7B4CFF;
}

/* Dropdown Menu Styling */
.dropdown-menu {
    background: rgba(13, 17, 23, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    margin-top: 1rem;
}

.dropdown-item {
    color: #E0E0E0;
    transition: all 0.3s ease;
    padding: 0.75rem 1.5rem;
}

.dropdown-item:hover {
    background: rgba(123, 76, 255, 0.1);
    color: #7B4CFF;
}

.dropdown-divider {
    border-color: rgba(255, 255, 255, 0.1);
}

/* Footer Styles */
.footer-section {
    background: linear-gradient(180deg, #0A0F1C 0%, #151C32 100%);
    position: relative;
    overflow: hidden;
    padding: 80px 0 30px;
    color: #E0E0E0;
    font-family: 'Exo 2', sans-serif;
}

/* Brand Section */
.footer-logo {
    text-decoration: none;
    position: relative;
    display: inline-block;
}

.gradient-text {
    font-family: 'Orbitron', sans-serif;
    font-size: 1.8rem;
    font-weight: 700;
    background: linear-gradient(135deg, #7B4CFF 0%, #9D7BFF 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 1px;
}

.footer-about {
    color: #A8B2D1;
    line-height: 1.8;
    margin-top: 1.5rem;
    font-size: 0.95rem;
    position: relative;
    padding-left: 1rem;
    border-left: 2px solid rgba(123, 76, 255, 0.3);
}

/* Enhanced Social Links */
.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.social-link {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(123, 76, 255, 0.1);
    border: 1px solid rgba(123, 76, 255, 0.2);
    border-radius: 12px;
    color: #7B4CFF;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.social-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 0;
}

.social-link i {
    position: relative;
    z-index: 1;
    transition: all 0.3s ease;
}

.social-link:hover {
    transform: translateY(-5px) scale(1.1);
    box-shadow: 0 5px 15px rgba(123, 76, 255, 0.3);
}

.social-link:hover::before {
    opacity: 1;
}

.social-link:hover i {
    color: white;
}

/* Enhanced Footer Titles */
.footer-title {
    font-family: 'Orbitron', sans-serif;
    color: #FFF;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1.8rem;
    position: relative;
    padding-bottom: 0.8rem;
    letter-spacing: 1px;
}

.footer-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #7B4CFF, transparent);
    transition: width 0.3s ease;
}

.footer-title:hover::after {
    width: 100px;
}

/* Enhanced Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 1rem;
}

.footer-links a {
    color: #A8B2D1;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
    padding-left: 0;
}

.footer-links a::before {
    content: '→';
    position: relative;
    left: 0;
    opacity: 0;
    margin-right: 0;
    transition: all 0.3s ease;
    color: #7B4CFF;
}

.footer-links a:hover {
    color: #7B4CFF;
    padding-left: 1.5rem;
}

.footer-links a:hover::before {
    opacity: 1;
    margin-right: 0.5rem;
}

/* Enhanced Contact Info */
.footer-contact {
    list-style: none;
    padding: 0;
}

.footer-contact li {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.2rem;
    padding: 0.8rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: rgba(123, 76, 255, 0.05);
}

.footer-contact li:hover {
    background: rgba(123, 76, 255, 0.1);
    transform: translateX(5px);
}

.footer-contact i {
    color: #7B4CFF;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.footer-contact li:hover i {
    transform: scale(1.2);
}

/* Enhanced Opening Hours */
.footer-hours {
    list-style: none;
    padding: 0;
}

.footer-hours li {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    padding: 0.8rem;
    border-radius: 8px;
    background: rgba(123, 76, 255, 0.05);
    transition: all 0.3s ease;
}

.footer-hours li:hover {
    background: rgba(123, 76, 255, 0.1);
    transform: translateX(5px);
}

.footer-hours span {
    color: #A8B2D1;
    transition: color 0.3s ease;
}

.footer-hours li:hover span {
    color: #fff;
}

/* Enhanced Footer Bottom */
.footer-bottom {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(123, 76, 255, 0.2);
    position: relative;
}

.footer-bottom::before {
    content: '';
    position: absolute;
    top: -1px;
    left: 50%;
    transform: translateX(-50%);
    width: 50%;
    height: 1px;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(123, 76, 255, 0.5),
        transparent
    );
}

.copyright {
    color: #A8B2D1;
    font-size: 0.9rem;
}

.copyright i.fa-heart {
    color: #7B4CFF;
    transition: transform 0.3s ease;
}

.copyright:hover i.fa-heart {
    transform: scale(1.2);
}

.footer-bottom-links {
    display: flex;
    gap: 2rem;
    justify-content: flex-end;
}

.footer-bottom-links a {
    color: #A8B2D1;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    position: relative;
}

.footer-bottom-links a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: #7B4CFF;
    transition: width 0.3s ease;
}

.footer-bottom-links a:hover {
    color: #7B4CFF;
}

.footer-bottom-links a:hover::after {
    width: 100%;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .footer-section {
        padding: 60px 0 20px;
    }

    .footer-bottom-links {
        justify-content: center;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .copyright {
        text-align: center;
    }
}

/* Orders Styles */
.orders-container {
    padding: 2rem;
    background: linear-gradient(145deg, #1a1f2e 0%, #0d1117 100%);
    border-radius: 24px;
    border: 1px solid rgba(123, 76, 255, 0.2);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    margin-top: 2rem;
}

.cosmic-title {
    font-family: 'Orbitron', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    background: linear-gradient(135deg, #fff 0%, #7B4CFF 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 2px;
}

.order-card {
    background: rgba(255, 255, 255, 0.02);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(123, 76, 255, 0.2);
    border-radius: 24px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.order-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at top right, rgba(123, 76, 255, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.order-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    border-color: rgba(123, 76, 255, 0.4);
}

.status-badge {
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    font-weight: 500;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.status-badge.pending { 
    background: linear-gradient(135deg, #FFA500 0%, #FF6B00 100%);
    color: #000;
}
.status-badge.validated { 
    background: linear-gradient(135deg, #00FF00 0%, #00CC00 100%);
    color: #000;
}
.status-badge.rejected { 
    background: linear-gradient(135deg, #FF0000 0%, #CC0000 100%);
    color: #fff;
}

.order-items {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 16px;
    padding: 1.5rem;
    margin-top: 1.5rem;
    border: 1px solid rgba(123, 76, 255, 0.1);
}

.table {
    color: #E0E0E0;
}

.table th {
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-color: rgba(123, 76, 255, 0.2);
}

.table td {
    font-family: 'Space Grotesk', sans-serif;
    border-color: rgba(123, 76, 255, 0.1);
}

.validation-info {
    margin-top: 1rem;
    padding: 1rem;
    background: rgba(123, 76, 255, 0.05);
    border-radius: 12px;
    border-left: 3px solid #7B4CFF;
}

/* Method Badges Styling */
.method-badge {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.method-badge.payment {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    color: white;
}

.method-badge.delivery {
    background: linear-gradient(135deg, #00B4DB 0%, #0083B0 100%);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 3rem;
}

.empty-state p {
    color: #A8B2D1;
    font-size: 1.2rem;
    margin-bottom: 2rem;
}

.cosmic-btn {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    color: #fff;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 50px;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 500;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.cosmic-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
    color: #fff;
}

/* Pagination Styling */
.pagination {
    justify-content: center;
    gap: 0.5rem;
}

.pagination .page-link {
    background: rgba(123, 76, 255, 0.1);
    border: 1px solid rgba(123, 76, 255, 0.2);
    color: #E0E0E0;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    transition: all 0.3s ease;
}

.pagination .page-link:hover,
.pagination .active .page-link {
    background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
    border-color: transparent;
    color: #fff;
    transform: translateY(-2px);
}
</style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo" class="navbar-logo">
                <span>Brewverse</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars" style="color: #7B4CFF"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('main_dashboard') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('menu') ?>">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Contact</a>
                    </li>
                    
                    <?php if (session()->has('username')): ?>
                    <li class="nav-item dropdown ms-3">
                        <a class="profile-button dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-image-container">
                                <?php if (session()->has('profile_picture') && !empty(session('profile_picture'))): ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode(session('profile_picture')) ?>" 
                                         alt="Profile" 
                                         style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center h-100"
                                         style="background: #4C2EAA; color: white; font-weight: bold;">
                                        <?= strtoupper(substr(esc(session('username')), 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <span><?= esc(session('username')) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                <i class="fas fa-user-circle me-2"></i>View Profile
                            </a></li>
                            <li><a class="dropdown-item" href="<?= site_url('user/orders') ?>">
                                <i class="fas fa-shopping-bag me-2"></i>View Orders
                            </a></li>
                            <?php if (session()->get('is_admin') == 1): ?>
                            <li><a class="dropdown-item" href="<?= site_url('admin/users') ?>">
                                <i class="fas fa-users-cog me-2"></i>Manage Users
                            </a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item ms-3">
                        <a class="profile-button" href="<?= site_url('auth/login') ?>">
                            <i class="fas fa-sign-in-alt"></i>
                            Sign In
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5" style="margin-top: 76px;">
        <h1 class="cosmic-title">My Cosmic Orders</h1>

        <?php if (empty($orders)): ?>
            <div class="empty-state">
                <p>Your order constellation is empty. Start your cosmic coffee journey today!</p>
                <a href="<?= site_url('menu') ?>" class="cosmic-btn">
                    <i class="fas fa-rocket"></i>
                    Explore Our Menu
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-1" style="color: #E0E0E0;">Order #<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></h5>
                            <small style="color: #A8B2D1;">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <?= date('M d, Y h:i A', strtotime($order['created_at'])) ?>
                            </small>
                            <div class="mt-2 d-flex gap-2">
                                <?php
                                    $paymentIcon = match($order['payment_method']) {
                                        'Cash' => 'money-bill-wave',
                                        'GCash' => 'mobile-alt',
                                        'Walk-in' => 'store',
                                        default => 'credit-card'
                                    };
                                    $deliveryIcon = match($order['delivery_method']) {
                                        'Delivery' => 'truck',
                                        'Pick-up' => 'store',
                                        default => 'question'
                                    };
                                ?>
                                <span class="method-badge payment">
                                    <i class="fas fa-<?= $paymentIcon ?> me-1"></i>
                                    <?= esc($order['payment_method']) ?>
                                </span>
                                <span class="method-badge delivery">
                                    <i class="fas fa-<?= $deliveryIcon ?> me-1"></i>
                                    <?= esc($order['delivery_method']) ?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <?php
                                $statusClass = match($order['status']) {
                                    'Pending' => 'pending',
                                    'Validated' => 'validated',
                                    'Rejected' => 'rejected',
                                    default => ''
                                };
                                $statusIcon = match($order['status']) {
                                    'Pending' => 'clock',
                                    'Validated' => 'check-circle',
                                    'Rejected' => 'times-circle',
                                    default => 'question-circle'
                                };
                            ?>
                            <span class="status-badge <?= $statusClass ?>">
                                <i class="fas fa-<?= $statusIcon ?>"></i>
                                <?= esc($order['status']) ?>
                            </span>
                        </div>
                    </div>

                    <div class="order-items">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($order['items'] as $item): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if (!empty($item['image'])): ?>
                                                        <img src="<?= base_url('admin/image/' . $item['product_id']) ?>" 
                                                             alt="<?= esc($item['product_name']) ?>"
                                                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                                    <?php endif; ?>
                                                    <?= esc($item['product_name']) ?>
                                                </div>
                                            </td>
                                            <td>₱<?= number_format($item['price'], 2) ?></td>
                                            <td><?= $item['quantity'] ?></td>
                                            <td class="text-end">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total Amount</strong></td>
                                        <td class="text-end"><strong>₱<?= number_format($order['total_amount'], 2) ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php if ($order['status'] !== 'Pending'): ?>
                        <div class="validation-info">
                            <small style="color: #A8B2D1;">
                                <i class="fas fa-info-circle me-2"></i>
                                <?= $order['status'] ?> on <?= date('M d, Y h:i A', strtotime($order['validation_date'])) ?>
                                <?php if (!empty($order['validation_notes'])): ?>
                                    <br><i class="fas fa-comment-alt me-2"></i>Notes: <?= esc($order['validation_notes']) ?>
                                <?php endif; ?>
                            </small>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <!-- Pagination -->
            <?= $pager->links() ?>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer id="footer" class="footer-section">
        <div class="stars"></div>
        <div class="container">
            <!-- Footer Main Content -->
            <div class="row g-4 pb-4">
                <!-- Brand Section -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <a href="#" class="footer-logo d-flex align-items-center gap-3 mb-3">
                            <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo" height="40">
                            <span class="gradient-text">Brewverse</span>
                        </a>
                        <p class="footer-about">Explore the cosmic confluence of coffee and space at Brewverse. Where every cup tells a story written in the stars.</p>
                        <div class="social-links mt-4">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Navigation</h5>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#reviews">Reviews</a></li>
                        <?php if (session()->get('is_admin') == 1): ?>
                        <li><a class="dropdown-item" href="<?= site_url('admin/users') ?>">
                            <i class=""></i>Manage Users
                        </a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Contact Us</h5>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>+63 912 345 6789</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>contact@brewverse.com</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Cosmic Avenue, Metro Bulihan, Philippines</span>
                        </li>
                    </ul>
                </div>

                <!-- Opening Hours -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">Opening Hours</h5>
                    <ul class="footer-hours">
                        <li>
                            <span>Monday - Friday</span>
                            <span>7:00 AM - 11:00 PM</span>
                        </li>
                        <li>
                            <span>Saturday - Sunday</span>
                            <span>8:00 AM - 12:00 AM</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright mb-0">
                            © 2024 Brewverse. All rights reserved | Crafted with <i class="fas fa-heart text-danger"></i> in the cosmos
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-bottom-links">
                            <a href="#">Privacy Policy</a>
                            <a href="#">Terms of Service</a>
                            <a href="#">Cookie Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 