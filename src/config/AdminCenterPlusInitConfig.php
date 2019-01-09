<?php

namespace epii\admin\center\config;

use epii\admin\center\libs\Tools;
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



    public function get_web_url_prefix(): string
    {
        // TODO: Implement get_web_url_prefix() method.
        return Tools::get_current_url();
    }


}