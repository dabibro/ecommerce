<div class="row">
    <div class="col-lg-3">
        <?php require_once __DIR__ . '/../side/categories.php'; ?>
        <?php require_once __DIR__ . '/../side/price.php'; ?>
    </div>
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Trending Items</h4>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-grid-view" role="tabpanel"
                 aria-labelledby="grid-view-tab">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                    <?php foreach ($this->trending_products as $product) {
                        echo $this->productsController->ProductGrid($product);
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 pt-3">
        <?php $categories = $this->productsController->CategoryShowcase(); ?>
        <div class="category-showcase fade-in-section">
            <?php foreach ($categories as $category): ?>
                <div class="category-section mb-2">
                    <h3 class="mb-3">
                        <a href="<?php echo BASE_PATH . 'category/' . $category['category_id'] ?>"> <?= htmlspecialchars($category['category_name']); ?></a>
                    </h3>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5">
                        <?php foreach ($category['products'] as $product):
                            echo $this->productsController->ProductGrid($product);
                        endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-lg-12 pb-5">
        <section class="bg-primary text-white py-5 rounded-4 cta">
            <div class="container text-center">
                <h2 class="mb-3 text-secondary">Shop the Best Deals Today!</h2>
                <p class="mb-4 fs-5">Discover high-quality products at unbeatable prices. Don’t miss out on our latest
                    arrivals and exclusive offers.</p>
                <a href="<?php echo BASE_PATH . 'shop/'; ?>" class="btn btn-light btn-lg px-4 py-2 rounded-pill">
                    Start Shopping
                </a>
            </div>
        </section>
    </div>
</div>