<?php
namespace epii\admin\center\app;

use epii\admin\center\common\_controller;
use epii\admin\center\libs\AddonsManager;
use epii\admin\ui\lib\epiiadmin\jscmd\JsCmd;
use epii\orm\Db;
use epii\server\Args;

class addons extends _controller{
    public function index(){
     
    
        $this->adminUiDisplay('addons/index', "", ["version" => time()]);
    }
    public function ajaxdata()
    { 


        $all = AddonsManager::getAllAddons();
        foreach ($all as $key=>$value){
            if($value["__data"])
            {
                $all[$key]["addtime"] = date("Y-m-d",$value['__data']["addtime"]);
            }else{
                $all[$key]["addtime"] = "";
            }
        }

        $outdata = ["rows" =>array_values($all), "total" => count($all)];
        
        echo  json_encode($outdata, JSON_UNESCAPED_UNICODE);
    }
    public function status(){
        $name = Args::params("name/1");
        Db::name("addons")->where("name",$name)->update(["status"=>Args::params("status/d")]);
        $info = DB::name("addons")->where("name",$name)->find();
        if($info["menu_ids"])
        {
            Db::name('node')->whereIn("id",explode(",",$info["menu_ids"]))->update(["status"=>Args::params("status/d")]);
        }
        return JsCmd::alertRefresh("操作成功");
    }

    public function install(){
        $name = Args::params("name/1");
       
        $info = AddonsManager::getAddonsConfig($name);
        if(!$info){
            return JsCmd::alert("扩展不存在");
        }
        if($info["install"]){
            return JsCmd::alert("扩展已经安装");
        }
        $ret = AddonsManager::install($name);
        if(!$ret){
            return JsCmd::alert("安装失败");
        }

       

        return JsCmd::alertRefresh("安装成功");

    }
}

