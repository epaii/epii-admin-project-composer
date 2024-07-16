<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/15
 * Time: 1:05 PM
 */

namespace epii\admin\center\config;

use epii\admin\center\AdminCenter;
use epii\admin\center\libs\Tools;
use epii\server\Tools as ServerTools;
use epii\ui\login\IloginConfig;
use think\Db;
use wangshouwei\session\Session;

class LoginPageConfig implements IloginConfig
{

    protected function onLogin($user)
    {

    }


    public function onPost(string $username, string $password, &$msg): bool
    {
        // TODO: Implement onPost() method.

        if (empty($username)) {
            $msg = '用户名不能为空!';
            return false;
        }


        if (empty($password)) {
            $msg = '密码不能为空!';
            return false;
        }


        $user = Db::name('admin')
            ->field('id,password,username,role,photo')
            ->where('username', $username)
            ->find();
        if ($user) {
            if ($user['password'] == md5($password)) {
                AdminCenter::login($user);
                $this->onLogin($user);
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
        $config = ["success_url" =>  ServerTools::get_web_root()];
        $allset = Settings::get();
        foreach ($allset as $key => $value) {
            if(stripos($key,"app.login.")===0){
                $config[str_replace("app.login.","",$key)] = $value;
            }
        }
        if(isset($config["bg_imgs"]) && $config["bg_imgs"]){
            $config["bg_imgs"] = explode(",", $config["bg_imgs"]);
        }

        return $config;
    }
}