<?= $this->extend('templates/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Products</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Admin</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div>

    <!-- Search and Add Product Button -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="<?= base_url('admin/products') ?>" method="get" class="search-form">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control bg-light border-0 small" 
                           placeholder="Search products..." 
                           value="<?= esc($search ?? '') ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Create Product
            </a>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Products Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                Products
            </h6>
            <span class="badge bg-primary rounded-pill">
                <?= $total ?> items
            </span>
        </div>
        <div class="card-body">
            <?php if (isset($products) && !empty($products)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td>
                                        <?php if (!empty($product['image'])): ?>
                                            <img src="<?= base_url('admin/image/' . $product['id']) ?>" 
                                                 alt="<?= esc($product['product_name']) ?>" 
                                                 class="product-image">
                                        <?php else: ?>
                                            <div class="no-image">No image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($product['product_name']) ?></td>
                                    <td class="price-column">$<?= number_format($product['price'], 2) ?></td>
                                    <td><?= esc($product['category']) ?></td>
                                    <td>
                                        <span class="badge <?= $product['status'] === 'in_stock' ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $product['status'] === 'in_stock' ? 'In Stock' : 'Out of Stock' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="rating-stars">
                                            <?= str_repeat('★', intval($product['rating'])) ?>
                                            <?= str_repeat('☆', 5 - intval($product['rating'])) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/editProduct/' . $product['id']) ?>" 
                                           class="btn btn-edit">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <?php if ($pager): ?>
                    <div class="mt-4">
                        <?= $pager->links() ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">No products found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteButton" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(productId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteButton = document.getElementById('deleteButton');
    deleteButton.href = `<?= base_url('admin/deleteProduct/') ?>${productId}`;
    modal.show();
}
</script>

<style>
/* Table Container */
.table-responsive {
    background: rgba(13, 17, 23, 0.95);
    border-radius: 10px;
    padding: 1rem;
}

/* Table Styling */
.table {
    color: #e6edf3;
    margin-bottom: 0;
}

/* Table Header */
.table thead tr {
    background: rgba(22, 27, 34, 0.8);
    border-bottom: 2px solid rgba(65, 132, 228, 0.2);
}

.table thead th {
    color: #8b949e;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 1rem;
    border: none;
}

/* Table Body */
.table tbody tr {
    background: rgba(22, 27, 34, 0.4);
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(31, 111, 235, 0.1);
    transform: translateY(-2px);
}

.table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid rgba(65, 132, 228, 0.1);
}

/* Status Badge */
.badge.active {
    background: #238636 !important;
    color: #e6edf3;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 500;
}

/* Rating Stars */
.rating-stars {
    color: #f1e05a;
    font-size: 1rem;
}

/* Edit Button */
.btn-edit {
    background: #6f42c1;
    color: #fff;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-edit:hover {
    background: #8250df;
    transform: translateY(-2px);
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.3);
}

/* Product Image */
.product-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid rgba(65, 132, 228, 0.2);
}

/* Price Column */
.price-column {
    font-family: 'Monaco', monospace;
    color: #58a6ff;
}

/* Products Header */
.products-header {
    color: #58a6ff;
    font-size: 1rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.items-count {
    background: rgba(31, 111, 235, 0.2);
    color: #58a6ff;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.9rem;
}

/* Add to the previous styles */
.img-thumbnail {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.1);
    padding: 0.5rem;
}

.badge {
    padding: 0.5em 1em;
}

.badge.bg-success {
    background: #238636 !important;
}

.badge.bg-danger {
    background: #da3633 !important;
}

.form-select {
    background-color: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.1);
    color: #e6edf3;
}

.form-select:focus {
    background-color: rgba(22, 27, 34, 0.9);
    border-color: #1f6feb;
    box-shadow: 0 0 10px rgba(31, 111, 235, 0.3);
}

.text-muted {
    color: #8b949e !important;
}

/* Star rating color */
.rating-stars {
    color: #f1e05a;
}

/* Modal styling */
.modal-content {
    background: rgba(13, 17, 23, 0.95);
    border: 1px solid rgba(65, 132, 228, 0.1);
}

.modal-header {
    border-bottom: 1px solid rgba(65, 132, 228, 0.1);
}

.modal-footer {
    border-top: 1px solid rgba(65, 132, 228, 0.1);
}

/* Input group styling */
.input-group-text {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.1);
    color: #8b949e;
}

