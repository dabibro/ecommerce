<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 13/10/2023
 * Time: 12:16 AM
 */

namespace App\DB;


class Tables
{
    public string $config, $stores, $categories, $products, $invoices, $sold_products, $customers;
    public $storage;
    public $measurement;
    public $transfers;

    public $states;
    public $locals;

    public $users;
    public $users_group;
    //    public $user_rights;


    public $staff_login;

    protected $users_sessions;

    protected $logger;

    public function __construct()
    {
        $this->config = 'app_config';
        $this->stores = 'app_stores';
        $this->customers = 'app_customers';
        //Inventory
        $this->categories = 'app_inventory_category';
        $this->products = 'app_inventory';

        //Sales
        $this->invoices = 'app_sales_invoice';
        $this->sold_products = 'app_sales_products';

        $this->stocking = "inventory_stocking";
        $this->measurement = "measure_unit";
        $this->transfers = "transfers";

//        $this->customers = 'app_customers';
        $this->solutions = 'packages';
        $this->users = 'app_users';

        $this->states = 'app_states';
        $this->locals = 'app_locals';

        $this->license = 'licensing';
        $this->cloud = 'smb_cloud';


        // Locations
        // Users


//        $this->user_rights = 'user_rights';


        $this->posts = 'posts';

        $this->users_group = 'users_group';


        $this->logger = 'logger';
        $this->users_sessions = 'users_sessions';

    }

    public function isLocal()
    {
        return !checkdnsrr($_SERVER['SERVER_NAME'], 'NS');
    }
}