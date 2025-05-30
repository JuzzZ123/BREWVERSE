<?= $this->extend('templates/auth_layout') ?>

<?= $this->section('content') ?>
<h2 class="text-center mb-2 fw-bold" style="font-family: 'Orbitron', sans-serif;">Reset Your Coordinates</h2>
<p class="text-center text-muted mb-4">Enter your new access codes below</p>

<form action="<?= base_url('/auth/reset/' . $token) ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">
            <i class="fas fa-key me-2"></i>New Password
        </label>
        <div class="input-group">
            <input type="password" name="password" class="form-control" required id="password"
                   placeholder="Enter your new secret code">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye-slash" id="toggleIcon"></i>
            </button>
        </div>
        <div class="form-text text-muted">
            <i class="fas fa-shield-alt me-1"></i>
            Must be at least 8 characters with 1 uppercase letter and 1 number
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">
            <i class="fas fa-key me-2"></i>Confirm New Password
        </label>
        <div class="input-group">
            <input type="password" name="confirm_password" class="form-control" required id="confirmPassword"
                   placeholder="Confirm your new secret code">
            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
            </button>
        </div>
    </div>
    
    <button type="submit" class="cosmic-btn w-100">
        <i class="fas fa-sync-alt me-2"></i>Reset Password
    </button>

    <p class="text-center mt-4">
        Remember your password? 
        <a href="<?= base_url('/auth/login') ?>" class="cosmic-link fw-bold">
            <i class="fas fa-sign-in-alt me-1"></i>Return to Base
        </a>
    </p>
</form>

<!-- Reset Success Modal -->
<div class="modal fade" id="resetSuccessModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100">
                    <i class="fas fa-check-circle me-2"></i>
                    Mission Accomplished!
                </h5>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <i class="fas fa-shield-check" style="font-size: 3rem; color: #7B4CFF;"></i>
                </div>
                <p>Your password has been successfully reset.</p>
                <p class="small text-muted">Redirecting you to the login portal...</p>
                <div class="spinner-border text-primary mt-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast container for messages -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <?php if(session()->getFlashdata('error')): ?>
    <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($errors)): ?>
    <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php foreach($errors as $error): ?>
                    <?= $error ?><br>
                <?php endforeach; ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Initialize toasts
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl);
    });
    toastList.forEach(toast => toast.show());

    // Password visibility toggles
    function setupPasswordToggle(inputId, toggleId, iconId) {
        const toggleBtn = document.querySelector(toggleId);
        const input = document.querySelector(inputId);
        const icon = document.querySelector(iconId);

        toggleBtn.addEventListener('click', function () {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.classList.toggle('bi-eye');
            icon.classList.toggle('bi-eye-slash');
        });
    }

    setupPasswordToggle('#password', '#togglePassword', '#toggleIcon');
    setupPasswordToggle('#confirmPassword', '#toggleConfirmPassword', '#toggleConfirmIcon');

    // Show success modal and redirect if password reset successful
    <?php if(session()->getFlashdata('reset_success')): ?>
    var successModal = new bootstrap.Modal(document.getElementById('resetSuccessModal'), {
        backdrop: 'static',
        keyboard: false
    });
    successModal.show();
    setTimeout(function() {
        window.location.href = "<?= base_url('/auth/login') ?>";
    }, 3000);
    <?php endif; ?>
    });
</script>

<?= $this->endSection() ?>
