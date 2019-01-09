<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 9:16 AM
 */

use app\pluseinit;

require_once __DIR__ . "/../../vendor/epii_admin_project_vendor/autoload.php";

(new \epii\admin\center\App())->setConfig(new pluseinit())->run();