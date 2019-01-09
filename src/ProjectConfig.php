<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:54 AM
 */

namespace epii\admin\center;


use epii\admin\center\config\AdminCenterUiConfig;


class ProjectConfig
{
    private static $adminUi = null;

    public static function setAdminUiConfig(AdminCenterUiConfig $adminUi)
    {
        self::$adminUi = $adminUi;
    }

    public static function getAdminUiConfig(): AdminCenterUiConfig
    {
        if (!self::$adminUi)
            self::$adminUi = new AdminCenterUiConfig();
        return self::$adminUi;
    }
}