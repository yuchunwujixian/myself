-- MySQL dump 10.13  Distrib 5.5.59, for Linux (x86_64)
--
-- Host: localhost    Database: demo1_atmomo_cn
-- ------------------------------------------------------
-- Server version	5.5.59-log

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
-- Table structure for table `zm_admin`
--

DROP TABLE IF EXISTS `zm_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `qq` varchar(15) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `group_id` int(10) NOT NULL DEFAULT '1',
  `status` varchar(10) NOT NULL DEFAULT '1',
  `create_time` int(10) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_admin`
--

LOCK TABLES `zm_admin` WRITE;
/*!40000 ALTER TABLE `zm_admin` DISABLE KEYS */;
INSERT INTO `zm_admin` VALUES (1,'admin','超级管理员','e8e1dbd76c23fd7d9710ceb81c620521','/static/assets/img/avatar.png','','3133430','15888888888',1,'normal',NULL,NULL);
/*!40000 ALTER TABLE `zm_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_adsense`
--

DROP TABLE IF EXISTS `zm_adsense`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_adsense` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '广告位ID',
  `title` varchar(100) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `parame` varchar(1000) DEFAULT NULL,
  `weigh` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_adsense`
--

LOCK TABLES `zm_adsense` WRITE;
/*!40000 ALTER TABLE `zm_adsense` DISABLE KEYS */;
INSERT INTO `zm_adsense` VALUES (1,1,'小米8','/uploads/20180709/74b56a49cad51d7a3726185381d35d31.jpg','',0);
/*!40000 ALTER TABLE `zm_adsense` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_attribute`
--

DROP TABLE IF EXISTS `zm_attribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_attribute` (
  `attr_id` int(10) NOT NULL AUTO_INCREMENT,
  `attr_name` varchar(200) NOT NULL,
  `spec_id_array` varchar(500) DEFAULT NULL,
  `weigh` int(10) DEFAULT '0',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_attribute`
--

LOCK TABLES `zm_attribute` WRITE;
/*!40000 ALTER TABLE `zm_attribute` DISABLE KEYS */;
INSERT INTO `zm_attribute` VALUES (1,'手机','1,2',0,NULL,NULL),(2,'电脑','3,4',0,NULL,NULL),(3,'衣服','5',0,NULL,NULL);
/*!40000 ALTER TABLE `zm_attribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_config`
--

DROP TABLE IF EXISTS `zm_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_config` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `base` text,
  `sms` text,
  `email` text,
  `shop` text,
  `app` text,
  `wxpay` text,
  `alipay` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_config`
--

LOCK TABLES `zm_config` WRITE;
/*!40000 ALTER TABLE `zm_config` DISABLE KEYS */;
INSERT INTO `zm_config` VALUES (1,'{\"title\":\"装饰公司\",\"keywords\":\"装饰公司\",\"description\":\"装饰公司\"}','{\"access_key_id\":\"LTAIybbPCsfoh0hp\",\"access_key_secret\":\"Al2US7MEaNSNgG3Iw3zzSd9r2zRPt7\",\"register_code\":\"SMS_100445079\",\"find_code\":\"SMS_100445078\",\"test_code\":\"SMS_100445082\",\"sign\":\"莫莫电子科技\",\"admin_mobile\":\"15537591106\"}',NULL,'{\"return1\":\"3\",\"return2\":\"2\",\"return3\":\"1\",\"postType\":{\"field\":[\"sf\",\"st\",\"yt\"],\"value\":[\"顺丰\",\"申通\",\"圆通\"]}}','{\"version\":\"1.0\",\"download\":\"www.baidi.com\"}',NULL,'{\"user\":\"97401725@qq.com\",\"appid\":\"2017092608941037\",\"privatekey\":\"MIICXAIBAAKBgQCk3R7CZuJH\\/T4g6gP\\/rD5qOMYxrPBiFbTt11xsZvosP1oquOyfV3woHZ6mGi+z2N3vHfvlcCBiRsDgP9ElvRMVscG\\/tZvr2U4+qHB2PamvdRfOVHkPK6oYL7WfRjXRpD0mIYwqSeb9ies0NrkWHQPt0MTbEUA7zONA2k+DDR9DWQIDAQABAoGAeTkyDeXSyvZWAaOxDwVa24YljY9JLgYiBKTPi9HocDKhHTremoecfm7RIfetTcPP5KwadWmOFlVKK1ohcmtlpOa+T\\/mVsyZ\\/qCTWEXRq+k7BesJf6KECQOIloMu3NtETjchEf8mEMtw1MZAlIc31JSI0E8y8wktcNEByiuyusFUCQQDVEzsHO3f37KLmGR\\/4SRSlf1XS0YNsre8N2kbIQiHGwhyKqQHfxGzM3xaYvUMM2XM2\\/PDt8WZMls7uJNDkW8TTAkEAxhOE+VDAJPYn9jiZCkj6AA0fknQ\\/yiAyAzI279xUrQ5UixDStvEnESnw2Pwoz3Smfs8EbLuyIsKgh7s5OeirowJAaCPJAuTm4q6ug2WeQXx+cdDFgo9R+6kbIJshYzknRvySdJbbyqE3R\\/51DdvazInvDN4dZz5H8ID4zF4EFshfbwJBAIPvWoJKpEG6aLHbzyyHoWZJV39QyXCT81wnpWotg4Vl5zBeO0y54oDPQ+r0Qya0F3ad49+dQjFfHFhsf9ivvysCQHVtqilbLN1mGANeUF7f65oYVLlvJH7vxke5LuKEZXNPhSYpxsnqLVZWFpj0mjNE4ws6vkPuKlWg5AhgXZLlDos=\"}');
/*!40000 ALTER TABLE `zm_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_content`
--

DROP TABLE IF EXISTS `zm_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_content` (
  `content_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `author` varchar(20) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `content` text,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `weigh` int(10) DEFAULT '0',
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_content`
--

LOCK TABLES `zm_content` WRITE;
/*!40000 ALTER TABLE `zm_content` DISABLE KEYS */;
INSERT INTO `zm_content` VALUES (1,'关于我们','admin',0,1,'','','<p>关于我们</p>',1506776650,1511858532,0,'normal'),(2,'公司简介','admin',0,1,'','','<p>公司简介<br></p>',1506776650,1512708103,0,'normal'),(3,'产品介绍','admin',1,1,'','','<p style=\"text-align: left;\">产品介绍<br></p>',1506776650,1512708126,0,'normal');
/*!40000 ALTER TABLE `zm_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_content_category`
--

DROP TABLE IF EXISTS `zm_content_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_content_category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `pid` int(10) NOT NULL DEFAULT '0',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weigh` int(10) NOT NULL DEFAULT '0',
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_content_category`
--

LOCK TABLES `zm_content_category` WRITE;
/*!40000 ALTER TABLE `zm_content_category` DISABLE KEYS */;
INSERT INTO `zm_content_category` VALUES (1,'APP',0,'','',0,'normal'),(2,'公司相关',0,'2','',0,'normal');
/*!40000 ALTER TABLE `zm_content_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_goods`
--

DROP TABLE IF EXISTS `zm_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_goods` (
  `goods_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `goods_name` varchar(100) NOT NULL COMMENT '商品名称',
  `admin_id` int(10) NOT NULL COMMENT '所属用户',
  `category_id` int(10) NOT NULL COMMENT '分类id',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `freight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int(10) NOT NULL DEFAULT '0' COMMENT '库存',
  `picture` varchar(255) DEFAULT NULL COMMENT '主图',
  `images` text COMMENT '图片列表',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `introduction` varchar(1000) DEFAULT NULL COMMENT '简介',
  `description` text COMMENT '描述',
  `attr_id` int(10) DEFAULT NULL COMMENT '商品类型',
  `spec` varchar(500) DEFAULT NULL COMMENT '商品规格',
  `spec_array` longtext,
  `volume` int(10) DEFAULT '0' COMMENT '销量',
  `unit` varchar(20) DEFAULT NULL COMMENT '单位',
  `recommend` varchar(500) DEFAULT NULL COMMENT '推荐位',
  `status` text NOT NULL COMMENT '商品状态',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `weigh` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_goods`
--

LOCK TABLES `zm_goods` WRITE;
/*!40000 ALTER TABLE `zm_goods` DISABLE KEYS */;
INSERT INTO `zm_goods` VALUES (1,'小米8SE',0,8,1799.00,0.00,198,'/uploads/20180709/527f0343db13e2a76bd29cb62133f6ac.jpg','/uploads/20180709/b8e3d7ff17637088d0c3fcb08f323d3a.jpg,/uploads/20180709/ec9bd670cf6d5064a07218318ce9dbff.jpg','','','<p><img style=\"width: 603px;\" src=\"/uploads/20180709/3accf253368af92d1c71df62f34eb479.jpg\" data-filename=\"filename\"></p><p><img style=\"width: 603px;\" src=\"/uploads/20180709/d194828e0b86d17a2351cd6a2f305847.jpg\" data-filename=\"filename\"><br></p>',1,'{\"1\":[\"1\",\"2\"],\"2\":[\"5\"]}','[{\"spec_id\":1,\"spec_name\":\"\\u5185\\u5b58\",\"spec_desc\":\"\\u5185\\u5b58\\u5927\\u5c0f\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":1,\"spec_id\":1,\"spec_value_name\":\"4G\",\"create_time\":\"2018-07-09 17:04:51\",\"update_time\":\"2018-07-09 17:05:04\"},{\"spec_value_id\":2,\"spec_id\":1,\"spec_value_name\":\"6G\",\"create_time\":\"2018-07-09 17:04:51\",\"update_time\":\"2018-07-09 17:05:07\"}]},{\"spec_id\":2,\"spec_name\":\"\\u5b58\\u50a8\",\"spec_desc\":\"\\u5b58\\u50a8\\u7a7a\\u95f4\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":5,\"spec_id\":2,\"spec_value_name\":\"64G\",\"create_time\":\"2018-07-09 17:06:06\",\"update_time\":\"1970-01-01 08:00:00\"}]}]',0,'台','[\"1\",\"2\",\"3\"]','normal',1531127552,1531128652,0),(2,'小米6X 初音未来版',0,8,1799.00,0.00,39996,'/uploads/20180709/b3236177c464aa46645910e8a546adea.jpg','/uploads/20180709/d9fb4e37f330453ad8c37666b76112e0.jpg,/uploads/20180709/6ed10d057a514392bc90ee435e9d55cb.jpg','','','<p><img style=\"width: 603px;\" src=\"/uploads/20180709/fa61dd7376ee2e61d78de951742a837b.jpg\" data-filename=\"filename\"><img style=\"width: 603px;\" src=\"/uploads/20180709/dc7b5cde01322ea007dd76168b5d8a1b.jpg\" data-filename=\"filename\"><img style=\"width: 603px;\" src=\"/uploads/20180709/9c7d913c09f5f271d208705f5bd08432.jpg\" data-filename=\"filename\"><br></p>',1,'{\"1\":[\"1\",\"2\"],\"2\":[\"4\",\"5\",\"6\"]}','[{\"spec_id\":1,\"spec_name\":\"\\u5185\\u5b58\",\"spec_desc\":\"\\u5185\\u5b58\\u5927\\u5c0f\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":1,\"spec_id\":1,\"spec_value_name\":\"4G\",\"create_time\":\"2018-07-09 17:04:51\",\"update_time\":\"2018-07-09 17:05:04\"},{\"spec_value_id\":2,\"spec_id\":1,\"spec_value_name\":\"6G\",\"create_time\":\"2018-07-09 17:04:51\",\"update_time\":\"2018-07-09 17:05:07\"}]},{\"spec_id\":2,\"spec_name\":\"\\u5b58\\u50a8\",\"spec_desc\":\"\\u5b58\\u50a8\\u7a7a\\u95f4\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":4,\"spec_id\":2,\"spec_value_name\":\"32G\",\"create_time\":\"2018-07-09 17:06:06\",\"update_time\":\"1970-01-01 08:00:00\"},{\"spec_value_id\":5,\"spec_id\":2,\"spec_value_name\":\"64G\",\"create_time\":\"2018-07-09 17:06:06\",\"update_time\":\"1970-01-01 08:00:00\"},{\"spec_value_id\":6,\"spec_id\":2,\"spec_value_name\":\"128G\",\"create_time\":\"2018-07-09 17:06:06\",\"update_time\":\"1970-01-01 08:00:00\"}]}]',0,'台','[\"1\",\"2\",\"3\"]','normal',1531127776,1531128657,0),(3,'iphoneX',0,10,7799.00,0.00,198,'/uploads/20180709/b3740361dde13416a51f48813672be10.jpg','/uploads/20180709/4f62fd3cb67a04e2b2ff0ce8d4d4ea46.jpg','','','',1,'{\"2\":[\"5\",\"6\"]}','[{\"spec_id\":2,\"spec_name\":\"\\u5b58\\u50a8\",\"spec_desc\":\"\\u5b58\\u50a8\\u7a7a\\u95f4\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":5,\"spec_id\":2,\"spec_value_name\":\"64G\",\"create_time\":\"2018-07-09 17:06:06\",\"update_time\":\"1970-01-01 08:00:00\"},{\"spec_value_id\":6,\"spec_id\":2,\"spec_value_name\":\"128G\",\"create_time\":\"2018-07-09 17:06:06\",\"update_time\":\"1970-01-01 08:00:00\"}]}]',0,'台','[\"1\",\"2\",\"3\"]','normal',1531127890,1531128663,0),(4,'联想台式整机',0,16,4999.00,0.00,198,'/uploads/20180709/0d20469006f4eedba916f18f8792d8ef.jpg','/uploads/20180709/0f0c9211faaaeee8d4c70ad3d37f6497.jpg','','','',2,'{\"3\":[\"9\",\"10\"]}','[{\"spec_id\":3,\"spec_name\":\"\\u786c\\u76d8\\u5927\\u5c0f\",\"spec_desc\":\"\\u786c\\u76d8\\u5927\\u5c0f\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":9,\"spec_id\":3,\"spec_value_name\":\"500G\",\"create_time\":\"2018-07-09 17:09:07\",\"update_time\":\"1970-01-01 08:00:00\"},{\"spec_value_id\":10,\"spec_id\":3,\"spec_value_name\":\"1T\",\"create_time\":\"2018-07-09 17:09:07\",\"update_time\":\"1970-01-01 08:00:00\"}]}]',0,'台','[\"1\",\"2\",\"3\"]','normal',1531127959,1531128671,0),(5,'七匹狼男装上衣',0,3,39.00,0.00,297,'/uploads/20180709/ce8ad9d3b2e6350f7112d762cb844c27.jpg','/uploads/20180709/d62de38967589aa0ee53c0532beb2d00.jpg','','','',3,'{\"5\":[\"17\",\"18\",\"19\"]}','[{\"spec_id\":5,\"spec_name\":\"\\u5c3a\\u7801\",\"spec_desc\":\"\\u5c3a\\u7801\",\"create_time\":\"1970-01-01 08:00:00\",\"weigh\":0,\"values\":[{\"spec_value_id\":17,\"spec_id\":5,\"spec_value_name\":\"165\",\"create_time\":\"2018-07-09 17:22:23\",\"update_time\":\"1970-01-01 08:00:00\"},{\"spec_value_id\":18,\"spec_id\":5,\"spec_value_name\":\"170\",\"create_time\":\"2018-07-09 17:22:23\",\"update_time\":\"1970-01-01 08:00:00\"},{\"spec_value_id\":19,\"spec_id\":5,\"spec_value_name\":\"180\",\"create_time\":\"2018-07-09 17:22:23\",\"update_time\":\"1970-01-01 08:00:00\"}]}]',0,'件','[\"1\",\"2\",\"3\"]','normal',1531128097,1535820889,0);
/*!40000 ALTER TABLE `zm_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_goods_category`
--

DROP TABLE IF EXISTS `zm_goods_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_goods_category` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `pid` int(10) NOT NULL DEFAULT '0',
  `is_visible` int(1) NOT NULL DEFAULT '1',
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `weigh` int(10) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_goods_category`
--

LOCK TABLES `zm_goods_category` WRITE;
/*!40000 ALTER TABLE `zm_goods_category` DISABLE KEYS */;
INSERT INTO `zm_goods_category` VALUES (1,'手机',0,1,'','',0,'/uploads/20180709/2b50660a824bbdd213d70edcfceb30cc.jpg','normal'),(2,'电脑',0,1,'','',0,'/uploads/20180709/1ae3b3e5ba263864d058dd8f1e0bc4d1.jpg','normal'),(3,'男装',0,1,'','',0,'/uploads/20180709/b74b33bbf3feee529738890848fa84ac.jpg','normal'),(4,'女装',0,1,'','',0,'/uploads/20180709/000a57f469efe2df88bfc3858bd775d3.jpg','normal'),(5,'数码',0,1,'','',0,'/uploads/20180709/8e32367a17807301bcb2c160d4033ab1.jpg','normal'),(6,'家电',0,1,'','',0,'/uploads/20180709/989182fbb674436d9cbd9e354b2ccd48.jpg','normal'),(7,'玩具',0,1,'','',0,'/uploads/20180709/a2ed86dad487be184d01249412ce6e05.jpg','normal'),(8,'小米',1,1,'','',0,'','normal'),(9,'华为',1,1,'','',0,'','normal'),(10,'苹果',1,1,'','',0,'','normal'),(11,'oppo',1,1,'','',0,'','normal'),(12,'vivo',1,1,'','',0,'','normal'),(13,'笔记本',2,1,'','',0,'','normal'),(14,'一体机',2,1,'','',0,'','normal'),(15,'平板',2,1,'','',0,'','normal'),(16,'整机',2,1,'','',0,'','normal');
/*!40000 ALTER TABLE `zm_goods_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_goods_sku`
--

DROP TABLE IF EXISTS `zm_goods_sku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_goods_sku` (
  `sku_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'sku id',
  `goods_id` int(10) NOT NULL COMMENT '商品id',
  `code` varchar(200) DEFAULT NULL COMMENT '商家编码',
  `sku_name` varchar(500) NOT NULL COMMENT 'sku 名称',
  `attr_value` varchar(1000) NOT NULL DEFAULT '属性值',
  `attr_value_array` varchar(2000) NOT NULL COMMENT '属性值数组形式',
  `price` decimal(10,2) NOT NULL COMMENT '价格',
  `stock` int(10) NOT NULL DEFAULT '0',
  `image` varchar(200) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`sku_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_goods_sku`
--

LOCK TABLES `zm_goods_sku` WRITE;
/*!40000 ALTER TABLE `zm_goods_sku` DISABLE KEYS */;
INSERT INTO `zm_goods_sku` VALUES (36,1,'','4G/64G','1:1;2:5','[[\"1\",\"1\"],[\"2\",\"5\"]]',1799.00,99,'',1531128652,NULL),(37,1,'','6G/64G','1:2;2:5','[[\"1\",\"2\"],[\"2\",\"5\"]]',1999.00,99,'',1531128652,NULL),(39,2,'','4G/32G','1:1;2:4','[[\"1\",\"1\"],[\"2\",\"4\"]]',1399.00,9999,'',1531128657,NULL),(40,2,'','4G/64G','1:1;2:5','[[\"1\",\"1\"],[\"2\",\"5\"]]',1599.00,9999,'',1531128657,NULL),(41,2,'','4G/128G','1:1;2:6','[[\"1\",\"1\"],[\"2\",\"6\"]]',0.00,0,'',1531128657,NULL),(42,2,'','6G/32G','1:2;2:4','[[\"1\",\"2\"],[\"2\",\"4\"]]',0.00,0,'',1531128657,NULL),(43,2,'','6G/64G','1:2;2:5','[[\"1\",\"2\"],[\"2\",\"5\"]]',1799.00,9999,'',1531128657,NULL),(44,2,'','6G/128G','1:2;2:6','[[\"1\",\"2\"],[\"2\",\"6\"]]',1999.00,9999,'',1531128657,NULL),(46,3,'','64G','2:5','[[\"2\",\"5\"]]',7799.00,99,'',1531128663,NULL),(47,3,'','128G','2:6','[[\"2\",\"6\"]]',8899.00,99,'',1531128663,NULL),(49,4,'','500G','3:9','[[\"3\",\"9\"]]',4999.00,99,'',1531128671,NULL),(50,4,'','1T','3:10','[[\"3\",\"10\"]]',5999.00,99,'',1531128671,NULL),(55,5,'222','165','5:17','[[\"5\",\"17\"]]',39.00,99,'',1535820889,NULL),(56,5,'','170','5:18','[[\"5\",\"18\"]]',39.00,99,'',1535820889,NULL),(57,5,'','180','5:19','[[\"5\",\"19\"]]',39.00,99,'',1535820889,NULL);
/*!40000 ALTER TABLE `zm_goods_sku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_goods_spec`
--

DROP TABLE IF EXISTS `zm_goods_spec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_goods_spec` (
  `spec_id` int(10) NOT NULL AUTO_INCREMENT,
  `spec_name` varchar(200) NOT NULL,
  `spec_desc` varchar(200) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `weigh` int(10) DEFAULT '0',
  PRIMARY KEY (`spec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_goods_spec`
--

LOCK TABLES `zm_goods_spec` WRITE;
/*!40000 ALTER TABLE `zm_goods_spec` DISABLE KEYS */;
INSERT INTO `zm_goods_spec` VALUES (1,'内存','内存大小',NULL,0),(2,'存储','存储空间',NULL,0),(3,'硬盘大小','硬盘大小',NULL,0),(4,'硬盘类型','硬盘类型',NULL,0),(5,'尺码','尺码',NULL,0);
/*!40000 ALTER TABLE `zm_goods_spec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_goods_spec_value`
--

DROP TABLE IF EXISTS `zm_goods_spec_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_goods_spec_value` (
  `spec_value_id` int(10) NOT NULL AUTO_INCREMENT,
  `spec_id` int(10) DEFAULT NULL,
  `spec_value_name` varchar(200) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`spec_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_goods_spec_value`
--

LOCK TABLES `zm_goods_spec_value` WRITE;
/*!40000 ALTER TABLE `zm_goods_spec_value` DISABLE KEYS */;
INSERT INTO `zm_goods_spec_value` VALUES (1,1,'4G',1531127091,1531127104),(2,1,'6G',1531127091,1531127107),(3,1,'8G',1531127091,1531127114),(4,2,'32G',1531127166,NULL),(5,2,'64G',1531127166,NULL),(6,2,'128G',1531127166,NULL),(7,3,'128G',1531127347,NULL),(8,3,'256G',1531127347,NULL),(9,3,'500G',1531127347,NULL),(10,3,'1T',1531127347,NULL),(14,4,'固态',1531127369,NULL),(15,4,'普通',1531127369,NULL),(17,5,'165',1531128143,NULL),(18,5,'170',1531128143,NULL),(19,5,'180',1531128143,NULL);
/*!40000 ALTER TABLE `zm_goods_spec_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_group`
--

DROP TABLE IF EXISTS `zm_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_group` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `weigh` int(10) DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_group`
--

LOCK TABLES `zm_group` WRITE;
/*!40000 ALTER TABLE `zm_group` DISABLE KEYS */;
INSERT INTO `zm_group` VALUES (1,'超级管理员',258633),(3,'1',0);
/*!40000 ALTER TABLE `zm_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_order`
--

DROP TABLE IF EXISTS `zm_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_order` (
  `order_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `uid` int(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `post_time` int(10) DEFAULT NULL,
  `post_type` varchar(50) DEFAULT NULL COMMENT '配送方式',
  `post_id` varchar(50) DEFAULT NULL,
  `pay_type` varchar(50) DEFAULT NULL COMMENT '支付方式',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `link_name` varchar(50) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_order`
--

LOCK TABLES `zm_order` WRITE;
/*!40000 ALTER TABLE `zm_order` DISABLE KEYS */;
INSERT INTO `zm_order` VALUES (1,'2018072256981005',1999.00,15,1532244808,1532244808,1,NULL,'',NULL,NULL,NULL,'可口可乐了','13396986857','健健康康健健康康'),(2,'2018072748991005',1999.00,16,1532663136,1532663136,1,NULL,'',NULL,NULL,NULL,'555','13535565711','枝'),(3,'2018080451579749',5999.00,17,1533351715,1533351715,99,1534578662,'','',NULL,NULL,'18607835800','18607835800','所以现在'),(4,'2018081057494851',7799.00,18,1533889561,1533889561,1,NULL,'',NULL,NULL,NULL,'王青','13951645558','热情洋溢'),(5,'2018081010298491',7799.00,18,1533889583,1533889583,-1,NULL,'',NULL,NULL,NULL,'王青','13951645558','热情洋溢'),(6,'2018081098545210',7799.00,18,1533889595,1533889595,-1,NULL,'',NULL,NULL,NULL,'王青','13951645558','热情洋溢'),(7,'2018081099102515',7799.00,18,1533889660,1533889660,-1,1535444880,'nfgaiong','gfvnasoibm',NULL,NULL,'王青','13951645558','热情洋溢'),(8,'2018090249984910',1799.00,19,1535864961,1535864961,1,NULL,'',NULL,NULL,NULL,'测试名称','17765528199','测试地址'),(9,'2018090297555154',5999.00,19,1535867338,1535867338,1,NULL,'',NULL,NULL,NULL,'测试','13888888888','测试'),(10,'2018090854575156',9798.00,18,1536403414,1536403414,1,NULL,'',NULL,NULL,NULL,'无用功','13951645558','默默');
/*!40000 ALTER TABLE `zm_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_order_goods`
--

DROP TABLE IF EXISTS `zm_order_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_order_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `goods_name` varchar(100) DEFAULT NULL,
  `sku_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL COMMENT '购买时的价格 或客史价',
  `num` int(10) DEFAULT '1',
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_order_goods`
--

LOCK TABLES `zm_order_goods` WRITE;
/*!40000 ALTER TABLE `zm_order_goods` DISABLE KEYS */;
INSERT INTO `zm_order_goods` VALUES (1,1,'小米8SE','6G/64G',1999.00,1,'/uploads/20180709/527f0343db13e2a76bd29cb62133f6ac.jpg'),(2,2,'小米6X 初音未来版','6G/128G',1999.00,1,'/uploads/20180709/b3236177c464aa46645910e8a546adea.jpg'),(3,3,'联想台式整机','1T',5999.00,1,'/uploads/20180709/0d20469006f4eedba916f18f8792d8ef.jpg'),(4,4,'iphoneX','64G',7799.00,1,'/uploads/20180709/b3740361dde13416a51f48813672be10.jpg'),(5,5,'iphoneX','64G',7799.00,1,'/uploads/20180709/b3740361dde13416a51f48813672be10.jpg'),(6,6,'iphoneX','64G',7799.00,1,'/uploads/20180709/b3740361dde13416a51f48813672be10.jpg'),(7,7,'iphoneX','64G',7799.00,1,'/uploads/20180709/b3740361dde13416a51f48813672be10.jpg'),(8,8,'小米8SE','4G/64G',1799.00,1,'/uploads/20180709/527f0343db13e2a76bd29cb62133f6ac.jpg'),(9,9,'联想台式整机','1T',5999.00,1,'/uploads/20180709/0d20469006f4eedba916f18f8792d8ef.jpg'),(10,10,'小米8SE','6G/64G',1999.00,1,'/uploads/20180709/527f0343db13e2a76bd29cb62133f6ac.jpg'),(11,10,'iphoneX','64G',7799.00,1,'/uploads/20180709/b3740361dde13416a51f48813672be10.jpg');
/*!40000 ALTER TABLE `zm_order_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_point_log`
--

DROP TABLE IF EXISTS `zm_point_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_point_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL DEFAULT '0' COMMENT '用户',
  `object_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目id',
  `action_uid` int(10) DEFAULT NULL COMMENT '来源用户ID',
  `num` decimal(10,2) NOT NULL DEFAULT '0.00',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT '1，推广订单奖励|2，提现扣除|3，提现拒绝返回',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_point_log`
--

LOCK TABLES `zm_point_log` WRITE;
/*!40000 ALTER TABLE `zm_point_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_point_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_position`
--

DROP TABLE IF EXISTS `zm_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT '广告位名称',
  `width` int(5) DEFAULT NULL,
  `height` int(5) DEFAULT NULL,
  `param` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_position`
--

LOCK TABLES `zm_position` WRITE;
/*!40000 ALTER TABLE `zm_position` DISABLE KEYS */;
INSERT INTO `zm_position` VALUES (1,'APP首页轮播图',0,0,NULL);
/*!40000 ALTER TABLE `zm_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_task`
--

DROP TABLE IF EXISTS `zm_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_task` (
  `task_id` int(10) NOT NULL AUTO_INCREMENT,
  `task_goods_ids` varchar(100) NOT NULL COMMENT '任务商品id',
  `title` varchar(100) NOT NULL COMMENT '名称',
  `task_no` varchar(50) DEFAULT NULL,
  `post_address` varchar(200) DEFAULT NULL,
  `post_name` varchar(50) DEFAULT NULL,
  `post_no` varchar(100) DEFAULT NULL,
  `post_phone` varchar(15) DEFAULT NULL,
  `link_name` varchar(100) DEFAULT NULL,
  `link_type` varchar(100) DEFAULT NULL COMMENT '联系方式',
  `buyer` varchar(100) DEFAULT NULL COMMENT '购买者',
  `address` varchar(400) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00' COMMENT '金额',
  `pay_type` varchar(200) DEFAULT NULL COMMENT '付款方式',
  `do_user` varchar(50) DEFAULT NULL,
  `action_user` varchar(50) DEFAULT NULL COMMENT '经办人',
  `remark` varchar(1000) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_task`
--

LOCK TABLES `zm_task` WRITE;
/*!40000 ALTER TABLE `zm_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_task_goods`
--

DROP TABLE IF EXISTS `zm_task_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_task_goods` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL COMMENT '商品编号',
  `goods_name` varchar(200) DEFAULT '' COMMENT '商品名称',
  `num` int(10) DEFAULT NULL COMMENT '数量',
  `price` decimal(10,2) DEFAULT '0.00',
  `unit` varchar(10) DEFAULT '' COMMENT '单位',
  `remark` varchar(500) DEFAULT NULL COMMENT '备注',
  `status` int(1) DEFAULT '0' COMMENT '是否执行',
  `create_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_task_goods`
--

LOCK TABLES `zm_task_goods` WRITE;
/*!40000 ALTER TABLE `zm_task_goods` DISABLE KEYS */;
INSERT INTO `zm_task_goods` VALUES (1,'222','七匹狼男装上衣/165',1,39.00,'件','',0,1535820900);
/*!40000 ALTER TABLE `zm_task_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_user`
--

DROP TABLE IF EXISTS `zm_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `sex` int(1) DEFAULT '0',
  `avatar` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `login_time` int(10) DEFAULT NULL,
  `register_time` int(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT '1',
  `level` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  `point` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_user`
--

LOCK TABLES `zm_user` WRITE;
/*!40000 ALTER TABLE `zm_user` DISABLE KEYS */;
INSERT INTO `zm_user` VALUES (5,'test','','e8e1dbd76c23fd7d9710ceb81c620521','测试用户',1,'/static/assets/img/avatar.png','test@qq.com',NULL,NULL,'normal',NULL,'5e5d4c706d25d79fa484617cd0b2b668',NULL,0.00),(7,'','15555555555','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1505654616,'normal',NULL,NULL,6,0.00),(9,'','15555555556','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1505655252,'normal',NULL,'94676d33b0ae68cbd6377dab23893099',7,16910.00),(10,'','15537591106','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1511859752,'normal',NULL,'515f46da7709ad21f4daaafd3bd608f0',NULL,0.00),(11,'','15021283840','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1511864055,'normal',NULL,'3e0b0d123ef31f9abd17f9f3bd6d099f',NULL,0.00),(12,'','15601721657','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1512353538,'normal',NULL,'cfe94e2cb1ff844f5eafcc3a5225a92a',NULL,0.00),(13,'','15921187109','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1512368941,'normal',NULL,'e1081a33127694e2b6f6ee44e6b1fd66',NULL,0.00),(14,'','18001869183','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1512548763,'normal',NULL,'50622287d99beabe9ff5ca5a361fca4b',NULL,0.00),(15,'','13396986857','6d829dfaafe43ab47c5d5de691286d20',NULL,0,NULL,NULL,NULL,1532244579,'normal',NULL,'cfc6af2518e55edbd01fd429970eadfe',NULL,0.00),(16,'','13535565711','8efd0432e656882255edcc01dec5b334',NULL,0,NULL,NULL,NULL,1532663076,'normal',NULL,'4d357cefce41808362228aa808b6beb0',NULL,0.00),(17,'','18607835800','e8e1dbd76c23fd7d9710ceb81c620521',NULL,0,NULL,NULL,NULL,1533351663,'normal',NULL,'5c8cc3e65fff723a854f499fd1141a95',NULL,0.00),(18,'admin','13951645558','e8e1dbd76c23fd7d9710ceb81c620521','123',0,'','12123@123.com',NULL,1533889467,'normal',NULL,'8e9af3102949a48f467e9dcedb5faff0',NULL,0.00),(19,'','17765528199','77ecaa953df55022f7294e9c97dedd11',NULL,0,NULL,NULL,NULL,1535864924,'normal',NULL,'4ff15a32ab4b618d990e2059fc2ce58e',NULL,0.00);
/*!40000 ALTER TABLE `zm_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_withdrawals`
--

DROP TABLE IF EXISTS `zm_withdrawals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_withdrawals` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `point` decimal(10,2) DEFAULT NULL,
  `ali_id` varchar(50) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `create_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_withdrawals`
--

LOCK TABLES `zm_withdrawals` WRITE;
/*!40000 ALTER TABLE `zm_withdrawals` DISABLE KEYS */;
INSERT INTO `zm_withdrawals` VALUES (9,6,50.00,'1',-1,1505919957),(10,6,100.00,'test@qq.com',99,1505925047);
/*!40000 ALTER TABLE `zm_withdrawals` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-09 22:48:06


-- 表字段修改
-- 2018-09-11
alter table zm_goods_category add `foreign_key` varchar(255) DEFAULT NULL  COMMENT '外键id';
alter table zm_goods_category add `uptime` varchar(255) DEFAULT NULL  COMMENT '修改时间';
-- 2018-09-12
alter table zm_goods add `foreign_key` varchar(255) DEFAULT NULL  COMMENT '外键id';
alter table zm_goods add `uptime` varchar(255) DEFAULT NULL  COMMENT '修改时间';
alter table zm_goods add `isdiscount` tinyint(1) DEFAULT 0  COMMENT '允许打折, 1是，0否, 默认';
alter table zm_goods add `taxrate` decimal(18, 6) DEFAULT 0  COMMENT '税率（%）';
-- 2018-09-14
alter table zm_user add `foreign_key` varchar(255) DEFAULT NULL  COMMENT '外键id';
alter table zm_user add `uptime` varchar(255) DEFAULT NULL  COMMENT '修改时间';
alter table zm_user add `isusecustomerprice` tinyint(1) DEFAULT 0  COMMENT '是否使用客史，1 是，0 否。取值为0';
alter table zm_user add `pricesystemid` varchar(255) DEFAULT NULL  COMMENT '价格体系，自动写值，从sz_pricesystem取值（“零售价”对应的id）';
alter table zm_order add `foreign_key` varchar(255) DEFAULT NULL  COMMENT '外键id';
alter table zm_order add `uptime` varchar(255) DEFAULT NULL  COMMENT '修改时间';
alter table zm_order_goods add `goodsprice` decimal(18, 4) DEFAULT 0  COMMENT '商品原价';
alter table zm_order_goods add `discountratio` decimal(38, 2) DEFAULT 0  COMMENT '单品折扣';
alter table zm_order_goods add `foreign_key` varchar(255) DEFAULT NULL  COMMENT '外键id';
alter table zm_order_goods add `goods_id` int(11) DEFAULT 0  COMMENT '商品id';
