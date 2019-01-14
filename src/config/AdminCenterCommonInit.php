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
        EpiiViewEngine::addFunction("options",function($list,$select_value=null){


             if (  is_array($list))
             {

                 $out = "";
                 foreach ($list as $key=>$value)
                 {
                     if (!is_array($value))
                     {
                         $out.="<option value='".$key."'>".$value."</option>";
                     }else{
                         $_v = $key;
                         if (isset($value["id"]))
                         {
                             $_v = $value["id"];
                         }
                         if (isset($value["value"]))
                         {
                             $_v = $value["value"];
                         }
                         $_name = "";
                         if (isset($value["name"]))
                         {
                             $_name = $value["name"];
                         }
                         if (isset($value["text"]))
                         {
                             $_name = $value["text"];
                         }
                         $select = "";
                        // var_dump($args);
                         if (  ($select_value!==null && $_v==$select_value)  || (isset($value["selected"]) && $value["selected"]))
                         {
                             $select = "selected";
                         }
                         $out.="<option value='".$_v."' ".$select.">".$_name."</option>";

                     }
                 }
             }

             return $out;
        });
        Session::start();
    }
}