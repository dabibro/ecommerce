<?php foreach ($this->shipping as $item) { ?>
    <div class="col-lg-4">
        <div class="mt-4">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="address" id="address21"
                       checked="">
                <label class="form-check-label mb-0" for="address21">
                    <span class="h6 mb-0"><?= $item['first_name'] . ' ' . $item['last_name'] ?></span>
                </label>
            </div>
            <p class="mb-0"><?= $item['apartment'] ?>, <?= $item['street'] ?></p>
            <p class="mb-0"><?= $item['city_lga'] . ', ' . $item['state'] ?></p>
            <p class="mb-0"><?= $item['phone'] ?></p>
            <p class="mb-0"><?= $item['email'] ?></p>
            <div class="mt-2">
                <a href="javascript:" onclick="editShipping('<?= $item['id'] ?>')">Edit</a>
                <span>|</span>
                <a href="javascript:">Remove </a>
            </div>
        </div>
    </div>
<?php } ?>