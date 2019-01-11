<?php

namespace epii\admin\center\common;

use epii\admin\center\admin_center_controller;

use epii\template\engine\EpiiViewEngine;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:51 AM
 */
class _controller extends admin_center_controller
{


    public function init()
    {

        $engin = new EpiiViewEngine();
        $engin->init(["tpl_dir" => __DIR__ . "/../view/", "cache_dir" => __DIR__ . "/../runtime/cache/view/"]);
        $this->setViewEngine($engin);
        parent::init();
    }

    //密码加密
    protected function password_md5($password)
    {
        $pwd = 'E3QihGxs1hPPXH2aMKr^keaFm5F8X#bXX03q1fKli7vicXM&&t4u94RVO@oneoeEcmrvk1EECyLZh83gRaS#VXH9nXfH&Pg0IsI';
        return md5(md5($password) . $pwd);
    }
}