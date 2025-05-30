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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Total Users</div>
                        <div class="card-value"><?= $total_users ?></div>
                    </div>
                    <i class="fas fa-users fa-2x" style="color: #7B4CFF"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Admin Users</div>
                        <div class="card-value"><?= $admin_count ?></div>
                    </div>
                    <i class="fas fa-user-shield fa-2x" style="color: #7B4CFF"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Regular Users</div>
                        <div class="card-value"><?= $regular_count ?></div>
                    </div>
                    <i class="fas fa-user fa-2x" style="color: #7B4CFF"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Login History Tables -->
    <div class="row">
        <!-- Admin Login History -->
        <div class="col-md-6">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Admin Login History</h6>
                    <span class="badge"><?= $total_admin_logs ?> entries</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
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
                <?php if (($total_admin_logs ?? 0) > $perPage): ?>
                    <div class="mt-3 d-flex justify-content-end">
                        <?= $pager->makeLinks($adminPage, $perPage, $total_admin_logs, 'bootstrap_pagination', 0, 'admin_logins') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- User Login History -->
        <div class="col-md-6">
            <div class="admin-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="m-0" style="font-family: 'Orbitron', sans-serif; color: #7B4CFF;">
                        User Login History
                    </h6>
                    <span class="badge"><?= $total_user_logs ?> entries</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Login Time</th>
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
                <?php if (($total_user_logs ?? 0) > $perPage): ?>
                    <div class="mt-2 d-flex justify-content-end">
                        <?= $pager->makeLinks($userPage, $perPage, $total_user_logs, 'bootstrap_pagination', 0, 'user_logins') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?> 