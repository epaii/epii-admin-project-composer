<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8
 * Time: 15:13
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\admin\ui\lib\epiiadmin\jscmd\Alert;
use epii\admin\ui\lib\epiiadmin\jscmd\CloseAndRefresh;
use epii\admin\ui\lib\epiiadmin\jscmd\JsCmd;
use epii\admin\ui\lib\epiiadmin\jscmd\Refresh;
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

           $nodeArr =  Db::name('node')
               ->field('id,name')
               ->where(['id'=>unserialize($data['nodes'])])
               ->select();
            $arr = [];
           foreach ($nodeArr as $v){
                array_push($arr,$v['name']);
           }
            $data['nodes'] = implode('   ',$arr);
            $arr = [];
            $data['status'] = $data['status']==1?"已启用":"未启用";
            return $data;
        });
    }


    public function addpage()
    {
        $nodes = Db::name('node')->field('id,name')->select();
        $this->assign('nodes',$nodes);
        $this->adminUiDisplay('rolelist/add');
    }

    public function add()
    {
        $name = trim(Args::params("name"));
        $slug = trim(Args::params("slug"));
        $sort = trim(Args::params("sort"));
        $status = trim(Args::params("status"));
        $nodes = serialize(Args::params("nodes"));
        $remark = trim(Args::params("remark"));

        $res = Db::name('role')
            ->insert([
                'name'=>$name,
                'slug'=>$slug,
                'sort'=>$sort,
                'nodes'=>$nodes,
                'remark'=>$remark,
                'status'=>$status,
            ]);

        if ($res) {
            $cmd = Alert::make()->msg('添加成功')->icon('6')->onOk(CloseAndRefresh::make()->type("table"));
        } else {
            $cmd = Alert::make()->msg('添加失败')->icon('5')->onOk(null);
        }
        return JsCmd::make()->addCmd($cmd)->run();
    }

    public function editpage(){
        $id = trim(Args::params("id"));
        $nodes = Db::name('node')->field('id,name')->select();
        $this->assign('nodes',$nodes);
        $this->assign('id',$id);
        $this->adminUiDisplay('rolelist/edit');
    }
    public function edit()
    {
        $id = trim(Args::params("id"));
        $name = trim(Args::params("name"));
        $slug = trim(Args::params("slug"));
        $sort = trim(Args::params("sort"));
        $status = trim(Args::params("status"));
        $nodes = serialize(Args::params("nodes"));
        $remark = trim(Args::params("remark"));

        $res = Db::name('role')
            ->where('id',$id)
            ->update([
                'name'=>$name,
                'slug'=>$slug,
                'sort'=>$sort,
                'nodes'=>$nodes,
                'remark'=>$remark,
                'status'=>$status,
            ]);

        if ($res) {
            $cmd = Alert::make()->msg('修改成功')->icon('6')->onOk(CloseAndRefresh::make()->type("table"));
        } else {
            $cmd = Alert::make()->msg('修改失败')->icon('5')->onOk(null);
        }
        return JsCmd::make()->addCmd($cmd)->run();
    }



    public function del()
    {
        $id = Args::params('id');
        $res = Db::name('role')->delete($id);
        if ($res) {
            $cmd = Alert::make()->msg('删除成功')->icon('6')->onOk(Refresh::make()->type("table"));
        } else {
            $cmd = Alert::make()->msg('删除失败')->icon('5')->onOk(null);
        }
        return JsCmd::make()->addCmd($cmd)->run();
    }


}