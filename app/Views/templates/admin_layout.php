<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($title) ? esc($title) : 'Admin Dashboard' ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #7B4CFF;
            --secondary-color: #4C2EAA;
            --background: #0A0F1C;
            --surface: #151C32;
            --text: #E0E0E0;
            --text-muted: #A8B2D1;
        }

        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
        }

        /* Navbar Styling */
        .navbar {
            background: rgba(13, 17, 23, 0.95) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            background: rgba(21, 28, 50, 0.95);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(123, 76, 255, 0.2);
            min-width: 250px;
            min-height: 100vh;
            padding: 1rem 0;
        }

        .sidebar-header {
            font-family: 'Orbitron', sans-serif;
            color: var(--primary-color);
            padding: 1.5rem;
            font-size: 1.2rem;
            font-weight: 600;
            border-bottom: 1px solid rgba(123, 76, 255, 0.2);
        }

        .admin-sidebar .nav-link {
            color: var(--text);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            border-radius: 0 50px 50px 0;
            margin: 0.2rem 0;
        }

        .admin-sidebar .nav-link i {
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(123, 76, 255, 0.1);
            color: var(--primary-color);
            transform: translateX(10px);
        }

        .admin-sidebar .logout-link {
            color: #ff4d4d;
            margin-top: auto;
        }

        .admin-sidebar .logout-link i {
            color: #ff4d4d;
        }

        /* Main Content Area */
        .admin-main {
            flex: 1;
            padding: 2rem;
            background: linear-gradient(145deg, #0A0F1C 0%, #151C32 100%);
        }

        /* Cards Styling */
        .admin-card {
            background: rgba(21, 28, 50, 0.8);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(123, 76, 255, 0.2);
        }

        .card-title {
            color: var(--text-muted);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-value {
            color: var(--primary-color);
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 700;
        }

        /* Table Styling - Dark Space Theme */
        .table {
            color: #7B4CFF;
            background: rgba(13, 17, 23, 0.95);
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead {
            background: rgba(21, 28, 50, 0.95);
        }

        .table thead th {
            background: transparent;
            color: #7B4CFF;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            padding: 1rem;
            font-size: 1rem;
            border: none;
            text-transform: none;
        }

        .table tbody tr {
            background: transparent;
            border-bottom: 1px solid rgba(123, 76, 255, 0.1);
            transition: all 0.3s ease;
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        .table tbody td {
            padding: 1rem;
            border: none;
            color: #E0E0E0;
            background: rgba(21, 28, 50, 0.3);
        }

        .table-striped tbody tr:nth-of-type(odd) td {
            background: rgba(21, 28, 50, 0.5);
        }

        .table-striped tbody tr:nth-of-type(even) td {
            background: rgba(21, 28, 50, 0.3);
        }

        .table tbody tr:hover td {
            background: rgba(123, 76, 255, 0.1);
        }

        /* Time column styling */
        .table td:last-child {
            color: #E0E0E0;
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Card header for tables */
        .admin-card .d-flex {
            margin-bottom: 1.5rem;
        }

        .admin-card h6 {
            color: #7B4CFF;
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
        }

        /* Badge styling */
        .badge {
            background: #7B4CFF;
            color: white;
            padding: 0.5em 1.2em;
            border-radius: 50px;
            font-weight: normal;
        }

        /* Pagination styling */
        .pagination {
            gap: 0.3rem;
        }

        .pagination .page-link {
            background: rgba(21, 28, 50, 0.8);
            border: 1px solid rgba(123, 76, 255, 0.2);
            color: #7B4CFF;
            min-width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 8px;
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background: #7B4CFF;
            color: white;
        }

        /* Table container */
        .table-responsive {
            border-radius: 12px;
            border: 1px solid rgba(123, 76, 255, 0.2);
            background: rgba(13, 17, 23, 0.95);
        }

        /* Username styling in table */
        .table tbody td strong {
            color: #7B4CFF;
            font-weight: 600;
            font-size: 1rem;
        }

        /* Time/Date styling in table */
        .table tbody td:last-child {
            color: #A8B2D1;
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Empty state styling */
        .table tbody td.text-center {
            color: #A8B2D1;
            font-style: italic;
            padding: 2rem;
        }

        /* Scrollbar styling for table */
        .table-responsive::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: rgba(123, 76, 255, 0.1);
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: rgba(123, 76, 255, 0.3);
            border-radius: 3px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: rgba(123, 76, 255, 0.5);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
        }

        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--text-muted);
        }
    </style>
</head>
<body>

<header class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/admin') ?>">
            <img src="<?= base_url('images/logo.png') ?>" alt="Brewverse Logo" height="35">
            Brewverse Admin
        </a>
        <div class="d-flex align-items-center gap-3">
            <a href="<?= base_url('/') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-home me-2"></i>Main Site
            </a>
            <a href="<?= base_url('/auth/logout') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
        </div>
    </div>
</header>

<div class="d-flex">
    <nav class="admin-sidebar">
        <div class="sidebar-header">
            <i class="fas fa-solar-system me-2"></i>Admin Panel
        </div>
        <a href="<?= base_url('/admin') ?>" class="nav-link<?= uri_string() == 'admin' ? ' active' : '' ?>">
            <i class="fas fa-dashboard"></i>Dashboard
        </a>
        <a href="<?= base_url('/admin/products') ?>" class="nav-link<?= uri_string() == 'admin/products' ? ' active' : '' ?>">
            <i class="fas fa-mug-hot"></i>Products
        </a>
        <a href="<?= base_url('/admin/orders') ?>" class="nav-link<?= uri_string() == 'admin/orders' ? ' active' : '' ?>">
            <i class="fas fa-shopping-cart"></i>Orders
        </a>
        <a href="<?= base_url('/admin/users') ?>" class="nav-link<?= uri_string() == 'admin/users' ? ' active' : '' ?>">
            <i class="fas fa-users"></i>Users
        </a>
        <a href="<?= base_url('/') ?>" class="nav-link">
            <i class="fas fa-store"></i>View Shop
        </a>
        <a href="<?= base_url('/auth/logout') ?>" class="nav-link logout-link">
            <i class="fas fa-sign-out-alt"></i>Logout
        </a>
    </nav>

    <main class="admin-main">
        <?= $this->renderSection('content') ?>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
