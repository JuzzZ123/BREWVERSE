<?= $this->extend('templates/auth_layout') ?>
<?= $this->section('content') ?>

<h2 class="text-center mb-2 fw-bold" style="font-family: 'Orbitron', sans-serif;">Lost in Space?</h2>
<p class="text-center mb-4" style="color: #E0E0E0 !important;">Don't worry, we'll help you find your way back</p>

<form action="<?= base_url('/auth/forgot') ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-4">
        <label class="form-label" style="color: #E0E0E0;">
            <i class="fas fa-envelope me-2"></i>Email Address
        </label>
        <input type="email" name="email" class="form-control" required 
               placeholder="Enter your registered email">
        <div class="form-text" style="color: #A8B2D1 !important;">
            <i class="fas fa-info-circle me-1"></i>
            We'll send you a reset link to this email
        </div>
    </div>
    
    <button type="submit" class="cosmic-btn w-100">
        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
    </button>

    <p class="text-center mt-4" style="color: #E0E0E0;">
        Remember your password? 
        <a href="<?= base_url('/auth/login') ?>" class="cosmic-link fw-bold">
            <i class="fas fa-sign-in-alt me-1"></i>Return to Base
        </a>
    </p>
</form>

<!-- Reset Link Sent Modal -->
<div class="modal fade" id="resetLinkModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <h5 class="modal-title w-100" style="color: #E0E0E0;">
                    <i class="fas fa-paper-plane me-2"></i>
                    Reset Link Launched!
                </h5>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <i class="fas fa-envelope-open-text" style="font-size: 3rem; color: #7B4CFF;"></i>
                </div>
                <p style="color: #E0E0E0;">We've sent a password reset link to your email.</p>
                <p class="small" style="color: #A8B2D1;">Please check your inbox and follow the instructions.</p>
                <div class="alert alert-info mt-3 mb-0" style="background: rgba(123, 76, 255, 0.1); border-color: rgba(123, 76, 255, 0.2);">
                    <small style="color: #E0E0E0;">
                        <i class="fas fa-clock me-1"></i>The link will expire in 1 hour.<br>
                        <i class="fas fa-exclamation-circle me-1"></i>If you don't see the email:
                        <ul class="mb-0 mt-1">
                            <li>Check your spam folder</li>
                            <li>Verify the email address</li>
                            <li>Try requesting again</li>
                        </ul>
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <a href="<?= base_url('/auth/login') ?>" class="cosmic-btn" style="width: auto;">
                    <i class="fas fa-check me-2"></i>Return to Login
                </a>
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

    // Show reset link modal if success
    <?php if(session()->getFlashdata('reset_link_sent')): ?>
    showResetLinkModal();
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

function showResetLinkModal() {
    removeBackdrop();
    const modalElement = document.getElementById('resetLinkModal');
    const modal = new bootstrap.Modal(modalElement, {
        backdrop: false
    });
    
    modalElement.addEventListener('hidden.bs.modal', function () {
        removeBackdrop();
    });

    modal.show();
}
</script>

<?= $this->endSection() ?>
