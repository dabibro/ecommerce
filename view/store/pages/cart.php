<?php if (empty($this->cart_count)) { ?>
    <div class="text-center py-5">
        <div class="mb-2">
            <i class="ri-shopping-basket-line text-secondary" style="font-size: 98px;"></i>
        </div>
        <h2 class="fw-bold">Your Cart is Empty</h2>
        <p class="text-muted mb-4">
            It looks like you haven’t added anything yet. Browse our categories and find something you love!
        </p>
        <a href="<?= BASE_PATH ?>shop/" class="btn btn-primary mb-5">
            <i class="fa-solid fa-store"></i> Continue Shopping
        </a>
    </div>
<?php } else { ?>
    <div class="row">
        <ul class="text-center iq-product-tracker mb-0 py-4" id="progressbar">
            <li class="active iq-tracker-position-0" id="iq-tracker-position-1">Cart</li>
            <li class="iq-tracker-position-0" id="iq-tracker-position-2">Checkout</li>
            <li class="iq-tracker-position-0" id="iq-tracker-position-3">Payment</li>
        </ul>
        <div id="cart" class="iq-product-tracker-card show b-0">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="pb-3">My Cart</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-responsive mb-0">
                                    <tbody>
                                    <?php foreach ($this->cart_items as $item) { ?>
                                        <tr data-item="list" id="row-<?= $item['product_id'] ?>">
                                            <td scope="row">
                                                <div class="d-flex align-items-center gap-5">
                                                    <img src="<?= $item['image'] ?>" alt="image"
                                                         class="img-fluid object-contain avatar-70 iq-product-bg p-1"
                                                         loading="lazy">
                                                    <div style="white-space: normal;  word-wrap: break-word;">
                                                        <h5 class="mb-3" style="font-size: 14px;">
                                                            <?= strtoupper($item['name']) ?>
                                                        </h5>
                                                        <!--                                                        <p class="mb-1">Colour: Red &amp; Black</p>-->
                                                        <!--                                                        <p class="mb-1">Size: L</p>-->
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group iq-qty-btn" data-qty="btn" role="group">
                                                    <button type="button" data-id="<?= $item['product_id'] ?>"
                                                            class="btn btn-sm btn-outline-light iq-quantity-minus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="6" height="3"
                                                             viewBox="0 0 6 3" fill="none">
                                                            <path d="M5.22727 0.886364H0.136364V2.13636H5.22727V0.886364Z"
                                                                  fill="currentColor"></path>
                                                        </svg>
                                                    </button>
                                                    <input type="text"
                                                           class="btn btn-sm btn-outline-light input-display"
                                                           data-qty="input" pattern="^(0|[1-9][0-9]*)$" minlength="1"
                                                           maxlength="2" value="<?= $item['qty'] ?>" title="Qty"
                                                           readonly="">
                                                    <button type="button" data-id="<?= $item['product_id'] ?>"
                                                            class="btn btn-sm btn-outline-light iq-quantity-plus">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="8"
                                                             viewBox="0 0 9 8" fill="none">
                                                            <path d="M3.63636 7.70455H4.90909V4.59091H8.02273V3.31818H4.90909V0.204545H3.63636V3.31818H0.522727V4.59091H3.63636V7.70455Z"
                                                                  fill="currentColor"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <!--                                                    <p class="text-decoration-line-through mb-0">$80.00</p>-->
                                                    <a href="javascript:" id="cost"
                                                       class="text-decoration-none"><?= number_format($item['qty'] * $item['price'], 2) ?></a>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-icon btn-danger btn-sm delete-btn delete-item"
                                                        data-id="<?= $item['product_id'] ?>">
                                                    <span class="btn-inner">
                                                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.4"
                                                                  d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z"
                                                                  fill="currentColor"></path>
                                                            <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z"
                                                                  fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="border-bottom">
                                <!--                                <div class="d-flex justify-content-between mb-4">-->
                                <!--                                    <h6 class="mb-0">Order ID</h6>-->
                                <!--                                    <h6 class="mb-0">ASDW11268</h6>-->
                                <!--                                </div>-->
                                <!--                                <div class="input-group mb-3">-->
                                <!--                                    <input type="text" class="form-control" placeholder="Coupon Code"-->
                                <!--                                           aria-label="Coupon Code" aria-describedby="CouponCode">-->
                                <!--                                    <button class="btn btn-primary" type="button" id="CouponCode">Apply</button>-->
                                <!--                                </div>-->
                            </div>
                            <div class="border-bottom mt-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Subtotal</h6>
                                    <h6 class="text-primary"
                                        id="cart-subtotal"><?= $this->currency . ' ' . number_format($this->cart_total, 2) ?></h6>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <h6>Discount</h6>
                                    <h6 class="text-success"><?= $this->currency . ' ' . number_format(0, 2) ?></h6>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <h6 class="mb-0">Order Total</h6>
                                    <h5 class="text-primary mb-0"
                                        id="cart-total"><?= $this->currency . ' ' . number_format($this->cart_total, 2) ?></h5>
                                </div>
                                <!--                                <div class="alert border-primary rounded border border-1 mb-4">-->
                                <!--                                    <div class="d-flex justify-content-between align-items-center ">-->
                                <!--                                        <h6 class="text-primary mb-0">Total Savings on this order</h6>-->
                                <!--                                        <h6 class="text-primary mb-0"><b>$38.00</b></h6>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <!--                                <div class="alert border-primary rounded border border-1 mb-4">-->
                                <!--                                    <div class="d-flex justify-content-between align-items-center ">-->
                                <!--                                        <h6 class="text-primary mb-0">Expected date of delivery</h6>-->
                                <!--                                        <h6 class="text-primary mb-0">12 Feb 2020</h6>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                                <div class="d-flex">
                                    <a id="place-order" href="javascript:" class="btn btn-primary d-block mt-3 w-100">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>