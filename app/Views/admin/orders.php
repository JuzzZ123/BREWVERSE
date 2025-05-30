<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="font-family: 'Orbitron', sans-serif; color: #7B4CFF;">Orders Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Admin</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </nav>
    </div>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Orders Filter -->
    <div class="admin-card mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Filter Orders</h5>
            <button type="button" class="btn btn-primary btn-sm" onclick="resetFilters()">
                <i class="fas fa-redo me-2"></i>Reset Filters
            </button>
        </div>
        <div class="row g-3">
            <div class="col-md-3">
                <select class="form-select" id="statusFilter" onchange="applyFilters()">
                    <option value="">All Statuses</option>
                    <option value="Pending" <?= ($current_status === 'Pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="Validated" <?= ($current_status === 'Validated') ? 'selected' : '' ?>>Validated</option>
                    <option value="Rejected" <?= ($current_status === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                    <option value="Completed" <?= ($current_status === 'Completed') ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="paymentMethodFilter" onchange="applyFilters()">
                    <option value="">All Payment Methods</option>
                    <option value="Cash" <?= ($current_payment_method === 'Cash') ? 'selected' : '' ?>>Cash</option>
                    <option value="GCash" <?= ($current_payment_method === 'GCash') ? 'selected' : '' ?>>GCash</option>
                    <option value="Walk-in" <?= ($current_payment_method === 'Walk-in') ? 'selected' : '' ?>>Walk-in</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" id="dateFilter" onchange="applyFilters()" value="<?= $current_date ?? '' ?>">
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                        <th>Delivery Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                <td>
                                    <strong><?= esc($order['user_name']) ?></strong><br>
                                    <?php if (!empty($order['address'])): ?>
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            <?= esc($order['address']) ?>
                                        </small>
                                    <?php endif; ?>
                                </td>
                                <td>₱<?= number_format($order['total_amount'], 2) ?></td>
                                <td>
                                    <?php
                                        $badgeClass = match($order['payment_method']) {
                                            'Cash' => 'bg-success',
                                            'GCash' => 'bg-primary',
                                            'Walk-in' => 'bg-info',
                                            default => 'bg-secondary'
                                        };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>">
                                        <?php if ($order['payment_method'] === 'GCash'): ?>
                                            <i class="fas fa-mobile-alt me-1"></i>
                                        <?php elseif ($order['payment_method'] === 'Cash'): ?>
                                            <i class="fas fa-money-bill-wave me-1"></i>
                                        <?php elseif ($order['payment_method'] === 'Walk-in'): ?>
                                            <i class="fas fa-store me-1"></i>
                                        <?php endif; ?>
                                        <?= esc($order['payment_method']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $deliveryBadgeClass = match($order['delivery_method']) {
                                            'Delivery' => 'bg-info',
                                            'Pickup' => 'bg-warning',
                                            'Walk-in' => 'bg-success',
                                            default => 'bg-secondary'
                                        };
                                        $deliveryIcon = match($order['delivery_method']) {
                                            'Delivery' => 'fa-truck',
                                            'Pickup' => 'fa-store',
                                            'Walk-in' => 'fa-walking',
                                            default => 'fa-question'
                                        };
                                    ?>
                                    <span class="badge <?= $deliveryBadgeClass ?>">
                                        <i class="fas <?= $deliveryIcon ?> me-1"></i>
                                        <?= esc($order['delivery_method']) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                        $statusBadgeClass = match($order['status']) {
                                            'Pending' => 'bg-warning',
                                            'Validated' => 'bg-success',
                                            'Rejected' => 'bg-danger',
                                            'Completed' => 'bg-info',
                                            default => 'bg-secondary'
                                        };
                                        $statusIcon = match($order['status']) {
                                            'Pending' => 'fa-clock',
                                            'Validated' => 'fa-check-circle',
                                            'Rejected' => 'fa-times-circle',
                                            'Completed' => 'fa-check-double',
                                            default => 'fa-question-circle'
                                        };
                                    ?>
                                    <span class="badge <?= $statusBadgeClass ?>">
                                        <i class="fas <?= $statusIcon ?> me-1"></i>
                                        <?= esc($order['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span><?= date('M d, Y', strtotime($order['created_at'])) ?></span>
                                        <small class="text-muted"><?= date('h:i A', strtotime($order['created_at'])) ?></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= base_url('admin/orders/view/' . $order['id']) ?>" 
                                           class="btn btn-sm btn-primary" 
                                           title="View Order Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                <p class="mb-0">No orders found</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($pager)): ?>
            <div class="d-flex justify-content-end mt-4">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function applyFilters() {
    const status = document.getElementById('statusFilter').value;
    const paymentMethod = document.getElementById('paymentMethodFilter').value;
    const date = document.getElementById('dateFilter').value;
    
    let url = '<?= site_url('admin/orders') ?>';
    const params = new URLSearchParams();
    
    if (status) params.append('status', status);
    if (paymentMethod) params.append('payment_method', paymentMethod);
    if (date) params.append('date', date);
    
    if (params.toString()) {
        url += '?' + params.toString();
    }
    
    window.location.href = url;
}

function resetFilters() {
    window.location.href = '<?= base_url('admin/orders') ?>';
}
</script>

<?= $this->endSection() ?> 