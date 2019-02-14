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

        EpiiViewEngine::addFunction("input",function($text,$name,$defualt_value="",$tip="",$other="",$type="text"){


            return "<div class=\"form-group\"><label>{$text}：</label><input type=\"{$type}\" class=\"form-control\" name=\"{$name}\" value='{$defualt_value}' {$other} placeholder=\"{$tip}\"></div>";
        });
        EpiiViewEngine::addParser("input",function($args){


            $args = array_merge(["value"=>"","tip"=>"","required"=>"","readonly"=>"","type"=>"text"],$args);
            if ($args["required"])
            {
                $args["required"]="required";
            }
            if ($args["readonly"])
            {
                $args["required"]="readonly";
            }
           return "<div class=\"form-group\"><label>{$args["text"]}：</label><input type=\"{$args["type"]}\" class=\"form-control\" name=\"{$args["name"]}\" value='{$args["value"]}' {$args["required"]} placeholder=\"{$args["tip"]}\"></div>";

        });
        Session::start();
    }
}