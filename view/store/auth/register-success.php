<div class="text-center">
    <div class="mb-3">
        <i class="ri-checkbox-circle-line text-success" style="font-size:3rem;"></i>
    </div>
    <h2 class="text-success mb-3 fw-bold">Registration Successful!</h2>
    <p class="lead mb-3">
        Thank you for creating an account with <br><strong><?php echo @$this->site_name; ?></strong>.
    </p>
    <p class="mb-2">
        We’ve sent a confirmation link to your registered email:
    </p>
    <p class="fw-semibold text-primary">
        <?php echo @$email; ?>
    </p>
    <p class="text-muted mb-4">
        Please check your inbox (and spam folder) to verify your account.
    </p>
    <div class="mt-3">
        <a href="/" class="btn btn-outline-primary me-2">
            <i class="bi bi-house-door"></i> Return to Home
        </a>
        <a href="javascript:" onclick="openLogin();" class="btn btn-primary">
            <i class="bi bi-box-arrow-in-right"></i> Go to Login
        </a>
    </div>
</div>
