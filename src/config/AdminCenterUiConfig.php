<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:52 AM
 */

namespace epii\admin\center\config;


use epii\admin\ui\lib\epiiadmin\MenuConfig;
use epii\admin\ui\lib\epiiadmin\SiteConfig;
use epii\admin\ui\lib\i\epiiadmin\IEpiiAdminUi;

class AdminCenterUiConfig implements IEpiiAdminUi
{

    public function getConfig(): SiteConfig
    {
        // TODO: Implement getConfig() method.
    }

    public function getLeftMenuData(): MenuConfig
    {
        // TODO: Implement getLeftMenuData() method.
    }

    public function getTopRightNavHtml(): string
    {
        // TODO: Implement getTopRightNavHtml() method.
    }
}