<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/12
 * Time: 10:01 AM
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\admin\center\libs\Tools;
use epii\admin\ui\lib\epiiadmin\jscmd\Alert;
use epii\admin\ui\lib\epiiadmin\jscmd\JsCmd;
use epii\server\Args;

class install extends _controller
{

    private static $is_install = null;

    public function init()
    {
        if (self::isInstall() !== false) {
            header("location:" . Tools::get_web_root());
            exit;
        }
        parent::init(); // TODO: Change the autogenerated stub
    }


    public function index()
    {

        $this->adminUiDisplay("install/index", "安装程序");
    }

    public function config()
    {

        $is_has = Args::params("is_has/d",0);
        if ($_POST) {
            $config_dir = Tools::getVendorDir() . "/../config";
            \epii\server\Tools::mkdir($config_dir);
            if (!is_dir($config_dir)) {
                return JsCmd::make()->addCmd(Alert::make()->msg("请确保有创建文件夹" . $config_dir . "的权限")->onOk(null))->run();
            }

            if (!@file_put_contents($config_file = $config_dir . "/db.conf.php", 1)) {
                return JsCmd::alert("没有权限写文件" . $config_file);
            }
            @unlink($config_file);


            $config = $_POST;
            $link = mysqli_connect($config["hostname"], $config["username"], $config["password"], '', $config["hostport"]);

            if (!$link) {
                return JsCmd::alert("数据库设置错误，检查账号或密码是否正确");

            }


            $db_has = mysqli_query($link, "use " . $config["database"]);
            if (!$db_has) {
                return JsCmd::alert("数据库不存在");
            }

            if($is_has == 1){
                unset($config["is_has"]);
                $config["type"] = "mysql";
                if(file_put_contents(Tools::getVendorDir() . "/../config/db.conf.php", "<?php return  " . var_export($config, true) . " ;")){
                    return JsCmd::alertCloseRefresh("绑定成功");
                }
            }

            $sql = file_get_contents(__DIR__ . "/../config/install.sql");

            $sql = str_replace("`epii_", "`" . $config["prefix"], $sql);

            $_arr = explode(';', $sql);
            mysqli_query($link, "SET AUTOCOMMIT=0");
            mysqli_begin_transaction($link);
            foreach ($_arr as $_value) {
                if ($_value = trim($_value)) {
                    $query_info = mysqli_query($link, $_value);


                    if ($query_info === false) {

                        mysqli_query($link, "ROLLBACK");      // 判断执行失败时回滚
                        return JsCmd::alert("安装失败，请重试,mysql:" . mysqli_errno($link));
                    }
                }

            }

            $query_info = mysqli_query($link, "update `" . $config["prefix"] . "admin` set username='" . $config["admin_username"] . "', password='" . md5($config["admin_password"]) . "'  where id=1");


            if ($query_info === false) {
                mysqli_query($link, "ROLLBACK");      // 判断执行失败时回滚
                return JsCmd::make()->addCmd(Alert::make()->msg("安装失败,默认账号密码失败！"))->run();
            }


            unset($config["admin_username"]);
            unset($config["admin_password"]);
            $config["type"] = "mysql";
            if(file_put_contents(Tools::getVendorDir() . "/../config/db.conf.php", "<?php return  " . var_export($config, true) . " ;"))
            {
                mysqli_commit($link);
                mysqli_close($link);
                return JsCmd::alertCloseRefresh("安装成功");
            }else{
                mysqli_query($link, "ROLLBACK");
                mysqli_close($link);
                return JsCmd::alert("安装失败");
            }

        } else {
            $this->_as_is_has = $is_has;
            $this->adminUiDisplay("install/config", "安装程序");
        }

    }


    public static function isInstall()
    {
        if (self::$is_install === null) {
            if (file_exists(Tools::getVendorDir() . "/../config/db.conf.php")) {
                self::$is_install = true;
            } else {
                self::$is_install = false;
            }
        }
        return self::$is_install;

    }

}

 