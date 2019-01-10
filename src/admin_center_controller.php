<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/10
 * Time: 1:54 PM
 */

namespace epii\admin\center;


use epii\admin\center\app\root;
use epii\admin\center\libs\Tools;
use epii\app\controller;
use epii\cli\Args;
use epii\server\App;
use wangshouwei\session\Session;

class admin_center_controller extends controller
{
    public function init()
    {
        if (Args::getVal("_show_runner"))
        {
            echo get_class(App::getInstance()->getRunner()[0])."@".App::getInstance()->getRunner()[1];
            exit;
        }
        if ( (!Session::get("is_login")) &&  ( !( get_class(App::getInstance()->getRunner()[0]) ===root::class && App::getInstance()->getRunner()[1]==="start" ) ) ) {
            header("location:" . Tools::get_web_root());
        }


    }
}