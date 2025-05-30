<?= $this->extend('templates/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="font-family: 'Orbitron', sans-serif; color: #7B4CFF;">Admin Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <style>
        .admin-card {
            background: rgba(21, 28, 50, 0.95);
            border: 1px solid rgba(123, 76, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            color: var(--text-muted);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
            font-family: 'Space Grotesk', sans-serif;
        }

        .card-value {
            color: var(--text);
            font-size: 1.8rem;
            font-family: 'Orbitron', sans-serif;
            font-weight: 600;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .progress {
            background: rgba(255, 255, 255, 0.1);
            margin-top: 15px;
            border-radius: 10px;
            height: 4px;
        }

        .progress-bar {
            border-radius: 10px;
        }

        .table {
            margin-top: 15px;
        }

        .table th {
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px;
            border-bottom: 1px solid rgba(123, 76, 255, 0.2);
        }

        .table td {
            padding: 12px;
            color: var(--text);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            background: rgba(123, 76, 255, 0.2);
            color: var(--text);
        }

        .fas, .far {
            font-size: 1.2rem;
        }

        h6 {
            font-size: 0.9rem;
        }
    </style>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- User Statistics -->
        <div class="col-xl-4 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Total Users</div>
                        <div class="card-value"><?= $total_users ?></div>
                    </div>
                    <i class="fas fa-users" style="color: #7B4CFF; margin-top: 5px;"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Admin Users</div>
                        <div class="card-value"><?= $admin_count ?></div>
                    </div>
                    <i class="fas fa-user-shield" style="color: #7B4CFF; margin-top: 5px;"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Regular Users</div>
                        <div class="card-value"><?= $regular_count ?></div>
                    </div>
                    <i class="fas fa-user" style="color: #7B4CFF; margin-top: 5px;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Order Statistics -->
        <div class="col-xl-3 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Total Orders</div>
                        <div class="card-value"><?= $total_orders ?></div>
                    </div>
                    <i class="fas fa-shopping-cart" style="color: #7B4CFF; margin-top: 5px;"></i>
                </div>
                <div class="mt-3">
                    <canvas id="ordersChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Total Sales</div>
                        <div class="card-value">₱<?= number_format($total_sales, 2) ?></div>
                    </div>
                    <i class="fas fa-coins" style="color: #7B4CFF; margin-top: 5px;"></i>
                </div>
                <div class="mt-3">
                    <canvas id="salesChart" width="100%" height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Pending Orders</div>
                        <div class="card-value"><?= $pending_orders ?></div>
                    </div>
                    <i class="fas fa-clock" style="color: #FFA500; margin-top: 5px;"></i>
                </div>
                <div class="mt-3">
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" 
                             style="width: <?= ($total_orders > 0 ? ($pending_orders / $total_orders) * 100 : 0) ?>%" 
                             aria-valuenow="<?= $pending_orders ?>" aria-valuemin="0" aria-valuemax="<?= $total_orders ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="admin-card h-100">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="card-title">Completed Orders</div>
                        <div class="card-value"><?= $completed_orders ?></div>
                    </div>
                    <i class="fas fa-check-circle" style="color: #00C853; margin-top: 5px;"></i>
                </div>
                <div class="mt-3">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" 
                             style="width: <?= ($total_orders > 0 ? ($completed_orders / $total_orders) * 100 : 0) ?>%" 
                             aria-valuenow="<?= $completed_orders ?>" aria-valuemin="0" aria-valuemax="<?= $total_orders ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login History Tables -->
    <div class="row">
        <!-- Admin Login History -->
        <div class="col-md-6">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="m-0" style="font-family: 'Orbitron', sans-serif; color: var(--text);">
                        Admin Login History
                    </h6>
                    <span class="badge bg-primary"><?= $total_admin_logs ?> entries</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($admin_logins)): ?>
                                <?php foreach ($admin_logins as $login): ?>
                                    <tr>
                                        <td><?= esc($login['username']) ?></td>
                                        <td>
                                            <i class="far fa-clock me-2"></i>
                                            <?= $login['login_time'] ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">No login history available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- User Login History -->
        <div class="col-md-6">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="m-0" style="font-family: 'Orbitron', sans-serif; color: var(--text);">
                        User Login History
                    </h6>
                    <span class="badge bg-primary"><?= $total_user_logs ?> entries</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($user_logins)): ?>
                                <?php foreach ($user_logins as $login): ?>
                                    <tr>
                                        <td><?= esc($login['username']) ?></td>
                                        <td><?= $login['login_time'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">No user login history</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Orders Chart
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($order_dates) ?>,
                datasets: [{
                    label: 'Orders',
                    data: <?= json_encode($order_counts) ?>,
                    borderColor: '#7B4CFF',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        display: false
                    },
                    x: {
                        display: false
                    }
                }
            }
        });

        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode($sales_dates) ?>,
                datasets: [{
                    label: 'Sales',
                    data: <?= json_encode($sales_amounts) ?>,
                    borderColor: '#00C853',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        display: false
                    },
                    x: {
                        display: false
                    }
                }
            }
        });
    </script>
</div>

<?= $this->endSection() ?> 