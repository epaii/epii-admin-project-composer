<?php

namespace epii\admin\center\traits;

use epii\admin\center\libs\AddonsManager;
use epii\orm\Db;

trait addons_controller{
    protected $addons_info = [];
    protected $addons_config = [];
    protected $static_url_pre = "";
    public function init()
    {

         parent::init();
         $addonsname = AddonsManager::getCurrentAddonsName();
         $config = AddonsManager::getAddonsConfig($addonsname);
         $this->addons_info = $config;
         $this->addons_config = Db::name("setting")->where("addons_id", $config["__data"]["id"])->column("value","name");
         $this->static_url_pre = \epii\server\Tools::get_web_root()."addons_static/".$config["name"];

         
         
    }
}
