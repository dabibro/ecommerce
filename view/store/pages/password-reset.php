<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/../layout/head.php' ?>
<style>
    body {
        background: #f8f9fa;
    }

    .reset-container {
        max-width: 450px;
        margin: 60px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .brand-title {
        font-size: 26px;
        font-weight: 700;
        color: #0d6efd;
    }
</style>
<body>
<div class="reset-container">
    <div class="text-center mb-4">
        <div class="brand-title">Reset Your Password</div>
        <p class="text-muted">Enter your new password below.</p>
    </div>
    <form class="AppForm" action="<?= BASE_PATH ?>auth/password-reset" method="post" id="password-reset-form">
        <input type="hidden" name="auth_token" value="<?php echo $auth_id ?? ''; ?>">
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <input type="password" id="new_password" name="new_password" class="form-control" required
                       minlength="6" tabindex="1">
                <label class="form-label">New Password <span class="required">*</span></label>
                <div class="position-absolute" style="z-index: 999; right: 35px; top: 15px;">
                    <a href="javascript:" onclick="passwordToggle('new_password',this)">
                        <i class="ri-eye-off-line"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-12 form-group mb-3">
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required
                       minlength="6" tabindex="2">
                <label class="form-label">Confirm New Password <span class="required">*</span></label>
                <div class="position-absolute" style="z-index: 999; right: 35px; top: 15px;">
                    <a href="javascript:" onclick="passwordToggle('confirm_password',this)">
                        <i class="ri-eye-off-line"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="form-response"></div>
        <button type="submit" class="btn btn-primary w-100 form-button">Reset Password</button>
        <div class="text-center mt-3">
            <a href="<?= BASE_PATH ?>">Return Home</a>
        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../layout/script.php'; ?>
</body>
</html>
