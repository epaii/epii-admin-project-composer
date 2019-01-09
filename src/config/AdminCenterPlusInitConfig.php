<?php

namespace epii\admin\center\config;

use epii\app\i\IAppPlusInitConfig;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:54 AM
 */
abstract class AdminCenterPlusInitConfig     implements IAppPlusInitConfig
{
    public function get_view_engine(): string
    {
        // TODO: Implement get_view_engine() method.
        return \epii\template\engine\EpiiViewEngine::class;
    }

    public function get_cache_dir(): string
    {
        // TODO: Implement get_cache_dir() method.
        return __DIR__ . "/../runtime/cache";
    }

    public function get_web_url_prefix(): string
    {
        // TODO: Implement get_web_url_prefix() method.
        return "http://demo2.this.jt/";
    }

    public function get_view_config(): array
    {
        // TODO: Implement get_view_config() method.
        return ["tpl_dir" => __DIR__ . "/../view", "cache_dir" => __DIR__ . "/../runtime/tpl"];
    }

    public function get_db_config(): array
    {
        // TODO: Implement get_db_config() method.
        return [];
    }
}