<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/10
 * Time: 1:54 PM
 */

namespace epii\admin\center;


use epii\admin\center\app\root;
use epii\admin\center\config\Rbac;
use epii\admin\center\libs\Tools;
use epii\app\controller;


use epii\server\Args;
use wangshouwei\session\Session;

class admin_center_controller extends controller
{
    public function init()
    {
        if (Args::getVal("_show_runner"))
        {
            echo get_class(\epii\server\App::getInstance()->getRunner()[0])."@".\epii\server\App::getInstance()->getRunner()[1];
            exit;
        }
        $is_login = false;
        if ( (!Session::get("is_login")  || Session::get("is_login") =="null") &&  ( !( $is_login = get_class(\epii\server\App::getInstance()->getRunner()[0]) ===root::class && \epii\server\App::getInstance()->getRunner()[1]==="start" ) ) ) {
            header("location:" . Tools::get_web_root());
        }

        if (!$is_login && !Session::get("admin_gid"))
        {
            echo "who you are? and which your group join in?";
            exit;
        }

        if ( !$is_login &&  (Session::get("admin_gid") !=1 ) && !Rbac::check(Session::get("admin_gid"),get_class(\epii\server\App::getInstance()->getRunner()[0])."@".\epii\server\App::getInstance()->getRunner()[1]))
        {
            echo "Permission denied;";
            exit;
        }


    }
}