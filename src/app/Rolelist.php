<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8
 * Time: 15:13
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;

class Rolelist extends _controller
{
    public function index(){
        $list = Db::name("role")->where("status=1")->select();
        $this->assign("list",$list);

        return $this->fetch();
    }

    public function ajaxdata(){

        $name = trim($this->request->param("name/s"));
        $offset=trim($this->request->param("offset/s"));
        $limit = trim($this->request->param("limit/s"));

        $map = [];
        if(!empty($name)){
            $map[] = ["name","LIKE","%{$name}%"];

        }

        $list = db::name('role')->where($map)->limit($offset,$limit)->select();

        foreach ($list as $k=>$v){
            $list[$k]['status'] = $v['status']==1?"已启用":"未启用";
        }

        return json(["rows" => $list,"total" => $list = db::name('role')->where($map)->count()]);
    }


}