<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/11
 * Time: 9:11 AM
 */

namespace epii\admin\center\app;


use epii\admin\center\admin_center_controller;
use epii\admin\center\config\Rbac;
use epii\admin\center\config\Settings;
use epii\tools\classes\ClassTools;

class test extends admin_center_controller
{
        public function index()
        {
          //  var_dump(Settings::_saveCache());
          var_dump(Rbac::_saveCache());
//
//            $all_roles = ClassTools::get_all_classes_and_methods(["epii\\admin\\center\\app"]);
//
//            foreach ($all_roles as $class => $ms) {
//                foreach ($ms as $metod) {
//                    $roles["info"][$class . "@" . $metod] = [];
//                }
//            }
//            print_r($all_roles);
        }
}