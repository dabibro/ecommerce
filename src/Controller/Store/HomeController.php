<?php

namespace App\Controller\Store;

use App\API\Application;
use App\API\Customers;
use App\API\Products;
use App\Infrastructure\App;
use App\Infrastructure\DataHandlers;

class HomeController extends App
{
    public $pages, $page, $carousel, $header, $breadcrumb, $pagination, $filter_path;
    public $config, $store, $categories, $category_data, $product_list;
    public $contact_number, $contact_email, $contact_address, $map_url;
    public $trending_products;

    public $auth_session, $auth;
    public int $cart_count = 0;
    public $cart_items;

    public $cart_total;
    public $product_detail;

    protected string $logo, $header_title, $min_price, $max_price;
    protected array $price_params;
    protected Application $appAPI;

    protected AuthController $authController;

    protected Customers $customerAPI;
    protected Products $productsAPI;
    protected ProductsController $productsController;

    protected CartController $cartController;


    /**
     * @throws \JsonException
     */
    public function __construct()
    {
        parent::__construct();
        $this->openStore();
        $this->getPricing();
    }

    public function index(): void
    {
        $this->carousel = 1;
        $this->page_title = "Home - " . $this->site_name;
        $this->page = $this->pages . 'landing.php';
        $this->filter_path = BASE_PATH . 'shop/';
        $this->layout();
    }

    public function products($category = ""): void
    {
        $this->header = 1;
        $query = [
            'default_limit' => 24,
            'mid_range' => 3,
            'condition' => [
                'active_status' => 1
            ],
            'orderBy' => 'product_name, product_category DESC'
        ];
        $where_condition = "";
        $this->page = $this->pages . 'products.php';
        $this->page_title = "Products - " . $this->site_name;
        $this->header_title = "Shopping";
        $this->breadcrumb = [
            "#" => "Shopping",
        ];
        if (!empty($category)) {
            $getCategory = $this->productsAPI->getCategory(['id' => $category]);
            $this->category_data = DataHandlers::convertObj($getCategory[0]);
            $this->page_title = $this->category_data->category . " | " . $this->site_name;
            $this->header_title = $this->category_data->category;
            $this->breadcrumb = [
                BASE_PATH . 'category/' . $this->category_data->id => $this->category_data->category,
            ];
            $query['condition']['product_category'] = $this->category_data->category_id;
        }
        /* start filter */
        if (!empty($_GET['category'])) {
            $getCategory = $this->productsAPI->getCategory(['id' => $_GET['category']]);
            if (!empty($getCategory)) {
                $query['condition']['product_category'] = $getCategory[0]['category_id'];
            }
        }
        if (!empty($_GET['q'])) {
            $keyword = DataHandlers::verify_input($_GET['q']);
            $query['condition']['search'] = [
                'keyword' => $keyword,
                'columns' => 'product_name, brief_description'
            ];
            $query['orderBy'] = "quantity DESC, product_name LIKE ('{$keyword}%') DESC, ifnull(nullif(instr(product_name, ' {$keyword}'), 0), 99999), ifnull(nullif(instr(product_name, '{$keyword}'), 0), 99999), product_name ";

        }
        if (!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
            $where_condition .= "sale_price > {$_GET['min_price']} and sale_price < {$_GET['max_price']}";
        }
        if (!empty($_GET['order'])) {
            $query['orderBy'] = 'sale_price ' . $_GET['order'] . ', ' . $query['orderBy'];
        }
        /* end filter */
        $getProducts = $this->productsAPI->getProductsPagination($query, $where_condition);
        if (!empty($getProducts['result'])) {
            $this->product_list = $getProducts['result'];
            $this->pagination = $getProducts['pagination'];
        }
        $this->layout();
    }

