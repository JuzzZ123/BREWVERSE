<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Cosmic Cart - Brewverse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: linear-gradient(180deg, #0A0F1C 0%, #151C32 100%);
            color: #E0E0E0;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #fff 0%, #7B4CFF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .cosmic-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-bottom: 30px;
        }

        .cosmic-table th {
            background: rgba(123, 76, 255, 0.1);
            color: #fff;
            padding: 15px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 500;
            border-bottom: 2px solid #7B4CFF;
        }

        .cosmic-table td {
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border: none;
            transition: all 0.3s ease;
        }

        .cosmic-table tr:hover td {
            background: rgba(123, 76, 255, 0.1);
            transform: translateY(-2px);
        }

        .cosmic-btn {
            background: linear-gradient(135deg, #7B4CFF 0%, #4C2EAA 100%);
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            font-weight: 500;
            margin: 0 5px;
        }

        .cosmic-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(123, 76, 255, 0.3);
            color: white;
        }

        .cosmic-btn.remove {
            background: linear-gradient(135deg, #FF4C4C 0%, #AA2E2E 100%);
        }

        .total {
            font-size: 1.6em;
            font-weight: bold;
            text-align: right;
            margin: 20px 0;
            font-family: 'Orbitron', sans-serif;
            color: #7B4CFF;
        }

        .empty-msg {
            text-align: center;
            font-size: 1.4em;
            margin: 50px 0;
            color: #7B4CFF;
        }

        /* Modal Styling */
        .cosmic-modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(10, 15, 28, 0.9);
            backdrop-filter: blur(10px);
            z-index: 9999;
        }

        .cosmic-modal .modal-content {
            background: linear-gradient(145deg, #1a1f2e 0%, #0d1117 100%);
            border: 1px solid rgba(123, 76, 255, 0.1);
            border-radius: 24px;
            width: 600px;
            margin: 80px auto;
            padding: 25px;
            position: relative;
            color: #E0E0E0;
        }

        .cosmic-modal h2 {
            font-family: 'Orbitron', sans-serif;
            color: #7B4CFF;
            margin-bottom: 20px;
        }

        /* Form Elements */
        .cosmic-select, .cosmic-textarea {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(123, 76, 255, 0.3);
            border-radius: 12px;
            color: #E0E0E0;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
        }

        .cosmic-select option {
            background: #1a1f2e;
            color: #E0E0E0;
        }

        .cosmic-label {
            color: #7B4CFF;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .cosmic-file-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px dashed rgba(123, 76, 255, 0.3);
            border-radius: 12px;
            padding: 15px;
            width: 100%;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .cosmic-file-input::-webkit-file-upload-button {
            background: #7B4CFF;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 50px;
            cursor: pointer;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }

        @media print {
    body * {
        visibility: hidden;
    }
    #receiptModal, #receiptModal * {
        visibility: visible;
                background: white !important;
                color: black !important;
    }
    #receiptModal {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .cosmic-modal .modal-content {
                width: 90%;
                margin: 40px auto;
            }
            
            .cosmic-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>

<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= esc(session()->getFlashdata('message')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="cart-container">
    <h1><i class="fas fa-shopping-cart me-3"></i>Your Cosmic Cart</h1>

<?php if (!empty($cart)): ?>
        <table class="cosmic-table">
        <thead>
            <tr>
                    <th>Stellar Item</th>
                    <th>Cosmic Price (₱)</th>
                <th>Quantity</th>
                <th>Subtotal (₱)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $id => $item): ?>
                <tr>
                    <td><?= esc($item['product_name']) ?></td>
                    <td><?= number_format($item['price'], 2) ?></td>
                    <td><?= esc($item['quantity']) ?></td>
                    <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    <td>
                            <a href="<?= site_url('menu/increaseQuantity/' . $id) ?>" class="cosmic-btn">+</a>
                            <a href="<?= site_url('menu/decreaseQuantity/' . $id) ?>" class="cosmic-btn">-</a>
                            <a href="<?= site_url('menu/removeItem/' . $id) ?>" class="cosmic-btn remove">
                                <i class="fas fa-trash"></i>
                            </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        Total: ₱<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?>
    </div>

        <div class="action-buttons">
            <a href="<?= site_url('menu') ?>" class="cosmic-btn">
                <i class="fas fa-arrow-left me-2"></i>Continue Exploring
            </a>

            <button onclick="selectWalkIn()" class="cosmic-btn">
                <i class="fas fa-store me-2"></i>Walk-In
            </button>
            
            <button onclick="selectOnlinePayment()" class="cosmic-btn">
                <i class="fas fa-globe me-2"></i>Online Payment
            </button>
</div>

        <div id="walkInSection" style="display: none;" class="text-center mt-4">
            <form id="walkInForm" onsubmit="handleWalkInSubmit(event)">
                <?= csrf_field() ?>
                <input type="hidden" name="order_type" value="walk_in">
                <button type="submit" class="cosmic-btn" id="walkInBtn">
                <i class="fas fa-check-circle me-2"></i>Complete Order
            </button>
            </form>
</div>

<form id="onlinePaymentForm" action="<?= site_url('menu/uploadReceipt') ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
<?= csrf_field() ?>
<input type="hidden" name="order_type" value="online">
<div id="onlinePaymentSection" style="display: none;" class="mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label class="cosmic-label">Payment Method</label>
                            <select id="paymentMethod" name="payment_method" class="cosmic-select" onchange="togglePaymentUI()" required>
                                <option value="">Select Payment Method</option>
            <option value="Cash">Cash on Delivery</option>
            <option value="GCash">GCash</option>
        </select>
                        </div>

                        <div class="mb-3">
                        <label class="cosmic-label">Delivery Method</label>
                            <select name="delivery_method" id="deliveryMethod" class="cosmic-select" onchange="toggleDeliveryAddress()" required>
                                <option value="">Select Delivery Method</option>
                                <option value="Pick-up">Pickup</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                        </div>

                        <div id="gcashUpload" style="display: none;" class="mb-3">
                            <label class="cosmic-label">Upload GCash Receipt</label>
                            <input type="file" name="receipt" id="receiptUpload" class="cosmic-file-input" accept="image/*">
                            <small class="text-muted d-block mt-1">Accepted formats: JPG, PNG, PDF (Max size: 5MB)</small>
                        </div>

                        <div id="deliveryAddress" style="display: none;" class="mb-3">
                            <label class="cosmic-label">Delivery Address</label>
                            <textarea name="address" id="addressInput" rows="3" class="cosmic-textarea" placeholder="Enter your complete delivery address"></textarea>
        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="cosmic-btn" id="placeOrderBtn">
                                <i class="fas fa-rocket me-2"></i>Launch Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    <?php else: ?>
        <div class="empty-msg">
            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
            <p>Your cosmic cart is empty! Start your galactic shopping journey.</p>
            <a href="<?= site_url('menu') ?>" class="cosmic-btn mt-3">
                <i class="fas fa-rocket me-2"></i>Explore Menu
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Receipt Modal -->
<div id="receiptModal" class="cosmic-modal">
    <div class="modal-content">
        <h2><i class="fas fa-receipt me-2"></i>Order Receipt</h2>
        <div id="receiptContent"></div>
        <div class="action-buttons">
            <button onclick="printReceipt()" class="cosmic-btn" id="printReceiptBtn">
                <i class="fas fa-print me-2"></i>Print
            </button>
            <button class="cosmic-btn" id="closeReceiptBtn">
                <i class="fas fa-check me-2"></i>Complete Order
            </button>
        </div>
    </div>
</div>

<!-- Confirm Order Modal -->
<div id="confirmOrderModal" class="cosmic-modal">
      <div class="modal-content">
        <h2><i class="fas fa-check-circle me-2"></i>Confirm Order</h2>
        <p>Are you ready to launch your order into the cosmos?</p>
        <div class="action-buttons">
            <button onclick="confirmOrder()" class="cosmic-btn">
                <i class="fas fa-rocket me-2"></i>Launch Order
            </button>
            <button onclick="closeConfirmModal()" class="cosmic-btn remove">
                <i class="fas fa-times me-2"></i>Cancel
            </button>
        </div>
      </div>
  </div>

<script>
function selectWalkIn() {
    document.getElementById('walkInSection').style.display = 'block';
    document.getElementById('onlinePaymentSection').style.display = 'none';
}

function selectOnlinePayment() {
    document.getElementById('walkInSection').style.display = 'none';
    document.getElementById('onlinePaymentSection').style.display = 'block';
}

function togglePaymentUI() {
    const paymentMethod = document.getElementById('paymentMethod').value;
    const gcashUpload = document.getElementById('gcashUpload');
    const receiptUpload = document.getElementById('receiptUpload');
    
    if (paymentMethod === 'GCash') {
        gcashUpload.style.display = 'block';
        receiptUpload.setAttribute('required', 'required');
    } else {
        gcashUpload.style.display = 'none';
        receiptUpload.removeAttribute('required');
        receiptUpload.value = '';
    }
}

function toggleDeliveryAddress() {
    const deliveryMethod = document.getElementById('deliveryMethod').value;
    const deliveryAddress = document.getElementById('deliveryAddress');
    const addressInput = document.getElementById('addressInput');
    
    if (deliveryMethod === 'Delivery') {
        deliveryAddress.style.display = 'block';
        addressInput.setAttribute('required', 'required');
    } else {
        deliveryAddress.style.display = 'none';
        addressInput.removeAttribute('required');
        addressInput.value = '';
    }
}

// Add event listeners when the page loads
document.addEventListener('DOMContentLoaded', function() {
    // Initial toggle of payment UI
    togglePaymentUI();
    // Initial toggle of delivery address
    toggleDeliveryAddress();
    
    // Add change event listeners
    document.getElementById('paymentMethod').addEventListener('change', togglePaymentUI);
document.getElementById('deliveryMethod').addEventListener('change', toggleDeliveryAddress);
});

// Form validation for online payment
document.getElementById('onlinePaymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const paymentMethod = document.getElementById('paymentMethod').value;
    const deliveryMethod = document.getElementById('deliveryMethod').value;
    const receiptUpload = document.getElementById('receiptUpload');
    const addressInput = document.getElementById('addressInput');

    // Basic validation
    if (!paymentMethod) {
        alert('Please select a payment method.');
        return;
    }

    if (!deliveryMethod) {
        alert('Please select a delivery method.');
        return;
    }

    // GCash validation
    if (paymentMethod === 'GCash') {
        if (!receiptUpload.files || !receiptUpload.files[0]) {
            alert('Please upload your GCash receipt.');
            return;
        }
        
        // Check file size (5MB limit)
        const fileSize = receiptUpload.files[0].size / 1024 / 1024; // in MB
        if (fileSize > 5) {
            alert('File size must be less than 5MB');
            return;
        }
    }

    // Delivery address validation only if delivery method is "Delivery"
    if (deliveryMethod === 'Delivery' && !addressInput.value.trim()) {
        alert('Please enter your delivery address.');
        return;
    }

    // If everything is valid, submit the form directly
    this.submit();
});

