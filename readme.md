
install

```json
{
    "require": {
        "epii/admin-center": ">=0.0.1"
    }
}
```

useage:

```php
  (new \epii\admin\center\App())->run();

```

更新的sql语句

```
ALTER TABLE `epii_setting` ADD `uid` INT NOT NULL DEFAULT '0' AFTER `tip`, ADD INDEX (`uid`);
ALTER TABLE `epii_setting` DROP INDEX `name`, ADD UNIQUE `name` (`name`, `uid`) USING BTREE;


```



初始效果

![screen]


[screen]:http://103.131.168.58:8180/app/epii-admin-js/img/screen.png

 
