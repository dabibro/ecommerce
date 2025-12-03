<div class="content-inner pb-0 container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="header-title border-bottom pb-3">
                        <h4 class="card-title">Welcome, <?= $this->auth->customer_name ?></h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="nav nav-tabs nav-iconly gap-5 mb-5" id="myTab" role="tablist">
                        <a class="nav-link <?php if ($this->active === 'orders'): echo 'active'; endif; ?>"
                           href="<?= BASE_PATH . 'account/orders/' ?>">
                            <svg class="icon-40" width="40" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                      d="M16.6203 22H7.3797C4.68923 22 2.5 19.8311 2.5 17.1646V11.8354C2.5 9.16894 4.68923 7 7.3797 7H16.6203C19.3108 7 21.5 9.16894 21.5 11.8354V17.1646C21.5 19.8311 19.3108 22 16.6203 22Z"
                                      fill="currentColor"></path>
                                <path d="M15.7551 10C15.344 10 15.0103 9.67634 15.0103 9.27754V6.35689C15.0103 4.75111 13.6635 3.44491 12.0089 3.44491C11.2472 3.44491 10.4477 3.7416 9.87861 4.28778C9.30854 4.83588 8.99272 5.56508 8.98974 6.34341V9.27754C8.98974 9.67634 8.65604 10 8.24487 10C7.8337 10 7.5 9.67634 7.5 9.27754V6.35689C7.50497 5.17303 7.97771 4.08067 8.82984 3.26285C9.68098 2.44311 10.7814 2.03179 12.0119 2C14.4849 2 16.5 3.95449 16.5 6.35689V9.27754C16.5 9.67634 16.1663 10 15.7551 10Z"
                                      fill="currentColor"></path>
                            </svg>
                            <span class="">
                     Your Orders
                  </span>
                        </a>
                        <a class="nav-link <?php if ($this->active === 'addresses'): echo 'active'; endif; ?>"
                           href="<?= BASE_PATH . 'account/addresses/' ?>">
                            <svg class="icon-40" width="40" viewBox="0 0 40 40" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M14.2194 4.89463C17.8608 2.7788 22.3367 2.81578 25.9439 4.9915C29.5157 7.21153 31.6866 11.1736 31.6664 15.4358C31.5832 19.6699 29.2555 23.65 26.3458 26.7268C24.6664 28.5107 22.7877 30.0881 20.748 31.4267C20.538 31.5482 20.3079 31.6295 20.0691 31.6667C19.8393 31.6569 19.6155 31.589 19.4179 31.4691C16.304 29.4576 13.5722 26.8901 11.3539 23.8899C9.49763 21.3856 8.44304 18.36 8.33331 15.224C8.3309 10.9538 10.5779 7.01046 14.2194 4.89463ZM16.3236 16.9913C16.9361 18.5014 18.3819 19.4864 19.986 19.4864C21.0368 19.494 22.047 19.0731 22.7913 18.3175C23.5357 17.5619 23.9524 16.5344 23.9487 15.464C23.9543 13.8301 22.9924 12.3539 21.5121 11.7246C20.0318 11.0954 18.325 11.4373 17.1888 12.5906C16.0526 13.7439 15.711 15.4812 16.3236 16.9913Z"
                                      fill="currentColor"></path>
                                <ellipse opacity="0.4" cx="20" cy="35" rx="8.33333" ry="1.66667"
                                         fill="currentColor"></ellipse>
                            </svg>
                            <span class="">
                     Your Address
                  </span>
                        </a>
                        <a class="nav-link <?php if ($this->active === 'wishlist'): echo 'active'; endif; ?>"
                           href="<?= BASE_PATH . 'account/wishlist/' ?>">
                            <svg class="icon-40" width="40" viewBox="0 0 40 40" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                      d="M11.7761 21.8374C9.49311 20.4273 7.37081 18.7645 5.44807 16.8796C4.09069 15.5338 3.05404 13.8905 2.41735 12.0753C1.27971 8.53523 2.60399 4.48948 6.30129 3.2884C8.2528 2.67553 10.3752 3.05175 12.0072 4.29983C13.6398 3.05315 15.7616 2.67705 17.7132 3.2884C21.4105 4.48948 22.7436 8.53523 21.606 12.0753C20.9745 13.8888 19.944 15.5319 18.5931 16.8796C16.6686 18.7625 14.5465 20.4251 12.265 21.8374L12.0161 22L11.7761 21.8374Z"
                                      fill="currentColor"></path>
                                <path d="M12.0109 22.0001L11.776 21.8375C9.49013 20.4275 7.36487 18.7648 5.43902 16.8797C4.0752 15.5357 3.03238 13.8923 2.39052 12.0754C1.26177 8.53532 2.58605 4.48957 6.28335 3.28849C8.23486 2.67562 10.3853 3.05213 12.0109 4.31067V22.0001Z"
                                      fill="currentColor"></path>
                                <path d="M18.2304 9.99922C18.0296 9.98629 17.8425 9.8859 17.7131 9.72157C17.5836 9.55723 17.5232 9.3434 17.5459 9.13016C17.5677 8.4278 17.168 7.78851 16.5517 7.53977C16.1609 7.43309 15.9243 7.00987 16.022 6.59249C16.1148 6.18182 16.4993 5.92647 16.8858 6.0189C16.9346 6.027 16.9816 6.04468 17.0244 6.07105C18.2601 6.54658 19.0601 7.82641 18.9965 9.22576C18.9944 9.43785 18.9117 9.63998 18.7673 9.78581C18.6229 9.93164 18.4291 10.0087 18.2304 9.99922Z"
                                      fill="currentColor"></path>
                            </svg>
                            <span class="">Your Wishlist</span>
                        </a>
                        <a class="nav-link <?php if ($this->active === 'profile'): echo 'active'; endif; ?>"
                           href="<?= BASE_PATH . 'account/profile/' ?>">
                            <svg class="icon-40" width="40" viewBox="0 0 40 40" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.9947 25.291C12.8063 25.291 6.66632 26.4243 6.66632 30.9577C6.66632 35.4927 12.768 36.666 19.9947 36.666C27.183 36.666 33.323 35.5343 33.323 30.9993C33.323 26.4643 27.223 25.291 19.9947 25.291"
                                      fill="currentColor"></path>
                                <path opacity="0.4"
                                      d="M19.9947 20.9728C24.8913 20.9728 28.8147 17.0478 28.8147 12.1528C28.8147 7.25782 24.8913 3.33282 19.9947 3.33282C15.0997 3.33282 11.1747 7.25782 11.1747 12.1528C11.1747 17.0478 15.0997 20.9728 19.9947 20.9728"
                                      fill="currentColor"></path>
                            </svg>
                            <span class="">
                     Profile
                  </span>
                        </a>
                    </div>
                    <div class="tab-content iq-tab-fade-up">
                        <?php if (file_exists(__DIR__ . '/' . $this->account_view)) {
                            require $this->account_view;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <?php if (empty($this->wishlist)) { ?>
                    <div class="text-center py-5 my-5 align-content-center card-body">
                        <h1 class="text-muted"><i class="ri-heart-line ri-2x"></i></h1>
                        <h5 class="text-muted">No Wishlist Item found!</h5>
                        <a href="<?php echo BASE_PATH; ?>shop/">Go Shopping</a>
                    </div>
                <?php } else { ?>
                    <div class="card-header">
                        <h4 class="mb-0">Buy It Again</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-inline m-0 p-0">
                            <li class="d-flex align-items-center mb-4 flex-wrap justify-content-center gap-3">
                                <div class="mb-0 mb-xl-0 mb-md-0 mb-lg-4">
                                    <img src="../e-commerce/assets/images/product/04.png" alt="user-profile"
                                         class="img-fluid rounded object-contain avatar-80 iq-product-bg"
                                         loading="lazy">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="../e-commerce/product-detail.html" class="h6 iq-product-detail">
                                        Biker’s Jacket
                                    </a>
                                    <h5 class="text-primary mt-2 mb-0">$45.99</h5>
                                    <small class="mb-0">Buy on Jan 2021</small>
                                </div>
                                <a class="btn btn-primary btn-icon btn-sm rounded-circle"
                                   href="../e-commerce/order-process.html" role="button">
                     <span class="btn-inner">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                    fill="currentColor"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                    fill="currentColor"></path>
                           </svg>
                     </span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center mb-4 flex-wrap justify-content-center gap-3">
                                <div class="mb-0 mb-xl-0 mb-md-0 mb-lg-4">
                                    <img src="../e-commerce/assets/images/product/06.png" alt="user-profile"
                                         class="img-fluid rounded object-contain avatar-80 iq-product-bg"
                                         loading="lazy">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="../e-commerce/product-detail.html" class="h6 iq-product-detail">
                                        Blue Side Bag
                                    </a>
                                    <h5 class="text-primary mt-2  mb-0">$19.42</h5>
                                    <small class="mb-0">Buy on Dec 2020</small>
                                </div>
                                <a class="btn btn-primary btn-icon btn-sm rounded-circle"
                                   href="../e-commerce/order-process.html" role="button">
                     <span class="btn-inner">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                    fill="currentColor"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                    fill="currentColor"></path>
                           </svg>
                     </span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center mb-4 flex-wrap justify-content-center gap-3">
                                <div class="mb-0 mb-xl-0 mb-md-0 mb-lg-4">
                                    <img src="../e-commerce/assets/images/product/07.png" alt="user-profile"
                                         class="img-fluid rounded object-contain avatar-80 iq-product-bg"
                                         loading="lazy">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="../e-commerce/product-detail.html" class="h6 iq-product-detail">
                                        Pink Sweater
                                    </a>
                                    <h5 class="text-primary mt-2  mb-0">$26.00</h5>
                                    <small class="mb-0">Buy on Jan 2021</small>
                                </div>
                                <a class="btn btn-primary btn-icon btn-sm rounded-circle"
                                   href="../e-commerce/order-process.html" role="button">
                     <span class="btn-inner">
                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                           <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                 d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                 fill="currentColor"></path>
                           <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                 fill="currentColor"></path>
                        </svg>
                     </span>
                                </a>
                            </li>
                            <li class="d-flex align-items-center flex-wrap justify-content-center gap-3">
                                <div class="mb-0 mb-xl-0 mb-md-0 mb-lg-4">
                                    <img src="../e-commerce/assets/images/product/02.png" alt="user-profile"
                                         class="img-fluid rounded object-contain avatar-80 iq-product-bg"
                                         loading="lazy">
                                </div>
                                <div class="flex-grow-1">
                                    <a href="../e-commerce/product-detail.html" class="h6 iq-product-detail">
                                        Casual Shoes
                                    </a>
                                    <h5 class="text-primary mt-2  mb-0">$19.99</h5>
                                    <small class="mb-0">Buy on Jan 2021</small>
                                </div>
                                <a class="btn btn-primary btn-icon btn-sm rounded-circle"
                                   href="../e-commerce/order-process.html" role="button">
                     <span class="btn-inner">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                    fill="currentColor"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                    fill="currentColor"></path>
                           </svg>
                     </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
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