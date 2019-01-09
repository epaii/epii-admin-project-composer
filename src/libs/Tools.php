<?php

namespace epii\admin\center\libs;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:20 AM
 */
class Tools
{
    public static function get_current_url()
    {
        $current_url = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $current_url = 'https://';
        }
        if ($_SERVER['SERVER_PORT'] != '80') {
            $current_url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        } else {
            $current_url .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }
        return $current_url;
    }
}