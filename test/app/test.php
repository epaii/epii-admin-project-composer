<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/2/14
 * Time: 3:08 PM
 */

namespace app;

use epii\admin\center\admin_center_controller;
use epii\app\controller;

class test  extends controller
{
    public function index()
    {


            $this->adminUiDisplay("index/test");
    }
}