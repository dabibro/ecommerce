<form autocomplete="off" action="<?= BASE_PATH ?>aubmit-shipping" method="post" class="AppForm">
    <div class="row">
        <div class="form-group col-lg-6">
            <input type="text" class="form-control" id="fName" placeholder=""
                   autocomplete="off" required name="first_name">
            <label class="form-label" for="fName">First Name <span
                        class="required">*</span></label>
        </div>
        <div class="form-group col-lg-6">
            <input type="text" class="form-control" id="LName" placeholder=""
                   autocomplete="off" required name="last_name">
            <label class="form-label" for="LName">Last Name <span
                        class="required">*</span></label>
        </div>
        <div class="form-group col-md-12">
            <input type="text" name="company" id="company" placeholder="" class="form-control">
            <label for="company">Company Name <small class="text-muted">(Optional)</small></label>
        </div>
        <div class="form-group col-lg-6">
            <input type="email" class="form-control" id="Cno" placeholder=""
                   autocomplete="off" required name="phone">
            <label class="form-label" for="Cno">Contact Number <span
                        class="required">*</span></label>
        </div>
        <div class="form-group col-lg-6">
            <input type="text" class="form-control" id="email" placeholder=""
                   autocomplete="off" required name="email">
            <label class="form-label" for="email">Email Address <span
                        class="required">*</span></label>
        </div>
        <div class="form-group col-lg-6">
            <input type="password" class="form-control" id="HName" placeholder=""
                   autocomplete="off" required name="apartment">
            <label class="form-label" for="HName">House No./ Flat No. <span
                        class="required">*</span></label>
        </div>
        <div class="form-group col-lg-6">
            <input type="text" class="form-control" id="Street" placeholder=""
                   autocomplete="off" required name="street">
            <label class="form-label" for="Street">Street Address <span
                        class="required">*</span></label>
        </div>
        <div class="form-group col-lg-6">
            <select name="state" id="state" class="form-control" required
                    onchange="states_local(this.value,'#city_lga');">
                <option value=""> -- Select --</option>
                <?php echo $this->getStateSelect(); ?>
            </select>
            <label class="form-label" for="state">State <span class="required">*</span></label>
        </div>
        <div class="form-group col-lg-6">
            <select name="city_lga" class="form-control" id="city_lga">
                <option value=""> -- Select --</option>
            </select>
            <label class="form-label" for="city_lga">Local Government Area <span
                        class="required">*</span></label>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary form-button">Submit</button>
        </div>
    </div>
</form>