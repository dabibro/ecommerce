<div class="card iq-filter-card">
    <div class="card-body">
        <a class="bg-transparent d-flex justify-content-between iq-custom-collapse pb-3"
           data-bs-toggle="collapse" href="#iq-product-categories" role="button"
           aria-expanded="true"
           aria-controls="iq-product-categories">
            <h5 class="mb-0">Categories</h5>
            <i class="right-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" width="18" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"></path>
                </svg>
            </i>
        </a>
        <div class="collapse show" id="iq-product-categories">
            <div style="max-height: 400px; overflow-y: auto;">
                <?php if (!empty($this->categories)) {
                    foreach ($this->categories as $category) { ?>
                        <div class="py-1">
                            <a href="<?php echo BASE_PATH . 'category/' . $category['id']; ?>"
                               class="form-check-label w-100">
                                <i class="ri-folder-2-line ri ri-mr"></i>
                                <?php echo ucwords(strtolower($category['category'])); ?>
                            </a>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
