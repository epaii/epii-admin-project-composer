<?php
namespace epii\admin\center\app;
use epii\ui\login\AdminLogin;
use epii\ui\login\IloginConfig;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/9
 * Time: 10:04 AM
 */
class root
{
    public function start()
    {

        AdminLogin::login(new class implements IloginConfig{
            public function onPost(string $username, string $password, &$msg): bool
            {
                // TODO: Implement onPost() method.
                return true;
            }

            public function getConfigs(): array
            {
                // TODO: Implement getConfigs() method.
                return ["success_url"=>""];
            }
        });
    }

}