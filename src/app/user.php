<?php
/**
 * User: hey
 * Date: 2019/1/10
 * Time: 8:57
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\admin\ui\lib\epiiadmin\jscmd\Alert;
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
                $cmd = Alert::make()->msg('失败')->icon('5')->onOk(Refresh::make()->type("page"));
            }
            return JsCmd::make()->addCmd($cmd)->run();

        } else {
            $user = Db::name('admin')->where('id', Session::get('user_id'))->find();
            $this->assign('user', $user);
            $this->adminUiDisplay('user/modify');
        }

    }

    public function test()
    {
        // $list = epii\tools\classes\ClassTools::get_all_classes_and_methods(["epii\\admin\\center\\app\\"]);
        $list = ClassTools::get_all_classes_and_methods(["epii\\admin\\center\\app\\"]);
        print_r($list);
    }

    public function power(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $class = Args::params('class');
            $method = Args::params('method');

            if(!$class[0] || !$method[0]){
                $cmd = Alert::make()->msg('至少选择一个类名和方法')->icon('5')->onOk(null);
                return JsCmd::make()->addCmd($cmd)->run();
            }


        }else{
            $list = ClassTools::get_all_classes_and_methods(["epii\\admin\\center\\app\\"]);
            $this->assign('list',$list);
            $this->adminUiDisplay('user/power');
        }

    }
}