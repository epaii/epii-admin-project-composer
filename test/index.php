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



(new \epii\admin\center\App())->setConfig(new class extends \epii\admin\center\config\AdminCenterPlusInitConfig
{
    public function get_db_config(): array
    {
        return [
            'type' => 'mysql',
            // 服务器地址
            'hostname' => "192.168.16.6",
            // 数据库名
            'database' => "epii",
            // 用户名
            'username' => "epii_db_user",
            // 密码
            'password' => 'Pg6oWIbyfRuT5Qmw',
            // 端口
            'hostport' => '3306',
            'prefix' => 'epii_'
        ];
    }
})->run();