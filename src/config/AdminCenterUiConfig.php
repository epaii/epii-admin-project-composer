<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:52 AM
 */

namespace epii\admin\center\config;


use epii\admin\ui\lib\epiiadmin\MenuConfig;
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
        //var_dump(Settings::get("app.style.nav_theme"));
        $sitconfig->user_name($user_name)->app_theme(Settings::get("app.style.nav_theme"))->app_left_theme(Settings::get("app.style.left_bg_theme"));

        $sitconfig->app_left_top_theme(Settings::get("app.style.left_top_theme"));
        $sitconfig->app_left_selected_theme(Settings::get("app.style.left_selected_theme"));
        $sitconfig->site_logo(Settings::get("app.logo"));
        $sitconfig->site_title(Settings::get("app.title"));
        $sitconfig->site_name(Settings::get("app.title"));
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
            <a class="nav-link btn-confirm" data-msg="确定要退出吗?" href="?app=user@logout&_vendor=1">
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
        $map = [];
        $map['status']=1;

        if(Session::get('user_id') != 1){
            $user_role_id = Db::name('admin')->where('id',Session::get('user_id'))->value('role');
            $nodes_arr = Db::name('role')->where('id',$user_role_id)->value('nodes');
            $map['id'] = json_dncode($nodes_arr,true);
        }
        $list = Db::name("node")->where($map)->select();
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

