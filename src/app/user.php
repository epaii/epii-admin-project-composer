<?php
/**
 * User: hey
 * Date: 2019/1/10
 * Time: 8:57
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;
use wangshouwei\session\Session;

class user extends _controller
{
public function logout(){

    //print_r(Session::get());
    Session::del('is_login');
    header('location:'.$_SERVER['HTTP_REFERER']);
}
}