<?php
/**
 * User: hey
 * Date: 2019/1/9
 * Time: 16:56
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;

class admin extends _controller
{
 public function index(){
    $this->adminUiDisplay('admin/index');
 }
public function ajaxdata(){

     echo $this->tableJsonData('admin',[],function($data){
         $data['addtime'] = date('Y-m-d H:i:s',$data['addtime']);
         $data['updatetime'] = date('Y-m-d H:i:s',$data['updatetime']);
         return $data;
     });
}
}