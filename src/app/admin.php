<?php
/**
 * User: hey
 * Date: 2019/1/9
 * Time: 16:56
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\admin\center\config\Settings;
use epii\admin\ui\lib\epiiadmin\jscmd\Alert;
use epii\admin\ui\lib\epiiadmin\jscmd\CloseAndRefresh;
use epii\admin\ui\lib\epiiadmin\jscmd\JsCmd;
use epii\admin\ui\lib\epiiadmin\jscmd\Refresh;
use epii\server\Args;
use think\Db;

class admin extends _controller
{
    public function index()
    {
        $this->adminUiDisplay('admin/index');
    }

    public function ajaxdata()
    {
        $map = [];
        $group_name = Args::params('group_name');
        if($group_name){

            $map[] = ["a.group_name", "LIKE", "%{$group_name}%"];
        }
        $table = Db::name('admin')
            ->alias('a')
            ->field('a.*,r.name as rname')
            ->join('role r', 'a.role=r.id');
        echo $this->tableJsonData($table, $map, function($data) {
            $data['addtime'] = date('Y-m-d H:i:s', $data['addtime']);
            $data['updatetime'] = date('Y-m-d H:i:s', $data['updatetime']);
            $data['status'] = $data['status'] == 'normal' ? "正常" : "禁用";
            return $data;
        });
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = trim(Args::params("username"));
            $password = md5(Args::params("password"));
            $group_name = trim(Args::params("group_name"));
            $status = trim(Args::params("status"));
            $role = trim(Args::params("role"));

            if (!$username || !$group_name || !$status || !$role) {
                $cmd = Alert::make()->msg('不能为空')->icon('5')->onOk(null);
                return JsCmd::make()->addCmd($cmd)->run();
            }

            $has = Db::name('admin')->where('username', $username)->find();
            if ($has) {
                $cmd = Alert::make()->msg('名字已存在')->icon('5')->onOk(null);
                return JsCmd::make()->addCmd($cmd)->run();
            }
            $data['username'] = $username;
            $data['password'] = $password;
            $data['group_name'] = $group_name;
            $data['status'] = $status;
            $data['role'] = $role;
            $data['addtime'] = time();
            $data['updatetime'] = time();

            $res = Db::name('admin')
                ->insert($data);

            if ($res) {
                Settings::_saveCache();
                $cmd = Alert::make()->msg('添加成功')->icon('6')->onOk(CloseAndRefresh::make()->type("table"));
            } else {
                $cmd = Alert::make()->msg('添加失败')->icon('5')->onOk(null);
            }
            return JsCmd::make()->addCmd($cmd)->run();

        } else {


            $roles = Db::name('role')->field('id,name')->select();
            $this->assign('roles', $roles);
            $this->adminUiDisplay('admin/add');
        }
    }


    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim(Args::params("id"));
            $username = trim(Args::params("username"));
            $password = md5(Args::params("password"));
            $group_name = trim(Args::params("group_name"));
            $status = trim(Args::params("status"));
            $role = trim(Args::params("role"));

            if (!$username || !$group_name || !$status || !$role) {
                $cmd = Alert::make()->msg('不能为空')->icon('5')->onOk(null);
                return JsCmd::make()->addCmd($cmd)->run();
            }
            $has = Db::name('admin')->where('username', $username)->find();
            if ($has) {
                $cmd = Alert::make()->msg('名字已存在')->icon('5')->onOk(null);
                return JsCmd::make()->addCmd($cmd)->run();
            }
            $data['username'] = $username;
            $data['group_name'] = $group_name;
            $data['status'] = $status;
            $data['role'] = $role;
            $data['updatetime'] = time();

            if ($password) {
                $data['password'] = $password;
            }
            $res = Db::name('admin')
                ->where('id', $id)
                ->update($data);

            if ($res) {
                Settings::_saveCache();
                $cmd = Alert::make()->msg('修改成功')->icon('6')->onOk(CloseAndRefresh::make()->type("table"));
            } else {
                $cmd = Alert::make()->msg('修改失败')->icon('5')->onOk(null);
            }
            return JsCmd::make()->addCmd($cmd)->run();

        } else {

            $id = Args::params('id');
            $admin = Db::name('admin')->where('id', $id)->find();
            $roles = Db::name('role')->field('id,name')->select();
            $this->assign('id', $id);
            $this->assign('admin', $admin);
            $this->assign('roles', $roles);
            $this->adminUiDisplay('admin/edit');
        }
    }

    public function del()
    {
        $id = Args::params('id');
        $res = Db::name('admin')->delete($id);
        if ($res) {
            Settings::_saveCache();
            $cmd = Alert::make()->msg('删除成功')->icon('6')->onOk(Refresh::make()->type("table"));
        } else {
            $cmd = Alert::make()->msg('删除失败')->icon('5')->onOk(Refresh::make()->type("table"));
        }
        return JsCmd::make()->addCmd($cmd)->run();
    }

}