function showReceiptModal(callback) {
    const receiptModal = document.getElementById('receiptModal');
    const receiptContent = document.getElementById('receiptContent');
    const paymentMethod = document.getElementById('paymentMethod').value;
    const deliveryMethod = document.getElementById('deliveryMethod').value;
    
    // Get current date and time
    const now = new Date();
    const dateStr = now.toLocaleDateString();
    const timeStr = now.toLocaleTimeString();
    
    // Generate receipt HTML
    let receiptHTML = `
        <div style="text-align: center; margin-bottom: 20px;">
            <h3>Brewverse Café</h3>
            <p>123 Cosmic Avenue, Metro Bulihan</p>
            <p>${dateStr} ${timeStr}</p>
            <p><strong>Payment Method:</strong> ${paymentMethod}</p>
            <p><strong>Delivery Method:</strong> ${deliveryMethod}</p>
        </div>
        <div style="margin-bottom: 20px;">
            <h4>Order Details</h4>
            <?php foreach ($cart as $item): ?>
            <div style="display: flex; justify-content: space-between; margin: 5px 0;">
                <span><?= esc($item['product_name']) ?> x <?= esc($item['quantity']) ?></span>
                <span>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
            </div>
            <?php endforeach; ?>
            <div style="border-top: 1px solid #7B4CFF; margin-top: 10px; padding-top: 10px;">
                <strong>Total: ₱<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?></strong>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p>Thank you for exploring the cosmos with us!</p>
            <p>Please visit us again!</p>
        </div>
    `;
    
    receiptContent.innerHTML = receiptHTML;
    receiptModal.style.display = 'block';
    
    // Update the close button to trigger the callback
    document.getElementById('closeReceiptBtn').onclick = function() {
        receiptModal.style.display = 'none';
        if (callback) callback();
    };
}

