<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="product-vertical-slider">
                            <div class="slider__flex d-flex">
                                <div class="slider__col me-3">
                                    <div class="swiper slider__thumbs">
                                        <div class="swiper-wrapper">
                                            <?php for ($i = 1; $i <= 5; $i++) {
                                                $getImages = \App\Controller\Store\ProductsController::ProductImages($this->product_detail->product_images, $i);
                                                if (!empty($getImages) && $getImages !== NO_IMAGE) { ?>
                                                    <div class="swiper-slide">
                                                        <div class="slider__image">
                                                            <img src="<?= $getImages ?>" class="img-fluid"/>
                                                        </div>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="slider__images flex-grow-1">
                                    <div class="swiper slider__main">
                                        <div class="swiper-wrapper">
                                            <?php for ($i = 1; $i <= 5; $i++) {
                                                $getImages = \App\Controller\Store\ProductsController::ProductImages($this->product_detail->product_images, $i);
                                                if (!empty($getImages) && $getImages !== NO_IMAGE) { ?>
                                                    <div class="swiper-slide">
                                                        <div class="slider__image">
                                                            <img src="<?= $getImages ?>" class="img-fluid"/>
                                                        </div>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-4 mt-lg-0">
                        <div class="border-bottom">
                            <div class="d-flex flex-column align-content-between justify-items-center mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <?php if (!empty($this->product_detail->product_name)) {
                                        echo '<h2 class="mb-0">' . ucwords($this->product_detail->product_name) . '</h2>';
                                    } ?>
                                    <div class="d-flex justify-content-end ">
                                        <button class="btn btn-primary-subtle btn-icon rounded-pill"
                                                data-bs-toggle="offcanvas" data-bs-target="#share-btn"
                                                aria-controls="share-btn">
                                                <span class="btn-inner">
                                                    <svg class="icon-24" xmlns="http://www.w3.org/2000/svg" width="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <path d="M5.50052 15C6.37518 14.9974 7.21675 14.6653 7.85752 14.07L14.1175 17.647C13.9078 18.4666 14.0002 19.3343 14.378 20.0913C14.7557 20.8483 15.3935 21.4439 16.1745 21.7692C16.9555 22.0944 17.8275 22.1274 18.6309 21.8623C19.4343 21.5971 20.1153 21.0515 20.5493 20.3252C20.9832 19.599 21.1411 18.7408 20.994 17.9076C20.8469 17.0745 20.4047 16.3222 19.7483 15.7885C19.0918 15.2548 18.2652 14.9753 17.4195 15.0013C16.5739 15.0273 15.7659 15.357 15.1435 15.93L8.88352 12.353C8.94952 12.103 8.98552 11.844 8.99152 11.585L15.1415 8.06996C15.7337 8.60874 16.4932 8.92747 17.2925 8.97268C18.0918 9.01789 18.8823 8.78684 19.5315 8.31828C20.1806 7.84972 20.6489 7.17217 20.8577 6.39929C21.0666 5.6264 21.0032 4.80522 20.6784 4.0735C20.3535 3.34178 19.7869 2.74404 19.0735 2.38056C18.3602 2.01708 17.5436 1.90998 16.7607 2.07723C15.9777 2.24447 15.2761 2.67588 14.7736 3.29909C14.271 3.92229 13.9981 4.69937 14.0005 5.49996C14.0045 5.78796 14.0435 6.07496 14.1175 6.35296L8.43352 9.59997C8.1039 9.09003 7.64729 8.67461 7.10854 8.39454C6.5698 8.11446 5.96746 7.97937 5.3607 8.00251C4.75395 8.02566 4.16365 8.20627 3.64781 8.52658C3.13197 8.84689 2.70834 9.29589 2.41853 9.82946C2.12872 10.363 1.98271 10.9628 1.99484 11.5699C2.00697 12.177 2.17683 12.7704 2.48772 13.292C2.79861 13.8136 3.23984 14.2453 3.76807 14.5447C4.29629 14.8442 4.89333 15.0011 5.50052 15Z"
                                                              fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex my-4">
                                <?php
                                $main_price = "";
                                $price = $this->product_detail->sale_price;
                                if (!empty($this->product_detail->discount) && $this->product_detail->discount > 0):
                                    $discounted = (int)(($this->product_detail->discount - 0) / 100 * $price);
                                    $main_price = '<span style="text-decoration:line-through" class="text-muted">' . number_format($price) . '</span>';
                                    $price -= $discounted;
                                endif; ?>
                                <h4 class="mb-0"> Price:</h4>
                                <h4 class="text-primary mb-0 ms-2"><?= $this->currency . ' ' . number_format($price) ?></h4>
                                <span class="small ml-5"><?= $main_price ?></span>
                            </div>
                        </div>
                        <?php if (!empty($this->product_detail->product_description)) {
                            echo '<div class="border-bottom"><p class="py-4 mb-0">' . ucwords($this->product_detail->product_description) . '</p></div>';
                        } ?>
                        <div class="d-flex flex-column py-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">In Stock:</span>
                                <span class="text-primary  ms-2"><?= number_format($this->product_detail->quantity) ?> Available</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-dark">Category:</span>
                                <span class="text-primary  ms-2"><?= strtoupper($this->category_data->category)?></span>
                            </div>
                        </div>
                        <div>
                            <div class="btn-group iq-qty-btn mb-3" data-qty="btn" role="group">
                                <button type="button" class="btn btn-sm btn-outline-light iq-quantity-minus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="6" height="3" viewBox="0 0 6 3"
                                         fill="none">
                                        <path d="M5.22727 0.886364H0.136364V2.13636H5.22727V0.886364Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </button>
                                <input type="text" class="btn btn-sm btn-outline-light input-display" data-qty="input"
                                       pattern="^(0|[1-9][0-9]*)$" minlength="1" maxlength="2" value="2" title="Qty"
                                       readonly="">
                                <button type="button" class="btn btn-sm btn-outline-light iq-quantity-plus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="8" viewBox="0 0 9 8"
                                         fill="none">
                                        <path d="M3.63636 7.70455H4.90909V4.59091H8.02273V3.31818H4.90909V0.204545H3.63636V3.31818H0.522727V4.59091H3.63636V7.70455Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="d-flex py-4 flex-wrap gap-4">
                                <a href="./order-process.html" class="btn btn-warning d-flex align-items-center gap-2">
                                        <span class="btn-inner d-flex ">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                      d="M16.6203 22H7.3797C4.68923 22 2.5 19.8311 2.5 17.1646V11.8354C2.5 9.16894 4.68923 7 7.3797 7H16.6203C19.3108 7 21.5 9.16894 21.5 11.8354V17.1646C21.5 19.8311 19.3108 22 16.6203 22Z"
                                                      fill="currentColor"></path>
                                                <path d="M15.7551 10C15.344 10 15.0103 9.67634 15.0103 9.27754V6.35689C15.0103 4.75111 13.6635 3.44491 12.0089 3.44491C11.2472 3.44491 10.4477 3.7416 9.87861 4.28778C9.30854 4.83588 8.99272 5.56508 8.98974 6.34341V9.27754C8.98974 9.67634 8.65604 10 8.24487 10C7.8337 10 7.5 9.67634 7.5 9.27754V6.35689C7.50497 5.17303 7.97771 4.08067 8.82984 3.26285C9.68098 2.44311 10.7814 2.03179 12.0119 2C14.4849 2 16.5 3.95449 16.5 6.35689V9.27754C16.5 9.67634 16.1663 10 15.7551 10Z"
                                                      fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    Buy Now
                                </a>
                                <button class="btn btn-primary d-flex align-items-center cart-btn  gap-2">
                                        <span class="btn-inner d-flex">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z"
                                                      fill="currentColor"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z"
                                                      fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    Add to cart
                                </button>
                                <a href="./wishlist.html" class="btn btn-info d-flex align-items-center gap-2">
                                        <span class="btn-inner d-flex">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4"
                                                      d="M11.7761 21.8374C9.49311 20.4273 7.37081 18.7645 5.44807 16.8796C4.09069 15.5338 3.05404 13.8905 2.41735 12.0753C1.27971 8.53523 2.60399 4.48948 6.30129 3.2884C8.2528 2.67553 10.3752 3.05175 12.0072 4.29983C13.6398 3.05315 15.7616 2.67705 17.7132 3.2884C21.4105 4.48948 22.7436 8.53523 21.606 12.0753C20.9745 13.8888 19.944 15.5319 18.5931 16.8796C16.6686 18.7625 14.5465 20.4251 12.265 21.8374L12.0161 22L11.7761 21.8374Z"
                                                      fill="currentColor"></path>
                                                <path d="M12.0109 22.0001L11.776 21.8375C9.49013 20.4275 7.36487 18.7648 5.43902 16.8797C4.0752 15.5357 3.03238 13.8923 2.39052 12.0754C1.26177 8.53532 2.58605 4.48957 6.28335 3.28849C8.23486 2.67562 10.3853 3.05213 12.0109 4.31067V22.0001Z"
                                                      fill="currentColor"></path>
                                                <path d="M18.2304 9.99922C18.0296 9.98629 17.8425 9.8859 17.7131 9.72157C17.5836 9.55723 17.5232 9.3434 17.5459 9.13016C17.5677 8.4278 17.168 7.78851 16.5517 7.53977C16.1609 7.43309 15.9243 7.00987 16.022 6.59249C16.1148 6.18182 16.4993 5.92647 16.8858 6.0189C16.9346 6.027 16.9816 6.04468 17.0244 6.07105C18.2601 6.54658 19.0601 7.82641 18.9965 9.22576C18.9944 9.43785 18.9117 9.63998 18.7673 9.78581C18.6229 9.93164 18.4291 10.0087 18.2304 9.99922Z"
                                                      fill="currentColor"></path>
                                            </svg>
                                        </span>
                                    Wishlist
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!empty($this->product_detail->product_description)) { ?>
            <div class="card">
                <div class="card-body">
                    <nav class="tab-bottom-bordered">
                        <div class="mb-0 nav nav-tabs" id="nav-tab1" role="tablist">
                            <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-description" type="button" role="tab"
                                    aria-controls="nav-description" aria-selected="true">Description
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content mt-4" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-description" role="tabpanel"
                             aria-labelledby="nav-description-tab">
                            <div class="d-flex flex-column">
                                <?php echo '<p class="mb-3">' . ucwords($this->product_detail->product_description) . '</p>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if (!empty($this->product_list)) { ?>
        <div class="col-md-12 col-lg-12">
            <div class="d-flex py-4">
                <h4>Similar Products</h4>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                <?php
                foreach ($this->product_list as $product) {
                    $product['product_id'] = $product['id'];
                    echo $this->productsController->ProductGrid($product);
                } ?>
            </div>
        </div>
    <?php } ?>
</div>

<input type="hidden" id="product-page">
