<div class="border-bottom">
    <div class="d-flex justify-content-between mb-3">
        <h6 class="mb-0">Order ID</h6>
        <h6 class="mb-0 font-weight"><?= $this->order->reference ?></h6>
    </div>
    <!--                            <div class="input-group mb-3">-->
    <!--                                <input type="text" class="form-control" placeholder="Coupon Code"-->
    <!--                                       aria-label="Coupon Code" aria-describedby="CouponCode001">-->
    <!--                                <button class="btn btn-primary" type="button" id="CouponCode001">Apply</button>-->
    <!--                            </div>-->
</div>
<div class="border-bottom mt-4">
    <div class="d-flex justify-content-between mb-4">
        <h6 class="mb-0">Subtotal</h6>
        <h6 class="mb-0 text-primary"><?= $this->currency . ' ' . number_format($this->order->subtotal, 2) ?></h6>
    </div>
   <!-- <div class="d-flex justify-content-between mb-4">
        <h6 class="mb-0">Discount</h6>
        <h6 class="mb-0 text-success"><?php /*= $this->currency . ' ' . number_format($this->order->discount, 2) */?></h6>
    </div>-->
    <?php if ($this->order->charges > 0) {
        $this->order->total_due += $this->order->charges;
        ?>
        <div class="d-flex justify-content-between mb-4">
            <h6 class="mb-0">Delivery Charges</h6>
            <h6 class="mb-0 text-primary"><?= $this->currency . ' ' . number_format($this->order->charges, 2) ?></h6>
        </div>
    <?php } ?>

</div>
<div class="mt-4">
    <div class="d-flex justify-content-between mb-4">
        <h6 class="mb-0">Order Total</h6>
        <h6 class="mb-0 text-primary"><?= $this->currency . ' ' . number_format($this->order->total_due, 2) ?></h6>
    </div>
    <div class="d-flex justify-content-between flex-wrap">
        <a id="backbutton" href="#checkout"
           class="btn btn-danger-subtle d-block back justify-content-between">Discard</a>
        <a id="deliver-address" href="#payment" class="btn btn-primary d-block">Place
            Order</a>
    </div>
</div>