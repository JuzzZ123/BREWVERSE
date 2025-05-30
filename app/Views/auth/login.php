<?= $this->extend('templates/auth_layout') ?>
<?= $this->section('content') ?>

<h2 class="text-center mb-2 fw-bold" style="font-family: 'Orbitron', sans-serif;">Launch Your Journey</h2>
<p class="text-center mb-4" style="color: #E0E0E0 !important;">Welcome back, cosmic explorer!</p>

<form action="<?= base_url('/auth/login') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-user-astronaut me-2"></i>Email or Username
        </label>
        <input type="text" name="email" class="form-control" required value="<?= old('email') ?>" placeholder="Enter your cosmic identity">
    </div>
    
    <div class="mb-3">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-key me-2"></i>Password
        </label>
        <div class="input-group">
            <input type="password" name="password" class="form-control" required id="password" placeholder="Enter your secret code">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye-slash" id="toggleIcon"></i>
            </button>
        </div>
    </div>
    
    <button class="cosmic-btn mt-4 w-100">
        <i class="fas fa-rocket me-2"></i>Launch Into Space
    </button>

    <div class="text-center mt-4">
        <a href="<?= base_url('/auth/forgot') ?>" class="cosmic-link">
            <i class="fas fa-question-circle me-1"></i>Lost in Space? Reset Password
        </a>
    </div>

    <p class="text-center mt-4" style="color: #E0E0E0;">
        New to the cosmos? 
        <a href="<?= base_url('/auth/register') ?>" class="cosmic-link fw-bold">
            <i class="fas fa-user-plus me-1"></i>Join the Mission
        </a>
    </p>
</form>

<!-- Verification Required Modal -->
<?php if(session()->getFlashdata('verification_required')): ?>
<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel" style="color: #E0E0E0;">
                    <i class="fas fa-satellite me-2"></i>
                    Cosmic Verification Required
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="fas fa-envelope-open-text" style="font-size: 3rem; color: #7B4CFF;"></i>
                </div>
                <p style="color: #E0E0E0;"><?= session()->getFlashdata('verification_required') ?></p>
                <p class="small" style="color: #A8B2D1;">Houston, we have a problem! Please try registering again.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Toast container for various messages -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100;">
    
    <!-- Error Toast -->
    <?php if(session()->getFlashdata('error')): ?>
    <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-meteor me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Success Toast -->
    <?php if(session()->getFlashdata('verification_success') || session()->getFlashdata('registration_complete')): ?>
    <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Mission Success!</strong><br>
                <?= session()->getFlashdata('verification_success') ?: session()->getFlashdata('registration_complete') ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Info Toast -->
    <?php if(session()->getFlashdata('info')): ?>
    <div class="toast align-items-center text-bg-info border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-info-circle me-2"></i>
                <?= session()->getFlashdata('info') ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Resend Success Toast -->
    <?php if(session()->getFlashdata('resend_success')): ?>
    <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-paper-plane me-2"></i>
                <?= session()->getFlashdata('resend_success') ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Login Success Modal -->
<div class="modal fade" id="loginSuccessModal" tabindex="-1" aria-labelledby="loginSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100" id="loginSuccessModalLabel" style="color: #E0E0E0;">
                    <i class="fas fa-rocket me-2"></i>
                    Launching Successfully!
                </h5>
            </div>
            <div class="modal-body">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p style="color: #E0E0E0;">Preparing for takeoff to your dashboard...</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Remove any existing backdrops
    removeBackdrop();

    // Initialize toasts
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl);
    });
    toastList.forEach(toast => toast.show());

    // Show verification modal if needed
    <?php if(session()->getFlashdata('verification_required')): ?>
    var verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
    verificationModal.show();
    <?php endif; ?>

    // Password visibility toggle
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const toggleIcon = document.querySelector('#toggleIcon');

    togglePassword.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    });

    <?php if(session()->getFlashdata('login_success') || session()->getFlashdata('admin_login_success')): ?>
    showSuccessModal();
    <?php endif; ?>
});

function removeBackdrop() {
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.remove();
    }
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
}

function showSuccessModal() {
    removeBackdrop();
    const modalElement = document.getElementById('loginSuccessModal');
    const modal = new bootstrap.Modal(modalElement, {
        backdrop: false
    });
    
    modalElement.addEventListener('hidden.bs.modal', function () {
        removeBackdrop();
    });

    modal.show();
    setTimeout(function() {
        modal.hide();
        removeBackdrop();
        window.location.href = "<?= base_url('/main_dashboard') ?>";
    }, 2000);
}
</script>

<?= $this->endSection() ?>