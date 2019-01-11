<?php

namespace epii\admin\center\libs;

use Closure;

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
        return self::get_web_root() . $_SERVER['REQUEST_URI'];
    }

    public static function get_web_root()
    {

        $current_url = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $current_url = 'https://';
        }
        if ($_SERVER['SERVER_PORT'] != '80') {
            $current_url .= $_SERVER['HTTP_HOST'] . ':' . $_SERVER['SERVER_PORT'];
        } else {
            $current_url .= $_SERVER['HTTP_HOST'];
        }


        return $current_url . (substr($_SERVER["SCRIPT_NAME"], 0, strrpos($_SERVER["SCRIPT_NAME"], "/")));
    }


    public static function getEnableNameSpacePre()
    {
        $name_pre =  Tools::getObjectAttr(App::getInstance(), "name_space_pre", App::class);
        $app_need = true;
        foreach ($name_pre as $value) {
            if (stripos($value, "app\\") === 0) {
                $app_need = false;
                break;
            }
        }
        if ($app_need) {
            $name_pre[] = "app";
        }
        return $name_pre;
    }

    public static function getObjectAttr($object, $name ,$newscop=null)
    {
        var_dump($newscop);
        $tmp = Closure::bind(function () use ($name) {
            return $this->{$name};
        }, $object, $newscop?$newscop:get_class($object));


        return $tmp();
    }
}