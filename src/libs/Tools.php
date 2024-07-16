<?php

namespace epii\admin\center\libs;

use epii\orm\Db;
use epii\server\App;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:20 AM
 */
class Tools
{
    private static $link = null;
    public static function get_current_url()
    {
        return self::get_web_http_domain() . $_SERVER['REQUEST_URI'];
    }

    public static function get_web_root()
    {

        if (!isset($_SERVER['REQUEST_URI'])) return "";
            $uri =  $_SERVER["REQUEST_URI"];


        if (isset($_SERVER["SCRIPT_NAME"])) {
            $file_name = $_SERVER["SCRIPT_NAME"];

            $uri_pre = substr($file_name, 0, strrpos($file_name, "/"));

            if (($find = stripos($uri, $file_name)) !== false) {
                $uri = substr($uri, 0, $find + 1);
            } else {
                $uri = "";
            }
            $uri = $uri_pre . $uri;
        }

        $tmp = parse_url("http://www.ba.ldi/" . $uri)["path"];

        if (strripos($tmp, "/") != (strlen($tmp) - 1)) {
            $tmp = pathinfo($tmp, PATHINFO_DIRNAME);
        }


        $uri = implode("/", array_filter(explode("/", $tmp)));
        $uri = ltrim($uri, "/");

        return rtrim(self::get_web_http_domain() . "/" . $uri, "/") . "/";
    }

    public static function get_web_http_domain()
    {
        $current_url = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $current_url = 'https://';
        }
        $http = explode(":", $_SERVER['HTTP_HOST']);
        $_SERVER['HTTP_HOST'] = $http[0];

        if (!isset($_SERVER['SERVER_PORT'])) {
            $_SERVER['SERVER_PORT'] = isset($http[1]) ? $http[1] : "80";
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
        
        $name_pre = App::getInstance()->getBaseNameSpace(); //  Tools::getObjectAttr(App::getInstance(), "name_space_pre", App::class);
        $addons =  AddonsScan::getAllAddons();
        if($addons){
            foreach ($addons as $key => $value) {
               
                AddonsManager::loadAddons($value["name"] );
                $name_pre = array_merge($name_pre,$value["base_name_space"]);
            }
        }
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

    // public static function getObjectAttr($object, $name, $newscop = null)
    // {
    //     $tmp = Closure::bind(function () use ($name) {
    //        return $this->{$name};
    //     }, $object, $newscop ? $newscop : get_class($object));

    //     return $tmp();
    // }

    private static $vendor_dir = null;

    public static function getVendorDir()
    {

        if (self::$vendor_dir !== null) {
            return self::$vendor_dir;
        }

        $files = get_required_files();
        if ($files) {
            foreach ($files as $file) {

                if (substr($file, $pos = -strlen($find = "composer" . DIRECTORY_SEPARATOR . "ClassLoader.php")) == $find) {
                    return self::$vendor_dir = substr($file, 0, $pos - 1);
                }
            }
        }
        return self::$vendor_dir = "";
    }

    public static function execSqlFile($file, $replace_prefix = ""): bool
    {
        $sql = file_get_contents($file);
        if (self::$link===null) {

           
            $config = Db::getConfig();
            self::$link = mysqli_connect($config["hostname"], $config["username"], $config["password"], '', $config["hostport"]);
            if(!self::$link) return false;
            $db_has = mysqli_query(self::$link, "use " . $config["database"]);
            if (!$db_has) {
                return false;
            }
        }
       
  
        if ($replace_prefix) {
            $sql = str_replace("`" . $replace_prefix, "`" . Db::getConfig("prefix"), $sql);
        }

        $_arr = explode(';', $sql);
        mysqli_query(self::$link, "SET AUTOCOMMIT=0");
        mysqli_begin_transaction(self::$link);
        foreach ($_arr as $_value) {
            if ($_value = trim($_value)) {
                $query_info = mysqli_query(self::$link, $_value);

                if ($query_info === false) {
                    mysqli_query(self::$link, "ROLLBACK");
                    return false;
                }
            }

        }
        mysqli_query(self::$link, "COMMIT");
        return true;
    }

}