/* Search Input Styling */
.search-form {
    position: relative;
}

.form-control.bg-light {
    background: rgba(22, 27, 34, 0.8) !important;
    border: 1px solid rgba(65, 132, 228, 0.2) !important;
    color: #e6edf3 !important;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.form-control.bg-light::placeholder {
    color: #8b949e;
}

.form-control.bg-light:focus {
    background: rgba(22, 27, 34, 0.9) !important;
    border-color: #1f6feb !important;
    box-shadow: 0 0 15px rgba(31, 111, 235, 0.2);
    color: #e6edf3 !important;
}

/* Search Button Styling */
.input-group-append .btn-primary {
    background: #1f6feb;
    border: none;
    padding: 0.75rem 1.25rem;
    margin-left: -1px;
    box-shadow: 0 0 10px rgba(31, 111, 235, 0.2);
    transition: all 0.3s ease;
}

.input-group-append .btn-primary:hover {
    background: #388bfd;
    transform: translateY(-1px);
    box-shadow: 0 0 15px rgba(31, 111, 235, 0.3);
}

.input-group-append .btn-primary i {
    color: #e6edf3;
}

/* Input Group Styling */
.input-group {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Card Header Styling */
.card-header.py-3 {
    background: linear-gradient(90deg, rgba(22, 27, 34, 0.95) 0%, rgba(13, 17, 23, 0.95) 100%);
    border-bottom: 1px solid rgba(65, 132, 228, 0.2);
    padding: 1.25rem !important;
}

/* Title Styling */
.card-header h6.font-weight-bold {
    color: #58a6ff !important;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    padding-left: 1rem;
}

.card-header h6.font-weight-bold:before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    
    height: 100%;
    background: #1f6feb;
    border-radius: 2px;
}
.card-body{
    background: rgba(13, 17, 23, 0.95);
}

/* Badge Styling */
.badge.bg-primary.rounded-pill {
    background: rgba(31, 111, 235, 0.2) !important;
    color: #58a6ff;
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border: 1px solid rgba(65, 132, 228, 0.3);
    box-shadow: 0 0 10px rgba(31, 111, 235, 0.1);
    transition: all 0.3s ease;
}

.badge.bg-primary.rounded-pill:hover {
    background: rgba(31, 111, 235, 0.3) !important;
    transform: translateY(-1px);
    box-shadow: 0 0 15px rgba(31, 111, 235, 0.2);
}

/* Card Header Container */
.card-header.py-3.d-flex {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Search Form Styling */
.search-form .input-group {
    background: rgba(22, 27, 34, 0.8);
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid rgba(65, 132, 228, 0.2);
}

.search-form .form-control {
    background: transparent !important;
    border: none !important;
    color: #e6edf3 !important;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    box-shadow: none !important;
}

.search-form .form-control::placeholder {
    color: #8b949e;
    font-size: 0.9rem;
}

.search-form .form-control:focus {
    background: rgba(22, 27, 34, 0.9) !important;
    box-shadow: none !important;
}

.search-form .input-group-append .btn {
    background: #6f42c1;
    border: none;
    padding: 0.75rem 1.5rem;
    color: #fff;
    transition: all 0.3s ease;
}

.search-form .input-group-append .btn:hover {
    background: #8250df;
    transform: translateY(-1px);
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.3);
}

.search-form .input-group-append .btn i {
    font-size: 0.85rem;
}

/* Remove the me-2 class effect */
.search-form .form-control.me-2 {
    margin-right: 0 !important;
}

/* Pagination Styling */
.pagination {
    display: flex;
    gap: 5px;
    justify-content: center;
    margin-top: 2rem;
}

.pagination li {
    list-style: none;
}

.pagination li a,
.pagination li span {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.2);
    color: #58a6ff;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
}

.pagination li.active span,
.pagination li.active a {
    background: #6f42c1;
    border-color: #6f42c1;
    color: #fff;
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.3);
}

.pagination li a:hover {
    background: rgba(111, 66, 193, 0.2);
    border-color: #6f42c1;
    transform: translateY(-2px);
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.2);
}

.pagination li.disabled span {
    background: rgba(22, 27, 34, 0.4);
    border-color: rgba(65, 132, 228, 0.1);
    color: #8b949e;
    cursor: not-allowed;
}

/* Pagination Container */
.mt-4 {
    display: flex;
    justify-content: center;
    width: 100%;
}
</style>

<?= $this->endSection() ?> 