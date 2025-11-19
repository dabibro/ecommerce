<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . '/../layout/head.php' ?>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm text-center p-4" style="max-width: 480px;">
        <div class="mb-3">
            <i class="ri-error-warning-line text-warning ri-3x" style="font-size: 3rem;"></i>
        </div>
        <h3 class="fw-bold mb-3 text-danger">Invalid or Expired Link</h3>
        <p class="text-muted">
            The password reset link you used is invalid or has expired.
            <br>
            Password reset links are only valid for a limited time or can be used once.
        </p>
        <div class="my-4">
            <a href="<?= BASE_PATH ?>" class="btn btn-primary w-100">Return Home</a>
        </div>
    </div>
</div>
</body>
</html>
