<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8
 * Time: 15:13
 */

namespace epii\admin\center\app;

use app\epiiadmin\controller\EpiiController;
use epii\admin\center\common\_controller;
use think\Db;

class Nodelist extends _controller
{
    public function index(){
        $list = Db::name("node")->where("pid =0")->select();
        $this->assign("list",$list);
        $this->adminUiDisplay('nodelist/index');
       // return $this->fetch();
    }

    public function ajaxdata(){

        $name = trim($this->request->param("name/s"));
        $pid = trim($this->request->param("pid/s"));
        $offset=trim($this->request->param("offset/s"));
        $limit = trim($this->request->param("limit/s"));

        $map = [];
        if(!empty($name)){
            $map[] = ["name","LIKE","%{$name}%"];

        }
        if(!empty($pid)){
            $map[] = ["pid","eq",$pid];
        }
        //$map[] = ["status","eq",1];
        $list = db::name('node')->where($map)->limit($offset,$limit)->select();

        foreach ($list as $k=>$v){
            $list[$k]['status'] = $v['status']==1?"已启用":"未启用";
        }

        return json(["rows" => $list,"total" => $list = db::name('node')->where($map)->count()]);
    }

    public function add(){

        if($this->request->isAjax()){



            $name = trim($this->request->param("name/s"));
            $slug = trim($this->request->param("slug/s"));
            $pid = trim($this->request->param("pid/s"));
            $icon = trim($this->request->param("icon/s"));
            $url = trim($this->request->param("url/s"));
            $remark = trim($this->request->param("remark/s"));
            $status = trim($this->request->param("status/s"));
            $sort = trim($this->request->param("sort/s"));


            if(!$name||!$slug||!$icon){
                $alert = Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }
            if(!$status){
                $status = 0;
            }


            if(Db::name('node')->where("name = '$name'")->find()){
                $alert = Alert::make()->msg($name."节点已存在")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }

            $re = Db::name('node')->insertGetId(['name' => $name , 'slug' => $slug , 'parent'=>$pid,'icon' => $icon,'url'=>$url,'remark'=>$remark,'status'=>$status,"sort"=>$sort]);
            if($re){
                $alert = Alert::make()->msg("操作成功")->onOk(CloseAndRefresh::make()->layerNum(0)->closeNum(0))->title("重要提示")->btn("好的");
            }else{
                $alert = Alert::make()->msg("操作失败，请重试")->title("重要提示")->btn("好的");
            }

            return JsCmd::make()->addCmd($alert)->run();
        }else{
            $list = Db::name("node")->where("pid =0")->select();
            $this->assign("list",$list);
            return $this->fetch();
        }
    }

    public function edit(){
        $id = $this->request->param("id/s");
        if(!$id){
            return JsCmd::make()->addCmd(Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的"))->run();
        }
        if($this->request->isAjax()){

            if($this->is_admin){
                if($id==1){
                    $alert = Alert::make()->msg("不能修改超级管理员")->title("重要提示")->btn("好的");
                    return JsCmd::make()->addCmd($alert)->run();
                }
            }else{
                $alert = Alert::make()->msg("没有权限")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }
            $name = trim($this->request->param("name/s"));
            $slug = trim($this->request->param("slug/s"));
            $pid = trim($this->request->param("pid/s"));
            $icon = trim($this->request->param("icon/s"));
            $url = trim($this->request->param("url/s"));
            $remark = trim($this->request->param("remark/s"));
            $status = trim($this->request->param("status/s"));
            $sort = trim($this->request->param("sort/s"));


            if(!$name||!$slug||!$icon){
                $alert = Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }
            if(!$status){
                $status = 0;
            }


            $re = Db::name("node")->where("id = '$id'")->update(['name' => $name , 'slug' => $slug , 'parent'=>$pid,'icon' => $icon,'url'=>$url,'remark'=>$remark,'status'=>$status,"sort"=>$sort]);

            if($re){
                $alert = Alert::make()->msg("操作成功")->onOk(CloseAndRefresh::make()->layerNum(0)->closeNum(0))->title("重要提示")->btn("好的");
            }else{
                $alert = Alert::make()->msg("失败或未修改，请重试")->title("重要提示")->btn("好的");
            }

            return JsCmd::make()->addCmd($alert)->run();
        }else{
            $list = Db::name("node")->where("pid =0")->select();
            $this->assign("list",$list);

            $nodeinfo = Db::name("node")->where("id  = $id")->find();
            if($nodeinfo['pid']==0){
                $this->assign("id",null);
            }else{
                $this->assign("id",$id);
            }

            return $this->fetch();
        }




    }
}