<?php

namespace epii\admin\center\libs;

use epii\orm\Db;
use epii\server\App;
use epii\server\Args;
use epii\server\i\IRun;
use epii\server\Response;

class AddonsManager implements IRun
{

    private static $__addones_dir = null;
    private static $__addones_configs = [];
    public static function getAddonsDir()
    {
        if (self::$__addones_dir === null) {
            return Tools::getVendorDir() . "/../addons";
        }
        return self::$__addones_dir;
    }
    public static function getAllAddons()
    {
        $dir = self::getAddonsDir();
        $file_arr = scandir($dir);
       
        foreach ($file_arr as $item) {
            if ($item != ".." && $item != ".") {
                if (is_dir($dir . "/" . $item)) {
                    self::getAddonsConfig($item);
                }
            }
        }
        return array_filter(self::$__addones_configs);
    }
    public static function setAddonsDir($dir)
    {
        self::$__addones_dir = rtrim($dir, DIRECTORY_SEPARATOR);
    }
    public static function getCurrentAddonsName()
    {
        return Args::params("__addons", null);
    }
    public static function getCurrentAddonsConfig()
    {
        $addonsname = self::getCurrentAddonsName();
        if ($addonsname) {
            return self::getAddonsConfig($addonsname);
        }
        return null;
    }

    public static function getAddonsConfig($addons_name)
    {
        if (isset(self::$__addones_configs[$addons_name])) {
            return self::$__addones_configs[$addons_name];
        }
        $path = self::getAddonsDir() . DIRECTORY_SEPARATOR . $addons_name . DIRECTORY_SEPARATOR . "app.json";
        $load_file = self::getAddonsDir() . DIRECTORY_SEPARATOR . $addons_name . DIRECTORY_SEPARATOR . "vendor/autoload.php";
        if (!file_exists($path)) {
            return self::$__addones_configs[$addons_name] = null;
        }
        if (!file_exists($load_file)) {
            return self::$__addones_configs[$addons_name] = null;
        }
        $config =  json_decode(file_get_contents($path), true);
        if (!$config) return self::$__addones_configs[$addons_name] = null;
        $config["autoload_file"] = $load_file;
        $config["name"] = $addons_name;
        $config["subject"] =  $config["subject"] ? $config["subject"] : "";
        if (isset($config["base_name_space"])) {
            if (!is_array($config["base_name_space"])) {
                $config["base_name_space"] = [$config["base_name_space"]];
            }
        }
        $config["__path_dir"] = self::getAddonsDir() . DIRECTORY_SEPARATOR . $addons_name;
        if (Db::getConfig("hostname")) {
            $installinfo = Db::name("addons")->where("name", $addons_name)->find();
            $config["install"] =  $installinfo  && ($installinfo["install"]);
            $config["status"] =  $installinfo ? $installinfo["status"] : "0";
            $config["__data"] = $installinfo;
        }

        return self::$__addones_configs[$addons_name] = $config;
    }
    public static function error($msg)
    {
        Response::error($msg);
    }


    public   static function onRequest()
    {
        $addonsname = self::getCurrentAddonsName();
        if ($addonsname) {
            $config = self::getAddonsConfig($addonsname, false);

            if (!$config) {
                self::error($addonsname . "不存在");
            }

            include_once $config["autoload_file"];
            $app = $config["app"];
            if (!class_exists($app)) {
                self::error($addonsname . "对应的app不存在");
            }
            foreach ($config["base_name_space"] as $class_pre) {
                App::getInstance()->setBaseNameSpace($class_pre);
            }
        }
    }


    public static function install($name)
    {
         return  Db::transaction(function () use ($name) {
            $config = self::getAddonsConfig($name);
            if (!$config) {

                return false;
            }

            include_once $config["autoload_file"];
            $app = $config["app"];
            if (!class_exists($app)) {

                return false;
            }

            $app_obj = new $app();
            if (!($app_obj instanceof AddonsApp)) {
                return false;
            }

            $id =  Db::name("addons")->insertGetId(["name" => $config["name"], "title" => $config["title"], "addtime" => 0, "status" => 0, "version" => $config["version"], "subject" => $config["subject"]]);
            if (!$id) return false;
            $app_obj->setConfig($id, $config);
            $ret =  $app_obj->install();
            if (!$ret) return false;
            $ret1 =  Db::name("addons")->where("id", $id)->update(["install" => 1, "status" => 1, "addtime" => time()]);
            if ($ret1) return true;
            return false;
        });
    }

    public   function run()
    {

        foreach (self::$__addones_configs as $key => $value) {
            if (!isset($value["__data"])) {
                $installinfo = Db::name("addons")->where("name", $key)->find();

                self::$__addones_configs[$key]["install"] =  $installinfo  && ($installinfo["install"]);
                self::$__addones_configs[$key]["status"] =  $installinfo ? $installinfo["status"] : "0";
                self::$__addones_configs[$key]["__data"] = $installinfo;
            }
        }

        $cinfo = self::getCurrentAddonsConfig();
        $is__addons_development = Args::params("__addons_development");
        if ($cinfo &&  (!$is__addons_development) && !$cinfo["install"]) {
            self::error("模块没有安装");
        }
        if ($cinfo &&  (!$is__addons_development) && !$cinfo["status"]) {
            self::error("模块已经关闭");
        }

        if ($cinfo && $cinfo["install"]) {
            if ($cinfo["__data"]["version"] != $cinfo["version"]) {
                $app_obj = new $cinfo["app"]();
                if (!($app_obj instanceof AddonsApp)) {
                    return false;
                }
                if ($app_obj->update($cinfo["version"], $cinfo["__data"]["version"])) {
                    Db::name("addons")->where("name", $cinfo["name"])->update(["version" => $cinfo["version"]]);
                } else {
                    self::error("模块更新失败");
                }
            }
        }
    }
}
