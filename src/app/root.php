<?php
namespace epii\admin\center\app;

use epii\admin\center\ProjectConfig;
use epii\app\controller;
use epii\server\Tools;
use epii\template\engine\EpiiViewEngine;
use epii\ui\login\AdminLogin;
 
use wangshouwei\session\Session;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:04 AM
 */
class root extends controller
{
    public function home()
    {
        $engin = new EpiiViewEngine();
        $engin->init(["tpl_dir" => __DIR__ . "/../view/", "cache_dir" => Tools::getVendorDir()  . "/../runtime/cache/view/"]);
        $this->setViewEngine($engin);
        $this->adminUiDisplay("start/home");
    }
    public function login(){//此函数可以自定义，实现完全自主的登录方式
        if (!Session::get("is_login"))
            AdminLogin::login(ProjectConfig::getLoginPageConfig());
    }

    public function start()
    {
        if (!install::isInstall())
        {
            $install = new install();
            $install->init();
            $install->index();
            exit;
        }

        if (!Session::get("is_login"))
           $this->login();
        else
            $this->adminUiBaseDisplay(ProjectConfig::getAdminUiConfig());

    }

}