    /**
     * @throws \JsonException
     */
    public function product($id): void
    {
        $this->productsAPI = new Products();
        $getProduct = $this->productsAPI->getProduct(['id' => $id]);
        if (empty($id) || empty($getProduct)) {
            $this->replace(BASE_PATH);
        }
        $this->product_detail = DataHandlers::convertObj($getProduct[0]);

        $this->page_title = ucwords($this->product_detail->product_name) . " - " . $this->site_name;
        $this->breadcrumb = [];
        $getSimilar = $this->productsAPI->getProduct(['product_category' => $this->product_detail->product_category], 'RAND()', 8);
        if (!empty($getSimilar)) {
            $this->product_list = $getSimilar;
        }
        $product_image = ProductsController::ProductImages($this->product_detail->product_images);
        $this->meta = [
            'og:title' => ucwords($this->product_detail->product_name) . ' - ' . $this->currency . ' ' . number_format($this->product_detail->sale_price, 2),
            'og:image' => URL . ltrim($product_image, '/'),
            'og:type' => 'product',
            'og:site_name' => $this->site_name,
            'og:url' => URL . 'product/' . $this->product_detail->id,
            'product:price:amount' => $this->product_detail->sale_price,
            'product:price:currency' => 'NGN',
        ];
        if (!empty($this->product_detail->product_description)) {
            $this->meta['og:description'] = htmlspecialchars_decode($this->product_detail->product_description);
            $this->site_description = htmlspecialchars_decode($this->product_detail->product_description);
        }
        if (!empty($this->product_detail->product_category)) {
            $getCategory = $this->productsAPI->getCategory(['category_id' => $this->product_detail->product_category]);
            if (!empty($getCategory)) {
                $this->category_data = DataHandlers::convertObj($getCategory[0]);
            }
        }
        $this->page = $this->pages . 'product.php';
        $this->layout();
    }

    public function cart(): void
    {
        $this->page_title = "Cart | " . $this->site_name;
        $this->page = $this->pages . 'cart.php';
        $this->cartController = new CartController();
        $this->cart_items = $this->cartController->getItems();
        $this->layout();
    }

    public function cart_to_database()
    {


    }

    public function checkout(): void
    {
        $this->page_title = "Cart | " . $this->site_name;
        $this->page = $this->pages . 'cart.php';
        $this->cartController = new CartController();
        $this->cart_items = $this->cartController->getItems();
        $this->layout();

    }


    public function layout(): void
    {
        require_once $this->views . 'index.php';
        die();
    }

    /**
     * @throws \JsonException
     */
    protected function openStore(): void
    {
        $this->views .= 'store/';
        $this->pages = $this->views . 'pages/';
        $this->auth_session = CUSTOMER_SESSION;
        $this->appAPI = new Application();
        $this->productsAPI = new Products();
        $this->productsController = new ProductsController();
        $this->cartController = new CartController();
        $this->config = $this->appAPI->getConfig(['id' => 1]);
        if (!empty($this->config)) {
            $this->config = DataHandlers::convertObj($this->config[0]);
            $this->site_name = $this->config->biz_name;
            $this->logo = $this->assets . 'images/logo.png';
            $getStore = $this->appAPI->getStore(['reference' => $this->config->online_store]);
            $this->site_description = htmlspecialchars_decode($this->config->biz_description);
            if (!empty($getStore)) {
                $this->store = DataHandlers::convertObj($getStore[0]);
                $this->site_name = $this->store->store_name;
                $this->contact_number = $this->store->contact_phone;
                $this->contact_email = $this->store->contact_email;
                $this->contact_address = $this->store->contact_address;
                $this->map_url = $this->store->map_url;
                $getCategories = $this->productsAPI->getCategory(['category_location' => $this->store->reference]);
                if (!empty($getCategories)) {
                    $this->categories = $getCategories;
                }
                $getTrending = $this->productsAPI->getTrending();
                if (!empty($getTrending)) {
                    $this->trending_products = $getTrending;
                }
            }
        }
        $this->cart_count = $this->cartController->countItems();
        $this->cart_total = $this->cartController->getTotal();
        $this->authenticate();
    }

    /**
     * @throws \JsonException
     */
    public function authenticate(): void
    {
        if (isset($_COOKIE[$this->auth_session])) {
            $session = $_COOKIE[$this->auth_session];
            $credentials = json_decode($session, false, 512, JSON_THROW_ON_ERROR);
            $this->auth = $credentials;
        }

    }

    protected function getPricing(): void
    {
        $condition = [
            'active_status' => 1
        ];
        $resp = $this->productsAPI->getProductsPricing($condition);
        if (!empty($resp)) {
            $this->min_price = $resp[0]['min_price'];
            $this->max_price = $resp[0]['max_price'];
        }
    }

}