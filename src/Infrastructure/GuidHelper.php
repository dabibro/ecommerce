<?php

namespace App\Infrastructure;

class GuidHelper
{
    /**
     * Generate a version 4 (random) GUID
     */
    public static function long(): string
    {
        // Generate 16 bytes (128 bits) of random data
        $data = random_bytes(16);

        // Set version to 0100 (UUID v4)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);

        // Set bits 6-7 to 10 (variant RFC 4122)
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Convert to UUID string format
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Generate a short unique ID (base62)
     */
    public static function short(): string
    {
        return str_replace(['.', '/'], '', base64_encode(random_bytes(9)));
    }

    /**
     * Check if a string is a valid GUID
     */
    public static function isValid(string $guid): bool
    {
        return preg_match(
                '/^\{?[A-Fa-f0-9]{8}\-[A-Fa-f0-9]{4}\-[1-5][A-Fa-f0-9]{3}\-[89ABab][A-Fa-f0-9]{3}\-[A-Fa-f0-9]{12}\}?$/',
                $guid
            ) === 1;
    }
}