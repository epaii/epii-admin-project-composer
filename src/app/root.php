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
    public function start()
    {

        if (!Session::get("is_login"))
            AdminLogin::login(new class implements IloginConfig
            {
                public function onPost(string $username, string $password, &$msg): bool
                {
                    // TODO: Implement onPost() method.
                    $user = Db::name('admin')
                        ->field('id,password,username')
                        ->where('username', $username)
                        ->find();
                    if ($user) {

                        if ($user['password'] == md5($password)) {
                            Session::set("is_login", 1);
                            Session::set("username", $user['username']);
                            Session::set("user_id", $user['id']);
                            $msg = '登录成功';
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