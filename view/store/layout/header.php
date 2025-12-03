<!-- Top Header -->
<div class="bg-primary border-bottom py-1 small d-none d-md-block">
    <div class="container d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex align-items-center">
      <span class="me-3 text-white">
          <i class="ri-phone-line ri ri-mr me-1"></i>
          <a class="text-white" href="tel:<?php echo $this->contact_number; ?>"><?php echo $this->contact_number; ?></a>
      </span>
            <span class="text-white me-3">
        <i class="ri ri-mail-line ri-mr me-1"></i>
                <a class="text-white"
                   href="mailto:<?php echo $this->contact_email; ?>"><?php echo $this->contact_email; ?></a>
      </span>
            <?php if (!empty($this->map_url)) { ?>
                <span class="text-white">
        <i class="ri ri-map-line ri-mr me-1"></i>
                <a class="text-white" target="_blank"
                   href="<?php echo $this->map_url; ?>">Locate Our Store</a>
      </span>
            <?php } ?>
        </div>
        <div class="d-flex align-items-center">
            <div class="me-3">
                <select class="form-select form-select-sm border-0 text-white bg-transparent">
                    <option selected>English</option>
                    <!--                    <option value="fr">French</option>-->
                    <!--                    <option value="es">Spanish</option>-->
                </select>
            </div>
            <div>
                <select class="form-select form-select-sm border-0 text-white bg-transparent">
                    <!--                    <option selected>USD</option>-->
                    <!--                    <option value="eur">EUR</option>-->
                    <option value="ngn">NGN</option>
                </select>
            </div>
        </div>

    </div>
</div>
<div class="position-relative bg-white">
    <div class="container">
        <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar header-hover-menu">
            <div class="container-fluid navbar-inner">
                <div class="d-flex align-items-center justify-content-between w-100 landing-header">
                    <div class="d-flex align-items-center d-xl-none">
                        <button data-trigger="navbar_main" class="d-xl-none btn btn-primary rounded-pill p-1 pt-0"
                                type="button">
                            <svg width="20px" class="icon-20" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                      d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
                            </svg>
                        </button>
                        <a href="<?php echo BASE_PATH; ?>" class="navbar-brand ms-3  d-xl-none">
                            <img src="<?php echo $this->logo; ?>" alt="logo" height="84">
                        </a>
                    </div>
                    <a href="<?php echo BASE_PATH; ?>" class="navbar-brand m-0 d-xl-flex d-none">
                        <img src="<?php echo $this->logo; ?>" alt="logo" height="84">
                    </a>
                    <!-- Horizontal Menu Start -->
                    <nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav">
                        <div class="container-fluid p-lg-0">
                            <div class="offcanvas-header px-0">
                                <div class="navbar-brand ms-3">
                                    <a href="<?php echo BASE_PATH; ?>" class="navbar-brand m-0">
                                        <img src="<?php echo $this->logo; ?>" alt="logo" height="84">
                                    </a>
                                </div>
                                <button class="btn-close float-end px-3"></button>
                            </div>
                            <form class="d-flex align-items-center w-100 d-none d-xl-flex" role="search"
                                  id="productSearchForm" action="<?php echo BASE_PATH . 'search/' ?>">
                                <div class="input-group" style="min-width: 450px">
                                    <?php if (!empty($this->categories)) { ?>
                                        <select class="form-select search-select" id="categorySelect" name="category"
                                                aria-label="Select category"
                                                style="width: 250px">
                                            <option selected value="">All Categories</option>
                                            <?php \App\Infrastructure\DataHandlers::DropDownList($this->categories, 'id', 'category', @$_GET['category']); ?>
                                        </select>
                                    <?php } ?>
                                    <input type="search" class="form-control" name="q" id="searchProductInput"
                                           style="width: 250px"
                                           value="<?php if (!empty($_GET['q'])) {
                                               echo $_GET['q'];
                                           } ?>"
                                           placeholder="Search products..." aria-label="Search products">
                                    <button class="btn btn-primary" type="submit" id="searchBtn">
                                        <i class="ri ri-search-line"></i> <!-- Bootstrap Icons -->
                                    </button>
                                </div>
                            </form>

                        </div> <!-- container-fluid.// -->
                    </nav>
                    <ul class="d-block d-xl-none list-unstyled m-0">
                        <li class="nav-item dropdown iq-responsive-menu ">
                            <div class="btn btn-sm bg-body" id="navbarDropdown-search-11" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                            stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-search-11"
                                style="width: 18rem;">
                                <li class="px-3 py-0">
                                    <div class="form-group input-group mb-0">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-text">
                                              <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24"
                                                   fill="none"
                                                   xmlns="http://www.w3.org/2000/svg">
                                                  <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                                          stroke-width="1.5" stroke-linecap="round"
                                                          stroke-linejoin="round"></circle>
                                                  <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor"
                                                        stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                              </svg>
                                          </span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav iq-nav-menu  align-items-center navbar-list d-none d-xl-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_PATH; ?>shop/">Shop All</a>
                        </li>
                        <?php if (empty($this->auth->id)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" onclick="openRegister();" href="javascript:">Sign Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="openLogin();" href="javascript:">Sign In</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="/cart">
                                <i class="ri-shopping-cart-line ri ri-mr"></i> My Cart
                                <span class="cart-counter position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                      id="cartCount"><?= $this->cart_count ?></span>
                            </a>
                        </li>
                        <?php if (!empty($this->auth->id)) { ?>
                            <li class="nav-item">
                                <a class="nav-link menu-arrow justify-content-start" data-bs-toggle="collapse"
                                   href="#my-account" role="button" aria-expanded="false" aria-controls="my-account">
                                    <span class="item-name">My Account</span>
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-18" width="18"
                                         height="18" viewBox="0 0 24 24">
                                        <path d="M19 8.5L12 15.5L5 8.5" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                                <ul class="iq-header-sub-menu list-unstyled collapse" id="my-account" style="right: 0">
                                    <li class="nav-item">
                                        <a class="nav-link bg-light active"
                                           href="javascript:">Welcome, <?= $this->auth->customer_name ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="<?= BASE_PATH ?>account/profile/">My Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="<?= BASE_PATH ?>account/orders/">My Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="<?= BASE_PATH ?>account/orders/">My Wishlist</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" onclick="logOut()" href="javascript:">Logout?</a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>