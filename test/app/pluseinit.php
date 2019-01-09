<?php

namespace app;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:47 AM
 */
class pluseinit extends \epii\admin\center\config\AdminCenterPlusInitConfig
{

    public function get_cache_dir(): string
    {
        // TODO: Implement get_cache_dir() method.
        return __DIR__ . "/runtime/cache";
    }

    public function get_view_config(): array
    {
        // TODO: Implement get_view_config() method.
        return ["tpl_dir" => __DIR__ . "/view/", "cache_dir" => __DIR__ . "/runtime/cache/view/"];
    }

    public function get_db_config(): array
    {
        // TODO: Implement get_db_config() method.
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
}