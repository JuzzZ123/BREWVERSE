<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="text-cosmic">Edit Product</h6>
                        <a href="<?= base_url('admin/products') ?>" class="btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/updateProduct/' . $product['id']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" 
                                           value="<?= esc($product['product_name']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Category</label>
                                    <select class="form-select" name="category" required>
                                        <option value="Hot Coffee" <?= $product['category'] == 'Hot Coffee' ? 'selected' : '' ?>>Hot Coffee</option>
                                        <option value="Iced Coffee" <?= $product['category'] == 'Iced Coffee' ? 'selected' : '' ?>>Iced Coffee</option>
                                        <option value="Pastries" <?= $product['category'] == 'Pastries' ? 'selected' : '' ?>>Pastries</option>
                                        <option value="Desserts" <?= $product['category'] == 'Desserts' ? 'selected' : '' ?>>Desserts</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" class="form-control" name="price" step="0.01" 
                                               value="<?= esc($product['price']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Rating (0-5) ⭐</label>
                                    <input type="number" class="form-control" name="rating" 
                                           min="0" max="5" step="0.1" 
                                           value="<?= esc($product['rating']) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label required">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="in_stock" <?= $product['status'] == 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                                        <option value="out_of_stock" <?= $product['status'] == 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"><?= esc($product['description']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Current Image</label>
                                    <?php if (!empty($product['image'])): ?>
                                        <div class="img-preview">
                                            <img src="<?= base_url('admin/image/' . $product['id']) ?>" 
                                                 alt="<?= esc($product['product_name']) ?>" 
                                                 class="img-thumbnail">
                                        </div>
                                    <?php else: ?>
                                        <div class="no-image-placeholder">No image uploaded</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">New Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Card Styling */
.card {
    background: rgba(13, 17, 23, 0.95);
    border: 1px solid rgba(65, 132, 228, 0.1);
    box-shadow: 0 0 20px rgba(65, 132, 228, 0.1);
}

.card-header {
    background: linear-gradient(90deg, rgba(22, 27, 34, 0.95) 0%, rgba(13, 17, 23, 0.95) 100%);
    border-bottom: 1px solid rgba(65, 132, 228, 0.2);
    padding: 1.25rem !important;
}

.text-cosmic {
    color: #58a6ff;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
}

/* Form Container */
.card-body {
    background: rgba(13, 17, 23, 0.95);
    color: #e6edf3;
    padding: 2rem;
}

/* Labels */
.form-label {
    color: #58a6ff;
    font-weight: 500;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Required Field Indicator */
.required::after {
    content: '*';
    color: #da3633;
    margin-left: 4px;
}

/* Inputs and Textareas */
.form-control {
    background: rgba(22, 27, 34, 0.8) !important;
    border: 1px solid rgba(65, 132, 228, 0.2) !important;
    color: #e6edf3 !important;
    padding: 0.75rem 1rem;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.form-control:focus {
    background: rgba(22, 27, 34, 0.9) !important;
    border-color: #6f42c1 !important;
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.2) !important;
}

/* Select Input */
.form-select {
    background-color: rgba(22, 27, 34, 0.8) !important;
    border: 1px solid rgba(65, 132, 228, 0.2) !important;
    color: #e6edf3 !important;
    padding: 0.75rem 1rem;
}

.form-select:focus {
    background-color: rgba(22, 27, 34, 0.9) !important;
    border-color: #6f42c1 !important;
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.2) !important;
}

/* Input Groups */
.input-group-text {
    background: rgba(22, 27, 34, 0.8) !important;
    border: 1px solid rgba(65, 132, 228, 0.2) !important;
    color: #58a6ff !important;
}

/* File Input */
input[type="file"].form-control {
    padding: 0.5rem;
}

input[type="file"].form-control::file-selector-button {
    background: #6f42c1;
    color: #fff;
    border: 0;
    padding: 0.5rem 1rem;
    margin-right: 1rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

input[type="file"].form-control::file-selector-button:hover {
    background: #8250df;
    transform: translateY(-1px);
}

/* Image Preview */
.img-preview {
    background: rgba(22, 27, 34, 0.8);
    border-radius: 8px;
    padding: 0.5rem;
    margin-bottom: 1rem;
}

.img-thumbnail {
    max-width: 200px;
    border: 2px solid rgba(65, 132, 228, 0.2);
    background: transparent;
    transition: all 0.3s ease;
}

.img-thumbnail:hover {
    border-color: #6f42c1;
    transform: scale(1.02);
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.2);
}

/* No Image Placeholder */
.no-image-placeholder {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.2);
    color: #8b949e;
    padding: 1rem;
    text-align: center;
    border-radius: 6px;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(65, 132, 228, 0.2);
}

/* Buttons */
.btn-primary {
    background: #6f42c1;
    border: none;
    padding: 0.75rem 1.5rem;
    color: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 0 10px rgba(111, 66, 193, 0.2);
}

.btn-primary:hover {
    background: #8250df;
    transform: translateY(-2px);
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.3);
}

.btn-secondary {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.2);
    color: #58a6ff;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: rgba(22, 27, 34, 0.9);
    border-color: #58a6ff;
    transform: translateY(-2px);
}

/* Back Button */
.btn-back {
    color: #58a6ff;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-back:hover {
    color: #6f42c1;
    transform: translateX(-2px);
    text-decoration: none;
}

/* Help Text */
.text-muted {
    color: #8b949e !important;
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

/* Alert Styling */
.alert-danger {
    background: rgba(218, 54, 51, 0.1);
    border: 1px solid rgba(218, 54, 51, 0.2);
    color: #ff7b72;
}
</style>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Add any additional JavaScript if needed
</script>
<?= $this->endSection() ?> 