<?php
/**
 * User: hey
 * Date: 2019/1/11
 * Time: 9:35
 */

namespace epii\admin\center\app;


use epii\admin\center\common\_controller;

class config extends _controller
{
    public function index()
    {
     $this->adminUiDisplay('config/index');
    }
}