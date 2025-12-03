<div class="tab-pane fade active show" id="order" role="tabpanel" aria-labelledby="order-tab">
    <?php if (empty($this->order_list)) { ?>
        <div class="text-center py-5 my-5 align-content-center">
            <h1 class="text-muted"><i class="ri-information-line ri-2x"></i></h1>
            <h5 class="text-muted">No order record found!</h5>
            <a href="<?php echo BASE_PATH; ?>shop/">Start Shopping Now</a>
        </div>
    <?php } else { ?>
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <h5 class="mb-0 pb-3"><?php echo @$this->pagination->items_total; ?> Orders placed in </h5>
            <div class="dropdown text-end pb-3">
                <button class="dropdown btn btn-primary-subtle" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    Last 30 Days
                    <svg width="12" class="ms-2" viewBox="0 0 12 8" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6 5.08579L10.2929 0.792893C10.6834 0.402369 11.3166 0.402369 11.7071 0.792893C12.0976 1.18342 12.0976 1.81658 11.7071 2.20711L6.70711 7.20711C6.31658 7.59763 5.68342 7.59763 5.29289 7.20711L0.292893 2.20711C-0.0976311 1.81658 -0.0976311 1.18342 0.292893 0.792893C0.683418 0.402369 1.31658 0.402369 1.70711 0.792893L6 5.08579Z"
                              fill="currentColor"></path>
                    </svg>
                </button>
                <ul class="dropdown-menu dropdown-menu-soft-primary"
                    aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item active" href="#">Last 30 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 90 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 180 Days</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Last 1 Year</a></li>
                </ul>
            </div>
        </div>
        <?php foreach ($this->order_list as $item) {
            $items = $this->orderAPI->getOrderProduct(['reference' => $item['reference']]);
            $ship_to = "";
            if (!empty($item['shipping'])) {
                $getShipping = $this->customerAPI->getShipping(['id' => $item['shipping']]);
                if (!empty($getShipping)) {
                    $ship_to .= $getShipping[0]['first_name'] . ' ' . $getShipping[0]['last_name'];
                }
            }
            ?>
            <div class="card shadow-none border iq-product-order-placed">
                <div class="card-header user-details-bg-color bg-light p-4">
                    <div class="iq-order-content">
                        <div class="iq-order-user-details d-flex justify-content-between align-items-center gap-4">
                            <div>
                                <p>Order Placed</p>
                                <h6 class="mb-0"><?php echo \App\Infrastructure\DataHandlers::formatDate($item['created_on'], true); ?></h6>
                            </div>
                            <div>
                                <p>Total</p>
                                <h6 class="mb-0"><?= $this->currency . ' ' . number_format($item['total_due'], 2) ?></h6>
                            </div>
                            <?php if (!empty($ship_to)) { ?>
                                <div>
                                    <p>Ship to</p>
                                    <h6 class="mb-0 text-primary"><?= $ship_to ?></h6>
                                </div>
                            <?php } ?>
                        </div>
                        <h6 class="mb-xl-0 mb-2 iq-order-id">Order ID:
                            <a href="<?= BASE_PATH . 'order/' . $item['reference'] ?>">#<?= $item['reference'] ?></a>
                            <span class="d-block">Items #: <?= count($items) ?></span>
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <div class="d-flex align-items-center gap-2">
                            <div>
                                <h6 class="mb-3">Delivery Option: <?= $item['delivery'] ?></h6>
                                <h5 class="text-primary mb-0">
                                    <?php if (empty($item['payment_status'])): echo '<span class="text-danger">UNPAID</span>'; else: echo '<span class="text-success">PAID</span>'; endif; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="mt-3 mt-xl-0 mt-3 mt-md-0">
                            <div class="dropdown text-end">
                                <a class="btn btn-primary mb-3"
                                   href="<?= BASE_PATH . 'checkout/' . $item['reference'] ?>">
                                    View Order
                                </a>
                                <!--                                <ul class="dropdown-menu dropdown-menu-soft-primary"-->
                                <!--                                    aria-labelledby="buy-again-drop">-->
                                <!--                                    <li><a class="dropdown-item active" href="#">Buy It Again</a></li>-->
                                <!--                                    <li><a class="dropdown-item" href="#">Replace</a></li>-->
                                <!--                                    <li><a class="dropdown-item" href="#">View</a></li>-->
                                <!--                                    <li>-->
                                <!--                                        <hr class="dropdown-divider">-->
                                <!--                                    </li>-->
                                <!--                                    <li><a class="dropdown-item" href="#">Cancel Order</a></li>-->
                                <!--                                </ul>-->
                            </div>
                            <div class="text-right">
                                <!--                                <a href="../e-commerce/invoice.html">Invoice</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-12 text-center">
            <div class="row">
                <div class="pl-2">
                    <?php echo $this->pagination->display_pages() . '</div>'; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>