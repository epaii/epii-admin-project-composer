<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:16 AM
 */

use epii\admin\ui\EpiiAdminUi;

require_once __DIR__ . "/../../vendor/epii_admin_project_vendor/autoload.php";

EpiiAdminUi::setBaseConfig(["static_url_pre"=>"http://ziyuan.this.jt/","version"=>time()]);



(new \epii\admin\center\App())->run();