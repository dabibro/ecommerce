<div class="row">
    <div class="col-lg-3">
        <?php require_once __DIR__ . '/../side/categories.php'; ?>
        <?php require_once __DIR__ . '/../side/price.php'; ?>
    </div>
    <div class="col-lg-9">
        <div class="tab-content mb-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-grid-view" role="tabpanel"
                 aria-labelledby="grid-view-tab">
                <?php if (empty($this->product_list)) { ?>
                    <section class="py-5 text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-6">
                                    <img src="<?php echo $this->assets ?>images/icon/no-result.svg"
                                         alt="No products found"
                                         class="img-fluid mb-4" style="max-width: 200px;">
                                    <h2 class="fw-bold mb-3">No Products Found</h2>
                                    <p class="text-muted mb-4">
                                        We couldn’t find any products matching your search.
                                        Try adjusting your filters or check back later for new arrivals.
                                    </p>
                                    <a href="<?php echo BASE_PATH . 'shop/' ?>" class="btn btn-primary btn-lg">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Shop
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                <?php } else { ?>
                    <div class="d-flex justify-content-between align-items-center flex-wrap pb-2 border-bottom mb-3">
                        <div class="mb-md-0">
                            <div class="fw-semibold">
                                <?php echo @$this->pagination->items_total; ?> Products found
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <select id="sortPrice" class="form-select form-control-sm w-auto"
                                    style="height: unset;" onchange="updateSortOrder(this)">
                                <option value="">Sort by</option>
                                <option value="asc">Price: Low to High</option>
                                <option value="desc">Price: High to Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                        <?php foreach ($this->product_list as $product) {
                            $product['product_id'] = $product['id'];
                            echo $this->productsController->ProductGrid($product);
                        } ?>
                    </div>
                    <?php if (isset($this->pagination->items_total) && $this->pagination->items_total > 0) { ?>
                        <div class="row">
                            <div class="pl-2">
                                <?php echo $this->pagination->display_pages() . '</div>'; ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>

    </div>
</div>