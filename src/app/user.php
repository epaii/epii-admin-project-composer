<?php
/**
 * User: hey
 * Date: 2019/1/10
 * Time: 8:57
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\admin\ui\demo\DemoUi;
use epii\admin\ui\lib\epiiadmin\jscmd\Alert;
use epii\admin\ui\lib\epiiadmin\jscmd\CloseAndRefresh;
use epii\admin\ui\lib\epiiadmin\jscmd\JsCmd;
use epii\admin\ui\lib\epiiadmin\jscmd\Refresh;
use epii\server\Args;
use epii\tools\classes\ClassTools;
use think\Db;
use wangshouwei\session\Session;

class user extends _controller
{
    /**
     * 退出
     */
    public function logout()
    {

        Session::del('is_login');
        header('location:' . $_SERVER['HTTP_REFERER']);
    }

    /**
     * 修改资料
     */
    public function modify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = Args::params('username');
            $group_name = Args::params('group_name');
            $phone = Args::params('phone');
            $email = Args::params('email');

            $data['id'] = Session::get('user_id');
            $data['username'] = $username;
            $data['group_name'] = $group_name;
            $data['phone'] = $phone;
            $data['email'] = $email;
            $res = Db::name('admin')->update($data);

            if ($res) {
                $cmd = Alert::make()->msg('成功')->icon('6')->onOk(Refresh::make()->type("page"));
            } else {
                $cmd = Alert::make()->msg('失败')->icon('5')->onOk(null);
            }
            return JsCmd::make()->addCmd($cmd)->run();

        } else {
            $user = Db::name('admin')->where('id', Session::get('user_id'))->find();
            $this->assign('user', $user);
            $this->adminUiDisplay('user/modify');
        }

    }

    /**
     * @return array|false|string
     * @throws \think\Exception
     * 权限控制
     */

    public function power()
    {
        $id = Args::params('id');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type = Args::params('type');
            $power = Args::params('power');
            if(!$type){
                $cmd = Alert::make()->msg('至少选择一种类型')->icon('5')->onOk(null);
                return JsCmd::make()->addCmd($cmd)->run();
            }
            foreach ($power as $k => $v) {
                $power[$k]=array_flip($v);
                if (!$v[0]) {
                    unset($power[$k]);
                }
            }

            $power_array = [
                'type'=>$type,
                'power'=>$power
            ];

            $res = Db::name('role')
                ->where('id', $id)
                ->update(['powers'=> json_encode($power_array)]);
            if ($res) {
                $cmd = Alert::make()->msg('成功')->icon('6')->onOk(CloseAndRefresh::make()->type("page"));
            } else {
                $cmd = Alert::make()->msg('失败')->icon('5')->onOk(null);
            }
            return JsCmd::make()->addCmd($cmd)->run();

        } else {
            $list = ClassTools::get_all_classes_and_methods(["epii\\admin\\center\\app\\"]);

            $power_array = Db::name('role')->where('id',$id)->value('powers');
            $power = json_decode($power_array,true)['power'];
            $type = json_decode($power_array,true)['type'];

            $this->assign('type',$type);
            $this->assign('power',$power);
            $this->assign('list', $list);
            $this->assign('id', $id);
            $this->adminUiDisplay('user/power');
        }

    }
}