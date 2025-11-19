<?php

namespace App\Infrastructure;

class StringHelper
{
    /**
     * Convert string to uppercase
     */
    public static function upper(string $str): string
    {
        return mb_strtoupper($str); // supports UTF-8
    }

    /**
     * Convert string to lowercase
     */
    public static function lower(string $str): string
    {
        return mb_strtolower($str);
    }

    /**
     * Trim whitespace (both sides)
     */
    public static function trim(string $str): string
    {
        return trim($str);
    }

    /**
     * Trim left only
     */
    public static function ltrim(string $str): string
    {
        return ltrim($str);
    }

    /**
     * Trim right only
     */
    public static function rtrim(string $str): string
    {
        return rtrim($str);
    }

    /**
     * Capitalize first letter
     */
    public static function capitalize(string $str): string
    {
        return ucfirst(mb_strtolower($str));
    }

    /**
     * Reverse string
     */
    public static function reverse(string $str): string
    {
        return strrev($str);
    }

    public static function sanitize_text_field($str): string
    {
        $str = strip_tags($str);          // remove HTML tags
        $str = htmlspecialchars($str);    // escape special chars
        $str = trim($str);                // remove leading/trailing spaces
        return $str;
    }

    public static function sanitize_email($email)
    {
        $email = trim($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return $email;
    }

    public static function sanitize_phone_number($phone): string
    {
        // Remove all characters except digits, +, - and spaces
        $phone = preg_replace('/[^0-9+\-\s]/', '', $phone);

        // Trim leading/trailing spaces
        $phone = trim($phone);

        return $phone;
    }
    public static function is_email($email): bool
    {
        // Trim whitespace
        $email = trim($email);

        // Use PHP built-in filter
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}