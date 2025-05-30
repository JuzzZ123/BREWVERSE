<?= $this->extend('templates/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= isset($product) && $product ? 'Edit Product' : 'Add New Product' ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/products') ?>">Products</a></li>
                <li class="breadcrumb-item active"><?= isset($product) && $product ? 'Edit Product' : 'Add Product' ?></li>
            </ol>
        </nav>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= isset($product) && $product ? base_url('admin/updateProduct/' . $product['id']) : base_url('admin/products/create') ?>" 
                  method="post" 
                  enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label class="form-label required">Product Name</label>
                    <input type="text" 
                           class="form-control" 
                           name="product_name" 
                           value="<?= isset($product) ? esc($product['product_name']) : old('product_name') ?>" 
                           placeholder="Enter product name"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" 
                              name="description" 
                              rows="3" 
                              placeholder="Enter product description"><?= isset($product) ? esc($product['description']) : old('description') ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">₱</span>
                        <input type="number" 
                               class="form-control" 
                               name="price" 
                               step="0.01" 
                               value="<?= isset($product) ? esc($product['price']) : old('price') ?>" 
                               placeholder="0.00"
                               required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="Hot Coffee" <?= (isset($product) && $product['category'] == 'Hot Coffee') ? 'selected' : '' ?>>Hot Coffee</option>
                        <option value="Iced Coffee" <?= (isset($product) && $product['category'] == 'Iced Coffee') ? 'selected' : '' ?>>Iced Coffee</option>
                        <option value="Pastries" <?= (isset($product) && $product['category'] == 'Pastries') ? 'selected' : '' ?>>Pastries</option>
                        <option value="Desserts" <?= (isset($product) && $product['category'] == 'Desserts') ? 'selected' : '' ?>>Desserts</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label required">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="in_stock" <?= (isset($product) && $product['status'] == 'in_stock') ? 'selected' : '' ?>>In Stock</option>
                        <option value="out_of_stock" <?= (isset($product) && $product['status'] == 'out_of_stock') ? 'selected' : '' ?>>Out of Stock</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" 
                           class="form-control" 
                           id="rating" 
                           name="rating" 
                           min="0" 
                           max="5" 
                           step="0.1" 
                           value="<?= isset($product) ? esc($product['rating']) : old('rating') ?>">
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <?php if (isset($product) && $product['image']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" 
                                 alt="Current product image" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" 
                           class="form-control" 
                           id="image" 
                           name="image" 
                           accept="image/*">
                    <?php if (isset($product) && $product['image']): ?>
                        <small class="text-muted">Leave empty to keep current image</small>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($product) && $product ? 'Update Product' : 'Add Product' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Form Container */
.card-body {
    background: rgba(13, 17, 23, 0.95);
    color: #e6edf3;
    padding: 2rem;
}

/* Form Groups */
.mb-3 {
    margin-bottom: 1.5rem !important;
}

/* Labels */
.form-label {
    color: #58a6ff;
    font-weight: 500;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Text Inputs and Textareas */
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

.form-control::placeholder {
    color: #8b949e;
}

/* Input Groups */
.input-group-text {
    background: rgba(22, 27, 34, 0.8) !important;
    border: 1px solid rgba(65, 132, 228, 0.2) !important;
    color: #58a6ff !important;
    padding: 0 1rem;
}

/* Select Inputs */
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

/* File Input */
input[type="file"].form-control {
    padding: 0.5rem;
    background: rgba(22, 27, 34, 0.8) !important;
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

/* Number Inputs */
input[type="number"].form-control {
    font-family: 'Monaco', monospace;
}

/* Textarea */
textarea.form-control {
    min-height: 120px;
    resize: vertical;
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

/* Submit Button */
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

/* Cancel Button */
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

/* Image Preview */
.img-preview {
    background: rgba(22, 27, 34, 0.8);
    border: 2px solid rgba(65, 132, 228, 0.2);
    border-radius: 8px;
    padding: 0.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.img-preview:hover {
    border-color: #6f42c1;
    box-shadow: 0 0 15px rgba(111, 66, 193, 0.2);
}

/* Help Text */
.text-muted {
    color: #8b949e !important;
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

/* Required Field Indicator */
.required::after {
    content: '*';
    color: #da3633;
    margin-left: 4px;
}
</style>

<?= $this->endSection() ?> 