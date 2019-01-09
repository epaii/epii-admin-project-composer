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
    public function getConfig(): \epii\admin\ui\lib\epiiadmin\SiteConfig
    {
        // TODO: Implement getConfig() method.
        $sitconfig = new \epii\admin\ui\lib\epiiadmin\SiteConfig();
        $sitconfig->app_left_theme(\epii\admin\ui\lib\epiiadmin\SiteConfig::app_left_theme_light);
        $sitconfig->user_name("张三")->app_theme(SiteConfig::app_theme_success)->app_left_theme(SiteConfig::app_left_theme_dark);
        return $sitconfig;
    }

    public function getLeftMenuData(): \epii\admin\ui\lib\epiiadmin\MenuConfig
    {
        // TODO: Implement getLeftMenuData() method.
        $m_config = new MenuConfig();
        $m_config->addMenu(1, 0, "仪表盘", "", "fa fa-dashboard");
        $m_config->addMenu(2, 1, "gongneng", "?app=index@index", "fa fa-circle-o");

        $m_config->addMenuHeader("小组件");
        $m_config->addMenu(5, 0, "开发文档", "http://docs.epii-admin.epii.cn", "fa fa-dashboard");
        $m_config->selectId(2)->isAllOpen(true);

        return $m_config;
    }

    public function getTopRightNavHtml(): string
    {
        // TODO: Implement getTopRightNavHtml() method.
        return "";
    }
}