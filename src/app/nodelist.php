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
use epii\admin\ui\lib\epiiadmin\jscmd\Alert;
use epii\admin\ui\lib\epiiadmin\jscmd\CloseAndRefresh;
use epii\admin\ui\lib\epiiadmin\jscmd\JsCmd;
use epii\admin\ui\lib\epiiadmin\jscmd\Refresh;
use epii\server\Args;
use think\Db;

class nodelist extends _controller
{
    public function index()
    {
        $list = Db::name("node")->where("pid =0")->select();
        $this->assign("list", $list);
        $this->adminUiDisplay('nodelist/index');
    }

    public function ajaxdata()
    {

        $name = trim(Args::params("name"));
        $pid = trim(Args::params("pid"));
        $map = [];
        if (!empty($name)) {
            $map[] = ["name", "LIKE", "%{$name}%"];

        }
        if (!empty($pid)) {
            $map[] = ["pid", "eq", $pid];
        }

        echo $this->tableJsonData('node', $map, function($data) {

            $data['status'] = $data['status'] == 1 ? "已启用" : "未启用";

            return $data;
        });
    }

    public function add()
    {

        $name = trim(Args::params("name"));
        $slug = trim(Args::params("slug"));
        $pid = trim(Args::params("pid"));
        $icon = trim(Args::params("icon"));
        $url = trim(Args::params("url"));
        $remark = trim(Args::params("remark"));
        $status = trim(Args::params("status"));
        $sort = trim(Args::params("sort"));





        if (!$name || !$slug || !$icon) {
            $alert = Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的");
            return JsCmd::make()->addCmd($alert)->run();
        }
        if (!$status) {
            $status = 0;
        }
        if ($pid != 0 && !$url) {
            $alert = Alert::make()->msg("URL不能是空")->title("重要提示")->btn("好的");
            return JsCmd::make()->addCmd($alert)->run();
        }

        if (Db::name('node')->where("name = '$name'")->find()) {
            $alert = Alert::make()->msg($name . "节点已存在")->title("重要提示")->btn("好的");
            return JsCmd::make()->addCmd($alert)->run();
        }

        $re = Db::name('node')->insertGetId(['name' => $name,
            'slug' => $slug,
            'pid' => $pid,
            'icon' => $icon,
            'url' =>'app='.$url,
            'remark' => $remark,
            'status' => $status,
            "sort" => $sort]);
        if ($re) {
            $alert = Alert::make()->msg("操作成功")->onOk(CloseAndRefresh::make()->layerNum(0)->closeNum(0))->title("重要提示")->btn("好的");
        } else {
            $alert = Alert::make()->msg("操作失败，请重试")->title("重要提示")->btn("好的");
        }

        return JsCmd::make()->addCmd($alert)->run();
    }

    public function addpage()
    {

        $list = Db::name("node")->where("pid =0")->select();
        $this->assign("list", $list);
        $this->adminUiDisplay('nodelist/add');

    }

    public function edit()
    {
        $id = Args::params("id");
        if (!$id) {
            return JsCmd::make()->addCmd(Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的"))->run();
        }


        /*if ($this->is_admin) {
            if ($id == 1) {
                $alert = Alert::make()->msg("不能修改超级管理员")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }
        } else {
            $alert = Alert::make()->msg("没有权限")->title("重要提示")->btn("好的");
            return JsCmd::make()->addCmd($alert)->run();
        }*/
        $name = trim(Args::params("name"));
        $slug = trim(Args::params("slug"));
        $pid = trim(Args::params("pid"));
        $icon = trim(Args::params("icon"));
        $url = trim(Args::params("url"));
        $remark = trim(Args::params("remark"));
        $status = trim(Args::params("status"));
        $sort = trim(Args::params("sort"));
        $is_open = trim(Args::params("is_open"));

        if($is_open){
            Db::name("node")->where('id','<>',$id)->setField('is_open',null);
        }

        if (!$name || !$slug || !$icon) {
            $alert = Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的");
            return JsCmd::make()->addCmd($alert)->run();
        }
        if (!$status) {
            $status = 0;
        }
        if ($pid != 0 && !$url) {
            $alert = Alert::make()->msg("URL不能是空")->title("重要提示")->btn("好的");
            return JsCmd::make()->addCmd($alert)->run();
        }

        $re = Db::name("node")->where("id = '$id'")->update(['name' => $name,
            'slug' => $slug,
            'pid' => $pid,
            'icon' => $icon,
            'remark' => $remark,
            'status' => $status,
            'url'=>'?app='.$url,
            "sort" => $sort,
            'is_open'=>$is_open]);

        if ($re) {
            $alert = Alert::make()->msg("操作成功")->onOk(CloseAndRefresh::make()->layerNum(0)->closeNum(0))->title("重要提示")->btn("好的");
        } else {
            $alert = Alert::make()->msg("失败或未修改，请重试")->title("重要提示")->btn("好的");
        }

        return JsCmd::make()->addCmd($alert)->run();

    }

    public function editpage()
    {
        $id = Args::params('id');
        $list = Db::name("node")->where("pid =0")->select();
        $this->assign("list", $list);

        $nodeinfo = Db::name("node")->where("id  = $id")->find();
        if ($nodeinfo['pid'] == 0) {
            $this->assign("id", null);
        } else {
            $this->assign("id", $id);
        }

        $this->adminUiDisplay('nodelist/edit');
    }

    public function del()
    {
        $id = Args::params('id');
        $res = Db::name('node')->delete($id);
        if ($res) {
            $cmd = Alert::make()->msg('删除成功')->icon('6')->onOk(Refresh::make()->type("table"));
        } else {
            $cmd = Alert::make()->msg('删除失败')->icon('5')->onOk(null);
        }
        return JsCmd::make()->addCmd($cmd)->run();
    }
}