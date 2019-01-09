<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/8
 * Time: 15:13
 */

namespace app\user\controller;

use app\epiiadmin\controller\EpiiController;
use think\Db;
use wslibs\epiiadmin\jscmd\Alert;
use wslibs\epiiadmin\jscmd\JsCmd;
use wslibs\epiiadmin\jscmd\Refresh;
use wslibs\epiiadmin\jscmd\CloseAndRefresh;
class Rolelist extends EpiiController
{
    public function index(){
        $list = Db::name("role")->where("status=1")->select();
        $this->assign("list",$list);

        return $this->fetch();
    }

    public function ajaxdata(){

        $name = trim($this->request->param("name/s"));
        $offset=trim($this->request->param("offset/s"));
        $limit = trim($this->request->param("limit/s"));

        $map = [];
        if(!empty($name)){
            $map[] = ["name","LIKE","%{$name}%"];

        }

        $list = db::name('role')->where($map)->limit($offset,$limit)->select();

        foreach ($list as $k=>$v){
            $list[$k]['status'] = $v['status']==1?"已启用":"未启用";
        }

        return json(["rows" => $list,"total" => $list = db::name('role')->where($map)->count()]);
    }


}