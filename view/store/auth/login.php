<form class="AppForm" action="<?php echo BASE_PATH; ?>auth/login" method="post" id="signIn-form">
    <div class="text-center">
        <img src="<?php echo $this->logo; ?>" alt="logo" height="68">
    </div>
    <h3 class="text-center">Sign In</h3>
    <p class="text-center">Sign in to stay connected</p>
    <div class="row">
        <div class="form-group col-md-12">
            <input type="email" name="email" class="form-control mb-0" placeholder=" " autocomplete="off" required
                   data-title="Enter a valid email address.">
            <label class="form-label">Email <span class="required">*</span></label>
        </div>
        <div class="form-group col-md-12">
            <input type="password" id="password" name="password" class="form-control mb-0" placeholder=" "
                   autocomplete="off" required
                   data-title="Password is mandatory.">
            <label class="form-label">Password <span class="required">*</span></label>
            <div class="position-absolute" style="z-index: 999; right: 35px; top: 15px;">
                <a href="javascript:" onclick="passwordToggle('password',this)">
                    <i class="ri-eye-off-line"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div class="form-check d-inline-block ">
            <input type="checkbox" class="form-check-input" id="customCheck11">
            <label class="form-check-label" for="customCheck11">Remember Me</label>
        </div>
        <a href="javascript:" onclick="openForgotPassword();">Forget password</a>
    </div>
    <div class="my-2 form-response"></div>
    <div class="text-center pb-3">
        <button type="submit" class="btn btn-primary btn-block w-100 form-button">Sign In</button>
    </div>
    <p class="text-center">Don't have an account?<a href="javascript:" onclick="openRegister();"> Click here to sign
            up.</a></p>
</form>

<script>
    $('.AppForm').bootstrap5Validate(function (e, data) {
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