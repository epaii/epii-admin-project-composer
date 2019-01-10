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
use think\Db;
use wangshouwei\session\Session;

class AdminCenterUiConfig implements IEpiiAdminUi
{
    public function getConfig(): \epii\admin\ui\lib\epiiadmin\SiteConfig
    {
        // TODO: Implement getConfig() method.
        $sitconfig = new \epii\admin\ui\lib\epiiadmin\SiteConfig();
        $sitconfig->app_left_theme(\epii\admin\ui\lib\epiiadmin\SiteConfig::app_left_theme_light);
        $user_name = Session::has('username')?Session::get('username'):'';
        $sitconfig->user_name($user_name)->app_theme(SiteConfig::app_theme_success)->app_left_theme(SiteConfig::app_left_theme_dark);
        //$sitconfig->user_avatar();
        return $sitconfig;
    }

    public function getLeftMenuData(): \epii\admin\ui\lib\epiiadmin\MenuConfig
    {
        // TODO: Implement getLeftMenuData() method.
        $m_config = new MenuConfig();
        $menus = $this->getLeftMenu();
        $open_id = 3;
        foreach ($menus as $menu){
            $m_config->addMenu($menu['id'], $menu['pid'], $menu['name'], $menu['url'], $menu['icon']);
            if($menu['is_open']){
                $open_id = $menu['id'];
            }

        }

        $m_config->selectId($open_id)->isAllOpen(true);

        return $m_config;
    }

    public function getTopRightNavHtml(): string
    {
        // TODO: Implement getTopRightNavHtml() method.
        return '  <li class="nav-item">
            <a class="nav-link"  href="?app=user@logout&_vendor=1">
                <i class="fa fa-power-off" ></i>
            </a>
        </li>';
        //return "";
    }

    private function sortarr($key,$sort,$arr){
        if(count($arr)<=1){
            return $arr;
        }
        foreach ($arr as $ks => $vs) {
            $edition[] = $vs[$key];
        }
        array_multisort($edition, $sort, $arr);
        return $arr;
    }

    public function getLeftMenu()//获取菜单
    {

       /* $admin_id = $_SESSION['admin_id'];
        $role = "";
        if($admin_id == 1 ){
            //$role = " and slug in ()";//还没写
        }*/
        $role = "";
        $list = Db::name("node")->where("status = 1".$role)->select();

        $arr1 = $this->sortarr('sort',SORT_ASC,array_filter($list,function($val){return $val['pid'] == 0;}));

        $big_list = [];
        foreach ($arr1 as $k=>$v){

            $big_list[] = $arr1[$k];

            $son_list = self::sortarr("sort",SORT_ASC,array_filter($list,function($val) use($v){
                return $val['pid'] == $v['id'];
            }));

            $big_list = array_merge($big_list,$son_list);
        }
        return $big_list;
    }


}

