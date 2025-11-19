<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 15/10/2023
 * Time: 12:46 PM
 */

namespace App\Routing;


class Response
{
    private int $status = 200;

    public function status(int $code): Response
    {
        $this->status = $code;
        return $this;
    }

    /**
     * @throws \JsonException
     */
    public function toJSON($data = []): void
    {
        http_response_code($this->status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_THROW_ON_ERROR);
    }
}