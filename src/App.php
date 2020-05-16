<?php

namespace epii\admin\center;

use epii\admin\center\app\root;
use epii\admin\center\config\AdminCenterCommonInit;
use epii\admin\center\config\AdminCenterPlusInitConfig;
use epii\admin\center\config\UpdateConfig;
use epii\admin\center\libs\AddonsManager;
use epii\app\i\IAppPlusInitConfig;

use epii\server\Args;
use wangshouwei\session\Session;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:34 AM
 */
class App extends \epii\app\App
{

    private $_is_setconfig = false;

    public function __construct($configOrFilePath = null)
    {


        Session::start();
        if (Args::getVal("_vendor") && Args::getVal("_vendor") == 1) {
            if (isset($_REQUEST['app'])) {
                $_REQUEST['app'] = "epii\\admin\\center\\app\\" . $_REQUEST['app'];
            }
        }
        if (!isset($_REQUEST['app'])) {

            $_REQUEST['app'] = root::class . "@start";

        }
        parent::__construct($configOrFilePath);


    }

    public function run($app = null)
    {


        if (!$this->_is_setconfig) {
            $this->setConfig(new AdminCenterPlusInitConfig());
        }

        $this->init(AdminCenterCommonInit::class);


        $this->init(UpdateConfig::class);
     
        $this->init(AddonsManager::class);
       
        AddonsManager::onRequest();
        $this->setBaseNameSpace("epii\\admin\\center\\app");

        parent::run($app);
    }

    public function setConfig(IAppPlusInitConfig $appPlusInitConfig)
    {
        if (!$appPlusInitConfig instanceof AdminCenterPlusInitConfig) {
            echo '$appPlusInitConfig must  extends AdminCenterPlusInitConfig';
            exit;
        }
        $this->_is_setconfig = true;
        ProjectConfig::_setAdminCenterPlusInitConfig($appPlusInitConfig);

        return parent::setConfig($appPlusInitConfig);
    }

    public function setAddonsDevelopment($name){
         Args::setConfig("__addons",$name);
         Args::setConfig("__addons_development",true);
        return $this;
    }
}