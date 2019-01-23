-- MySQL dump 10.13  Distrib 5.7.17, for osx10.12 (x86_64)
--
-- Host: 192.168.16.6    Database: epii
-- ------------------------------------------------------
-- Server version	5.6.19-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `epii_admin`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epii_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `addtime` int(11) NOT NULL COMMENT '创建时间',
  `updatetime` int(11) NOT NULL COMMENT '更新时间',
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL COMMENT '用户邮箱',
  `photo` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `status` varchar(30) NOT NULL DEFAULT 'normal' COMMENT '状态',
  `group_name` varchar(80) NOT NULL,
  `role` smallint(6) DEFAULT NULL COMMENT '管理员角色',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='管理员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epii_admin`
--

LOCK TABLES `epii_admin` WRITE;
/*!40000 ALTER TABLE `epii_admin` DISABLE KEYS */;
INSERT INTO `epii_admin` VALUES (1,'admin','dd4b21e9ef71e1291183a46b913ae6f2',1546926683,1547449710,'3333355881','1222455','','normal','超级管理员',1);
/*!40000 ALTER TABLE `epii_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epii_node`
--

DROP TABLE IF EXISTS `epii_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epii_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '节点名称',
  `url` varchar(255) DEFAULT NULL COMMENT 'url',
  `status` tinyint(1) DEFAULT '0' COMMENT '状态0未开启,1开启',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` smallint(6) unsigned DEFAULT '255' COMMENT '排序',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级节点ID',
  `icon` varchar(50) NOT NULL COMMENT '图标',
  `badge` varchar(20) DEFAULT NULL COMMENT '小标',
  `is_open` varchar(10) DEFAULT NULL COMMENT '是否默认打开',
  `_blank` tinyint(1) unsigned DEFAULT 0 COMMENT '状态0addtab打开1新窗口打开',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `pid_2` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='节点表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epii_node`
--

LOCK TABLES `epii_node` WRITE;
/*!40000 ALTER TABLE `epii_node` DISABLE KEYS */;
INSERT INTO `epii_node` VALUES (3,'系统中心','',1,'权限管理',2,0,'fa fa fa-cog',NULL,NULL),(4,'管理员列表','?app=admin@index&_vendor=1',1,'管理员列表',1,3,'fa fa-users',NULL,NULL),(5,'导航管理','?app=nodelist@index&_vendor=1',1,'',2,3,'fa fa-bars',NULL,NULL),(6,'角色管理','?app=rolelist@index&_vendor=1',1,'111',8,3,'fa fa-address-card',NULL,'1'),(13,'个人中心','',1,'',10,0,'fa fa-user',NULL,''),(14,'修改资料','?app=user@modify&_vendor=1',1,'',3,13,'fa fa-pencil',NULL,''),(16,'应用设置','?app=config@index&_vendor=1',1,'',20,3,'fa fa-cogs',NULL,''),(17,'后台首页','?app=root@home',1,'请修改为您的连接地址',1,0,'fa fa-dashboard',NULL,NULL),(18,'教程','http://docs.epii-admin.epii.cn/704402',1,'',100,0,'fa fa-circle-o',NULL,NULL);
/*!40000 ALTER TABLE `epii_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epii_role`
--

DROP TABLE IF EXISTS `epii_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epii_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '角色名称',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态0未启用1启用',
  `powers` text,
  `nodes` text,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epii_role`
--

LOCK TABLES `epii_role` WRITE;
/*!40000 ALTER TABLE `epii_role` DISABLE KEYS */;
INSERT INTO `epii_role` VALUES (1,'总管理员',1,'{\"type\":\"2\",\"power\":{\"epii\\\\admin\\\\center\\\\app\\\\admin\":[\"ajaxdata\",\"add\"],\"epii\\\\admin\\\\center\\\\app\\\\nodelist\":[\"add\",\"edit\"],\"epii\\\\admin\\\\center\\\\app\\\\rolelist\":[\"index\",\"ajaxdata\"],\"epii\\\\admin\\\\center\\\\app\\\\test\":[\"index\"],\"epii\\\\admin\\\\center\\\\app\\\\user\":[\"logout\",\"modify\"]}}',NULL),(9,'运维人员',1,'{\"type\":\"1\",\"power\":{\"epii\\\\admin\\\\center\\\\app\\\\root\":[\"home\"],\"epii\\\\admin\\\\center\\\\app\\\\user\":[\"logout\",\"modify\",\"modify_info\"]}}','[\"5\",\"4\",\"17\",0,3,3]'),(10,'技术人员',1,'{\"type\":\"1\",\"power\":{\"epii\\\\admin\\\\center\\\\app\\\\nodelist\":[\"index\",\"ajaxdata\",\"add\"],\"epii\\\\admin\\\\center\\\\app\\\\rolelist\":[\"index\",\"ajaxdata\",\"add\",\"power\",\"nav\"]}}','[\"6\",\"14\",\"17\",0,3,13]');
/*!40000 ALTER TABLE `epii_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `epii_setting`
--

DROP TABLE IF EXISTS `epii_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `epii_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '2' COMMENT '1系统类型0用户类型',
  `addtime` int(11) NOT NULL,
  `tip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `addtime` (`addtime`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `epii_setting`
--

LOCK TABLES `epii_setting` WRITE;
/*!40000 ALTER TABLE `epii_setting` DISABLE KEYS */;
INSERT INTO `epii_setting` VALUES (5,'app.style.nav_theme','gray-light',1,1,'头部样式light primary warning info  danger success gray-light'),(6,'app.style.left_bg_theme','dark',1,1,'左侧背景dark or light'),(7,'app.style.left_top_theme','clear',1,1,'左侧头部背景 clear primary warning info  danger success'),(8,'app.style.left_selected_theme','primary',1,1547189470,'左侧选中时背景primary warning info  danger    success'),(9,'app.logo','https://epaii.github.io/epii-admin/public/epiiadmin-js/img/AdminLTELogo.png',1,1547191738,'左上角logo图标'),(11,'app.title','我的管理中心',1,1547191854,'左侧上部titledd');
/*!40000 ALTER TABLE `epii_setting` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-15 10:25:27
