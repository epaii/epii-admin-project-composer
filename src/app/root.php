<?php
namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use epii\admin\center\libs\Tools;
use epii\admin\center\ProjectConfig;
use epii\ui\login\AdminLogin;
use epii\ui\login\IloginConfig;
use think\Db;
use wangshouwei\session\Session;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:04 AM
 */
class root extends _controller
{
    public function home()
    {
        $this->adminUiDisplay("start/home");
    }

    public function start()
    {
        if (!install::isInstall())
        {
            $install = new install();
            $install->init();
            $install->index();
            exit;
        }

        if (!Session::get("is_login"))
            AdminLogin::login(new class implements IloginConfig
            {
                public function onPost(string $username, string $password, &$msg): bool
                {
                    // TODO: Implement onPost() method.

                    if(empty($username)){
                        $msg = '用户名不能为空!';
                        return false;
                    }

                    if(!preg_match("/^[a-zA-Z]{1}[a-zA-Z\d_]{4,19}$/",$username)){
                        $msg = '用户名格式错误';
                        return false;
                    }

                    if(empty($password)){
                        $msg = '密码不能为空!';
                        return false;
                    }

                    if(!preg_match("/^[a-zA-Z\d_]{6,16}$/",$password)){
                        $msg = '密码6~16位';
                        return false;
                    }

                    $user = Db::name('admin')
                        ->field('id,password,username,role')
                        ->where('username', $username)
                        ->find();
                    if ($user) {
                        if ($user['password'] == md5($password)) {
                            Session::set("is_login", 1);
                            Session::set("admin_gid", $user["role"]);
                            Session::set("username", $user['username']);
                            Session::set("user_id", $user['id']);
                            $msg = '';
                            return true;
                        } else {
                            $msg = '密码错误';
                            return false;
                        }
                    } else {
                        $msg = '用户名不存在';
                        return false;
                    }
                }

                public function getConfigs(): array
                {
                    // TODO: Implement getConfigs() method.
                    return ["success_url" => Tools::get_current_url()];
                }
            });
        else
            $this->adminUiBaseDisplay(ProjectConfig::getAdminUiConfig());

    }

}