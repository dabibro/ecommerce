<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 31/07/2024
 * Time: 06:07 PM
 */

namespace App\Infrastructure;

use App\DB\DBProcessor;
use App\DB\SQLQueryBuilder;
use App\Services\ProcManagerManagerService;
use Dotenv\Dotenv;
use JetBrains\PhpStorm\NoReturn;

class App
{
    protected string $views;
    public string $assets;

    public $scripts;
    public $styles;
    public $base_url;
    public $app_name;
    public $current_timestamp;

    public $currency;
    public $current_date;
    public $menus;
    public $module_path;
    public $module_name;
    public $db_update;
    public $config;
    protected string $page_title, $title, $subtitle, $site_name, $site_description, $site_keywords, $website_url;

    public function __construct()
    {
        $env = Dotenv::createImmutable(__DIR__ . '../../../');
        $env->load();
        $this->base_url = BASE_PATH;
        $this->views = '../view/';
        $this->assets = $this->base_url . "assets/";
        $this->page_title = "";
        $this->site_name = 'SmartBizness eCommerce';
        $this->app_name = 'ecommerce';
        $this->site_description = 'Streamline your business finances with SmartBizness FinManager. Simplify accounting, manage expenses, track profits, and make data-driven decisions with ease. Ideal for businesses of all sizes.';
        $this->site_keywords = "SmartBizness FinManager, business finance software, accounting tools, expense tracking, financial management, profit tracking, small business software, financial planning, business budgeting, cloud accounting software";
        $this->website_url = 'https://smbz.com.ng//';
        $this->current_timestamp = $this->CurrentTimeStamp();
        $this->current_date = $this->CurrentDate();
        $this->currency = $this->currency();
    }

    protected function CurrentTimeStamp(): string
    {
        $QueryBuilder = new SQLQueryBuilder();
        $sql = "SELECT CURRENT_TIMESTAMP as cts from " . $QueryBuilder->config . " ";
        return $QueryBuilder->getArray($sql)['dataArray'][0]['cts'];
    }

    public function CurrentDate()
    {
        $QueryBuilder = new SQLQueryBuilder();
        $sql = "SELECT CURRENT_DATE as c_date from " . $QueryBuilder->config . " ";
        return $QueryBuilder->getArray($sql)['dataArray'][0]['c_date'];

    }

    public function currency($param = "", $list = "")
    {
        $currency = 'NGN';
        if (!empty($param)):
            $currency = $param;
        endif;
        $array = [
            "NGN" => ['name' => 'Naira', 'symbol' => "&#x20A6;"],
            "USD" => ['name' => 'Dollar', 'symbol' => "&#36;"],
            "EUR" => ['name' => 'Euro', 'symbol' => "&#163;"]
        ];
        if (empty($list)):
            $array = $array[$currency]['symbol'];
        endif;
        return $array;
    }

    public function StatesList($path = ""): array
    {
        $file_handler = new FileHandler();
        $json = $path . 'json/states-locals.json';
        $states = $file_handler->JsonReader($json);
        $states = json_decode(json_encode($states), true);
        return $states;
    }

    public function getStateSelect($selected = ""): string
    {
        $result = "";
        $states = $this->StatesList();
        if (!empty($states)) {
            foreach ($states as $row):
                $result .= DataHandlers::DropDownOptions($row['state'], $row['state'], $selected);
            endforeach;
        }
        return $result;
    }

    public function getStateLocalsSelect($state = "", $selected = ""): string
    {
        $result = '<option value=""> -- Select --</option>';
        $states = $this->StatesList();
        if (!empty($states)) {
            foreach ($states as $row) {
                if ($row['state'] === $state) {
                    foreach ($row['lgas'] as $lgas) {
                        $result .= DataHandlers::DropDownOptions($lgas, $lgas, $selected);
                    }
                }
            }
        }
        return $result;
    }

    public function getWardsSelect($params = [], $selected = ""): void
    {
        $records = new ProcManagerManagerService();
        $wards = $records->getWard($params);
        echo '<option>-- Select --</option>';
        DataHandlers::DropDownList($wards, 'code', 'name', $selected);
    }

