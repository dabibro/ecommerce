<div class="text-center mb-4">
    <i class="ri-shield-line text-primary" style="font-size:3rem;"></i>
    <h4 class="mt-2 mb-1 fw-bold">Forgot Your Password?</h4>
    <p class="text-muted">
        Enter your registered email address, and we’ll send you a link to reset your password.
    </p>
</div>
<form action="<?php echo BASE_PATH; ?>auth/password-recovery" method="POST" id="forgot-password">
    <div class="form-response my-2"></div>
    <div class="mb-3 form-group">
        <label for="forgot-password-email" class="form-label fw-semibold">Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light"><i class="ri-mail-line"></i></span>
            <input type="email" name="email" id="forgot-password-email" class="form-control" placeholder="Enter your email" required
                   data-title="Enter a valid email address">
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 form-button">
        <i class="bi bi-send"></i> Send Reset Link
    </button>
</form>
<div class="text-center mt-4">
    <a href="javascript:" onclick="openLogin();" class="text-decoration-none">
        <i class="bi bi-arrow-left"></i> Back to Login
    </a>
</div>
<script>
    $('#forgot-password').bootstrap5Validate(function (e, data) {
        const form_id = "#" + this.id;
        const button = $(form_id + ' .form-button');
        const text = button.html();
        button.html('<i class="ri-loader-4-line icon-spin ri ri-mr"></i> Processing...').prop('disabled', true);
        $.ajax({
            url: this.action,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $(form_id + ' .form-response').html(response);
                button.html(text).prop('disabled', false);
            },
            error: function () {
                button.html(text).prop('disabled', false);
            }
        });
    });
</script>