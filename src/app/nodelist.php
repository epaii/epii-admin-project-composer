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
    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 菜单
     */
    public function index()
    {
        $list = Db::name("node")->where("pid =0")->select();
        $this->assign("list", $list);
        $this->adminUiDisplay('nodelist/index');
    }

    /**
     * 表格数据
     */
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

            $data['status'] = $data['status'] == 1 ? "<i class=\"fa fa-toggle-on\" aria-hidden=\"true\"></i>" : "<i class=\"fa fa-toggle-off\" aria-hidden=\"true\"></i>";
            $data['icon'] = '<i class="' . $data['icon'] . '" ></i>';
            if ($data['pid'] == 0){
                $data['pid'] = '顶级菜单';
            }else{
                $data['pid']=Db::name('node')->where('id',$data['pid'])->value('name');
            }

            return $data;
        });
    }

    /**
     * @return array|false|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 添加页面+添加
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim(Args::params("name"));
            $slug = trim(Args::params("slug"));
            $pid = trim(Args::params("pid"));
            $icon = trim(Args::params("icon"));
            $url = trim(Args::params("url"));
            $remark = trim(Args::params("remark"));
            $status = trim(Args::params("status")) ?: 0;
            $sort = trim(Args::params("sort"));

            if (!$name || !$slug || !$icon) {
                $alert = Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }

            if ($pid != 0 && !$url) {
                $alert = Alert::make()->msg("URL不能是空")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }

            if (Db::name('node')->where("name = '$name'")->find()) {
                $alert = Alert::make()->msg($name . "节点已存在")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }

            $data['name']=$name;

            $data['pid']=$pid;
            $data['remark']=$remark;
            $data['status']=$status;
            $data['sort']=$sort;
            $data['icon']=$icon;
            $data['url']='?app=' . $url . '&_vendor=1';
            $data['slug']='?app=' . $url . '&_vendor=1';
            $re = Db::name('node')
                ->insertGetId($data);
            if ($re) {
                $alert = Alert::make()->msg("操作成功")->onOk(CloseAndRefresh::make()->layerNum(0)->closeNum(0))->title("重要提示")->btn("好的");
            } else {
                $alert = Alert::make()->msg("操作失败，请重试")->title("重要提示")->btn("好的");
            }

            return JsCmd::make()->addCmd($alert)->run();

        } else {
            $list = Db::name("node")->where('pid',0)->select();
            print_r($list);exit();
            $this->assign("list", $list);
            $this->adminUiDisplay('nodelist/add');
        }
    }

    /**
     * @return array|false|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\db\exception\PDOException
     * 编辑页面+编辑
     */

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = Args::params("id");
            if (!$id) {
                return JsCmd::make()->addCmd(Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的"))->run();
            }

            $name = trim(Args::params("name"));
            $slug = trim(Args::params("slug"));
            $pid = trim(Args::params("pid"));
            $icon = trim(Args::params("icon"));
            $url = trim(Args::params("url"));
            $remark = trim(Args::params("remark"));
            $status = trim(Args::params("status")) ?: 0;
            $sort = trim(Args::params("sort"));
            $is_open = trim(Args::params("is_open"));

            if ($is_open) {
                Db::name("node")->where('id', '<>', $id)->setField('is_open', null);
            }

            if (!$name || !$slug || !$icon) {
                $alert = Alert::make()->msg("缺少参数")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }

            if ($pid != 0 && !$url) {
                $alert = Alert::make()->msg("URL不能是空")->title("重要提示")->btn("好的");
                return JsCmd::make()->addCmd($alert)->run();
            }


            $data['name']=$name;
            $data['slug']=$slug;
            $data['pid']=$pid;
            $data['remark']=$remark;
            $data['status']=$status;
            $data['sort']=$sort;
            $data['icon']=$icon;
            $data['is_open']=$is_open;

            if (strpos($url,'?')!==false){
                $data['url']=$url;
            }else{
                $data['url']='?app=' . $url . '&_vendor=1';
            }


            $re = Db::name("node")
                ->where("id = '$id'")
                ->update($data);

            if ($re) {
                $alert = Alert::make()->msg("操作成功")->onOk(CloseAndRefresh::make()->layerNum(0)->closeNum(0))->title("重要提示")->btn("好的");
            } else {
                $alert = Alert::make()->msg("失败或未修改，请重试")->title("重要提示")->btn("好的");
            }
            return JsCmd::make()->addCmd($alert)->run();

        } else {
            $id = Args::params('id');
            $list = Db::name("node")->where('pid',0)->select();
            $this->assign("list", $list);
            $this->assign("id", $id);
            $nodeinfo = Db::name("node")->where("id",$id)->find();
            $this->assign('nodeinfo',$nodeinfo);


            $this->adminUiDisplay('nodelist/edit');
        }

    }

    /**
     * @return array|false|string
     * @throws \think\Exception
     * @throws \think\db\exception\PDOException
     * 删除方法
     */
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