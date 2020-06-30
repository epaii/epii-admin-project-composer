<?php

namespace epii\admin\center;

use epii\orm\Db;
use wangshouwei\session\Session;

class AdminCenter 
{
    public static function login($admin_id_or_info){
        if(is_array($admin_id_or_info)){
            $admin_id = $admin_id_or_info["id"];
        }else{
            $admin_id = (int)$admin_id_or_info;
        }
        $user = Db::name('admin')
        ->where('id', $admin_id)
        ->find();
        Session::set("is_login", 1);
        Session::set("admin_gid", $user["role"]);
        Session::set("username", $user['username']);
        Session::set("user_id", $user['id']);
        Session::set("user_avatar", $user['photo']);
    }
    public static function logout(){
        Session::empty();
    }
}