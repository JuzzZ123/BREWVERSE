<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('content') ?>

<style>
/* Order Details Page Specific Styles */
.order-details-container {
    padding: 2rem;
    background: var(--surface);
    border-radius: 15px;
    border: 1px solid rgba(123, 76, 255, 0.2);
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.status-badge.pending { background: #FFA500; color: #000; }
.status-badge.validated { background: #00FF00; color: #000; }
.status-badge.rejected { background: #FF0000; color: #fff; }

.payment-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-size: 0.85rem;
    font-weight: 500;
    background: var(--primary-color);
    color: var(--text);
}

.customer-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    margin: 0 auto 1rem;
    border: 3px solid var(--primary-color);
    box-shadow: 0 0 20px rgba(123, 76, 255, 0.3);
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text);
    font-size: 2rem;
    font-weight: bold;
}

.btn-cosmic {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    color: var(--text);
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(123, 76, 255, 0.2);
}

.btn-cosmic:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(123, 76, 255, 0.3);
}

.btn-cosmic.success {
    background: linear-gradient(45deg, #00C853, #69F0AE);
}

.btn-cosmic.danger {
    background: linear-gradient(45deg, #FF1744, #FF5252);
}
</style>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" style="font-family: 'Orbitron', sans-serif; color: var(--primary-color);">
            Order Details
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>" style="color: var(--primary-color);">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/orders') ?>" style="color: var(--primary-color);">Orders</a></li>
                <li class="breadcrumb-item active" style="color: var(--text-muted);">Order #<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></li>
            </ol>
        </nav>
    </div>

    <div class="order-details-container">
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <!-- Order Information -->
                <div class="admin-card mb-4">
                    <h5 class="mb-4" style="color: var(--primary-color);">Order Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted mb-1">Order ID</label>
                            <p class="mb-3">#<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted mb-1">Order Date</label>
                            <p class="mb-3"><?= isset($order['created_at']) ? date('M d, Y h:i A', strtotime($order['created_at'])) : 'N/A' ?></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted mb-1">Status</label>
                            <p class="mb-3">
                                <?php
                                    $statusClass = match($order['status']) {
                                        'Pending' => 'pending',
                                        'Validated' => 'validated',
                                        'Rejected' => 'rejected',
                                        default => ''
                                    };
                                ?>
                                <span class="status-badge <?= $statusClass ?>"><?= esc($order['status']) ?></span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted mb-1">Payment Method</label>
                            <p class="mb-3">
                                <span class="payment-badge"><?= esc($order['payment_method']) ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="admin-card mb-4">
                    <h5 class="mb-4" style="color: var(--primary-color);">Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order_items as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <?php if (!empty($item['image'])): ?>
                                                    <img src="<?= base_url('admin/displayImage/' . $item['product_id']) ?>" 
                                                         alt="<?= esc($item['product_name']) ?>"
                                                         class="rounded"
                                                         style="width: 48px; height: 48px; object-fit: cover;">
                                                <?php endif; ?>
                                                <div>
                                                    <strong><?= esc($item['product_name']) ?></strong>
                                                </div>
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

                <?php if ($order['status'] === 'Pending'): ?>
                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mb-4">
                        <button type="button" 
                                class="btn btn-success" 
                                onclick="validateOrder(<?= $order['id'] ?>)"
                                title="<?= $order['payment_method'] === 'Walk-in' ? 'Complete Order' : 'Validate Order' ?>">
                            <i class="fas fa-check me-2"></i>
                            <?= $order['payment_method'] === 'Walk-in' ? 'Complete Order' : 'Validate Order' ?>
                        </button>
                        <button type="button" 
                                class="btn btn-danger" 
                                onclick="rejectOrder(<?= $order['id'] ?>)"
                                title="Reject Order">
                            <i class="fas fa-times me-2"></i>Reject Order
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <!-- Customer Information -->
                <div class="admin-card">
                    <h5 class="mb-4" style="color: var(--primary-color);">Customer Information</h5>
                    <div class="text-center mb-4">
                        <div class="customer-avatar">
                            <?php if (!empty($customer['profile_picture'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($customer['profile_picture']) ?>" 
                                     class="rounded-circle"
                                     style="width: 100%; height: 100%; object-fit: cover;"
                                     alt="<?= esc($customer['username']) ?>">
                            <?php else: ?>
                                <div class="avatar-placeholder">
                                    <?= strtoupper(substr($customer['username'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h5 class="mb-1"><?= esc($customer['username']) ?></h5>
                        <p class="text-muted mb-3"><?= esc($customer['email']) ?></p>
                        <div class="d-flex justify-content-center gap-3">
                            <div class="text-center">
                                <small class="text-muted d-block">Total Orders</small>
                                <span class="fs-5"><?= $customer['total_orders'] ?></span>
                            </div>
                            <div class="text-center">
                                <small class="text-muted d-block">Customer Since</small>
                                <span class="fs-6"><?= isset($customer['created_at']) ? date('M d, Y', strtotime($customer['created_at'])) : 'N/A' ?></span>
                            </div>
                        </div>

                        <!-- Delivery Address -->
                        <?php if (!empty($order['address'])): ?>
                            <div class="mt-4">
                                <h6 class="mb-3" style="color: var(--primary-color);">
                                    <i class="fas fa-map-marker-alt me-2"></i>Delivery Address
                                </h6>
                                <p class="mb-0" style="color: var(--text);"><?= esc($order['address']) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($order['payment_method'] === 'GCash' && !empty($order['receipt_image'])): ?>
                    <!-- GCash Receipt -->
                    <div class="admin-card mt-4">
                        <h5 class="mb-4" style="color: var(--primary-color);">
                            <i class="fas fa-receipt me-2"></i>GCash Receipt
                        </h5>
                        <div class="receipt-image-container text-center">
                            <img src="<?= base_url('uploads/' . $order['receipt_image']) ?>" 
                                 alt="GCash Receipt"
                                 class="img-fluid rounded"
                                 style="max-width: 100%; max-height: 400px; object-fit: contain;">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($order['status'] !== 'Pending'): ?>
                    <!-- Validation Information -->
                    <div class="admin-card mt-4">
                        <h5 class="mb-4" style="color: var(--primary-color);">Validation Information</h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="text-muted mb-1">Validated By</label>
                                <p class="mb-3"><?= esc($validator['username'] ?? 'N/A') ?></p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted mb-1">Validation Date</label>
                                <p class="mb-3"><?= $order['validation_date'] ? date('M d, Y h:i A', strtotime($order['validation_date'])) : 'N/A' ?></p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted mb-1">Notes</label>
                                <p class="mb-0"><?= esc($order['validation_notes']) ?: 'No notes provided' ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Validation Modal -->
<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationModalLabel">Validate Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="validationForm">
                    <div class="mb-3">
                        <label for="validationNotes" class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" id="validationNotes" rows="3" placeholder="Add any notes about this validation..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-cosmic success" id="confirmValidation">Validate Order</button>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div class="modal fade" id="rejectionModal" tabindex="-1" aria-labelledby="rejectionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectionModalLabel">Reject Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="rejectionForm">
                    <div class="mb-3">
                        <label for="rejectionNotes" class="form-label">Rejection Reason</label>
                        <textarea class="form-control" id="rejectionNotes" rows="3" placeholder="Please provide a reason for rejecting this order..." required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-cosmic danger" id="confirmRejection">Reject Order</button>
            </div>
        </div>
    </div>
</div>

<script>
function validateOrder(orderId) {
    const modal = new bootstrap.Modal(document.getElementById('validationModal'));
    modal.show();

    document.getElementById('confirmValidation').onclick = function() {
        const notes = document.getElementById('validationNotes').value;
        
        // Create a form and submit it as POST
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `<?= base_url('admin/orders/validate/') ?>/${orderId}`;

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '<?= csrf_token() ?>';
        csrfToken.value = '<?= csrf_hash() ?>';
        form.appendChild(csrfToken);

        // Add notes
        const notesInput = document.createElement('input');
        notesInput.type = 'hidden';
        notesInput.name = 'notes';
        notesInput.value = notes;
        form.appendChild(notesInput);

        // Submit the form
        document.body.appendChild(form);
        form.submit();
    };
}

function rejectOrder(orderId) {
    const modal = new bootstrap.Modal(document.getElementById('rejectionModal'));
    modal.show();

    document.getElementById('confirmRejection').onclick = function() {
        const notes = document.getElementById('rejectionNotes').value;
        if (!notes.trim()) {
            alert('Please provide a reason for rejection');
            return;
        }

        // Create a form and submit it as POST
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `<?= base_url('admin/orders/reject/') ?>/${orderId}`;

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '<?= csrf_token() ?>';
        csrfToken.value = '<?= csrf_hash() ?>';
        form.appendChild(csrfToken);

        // Add notes
        const notesInput = document.createElement('input');
        notesInput.type = 'hidden';
        notesInput.name = 'notes';
        notesInput.value = notes;
        form.appendChild(notesInput);

        // Submit the form
        document.body.appendChild(form);
        form.submit();
    };
}
</script>

<?= $this->endSection() ?> 