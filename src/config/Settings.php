<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2019/1/11
 * Time: 9:07 AM
 */

namespace epii\admin\center\config;


use epii\admin\center\ProjectConfig;
use think\Db;

class Settings
{
    public static function _saveCache()
    {
        $map = Db::name("setting")->column("value", "name");
        return file_put_contents(self::getCachefile(), "<?php return  " . var_export($map, true) . " ;");

    }

    private static function getCachefile()
    {

        $cachedir = ($dir = ProjectConfig::getAdminCenterPlusInitConfig()->get_cache_dir() . DIRECTORY_SEPARATOR . "setting") . DIRECTORY_SEPARATOR . "setting.php";
        if (!is_dir($dir))
            mkdir($dir, 0777, true);
        return $cachedir;
    }

    public static function get($key = null,$defualt_value="")
    {

        if (!is_file($file = self::getCachefile())) {
            if (!self::_saveCache()) {
                echo "setting cache file write error";
                exit();
            }
        }
        $map = include_once $file;
        if ($key) {
            if (is_string($key)) {
                if (isset($map[$key])) return $map[$key];
                else return $defualt_value;
            } elseif (is_array($key)) {
                $out = [];
                foreach ($key as $item) {
                    $out[$item] = isset($map[$item]) ? $map[$item] : $defualt_value;
                }
                return $out;
            }
        } else {
            return $map;
        }
        return null;
    }
}