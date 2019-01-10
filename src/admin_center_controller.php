<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/10
 * Time: 1:54 PM
 */

namespace epii\admin\center;


use epii\admin\center\libs\Tools;
use epii\app\controller;
use wangshouwei\session\Session;

class admin_center_controller extends controller
{
    public function init()
    {
        if (!Session::get("is_login")) {
            header("location:" . Tools::get_web_root());
        }

    }
}