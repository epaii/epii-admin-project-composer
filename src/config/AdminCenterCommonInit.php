<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:57 AM
 */

namespace epii\admin\center\config;


use epii\server\i\IRun;
use wangshouwei\session\Session;

class AdminCenterCommonInit implements IRun
{

    public function run()
    {
        // TODO: Implement run() method.

        Session::start();
    }
}