function showReceiptModal() {
    document.getElementById('confirmOrderModal').style.display = 'block';
}

function closeConfirmModal() {
    document.getElementById('confirmOrderModal').style.display = 'none';
}

function confirmOrder() {
// Create a form to submit
const form = document.createElement('form');
form.method = 'POST';
form.action = '<?= site_url('menu/completeOrder') ?>';
// Add CSRF token
const csrfToken = document.createElement('input');
csrfToken.type = 'hidden';
csrfToken.name = '<?= csrf_token() ?>';
csrfToken.value = '<?= csrf_hash() ?>';
form.appendChild(csrfToken);
// Generate receipt content
const receiptContent = document.getElementById('receiptContent');
receiptContent.innerHTML = generateReceiptHTML();
// Hide confirm modal and show receipt modal
document.getElementById('confirmOrderModal').style.display = 'none';
document.getElementById('receiptModal').style.display = 'block';
// After 2 seconds, submit the form
setTimeout(() => {
document.body.appendChild(form);
form.submit();
}, 2000);
}

function closeReceiptModal() {
    document.getElementById('receiptModal').style.display = 'none';
}

function printReceipt() {
    window.print();
}

function generateReceiptHTML() {
    const date = new Date();
    return `
        <div style="text-align: center; margin-bottom: 20px;">
            <h3>Brewverse Café</h3>
            <p>123 Cosmic Avenue, Metro Bulihan</p>
            <p>${date.toLocaleDateString()} ${date.toLocaleTimeString()}</p>
        </div>
        <div style="margin-bottom: 20px;">
            <h4>Order Details</h4>
            <!-- PHP will populate this part with actual order details -->
            <?php foreach ($cart as $item): ?>
            <div style="display: flex; justify-content: space-between; margin: 5px 0;">
                <span><?= esc($item['product_name']) ?> x <?= esc($item['quantity']) ?></span>
                <span>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
            </div>
            <?php endforeach; ?>
            <div style="border-top: 1px solid #7B4CFF; margin-top: 10px; padding-top: 10px;">
                <strong>Total: ₱<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?></strong>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p>Thank you for exploring the cosmos with us!</p>
            <p>Please visit us again!</p>
        </div>
    `;
}

