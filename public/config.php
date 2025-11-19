<?php

/*
 * PHP settings
 */
date_default_timezone_set('Africa/Lagos');
ini_set('display_errors', 'On');
ob_start("ob_gzhandler");
error_reporting(E_ALL);
ini_set('max_execution_time', 3000);

const BASE_PATH = "/";
const SITE_NAME = "";
const URL = "http://dev.ayaadevarieties.com.ng/";
const SUPPORT_EMAIL = "support@ayaadevarieties.com.ng";
const CONTACT_EMAIL = "";

const CUSTOMER_SESSION = "AyaadeStoreSession";
const CART_SESSION = "AyaadeCartSession";
/* Resources Directory */
const ASSETS_PATH = BASE_PATH . 'assets/';
const IMAGES_PATH = BASE_PATH . 'assets/images/';
const PRODUCT_IMAGES = BASE_PATH . 'assets/images/products/';
const NO_IMAGE = BASE_PATH . 'assets/images/icon/image.png';
const VENDOR_PATH = ASSETS_PATH . 'vendor/';
const HOPE_UI = ASSETS_PATH . 'hope-ui/';
/* End Resources Directory */

const ADMIN_PATH = BASE_PATH . 'admin/';
const DASHBOARD_PATH = BASE_PATH . 'dashboard/';

/*start smtp config*/
const SMTP_HOST = "ayaadevarieties.com.ng";
const SMTP_USER = "no-reply@ayaadevarieties.com.ng";
const SMTP_PASS = "Mail@Ayaade";