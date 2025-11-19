<div class="card iq-filter-card">
    <div class="card-body">
        <a class="bg-transparent iq-custom-collapse w-100 d-flex justify-content-between pb-3"
           data-bs-toggle="collapse" href="#iq-product-filter-01" role="button"
           aria-expanded="true"
           aria-controls="iq-product-filter-01">
            <h5 class="mb-0">Price</h5>
            <i class="right-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-18" width="18" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"></path>
                </svg>
            </i>
        </a>
        <div class="collapse show" id="iq-product-filter-01">
            <form action="<?php if (!empty($this->filter_path)): echo $this->filter_path; endif; ?>" method="get"
                  class="mt-4">
                <div class="form-group mt-3">
                    <div id="price-slider"></div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <div class="w-50">
                        <span class="fw-bold"><?php echo $this->currency; ?></span>
                        <span id="min-price-display"></span>
                    </div>
                    <div class="w-50 text-end">
                        <span class="fw-bold"><?php echo $this->currency; ?></span>
                        <span id="max-price-display"></span>
                    </div>
                </div>
                <input type="hidden" name="min_price" id="min-price">
                <input type="hidden" name="max_price" id="max-price">
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-block btn-primary btn-sm">
                        Apply Filter
                    </button>
                </div>
            </form>
            <!--  <div class="mt-2">
                  <div class="form-group mt-3 product-range">
                      <div class="range-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                      </div>
                  </div>
                  <div class="d-flex justify-content-between">
                      <small id="lower-value">$50</small>
                      <small id="upper-value">$2000</small>
                  </div>
              </div>-->
        </div>
    </div>
</div>