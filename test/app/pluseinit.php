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
        return [];
    }
}