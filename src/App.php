<?php

namespace epii\admin\center;

use epii\admin\center\app\root;
use epii\admin\center\config\AdminCenterCommonInit;
use epii\admin\center\config\AdminCenterPlusInitConfig;
use epii\app\i\IAppPlusInitConfig;

use epii\server\Args;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:34 AM
 */
class App extends \epii\app\App
{
    public function __construct()
    {


        if (Args::getVal("_vendor") && Args::getVal("_vendor") == 1) {
            if (isset($_REQUEST['app'])) {
                $_REQUEST['app'] = "epii\\admin\\center\\app\\" . $_REQUEST['app'];
            }
        }
        if (!isset($_REQUEST['app'])) {

            $_REQUEST['app'] = root::class . "@start";

        }
        parent::__construct();

        $this->setBaseNameSpace("epii\\admin\\center\\app");
    }

    public function run($app = null)
    {
        $this->init(AdminCenterCommonInit::class);


        return parent::run($app);
    }

    public function setConfig(IAppPlusInitConfig $appPlusInitConfig)
    {
        if (!$appPlusInitConfig instanceof AdminCenterPlusInitConfig) {
            echo '$appPlusInitConfig must  extends AdminCenterPlusInitConfig';
            exit;
        }
        ProjectConfig::_setAdminCenterPlusInitConfig($appPlusInitConfig);

        return parent::setConfig($appPlusInitConfig);
    }
}