function handleWalkInSubmit(event) {
    event.preventDefault();
    
    // Generate and show receipt first
    const receiptModal = document.getElementById('receiptModal');
    const receiptContent = document.getElementById('receiptContent');
    
    // Get current date and time
    const now = new Date();
    const dateStr = now.toLocaleDateString();
    const timeStr = now.toLocaleTimeString();
    
    // Generate receipt HTML
    let receiptHTML = `
        <div style="text-align: center; margin-bottom: 20px;">
            <h3>Brewverse Café</h3>
            <p>123 Cosmic Avenue, Metro Bulihan</p>
            <p>${dateStr} ${timeStr}</p>
            <p><strong>Walk-in Order</strong></p>
        </div>
        <div style="margin-bottom: 20px;">
            <h4>Order Details</h4>
            <?php foreach ($cart as $item): ?>
            <div style="display: flex; justify-content: space-between; margin: 5px 0;">
                <span><?= esc($item['product_name']) ?> x <?= esc($item['quantity']) ?></span>
                <span>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
            </div>
            <?php endforeach; ?>
            <div style="border-top: 1px solid #7B4CFF; margin-top: 10px; padding-top: 10px;">
                <strong>Total: ₱<?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?></strong>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p>Thank you for exploring the cosmos with us!</p>
            <p>Please visit us again!</p>
        </div>
    `;
    
    receiptContent.innerHTML = receiptHTML;
    receiptModal.style.display = 'block';
    
    // Add event listener for print button
    document.getElementById('printReceiptBtn').onclick = function() {
        window.print();
    };
    
    // Add event listener for close button with form submission
    document.getElementById('closeReceiptBtn').onclick = function() {
        // Create and submit the actual form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= site_url('menu/completeOrder') ?>';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '<?= csrf_token() ?>';
        csrfToken.value = '<?= csrf_hash() ?>';
        form.appendChild(csrfToken);
        
        // Add order type
        const orderType = document.createElement('input');
        orderType.type = 'hidden';
        orderType.name = 'order_type';
        orderType.value = 'walk_in';
        form.appendChild(orderType);
        
        // Submit the form
        document.body.appendChild(form);
        form.submit();
    };
}
</script>

</body>
</html>