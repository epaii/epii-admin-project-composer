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

<<<<<<< HEAD
=======

>>>>>>> 8f758e3fd37236a4d1e09fd263225327f951ddb8
    public function init()
    {

        $engin = new EpiiViewEngine();
        $engin->init(["tpl_dir" => __DIR__ . "/../view/", "cache_dir" => __DIR__ . "/../runtime/cache/view/"]);
        $this->setViewEngine($engin);
        parent::init();
    }
}