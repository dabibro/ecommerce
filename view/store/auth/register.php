<form class="AppForm" action="<?php echo BASE_PATH; ?>auth/register" method="post" id="signup-form">
    <div class="text-center">
        <img src="<?php echo $this->logo; ?>" alt="logo" height="68">
    </div>
    <h3 class="text-center">Sign Up</h3>
    <p class="text-center">Create your <?php echo ucwords(strtolower($this->store->store_name)); ?> account</p>
    <div class="row">
        <div class="form-group col-md-6">
            <input type="text" name="first_name" class="form-control mb-0" placeholder=" " autocomplete="off" required
                   data-title="* First name is a mandatory.">
            <label class="form-label">First Name <span class="required">*</span></label>
        </div>
        <div class="form-group col-md-6">
            <input type="text" name="last_name" class="form-control mb-0" placeholder=" " autocomplete="off" required
                   data-title="* Last name is mandatory.">
            <label class="form-label">Last Name <span class="required">*</span></label>
        </div>
        <div class="form-group col-md-12">
            <input type="email" name="email" class="form-control mb-0" placeholder=" " autocomplete="off" required
                   data-title="Enter a valid email address.">
            <label class="form-label">Email <span class="required">*</span></label>
        </div>
        <div class="form-group col-md-12">
            <input type="tel" name="phone" class="form-control mb-0" placeholder=" " autocomplete="off" required
                   data-title="Enter a valid phone number.">
            <label class="form-label">Phone Number <span class="required">*</span></label>
        </div>
        <div class="form-group col-md-6">
            <input type="password" id="password" name="password" class="form-control mb-0" placeholder=" " autocomplete="off" required
                   data-title="Password is mandatory.">
            <label class="form-label">Password <span class="required">*</span></label>
            <div class="position-absolute" style="z-index: 999; right: 35px; top: 15px;">
                <a href="javascript:" onclick="passwordToggle('password',this)">
                    <i class="ri-eye-off-line"></i>
                </a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <input type="password" id="confirm-password" name="confirm_password" class="form-control mb-0" placeholder=" " autocomplete="off"
                   required data-title="Confirm password is mandatory." data-equals="password">
            <label class="form-label">Confirm Password <span class="required">*</span></label>
            <div class="position-absolute" style="z-index: 999; right: 35px; top: 15px;">
                <a href="javascript:" onclick="passwordToggle('confirm-password',this)">
                    <i class="ri-eye-off-line"></i>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="text-center pb-3">
                <input type="checkbox" name="agree_terms" class="form-check-input" id="customCheck112"
                       required data-title="You must agree to the terms and conditions">
                <label class="form-check-label pointer" for="customCheck112">I agree with the terms and conditions of
                    use</label>
            </div>
            <div class="my-2 form-response"></div>
            <div class="text-center pb-3">
                <button type="submit" class="btn btn-primary btn-block w-100 form-button">Sign Up</button>
            </div>
        </div>
    </div>
    <p class="text-center">Already have an Account <a href="javascript:" onclick="openLogin();">Sign In</a></p>
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