<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8
 * Time: 15:13
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\server\Args;
use think\Db;

class rolelist extends _controller
{
    public function index(){
        $list = Db::name("role")->where("status=1")->select();
        $this->assign("list",$list);
        $this->adminUiDisplay('rolelist/index');
    }

    public function ajaxdata(){
        $name = trim(Args::params("name"));
        $map = [];
        if(!empty($name)){
            $map[] = ["name","LIKE","%{$name}%"];
        }
        echo $this->tableJsonData('role',$map,function($data){
            $data['status'] = $data['status']==1?"已启用":"未启用";
            return $data;
        });
    }
}