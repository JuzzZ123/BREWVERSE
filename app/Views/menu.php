<?= $this->extend('templates/default') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <h2 class="text-center mb-4">Our Menu</h2>
    
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100">
                    <?php if (!empty($product['image'])): ?>
                        <img src="<?= base_url('admin/image/' . $product['id']) ?>" 
                             class="card-img-top" 
                             alt="<?= esc($product['product_name']) ?>">
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($product['product_name']) ?></h5>
                        <p class="card-text"><?= esc($product['description']) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">₱<?= number_format($product['price'], 2) ?></span>
                            <?php if ($product['status'] === 'out_of_stock'): ?>
                                <span class="badge bg-danger">Out of Stock</span>
                            <?php else: ?>
                                <button class="btn btn-primary add-to-cart" 
                                        data-product-id="<?= $product['id'] ?>">
                                    Add to Cart
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.product-card {
    background: rgba(13, 17, 23, 0.95);
    border: 1px solid rgba(65, 132, 228, 0.1);
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(65, 132, 228, 0.2);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-title {
    color: #58a6ff;
    font-size: 1.2rem;
}

.card-text {
    color: #e6edf3;
}

.price {
    color: #7b4cff;
    font-size: 1.25rem;
    font-weight: bold;
}

.badge.bg-danger {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.btn-primary {
    background: #7b4cff;
    border: none;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #6f42c1;
    transform: translateY(-2px);
}
</style>

<script>
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.dataset.productId;
        
        fetch('<?= base_url('cart/add') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: `product_id=${productId}&<?= csrf_token() ?>=${encodeURIComponent('<?= csrf_hash() ?>')}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                Swal.fire({
                    title: 'Success!',
                    text: data.message,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                
                // Update cart count if you have a cart counter in your layout
                const cartCount = document.querySelector('.cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cart_count;
                }
            } else {
                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: data.message,
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error'
            });
        });
    });
});
</script>
<?= $this->endSection() ?> 