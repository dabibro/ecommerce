<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 23/08/2024
 * Time: 09:07 PM
 */

namespace App\Infrastructure;


abstract class AppConst
{
    public static function printerSize(): array
    {
        return [
            'thermal-80' => '80mm Paper',
            'thermal-58' => '58mm Paper',
            'A4' => 'A4 Paper',
            'A5' => 'A5 Paper',
        ];
    }

    public static function returnSales(): array
    {
        return [
            'Returned' => 'Returned',
            'Damaged' => 'Damaged'
        ];

    }

    public static function saleStatus(): array
    {
        return [
            'paid' => 'Paid',
            'unpaid' => 'Unpaid',
            'credit' => 'Credit',
            'return' => 'Return',
        ];

    }

    public static function paymentTypes(): array
    {
        return [
            'Payment',
            'Added Value',
        ];

    }

    public static function customerType($param = "")
    {
        $array = [
            "Unregistered" => "Walk-In-Customer",
            "Registered" => "Registered Customer",
            "Loan Applicant" => "Loan Applicant"
        ];
        $response = $array;
        if (!empty($param)):
            $response = $array[$param];
        endif;
        return $response;
    }

    public static function paymentChannel(): array
    {
        return [
            0 => [
                'name' => 'Cash',
                'type' => 'local',
                'status' => 1
            ],
            2 => [
                'name' => 'POS',
                'type' => 'local',
                'status' => 1
            ],
            3 => [
                'name' => 'Transfer',
                'type' => 'local',
                'status' => 1
            ],
//            4 => [
//                'name' => 'Wallet',
//                'type' => 'local',
//                'status' => 1
//            ]
        ];
    }

    public static function mixPayment($varParam): string
    {
        $pay = "";
        $varParam = json_decode(htmlspecialchars_decode($varParam), true);
        if (!empty($varParam)):
            foreach ($varParam as $key => $amt):
                if (!empty($amt)) $pay .= (trim($key)) . '=' . number_format($amt, 2) . ', ';
            endforeach;
        endif;
        return rtrim($pay, ', ');
    }

    public static function randomColorFactor(): string
    {
        return round(ceil(rand(000, 255)));
    }

    public static function randomColor($opacity): string
    {
        $colors = 'rgba(' . self::randomColorFactor() . ',' . self::randomColorFactor() . ',' . self::randomColorFactor() . ',' . ($opacity || '.3') . ')';
        return $colors;
    }

    public static function greeting(): string
    {
        $b = time();
        $hour = date("g", $b);
        $m = date("A", $b);
        $response = "";
        if ($m === "AM") {
            if ($hour === 12) {
                $response = "Good Evening!";
            } elseif ($hour < 4) {
                $response = "Good Evening!";
            } elseif ($hour > 3) {
                $response = "Good Morning!";
            }
        } elseif ($m === "PM") {
            if ($hour === 12) {
                $response = "Good Afternoon!";
            } elseif ($hour < 6) {
                $response = "Good Afternoon!";
            } elseif ($hour > 5) {
                $response = "Good Evening!";
            }
        }
        return $response;
    }

    public static function Gender(): array
    {

        $resp =
            [
                [
                    "label" => "Male",
                    "value" => "male",
                ],
                [
                    "label" => "Female",
                    "value" => "female",
                ],

            ];
        return $resp;
    }

    public static function MaritalStatus(): array
    {

        $resp =
            [
                [
                    "label" => "Single",
                    "value" => "single",
                ],
                [
                    "label" => "Married",
                    "value" => "married",
                ],

            ];
        return $resp;
    }

    public static function RecordGroup($key = '')
    {
        $array = [
            'AGT' => 'Agent',
            'FRM' => 'Farmer',
            'SEC' => 'Secretary'
        ];
        if (!empty($key)) {
            return $array[$key];
        }
        return $array;
    }

    public static function employmentType(): array
    {

        $resp =
            [
                [
                    "label" => "Full Time",
                    "value" => "fulltime",
                ],
                [
                    "label" => "Contract",
                    "value" => "contract",
                ],

            ];
        return $resp;
    }

    public static function Nationality(): array
    {

        $resp =
            [
                [
                    "label" => "Nigeria",
                    "value" => "Nigeria",
                ],

            ];
        return $resp;
    }

    public static function AccountTypes($type = "", $name = 0)
    {
        $response = [];
        $types = [
            1 => [
                'code' => '1',
                'description' => 'Administrator'
            ],
            2 => [
                "code" => '2',
                'description' => 'Standard',
            ],
            3 => [
                "code" => '3',
                'description' => 'Secretary',
            ],
            4 => [
                "code" => '4',
                'description' => 'Agent',
            ]
        ];
        if (empty($type)) {
            $response = $types;
        } else {
            if (!empty($name)) {
                if (isset($types[$type])) $response = $types[$type]['description'];
            } else {
                $response = $types[$type];
            }

        }
        return $response;
    }

    public static function LoanType($param = "")
    {
        $array = [
            "Items Request",
//            "Funds Request",
//            "Both Funds/Items"
        ];
        $response = $array;
        if (!empty($param)):
            $response = $array[$param];
        endif;
        return $response;
    }

    public static function LoanPaySchedule(): array
    {
        return [
            "Daily", "Weekly", "Monthly"
        ];
    }

    public static function PurchaseType($param = "")
    {
        $array = [
            'Standard', 'Service', 'Combine'
        ];
        $response = $array;
        if (!empty($param)):
            $response = $array[$param];
        endif;
        return $response;
    }

    public static function PurchaseRemark($param = "")
    {
        $array = [
            'Received', 'Not received yet'
        ];
        $response = $array;
        if (!empty($param)):
            $response = $array[$param];
        endif;
        return $response;
    }

    public static function SupplierType($param = "")
    {
        $array = [
            'Registered', 'Unregistered'
        ];
        $response = $array;
        if (!empty($param)):
            $response = $array[$param];
        endif;
        return $response;
    }

    public static function RecordStatus($param = "")
    {
        $array = [
            "pending" => "Pending", "submitted" => "Submitted", "approved" => "Approved"
        ];
        $response = $array;
        if (!empty($param)):
            $response = $array[$param];
        endif;
        return $response;
    }

}