    public function getURL($uri = 1): string
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $link = "https";
        else
            $link = "http";
        $link .= "://";
        $link .= $_SERVER['HTTP_HOST'];
        if (!empty($uri)) $link .= $_SERVER['REQUEST_URI'];
        return $link;
    }

    public function ExpiryStatus(): array
    {
        return [
            '30' => '1 Month',
            '60' => '2 Months',
            '90' => '3 Months',
        ];
    }

    public function doDataTable(): array
    {

        return [
            'styles' => [
                $this->base_url . 'assets/vendor/datatable/DataTables-1.10.18/css/dataTables.bootstrap4.min.css',
                $this->base_url . 'assets/vendor/datatable/Buttons-1.5.2/css/buttons.bootstrap4.min.css',
                $this->base_url . 'assets/vendor/datatable/Responsive-2.2.2/css/responsive.bootstrap4.min.css',
            ],
            'scripts' => [
                $this->base_url . 'assets/vendor/datatable/DataTables-1.10.18/js/jquery.dataTables.min.js',
                $this->base_url . 'assets/vendor/datatable/DataTables-1.10.18/js/dataTables.bootstrap4.min.js',
                $this->base_url . 'assets/vendor/datatable/Buttons-1.5.2/js/dataTables.buttons.min.js',
                $this->base_url . 'assets/vendor/datatable/Buttons-1.5.2/js/buttons.bootstrap4.min.js',
                $this->base_url . 'assets/vendor/datatable/Buttons-1.5.2/js/buttons.flash.min.js',
                $this->base_url . 'assets/vendor/datatable/Buttons-1.5.2/js/buttons.html5.min.js',
                $this->base_url . 'assets/vendor/datatable/Buttons-1.5.2/js/buttons.print.min.js',
                $this->base_url . 'assets/vendor/datatable/Responsive-2.2.2/js/dataTables.responsive.min.js',
                $this->base_url . 'assets/vendor/datatable/Responsive-2.2.2/js/responsive.bootstrap4.min.js',
                $this->base_url . 'assets/vendor/datatable/pdfmake-0.1.36/pdfmake.min.js',
                $this->base_url . 'assets/vendor/datatable/pdfmake-0.1.36/vfs_fonts.js',

            ],
        ];
    }

    public function getAppPricing($select = ""): array
    {
        $plans = [
            "BAS" => [
                'name' => 'Basic',
                'price' => 200,
                'features' => [
                    'User Management',
                    'Inventory Management',
                    'Sales Management',
                ]
            ],
            "STA" => [
                'name' => 'Standard',
                'duration' => 3,
                'price' => 250,
                'features' => [
                    'User Management',
                    'Inventory Management',
                    'Sales Management',
                    'Customer Management',
                ]
            ],
            "PRO" => [
                'name' => 'Professional',
                'duration' => 6,
                'price' => 300,
                'features' => [
                    'User Management',
                    'Inventory Management',
                    'Sales Management',
                    'Customer Management',
                    'Supplier Management',
                ]
            ],
            "ENT" => [
                'name' => 'Enterprise',
                'duration' => 12,
                'price' => 500,
                'features' => [
                    'User Management',
                    'Inventory Management',
                    'Sales Management',
                    'Customer Management',
                    'Supplier Management',
                    'Location Management',
                    'Expenses Management',
                ]
            ],
        ];
        $response = $plans;
        if (!empty($select)) {
            $response = $plans[$select];
        }
        return $response;
    }

    public function getAppDuration($duration = "")
    {
        $durations = [
            1 => '1 - Day',
            2 => '2 - Days',
            3 => '3 - Days',
            4 => '4 - Days',
            5 => '5 - Days',
            6 => '6 - Days',
            7 => '1 - Week',
            14 => '2 - Weeks',
            21 => '3 - Weeks',
            30 => '1 - Month',
            90 => '3 - Months',
            180 => '6 - Months',
            367 => '1 - Year',
            734 => '2 - Years',
        ];
        $response = $durations;
        if (!empty($duration)) {
            $response = $durations[$duration];
        }
        return $response;
    }

    public function alert($params = []): void
    {
        if (!empty($params)) {
            extract($params);
            $append_link = "";
            if (!empty($_GET)):
                $append_link = '?';
                foreach ($_GET as $key => $value):
                    $append_link .= $key . '=' . $value . '&';
                endforeach;
                $append_link = rtrim($append_link, '&');
            endif;
            die('
                    <div class="mb-3">
                    <div class="text-center py-2">
                        <div>' . $icon . '</div>
                            <h5 class="text-muted">' . $title . '</h5>
                            <p class="text-dark mb-3" style="font-size: 1rem">' . $message . ' </p>
                            <button onclick="confirm_alert(\'' . $link . $append_link . '\')" class="btn btn-primary confirm-button w-50"><span>' . $button . '</span>
                            <i class="ri-arrow-right-circle-line ri ri-ml icon ml-2"></i></button>
                        </div>
                    </div> <div id="alert-response"></div>
                ');
        }
    }

    public function isLocal()
    {
        return !checkdnsrr($_SERVER['SERVER_NAME'], 'NS');
    }

    private function checkInternet($url): array
    {
        $url = parse_url($url);
        $response = [
            'success' => 0,
            'message' => 'Internal server error, try again!'
        ];
        if (@$url['scheme'] !== 'http' && @$url['scheme'] !== 'https') {
            $response['message'] = 'Only HTTP request are supported!';
        } else {
            $host = $url['host'];
            @$fp = fsockopen($host, 80);
            if (!$fp) {
                $response['message'] = 'Check your connection and try again';
            } else {
                $response = [
                    'success' => 1,
                    'message' => 'Remote connection available'
                ];
            }
        }
        return $response;
    }

    public function curlRequest($params = [])
    {
        if (empty($params)) {
            $response = [
                'success' => 0,
                'message' => 'Request is missing arguments, try again!'
            ];
        } else {
            $resp = $this->checkInternet($params['url']);
            if (empty($resp['success'])) {
                $response = [
                    'success' => 0,
                    'message' => $resp['message']
                ];
            } else {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $params['url'],
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => $params['action'],
                    CURLOPT_HTTPHEADER => array(
//                "Authorization: Bearer " . $this->secret_key . "",
//                "Cache-Control: no-cache",
                    ),
                ));
                if ($params['action'] === "POST") {
                    $fields_string = http_build_query($params['fields']);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
                }
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                if ($err) {
                    $response = [
                        'success' => 0,
                        'message' => 'Error: could not connect to server ' . $err
                    ];
                } else {
                    $response = [
                        'success' => 1,
                        'message' => 'Request successful',
                        'data' => $response
                    ];
                }
            }
        }
        return $response;
    }

    public function replace($path): void
    {
        die('<script>location.replace("' . $path . '")</script>');
    }

    public function reload(): void
    {
        die('<script>location.reload()</script>');
    }
}