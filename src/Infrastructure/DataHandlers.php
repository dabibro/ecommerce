<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 11/10/2023
 * Time: 09:39 PM
 */

namespace App\Infrastructure;

use DateTime;
use Random\RandomException;

abstract class DataHandlers
{
    protected $DropDownList;
    protected $DropDownSelect;

    static function convertObj(array $data)
    {
        return json_decode(json_encode($data));
    }

    static function verify_input($data)
    {
        @$data = trim($data);
        @$data = stripslashes($data);
        @$data = htmlspecialchars($data);
        @$data = self::escape_string($data);
        return $data;
    }

    static function escape_string($value)
    {
        $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
        $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $value);
    }

    /**
     * @throws RandomException
     */
    static function generate_random_string($strength = 6, $patter = ''): string
    {
        if ($patter !== '') {
            $input = $patter;
        } else {
            $input = '0123456789#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $input_length = strlen($input);
        $random_string = '';
        for ($i = 0; $i < $strength; $i++) {
            $random_character = $input[random_int(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    public static function DropDownList($array, $key = "", $label = "", $selected = ""): void
    {
        if (!empty($array)) {
            foreach ($array as $list) {
                if (is_array($list)) {
                    echo self::DropDownOptions($list[$key], $list[$label], $selected);
                } else {
                    echo self::DropDownOptions($list, $list, $selected);
                }
            }
        }


    }

    public static function DropDownOptions($key, $label = "", $selected = ""): string
    {
        $DropDownSelect = "";
        $result = "";
        if (!empty($key)) {
            if (!empty($label)) {
                if (!empty($selected) && $selected === $key) {
                    $DropDownSelect = " selected";
                }
                $result = "<option value='" . $key . "' " . $DropDownSelect . ">" . $label . "</option>";
            } else {
                if ($selected === $key) {
                    $DropDownSelect = " selected";
                }
                $result = "<option value='" . $key . "' " . $DropDownSelect . " >" . $key . "</option>";
            }
        }
        return $result;
    }

    static function formatDate($date = "", $time = FALSE)
    {
        if ($date != "") {
            $dateTime = new DateTime($date);
        } else {
            $dateTime = new DateTime("now");
        }
        if ($time === TRUE):
            $date = $dateTime->format('d/m/Y h:i:s A');
        else:
            $date = $dateTime->format('d/m/Y');
        endif;
        return $date;

    }

    public static function DateDiff($from, $to)
    {
        $date1 = new DateTime($from);
        $date2 = new DateTime($to);
        $interval = $date1->diff($date2);
        return $interval->days;

    }

    public static function GUID()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public static function valueSign($value): string
    {
        if ($value < 0) {
            return '(' . str_replace('-', '', $value) . ')';
        }
        return $value;
    }

    public static function WrapText($dilemma, $separator, $content): string
    {
        return preg_replace('/' . $dilemma . '\\s*/', "," . $separator . "", $content);
    }

}