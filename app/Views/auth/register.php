<?= $this->extend('templates/auth_layout') ?>
<?= $this->section('content') ?>

<h2 class="text-center mb-2 fw-bold" style="font-family: 'Orbitron', sans-serif;">Join the Cosmic Journey</h2>
<p class="text-center mb-4" style="color: #E0E0E0 !important;">Create your account to start exploring</p>

<form action="<?= base_url('/auth/register') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-user-astronaut me-2"></i>Username
        </label>
        <input type="text" name="username" class="form-control" required 
               value="<?= old('username') ?>" placeholder="Choose your cosmic identity">
        <div class="form-text" style="color: #A8B2D1 !important;">
            <i class="fas fa-info-circle me-1"></i>
            3-20 characters long
        </div>
    </div>
    
    <div class="mb-3">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-envelope me-2"></i>Email Address
        </label>
        <input type="email" name="email" class="form-control" required 
               value="<?= old('email') ?>" placeholder="Your space mail">
    </div>
    
    <div class="mb-3">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-key me-2"></i>Password
        </label>
        <div class="input-group">
            <input type="password" name="password" class="form-control" required id="password"
                   placeholder="Create your secret code">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                <i class="bi bi-eye-slash" id="toggleIcon"></i>
            </button>
        </div>
        <div class="form-text" style="color: #A8B2D1 !important;">
            <i class="fas fa-shield-alt me-1"></i>
            Must be at least 8 characters with 1 uppercase letter and 1 number
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-key me-2"></i>Confirm Password
        </label>
        <div class="input-group">
            <input type="password" name="confirm_password" class="form-control" required id="confirmPassword"
                   placeholder="Confirm your secret code">
            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
            </button>
        </div>
    </div>
    
    <button type="submit" class="cosmic-btn w-100">
        <i class="fas fa-rocket me-2"></i>Launch Account
    </button>

    <p class="text-center mt-4" style="color: #E0E0E0;">
        Already have an account? 
        <a href="<?= base_url('/auth/login') ?>" class="cosmic-link fw-bold">
            <i class="fas fa-sign-in-alt me-1"></i>Return to Base
        </a>
    </p>
</form>

<!-- Verification Email Sent Modal -->
<div class="modal fade" id="verificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100" style="color: #E0E0E0;">
                    <i class="fas fa-paper-plane me-2"></i>
                    Verification Email Launched!
                </h5>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <i class="fas fa-envelope-open-text" style="font-size: 3rem; color: #7B4CFF;"></i>
</div>
                <p style="color: #E0E0E0;">We've sent a verification link to your email.</p>
                <p class="small" style="color: #A8B2D1;">Please check your inbox and click the verification link to complete your registration.</p>
                <div class="alert alert-info mt-3 mb-0" style="background: rgba(123, 76, 255, 0.1); border-color: rgba(123, 76, 255, 0.2);">
                    <small style="color: #E0E0E0;">
                        <i class="fas fa-clock me-1"></i>The link will expire in 1 hour.<br>
                        <i class="fas fa-exclamation-circle me-1"></i>If you don't see the email:
                        <ul class="mb-0 mt-1">
                            <li>Check your spam folder</li>
                            <li>Verify the email address</li>
                            <li>Try registering again</li>
                        </ul>
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="cosmic-btn" onclick="handleModalClose()" style="width: auto;">
                    <i class="fas fa-check me-2"></i>Got it
                </button>
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

    // Show verification modal if email sent
    <?php if(session()->getFlashdata('verification_sent')): ?>
    showVerificationModal();
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

function showVerificationModal() {
    removeBackdrop();
    const modalElement = document.getElementById('verificationModal');
    const modal = new bootstrap.Modal(modalElement, {
        backdrop: false
    });
    
    modalElement.addEventListener('hidden.bs.modal', function () {
        removeBackdrop();
    });

    modal.show();
}

function handleModalClose() {
    const modalElement = document.getElementById('verificationModal');
    const modal = bootstrap.Modal.getInstance(modalElement);
    if (modal) {
        modal.hide();
        removeBackdrop();
        window.location.href = '<?= base_url('/auth/login') ?>';
    }
}
</script>

<?= $this->endSection() ?>