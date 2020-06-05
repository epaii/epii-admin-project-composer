SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

ALTER TABLE `epii_setting` ADD `addons_id` INT NOT NULL DEFAULT '0' AFTER `uid`, ADD INDEX (`addons_id`);
ALTER TABLE `epii_setting` DROP INDEX `name`, ADD UNIQUE `name` (`name`, `uid`, `addons_id`) USING BTREE;

COMMIT;