<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:54 AM
 */

namespace epii\admin\center;


use epii\admin\center\config\AdminCenterPlusInitConfig;
use epii\admin\center\config\AdminCenterUiConfig;


class ProjectConfig
{
    private static $adminUi = null;
    private static $AdminCenterPlusInitConfig = null;

    public static function _setAdminUiConfig(AdminCenterUiConfig $adminUi)
    {
        self::$adminUi = $adminUi;
    }

    public static function getAdminUiConfig(): AdminCenterUiConfig
    {
        if (!self::$adminUi)
            self::$adminUi = new AdminCenterUiConfig();
        return self::$adminUi;
    }

    public static function _setAdminCenterPlusInitConfig(AdminCenterPlusInitConfig $AdminCenterPlusInitConfig)
    {
        self::$AdminCenterPlusInitConfig = $AdminCenterPlusInitConfig;
    }

    public static function getAdminCenterPlusInitConfig(): AdminCenterPlusInitConfig
    {
//        if (!self::$AdminCenterPlusInitConfig)
//            self::$AdminCenterPlusInitConfig = new AdminCenterUiConfig();
        return self::$AdminCenterPlusInitConfig;
    }


}