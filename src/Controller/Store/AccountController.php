<?php

namespace App\Controller\Store;

use App\API\Customers;
use App\API\Orders;

class AccountController extends HomeController
{
    protected string $account_view, $active;
    protected $order_list;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->auth->id)) {
            $this->replace(BASE_PATH);
        }
    }

    public function orders(): void
    {
        $this->page_title = "My Order | " . $this->site_name;
        $this->active = "orders";
        $this->account_view = 'orders.php';
        $query = [
            'default_limit' => 5,
            'mid_range' => 3,
            'condition' => [
                'customer_id' => $this->auth->customer_id
            ],
            'orderBy' => 'created_on DESC'
        ];
        $this->orderAPI = new Orders();
        $this->customerAPI = new Customers();
        $where_condition = "";
        $getOrders = $this->orderAPI->getOrderPagination($query, $where_condition);
        if (!empty($getOrders['result'])) {
            $this->order_list = $getOrders['result'];
            $this->pagination = $getOrders['pagination'];
        }
        $this->page = $this->pages . 'account/layout.php';
        $this->layout();
    }

}