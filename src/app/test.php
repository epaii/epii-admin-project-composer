<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/11
 * Time: 9:11 AM
 */

namespace epii\admin\center\app;


use Closure;
use epii\admin\center\admin_center_controller;
use epii\admin\center\config\Rbac;
use epii\admin\center\config\Settings;
use epii\admin\center\libs\Tools;
use epii\server\App;
use epii\tools\classes\ClassTools;

class test
{
        public function index()
        {
          //  var_dump(Settings::_saveCache());

          echo Tools::getVendorDir() ;

             //   print_r(Tools::getObjectAttr(App::getInstance(),"name_space_pre",App::class));
            exit;
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