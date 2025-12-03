<div class="row">
    <ul class="text-center iq-product-tracker mb-0 py-4" id="progressbar">
        <li class="iq-tracker-position-0" id="iq-tracker-position-1">Cart</li>
        <li class="active iq-tracker-position-0" id="iq-tracker-position-2">Checkout</li>
        <li class="iq-tracker-position-0" id="iq-tracker-position-3">Payment</li>
    </ul>
    <div id="checkout" class="iq-product-tracker-card b-0 show">
        <div class="row">
            <div class="col-lg-8">
                <?php if (!empty($this->shipping)) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-0">Shipping Addresses</h4>
                            <div class="row" id="shipping-addresses">
                                <?php require __DIR__ . '/../side/shipping-addresses.php'; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Add New Address</h4>
                    </div>
                    <div class="card-body">
                        <?php require_once __DIR__ . '/account/address.php' ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">Additional Instruction</h4>
                        <textarea class="form-control" name="notes" cols="30" rows="4" id="notes"
                                  onkeyup="checkInfo({notes:this.value});"
                                  placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Order Summary</h4>
                    </div>
                    <div class="card-body" id="order-summary">
                        <?php require __DIR__ . '/../side/order-summary.php'; ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Delivery Method</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($this->appAPI->getDeliveryOption(['status' => 1]) as $item) { ?>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check d-flex align-items-center gap-3 checkout-update">
                                    <input class="form-check-input" id="<?= $item['id'] ?>" type="radio"
                                           name="delivery" <?php if ($this->order->delivery === $item['title']): echo 'checked'; endif; ?>
                                           value="<?= $item['title'] ?>" data-delivery="<?= $item['title'] ?>"
                                           data-id="<?= $this->order->id ?>" data-charges="<?= $item['charges'] ?>">
                                    <label class="form-check-label d-flex flex-column pointer" for="<?= $item['id'] ?>">
                                        <span class="h6"><?= $item['title'] ?></span>
                                        <span class="small"><?= $item['description'] ?></span>
                                    </label>
                                </div>
                                <?php if ($item['charges'] > 0) { ?>
                                    <h6 class="text-primary mb-0"><?= $this->currency . ' ' . number_format($item['charges'], 2) ?></h6>
                                <?php } else { ?>
                                    <h6 class="pl-4"></h6>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Payment Options</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($this->appAPI->getPaymentOption(['status' => 1]) as $item) { ?>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check d-flex align-items-center gap-3 checkout-update">
                                    <input class="form-check-input" id="<?= $item['id'] ?>" type="radio" name="payment"
                                        <?php if ($this->order->payment === $item['gateway_id']): echo 'checked'; endif; ?>
                                           value="<?= $item['title'] ?>" data-id="<?= $this->order->id ?>"
                                           data-payment="<?= $item['gateway_id'] ?>">
                                    <label class="form-check-label d-flex flex-column pointer" for="<?= $item['id'] ?>">
                                        <span class="h6"><?= $item['mode_name'] ?></span>
                                        <span class="small"><?= $item['description'] ?></span>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>