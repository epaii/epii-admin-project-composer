<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:57 AM
 */

namespace epii\admin\center\config;


use epii\server\i\IRun;
use epii\template\engine\EpiiViewEngine;
use wangshouwei\session\Session;

class AdminCenterCommonInit implements IRun
{

    public function run()
    {
        // TODO: Implement run() method.

        EpiiViewEngine::addParser("url",function($args){

            return "?app=".$args[0]."@".$args[1]."&".(isset($args[2])?$args[2]:"");
        });

        Session::start();
    }
}