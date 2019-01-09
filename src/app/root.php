<?php
namespace epii\admin\center\app;

use epii\admin\center\common\_controller;

use epii\admin\center\ProjectConfig;
use epii\ui\login\AdminLogin;
use epii\ui\login\IloginConfig;
use wangshouwei\session\Session;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:04 AM
 */
class root extends _controller
{
    public function start()
    {

        if (!Session::get("is_login"))
            AdminLogin::login(new class implements IloginConfig
            {
                public function onPost(string $username, string $password, &$msg): bool
                {
                    // TODO: Implement onPost() method.
                    Session::set("is_login", 1);
                    return true;
                }

                public function getConfigs(): array
                {
                    // TODO: Implement getConfigs() method.
                    return ["success_url" => "#"];
                }
            });
        else
            $this->adminUiBaseDisplay(ProjectConfig::getAdminUiConfig());

    }

}