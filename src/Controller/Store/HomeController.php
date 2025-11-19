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

    public $auth_session;
    protected Application $appAPI;

    protected Customers $customerAPI;
    protected Products $productsAPI;
    protected ProductsController $productsController;

    protected string $logo, $header_title, $min_price, $max_price;
    protected array $price_params;

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

    public function layout(): void
    {
        require_once $this->views . 'index.php';
        die();
    }

    protected function openStore(): void
    {
        $this->views .= 'store/';
        $this->pages = $this->views . 'pages/';
        $this->auth_session = CUSTOMER_SESSION;
        $this->appAPI = new Application();
        $this->productsAPI = new Products();
        $this->productsController = new ProductsController();
        $this->config = $this->appAPI->getConfig(['id' => 1]);
        if (!empty($this->config)) {
            $this->config = DataHandlers::convertObj($this->config[0]);
            $this->site_name = $this->config->biz_name;
            $this->logo = $this->assets . 'images/logo.png';
            $getStore = $this->appAPI->getStore(['reference' => $this->config->online_store]);
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