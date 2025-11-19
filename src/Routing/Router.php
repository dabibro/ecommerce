<?php
/**
 * Created by PhpStorm.
 * User: Dauda Ibrahim
 * Date: 15/10/2023
 * Time: 12:44 PM
 */

namespace App\Routing;


use Dotenv\Dotenv;

class Router
{
    public static function get($route, $callback): void
    {
        $route = self::prepend_base($route);
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function post($route, $callback): void
    {
        $route = self::prepend_base($route);
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function on($regex, $cb): void
    {
        $params = $_SERVER['REQUEST_URI'];
        $explode = explode('?', $params);
        if ($explode) {
            $params = $explode[0];
        }
        $params = (!str_starts_with($params, "/")) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            // first value is normally the route, lets remove it
            array_shift($matches);
            // Get the matches as parameters
            $params = array_map(static function ($param) {
                return $param[0];
            }, $matches);
            $cb(new Request($params), new Response());
        }
    }

    protected static function prepend_base($route): string
    {
        if (!empty(BASE_PATH) && $route !== "/") {
            $route = BASE_PATH . $route;
        }
        return $route;
    }
}