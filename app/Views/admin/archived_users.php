<?= $this->extend('templates/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Archived Users</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin') ?>">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/users') ?>">Users</a></li>
                <li class="breadcrumb-item active">Archived</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Archived Users List</h6>
            <a href="<?= base_url('admin/users') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left me-2"></i>Back to Active Users
            </a>
        </div>
        <div class="card-body">
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <form action="<?= base_url('admin/archived-users') ?>" method="get" class="search-form">
                        <div class="input-group">
                            <input type="text" 
                                   name="search" 
                                   class="form-control bg-light border-0 small" 
                                   placeholder="Search archived users..." 
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
                        Showing <?= ($currentPage - 1) * $perPage + 1 ?> to <?= min($currentPage * $perPage, $total) ?> of <?= $total ?> archived users
                    </span>
                </div>
            </div>

            <?php if ($search): ?>
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        Showing results for: "<?= esc($search) ?>"
                        <a href="<?= base_url('admin/archived-users') ?>" class="alert-link ms-2">Clear search</a>
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
                            <th>Archived At</th>
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
                                    <td><?= date('Y-m-d H:i:s', strtotime($user['updated_at'])) ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-sm btn-success" onclick="confirmRestore(<?= $user['id'] ?>)">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No archived users found.</td>
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

<!-- Restore Confirmation Modal -->
<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">
                    <i class="fas fa-undo me-2"></i>Restore User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to restore this user? This will:</p>
                <ul>
                    <li>Allow them to access their account again</li>
                    <li>Move them back to the active users list</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="restoreButton" class="btn btn-success">
                    <i class="fas fa-undo me-2"></i>Restore User
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
    function confirmRestore(userId) {
        const modalElement = document.getElementById('restoreModal');
        const modal = new bootstrap.Modal(modalElement);
        const restoreButton = document.getElementById('restoreButton');
        restoreButton.href = `<?= base_url('admin/users/restore/') ?>${userId}`;
        modal.show();
    }

    // Make confirmRestore available globally
    window.confirmRestore = confirmRestore;
});
</script>

<?= $this->endSection() ?> 