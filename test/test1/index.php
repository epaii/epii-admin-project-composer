<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/11
 * Time: 2:20 PM
 */

require_once __DIR__ . "/../../../vendor/epii_admin_project_vendor/autoload.php";

(new \epii\admin\center\App())->setConfig(new \app\pluseinit())->setDisableNameSpace("app\\pluseinit")->run();