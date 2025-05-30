<?= $this->extend('templates/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Admin</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            <a href="<?= base_url('admin/archived-users') ?>" class="btn btn-sm btn-info">
                <i class="fas fa-archive me-2"></i>View Archived Users
            </a>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="<?= base_url('admin/users') ?>" method="get" class="search-form">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control bg-light border-0 small" 
                                   placeholder="Search users..." 
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
                    <span class="text-muted">
                        Showing <?= ($currentPage - 1) * $perPage + 1 ?> to <?= min($currentPage * $perPage, $total) ?> of <?= $total ?> users
                    </span>
                </div>
            </div>

<?php if ($search): ?>
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        Showing results for: "<?= esc($search) ?>"
                        <a href="<?= base_url('admin/users') ?>" class="alert-link ms-2">Clear search</a>
                    </div>
    </div>
<?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= esc($user['id']) ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= $user['is_admin'] ? 'Administrator' : 'User' ?></td>
                                    <td><?= date('Y-m-d H:i:s', strtotime($user['created_at'])) ?></td>
                                    <td><?= date('Y-m-d H:i:s', strtotime($user['updated_at'])) ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" class="btn btn-sm btn-primary" title="Edit User">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-warning" onclick="confirmDelete(<?= $user['id'] ?>)" title="Archive User">
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

<!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Page <?= $currentPage ?> of <?= ceil($total / $perPage) ?>
                </div>
                <div class="pagination-container">
                    <?= $pager->makeLinks($currentPage, $perPage, $total, 'default_full') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-archive me-2"></i>Archive User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to archive this user? This will:</p>
                <ul>
                    <li>Prevent them from accessing their account</li>
                    <li>Hide them from the active users list</li>
                    <li>Move them to the archived users section</li>
                </ul>
                <p class="mb-0 text-muted">Note: You can restore archived users at any time.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteButton" class="btn btn-warning">
                    <i class="fas fa-archive me-2"></i>Archive User
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Required Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function confirmDelete(userId) {
        const modalElement = document.getElementById('deleteModal');
        const modal = new bootstrap.Modal(modalElement);
        const deleteButton = document.getElementById('deleteButton');
        deleteButton.href = `<?= base_url('admin/users/delete/') ?>${userId}`;
        modal.show();
    }

    // Make confirmDelete available globally
    window.confirmDelete = confirmDelete;
});
</script>

<style>
/* Space Theme Styles */
.card {
    background: rgba(13, 17, 23, 0.95);
    border: 1px solid rgba(65, 132, 228, 0.1);
    box-shadow: 0 0 20px rgba(65, 132, 228, 0.1);
}

.card-header {
    background: rgba(22, 27, 34, 0.8);
    border-bottom: 1px solid rgba(65, 132, 228, 0.1);
    color: #e6edf3;
}

.table {
    color: #e6edf3;
}

.table thead th {
    background: rgba(22, 27, 34, 0.8);
    color: #58a6ff;
    border-color: rgba(65, 132, 228, 0.1);
}

.table tbody tr {
    background: rgba(13, 17, 23, 0.6);
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background: rgba(22, 27, 34, 0.8);
    transform: translateY(-2px);
}

.table td {
    border-color: rgba(65, 132, 228, 0.1);
    padding: 1rem;
}

.breadcrumb {
    background: transparent;
}

.breadcrumb-item a {
    color: #58a6ff;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #8b949e;
}

.btn-primary {
    background: #1f6feb;
    border-color: #1f6feb;
    box-shadow: 0 0 10px rgba(31, 111, 235, 0.3);
}

.btn-primary:hover {
    background: #388bfd;
    border-color: #388bfd;
    transform: translateY(-1px);
}

/* Pagination Styling */
.pagination {
    display: flex;
    gap: 5px;
    justify-content: center;
    margin: 0;
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
.pagination-container {
    display: flex;
    justify-content: center;
}

/* Page Info Text */
.text-muted {
    color: #8b949e !important;
    font-size: 0.9rem;
}

/* Container Spacing */
.mt-4 {
    margin-top: 2rem !important;
}

.alert {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.1);
    color: #e6edf3;
}

.form-control {
    background: rgba(22, 27, 34, 0.8);
    border: 1px solid rgba(65, 132, 228, 0.1);
    color: #e6edf3;
}

.form-control:focus {
    background: rgba(22, 27, 34, 0.9);
    border-color: #1f6feb;
    color: #e6edf3;
    box-shadow: 0 0 10px rgba(31, 111, 235, 0.3);
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
</style>

<?php if(session()->getFlashdata('error')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('loginToast');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
<?php endif; ?>

<?= $this->section('scripts') ?>
<script>
function confirmDelete(userId) {
    // Initialize Bootstrap modal
    const modalElement = document.getElementById('deleteModal');
    const modal = new bootstrap.Modal(modalElement);
    const deleteButton = document.getElementById('deleteButton');
    
    // Set the href for the delete button
    deleteButton.href = `<?= base_url('admin/users/delete/') ?>${userId}`;
    
    // Show the modal
    modal.show();
}
</script>

<!-- Make sure Bootstrap JS is loaded -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>
