-- MySQL dump 10.13  Distrib 5.5.53, for Win32 (AMD64)
--
-- Host: 127.0.0.1    Database: shop_template
-- ------------------------------------------------------
-- Server version	5.5.53

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
-- Table structure for table `mj_admin_user`
--

DROP TABLE IF EXISTS `mj_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '密码',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后登录时间',
  `real_name` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户角色id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_admin_user`
--

LOCK TABLES `mj_admin_user` WRITE;
/*!40000 ALTER TABLE `mj_admin_user` DISABLE KEYS */;
INSERT INTO `mj_admin_user` VALUES (1,'admin','198f8d7ebed9be5cfa1adf417a1ea2e7',135,'127.0.0.1','2018-05-10 06:07:44','admin',1,1),(8,'a','e4105597fdafa753a6167f4f9020ca8e',8,'127.0.0.1','2018-04-02 12:34:42','werwqrqwe',1,3),(10,'22地方32121','ea70bb8aeff0e6ee85f8587ed2c17129',0,'','2018-03-28 14:41:35','sdfsgsafs',1,2),(11,'fsfafdfasdf','f0ef32e7d3d5e0431118bc5036ba1eb7',0,'','2018-03-28 14:46:45','dsfasfsfasf',1,2),(12,'sdfsafasdfa','b96d9f825484859f4f462c3fdd855365',0,'','2018-03-28 14:46:56','sdfafsafsaf',1,2),(13,'sdfsfasfd','6d6ae8555db82740f57751f2eb761cfc',0,'','2018-03-28 14:47:10','sdafsasfas',1,3),(14,'dsafsfasfsaf','334206bc4ce10de89add72b00c16af6e',0,'','2018-03-28 14:47:24','sdfasfsfsaf',0,3),(15,'sdfsafsa','b96d9f825484859f4f462c3fdd855365',0,'','2018-03-28 14:47:36','sdfasfsaff',0,1);
/*!40000 ALTER TABLE `mj_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_article_cate`
--

DROP TABLE IF EXISTS `mj_article_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_article_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '分类名',
  `pid` int(11) DEFAULT '0' COMMENT '上级ID',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文章分类';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_article_cate`
--

LOCK TABLES `mj_article_cate` WRITE;
/*!40000 ALTER TABLE `mj_article_cate` DISABLE KEYS */;
INSERT INTO `mj_article_cate` VALUES (1,'dd',0,0),(2,'少巴西1',1,2),(3,'防守打法',1,0),(4,'时代大厦',0,0);
/*!40000 ALTER TABLE `mj_article_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_articles`
--

DROP TABLE IF EXISTS `mj_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(155) NOT NULL COMMENT '文章标题',
  `cid` int(11) DEFAULT NULL COMMENT '文章分类',
  `description` varchar(255) NOT NULL COMMENT '文章描述',
  `keywords` varchar(155) NOT NULL COMMENT '文章关键字',
  `thumbnail` varchar(255) NOT NULL COMMENT '文章缩略图',
  `content` text NOT NULL COMMENT '文章内容',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_articles`
--

LOCK TABLES `mj_articles` WRITE;
/*!40000 ALTER TABLE `mj_articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_cart`
--

DROP TABLE IF EXISTS `mj_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `pro_id` int(11) NOT NULL COMMENT '商品id',
  `pro_sku_id` int(11) unsigned NOT NULL COMMENT '商品扩展id',
  `name` char(50) NOT NULL COMMENT '商品名',
  `sku_name` char(50) DEFAULT NULL COMMENT '商品规格',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `num` smallint(6) NOT NULL COMMENT '商品数量',
  `img` char(50) DEFAULT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`),
  KEY `user_id` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_cart`
--

LOCK TABLES `mj_cart` WRITE;
/*!40000 ALTER TABLE `mj_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_cate`
--

DROP TABLE IF EXISTS `mj_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '分类名',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_cate`
--

LOCK TABLES `mj_cate` WRITE;
/*!40000 ALTER TABLE `mj_cate` DISABLE KEYS */;
INSERT INTO `mj_cate` VALUES (1,'吃',1,1,'2018-04-16 12:03:00'),(2,'喝',1,1,'2018-04-16 12:03:10'),(3,'玩',1,12,'2018-04-16 12:03:15'),(4,'乐',-1,0,'2018-04-16 12:03:23'),(5,'乐',1,21,'2018-04-16 12:14:07'),(6,' 衣',1,1,'2018-04-16 15:54:26'),(7,'食',1,1,'2018-04-16 15:54:38'),(8,'住',1,1,'2018-04-16 15:54:43'),(9,'行',-1,1,'2018-04-16 15:54:48'),(10,'行',1,50,'2018-04-17 11:49:39');
/*!40000 ALTER TABLE `mj_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_express`
--

DROP TABLE IF EXISTS `mj_express`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) DEFAULT NULL,
  `tel` char(15) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `contact` char(5) DEFAULT NULL,
  `contact_tel` char(11) DEFAULT NULL,
  `sort` tinyint(4) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1' COMMENT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_express`
--

LOCK TABLES `mj_express` WRITE;
/*!40000 ALTER TABLE `mj_express` DISABLE KEYS */;
INSERT INTO `mj_express` VALUES (1,'顺丰快递','123456','北京天安门','牛三','135558822',0,1),(2,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,1),(3,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,1),(4,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,-1),(5,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,1),(6,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,1),(7,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,1),(8,'顺丰快递','13212345678','北京天安门','刘翔','13212345678',0,1);
/*!40000 ALTER TABLE `mj_express` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_node`
--

DROP TABLE IF EXISTS `mj_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `type_id` int(11) NOT NULL COMMENT '父级节点id',
  `component_name` varchar(155) DEFAULT NULL COMMENT 'VUE使用,组件名',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_node`
--

LOCK TABLES `mj_node` WRITE;
/*!40000 ALTER TABLE `mj_node` DISABLE KEYS */;
INSERT INTO `mj_node` VALUES (1,'用户管理','#','#',2,0,'admin','fa fa-users'),(2,'管理员管理','user','index',2,1,'admin-user',''),(3,'添加管理员','user','useradd',1,2,'',''),(4,'编辑管理员','user','useredit',1,2,'',''),(5,'删除管理员','user','userdel',1,2,'',''),(6,'角色管理','role','index',2,1,'admin-role',''),(7,'添加角色','role','roleadd',1,6,'',''),(8,'编辑角色','role','roleedit',1,6,'',''),(9,'删除角色','role','roledel',1,6,'',''),(10,'分配权限','role','giveaccess',1,6,'',''),(11,'系统管理','#','#',2,0,'system','fa fa-desktop'),(12,'数据备份/还原','data','index',2,11,'database-list',''),(13,'备份数据','data','backup',1,12,'',''),(14,'删除数据库文件','data','del',1,12,'',''),(15,'节点管理','node','index',2,1,'admin-node',''),(16,'添加节点','node','nodeadd',1,15,'',''),(17,'编辑节点','node','nodeedit',1,15,'',''),(18,'删除节点','node','nodedel',1,15,'',''),(19,'文章管理','articles','index',2,0,'','fa fa-book'),(20,'文章列表','articles','index',2,19,'',''),(21,'添加文章','articles','articleadd',1,19,'',''),(22,'编辑文章','articles','articleedit',1,19,'',''),(23,'删除文章','articles','articledel',1,19,'',''),(24,'上传图片','articles','uploadImg',1,19,'',''),(27,'系统初始化','data','initdata',1,12,'',''),(28,'数据库下载','data','download',1,12,'',''),(29,'文章分类','articlecate','index',2,19,'',''),(30,'添加分类','articlecate','articlecateadd',1,29,'',''),(31,'编辑分类','articlecate','editarticlecate',1,29,'',''),(32,'删除分类','articlecate','delarticlecate',1,29,'',''),(33,'商品管理','#','#',2,0,'product',''),(34,'商品列表','product','index',2,33,'product-goods',''),(35,'分类管理','cate','index',2,33,'product-cate',''),(36,'订单管理','#','#',2,0,'order',''),(37,'订单列表','order','index',2,36,'order-list',''),(38,'快递管理','express','index',2,36,'express-list','');
/*!40000 ALTER TABLE `mj_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_order`
--

DROP TABLE IF EXISTS `mj_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户ID',
  `post_name` varchar(50) NOT NULL COMMENT '收件人',
  `post_tel` varchar(50) NOT NULL COMMENT '收货电话',
  `post_address` text COMMENT '收货地址',
  `money` decimal(10,2) DEFAULT NULL COMMENT '货物金额',
  `postage` decimal(10,2) DEFAULT NULL COMMENT '邮费',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `payment` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '已支付',
  `no` varchar(50) NOT NULL COMMENT '订单编号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1=>删除订单 | 0=>待付款 | 1 => 待提货 | 2=>已完成',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加订单时间',
  `pay_date` timestamp NULL DEFAULT NULL COMMENT '支付时间',
  `send_date` timestamp NULL DEFAULT NULL COMMENT '发货时间',
  `get_date` timestamp NULL DEFAULT NULL COMMENT '收货时间',
  `cancel_date` timestamp NULL DEFAULT NULL COMMENT '取消时间',
  `express` varchar(10) DEFAULT NULL COMMENT '快递',
  `express_no` varchar(50) DEFAULT NULL COMMENT '快递单号',
  `pay_way` tinyint(3) DEFAULT NULL COMMENT '支付方式',
  `reduce` decimal(10,2) DEFAULT '0.00' COMMENT '优惠金额',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `no` (`no`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8 COMMENT='订单表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_order`
--

LOCK TABLES `mj_order` WRITE;
/*!40000 ALTER TABLE `mj_order` DISABLE KEYS */;
INSERT INTO `mj_order` VALUES (213,1,'666','666','666',11.00,1.00,12.00,12.00,'112121212',0,'2018-05-10 08:13:02',NULL,NULL,NULL,NULL,NULL,NULL,NULL,0.00);
/*!40000 ALTER TABLE `mj_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_order_info`
--

DROP TABLE IF EXISTS `mj_order_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_order_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '订单pid',
  `pro_id` int(11) NOT NULL COMMENT '商品id',
  `pro_ext_id` int(11) NOT NULL COMMENT '商品扩展id',
  `name` varchar(50) NOT NULL COMMENT '商品名',
  `name_ext` varchar(50) DEFAULT NULL COMMENT '商品属性名字',
  `price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `num` tinyint(3) unsigned NOT NULL COMMENT '商品数量',
  `img` varchar(50) DEFAULT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`),
  KEY `order_id` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8 COMMENT='订单商品表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_order_info`
--

LOCK TABLES `mj_order_info` WRITE;
/*!40000 ALTER TABLE `mj_order_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_order_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_product`
--

DROP TABLE IF EXISTS `mj_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品名',
  `desc` text COLLATE utf8_unicode_ci COMMENT '详情',
  `cate_id` int(11) DEFAULT NULL COMMENT '所属分类',
  `market_price` decimal(10,2) DEFAULT NULL COMMENT '市场价',
  `price` decimal(10,2) DEFAULT NULL COMMENT '售价',
  `stock` int(11) DEFAULT '0' COMMENT '库存',
  `sales_volume` int(11) DEFAULT '0' COMMENT '出售个数',
  `img` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片地址(首页缩略图)',
  `imgs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '轮播图',
  `is_hot` tinyint(1) DEFAULT '0' COMMENT '是否在首页显示',
  `status` tinyint(1) DEFAULT '1' COMMENT '1=>上架|0=>下架',
  `sort` tinyint(1) DEFAULT '1' COMMENT '排序',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_product`
--

LOCK TABLES `mj_product` WRITE;
/*!40000 ALTER TABLE `mj_product` DISABLE KEYS */;
INSERT INTO `mj_product` VALUES (1,'这是测试测试测试测试测试','<p><img class=\"wscnph\" src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\" data-mce-src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\"></p>',6,100.00,99.00,4000,0,'20180508\\11412f32df9fa80f1bdfd2f243b65591.png','20180508\\11412f32df9fa80f1bdfd2f243b65591.png|20180508\\c7a01e2b69ef936e42d41c1e07efb17a.png|20180508\\9cdfb7f4f368a93a9d037303956d2355.png',0,1,0,'2018-05-08 07:47:25'),(2,'this is test','<p>sdfdfsdf</p>',1,1.00,1.00,1,0,'20180509\\7c707a7fc6466ff558d56450047bdb34.png','20180509\\7c707a7fc6466ff558d56450047bdb34.png',0,1,0,'2018-05-09 01:35:06'),(3,'this is test two','<p>adsdsa</p>',6,1.00,1.00,1,0,'20180509\\5232bef25b7d325a55baeedef7e9c7a6.png','20180509\\5232bef25b7d325a55baeedef7e9c7a6.png',0,1,0,'2018-05-09 01:35:51'),(4,'飞机大炮和火箭','<p>sfsfdsdf</p>',10,100.00,99.00,4000,0,'20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png','20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png',0,1,0,'2018-05-09 03:57:22'),(5,'这是测试测试测试测试测试','<p><img class=\"wscnph\" src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\" data-mce-src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\"></p>',6,100.00,99.00,4000,0,'20180508\\11412f32df9fa80f1bdfd2f243b65591.png','20180508\\11412f32df9fa80f1bdfd2f243b65591.png|20180508\\c7a01e2b69ef936e42d41c1e07efb17a.png|20180508\\9cdfb7f4f368a93a9d037303956d2355.png',0,1,0,'2018-05-08 07:47:25'),(6,'this is test','<p>sdfdfsdf</p>',1,1.00,1.00,1,0,'20180509\\7c707a7fc6466ff558d56450047bdb34.png','20180509\\7c707a7fc6466ff558d56450047bdb34.png',0,1,0,'2018-05-09 01:35:06'),(7,'this is test two','<p>adsdsa</p>',6,1.00,1.00,1,0,'20180509\\5232bef25b7d325a55baeedef7e9c7a6.png','20180509\\5232bef25b7d325a55baeedef7e9c7a6.png',0,1,0,'2018-05-09 01:35:51'),(8,'飞机大炮和火箭','<p>sfsfdsdf</p>',10,100.00,99.00,4000,0,'20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png','20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png',0,1,0,'2018-05-09 03:57:22'),(9,'这是测试测试测试测试测试','<p><img class=\"wscnph\" src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\" data-mce-src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\"></p>',6,100.00,99.00,4000,0,'20180508\\11412f32df9fa80f1bdfd2f243b65591.png','20180508\\11412f32df9fa80f1bdfd2f243b65591.png|20180508\\c7a01e2b69ef936e42d41c1e07efb17a.png|20180508\\9cdfb7f4f368a93a9d037303956d2355.png',0,1,0,'2018-05-08 07:47:25'),(10,'this is test','<p>sdfdfsdf</p>',1,1.00,1.00,1,0,'20180509\\7c707a7fc6466ff558d56450047bdb34.png','20180509\\7c707a7fc6466ff558d56450047bdb34.png',0,1,0,'2018-05-09 01:35:06'),(11,'this is test two','<p>adsdsa</p>',6,1.00,1.00,1,0,'20180509\\5232bef25b7d325a55baeedef7e9c7a6.png','20180509\\5232bef25b7d325a55baeedef7e9c7a6.png',0,1,0,'2018-05-09 01:35:51'),(12,'飞机大炮和火箭','<p>sfsfdsdf</p>',10,100.00,99.00,4000,0,'20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png','20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png',0,1,0,'2018-05-09 03:57:22'),(13,'这是测试测试测试测试测试','<p><img class=\"wscnph\" src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\" data-mce-src=\"http://localhost/web/public/uploads/20180508\\89a4c95deb35375187cb93f2bdcd66c1.png\"></p>',6,100.00,99.00,800,0,'20180508\\11412f32df9fa80f1bdfd2f243b65591.png','20180508\\11412f32df9fa80f1bdfd2f243b65591.png|20180508\\c7a01e2b69ef936e42d41c1e07efb17a.png|20180508\\9cdfb7f4f368a93a9d037303956d2355.png',0,1,0,'2018-05-08 07:47:25'),(14,'this is test','<p>sdfdfsdf</p>',1,1.00,1.00,1,0,'20180509\\7c707a7fc6466ff558d56450047bdb34.png','20180509\\7c707a7fc6466ff558d56450047bdb34.png',0,1,0,'2018-05-09 01:35:06'),(15,'this is test two','<p>adsdsa</p>',6,1.00,1.00,1,0,'20180509\\5232bef25b7d325a55baeedef7e9c7a6.png','20180509\\5232bef25b7d325a55baeedef7e9c7a6.png',0,1,0,'2018-05-09 01:35:51'),(16,'飞机大炮和火箭','<p>sfsfdsdf</p>',10,100.00,99.00,4000,0,'20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png','20180509\\b900fbc2bf30ca3ab5d9503aa7f2a500.png',0,1,0,'2018-05-09 03:57:22');
/*!40000 ALTER TABLE `mj_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_product_sku`
--

DROP TABLE IF EXISTS `mj_product_sku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_product_sku` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `name` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` char(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品图片',
  `sku_id_1` int(11) unsigned DEFAULT NULL COMMENT '属性ID1',
  `sku_id_2` int(11) unsigned DEFAULT NULL COMMENT '属性ID2',
  `stock` int(11) unsigned DEFAULT '0' COMMENT '库存',
  `market_price` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '市场价',
  `price` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '售价',
  `sales_volume` int(11) DEFAULT '0' COMMENT '出售个数',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常, -1删除',
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`),
  KEY `sku_id_2` (`sku_id_2`),
  KEY `sku_id_1` (`sku_id_1`),
  KEY `sales_volume` (`sales_volume`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_product_sku`
--

LOCK TABLES `mj_product_sku` WRITE;
/*!40000 ALTER TABLE `mj_product_sku` DISABLE KEYS */;
INSERT INTO `mj_product_sku` VALUES (1,1,'中绿','20180508\\27e740e73dda58f135108507f755652b.png',2,5,1000,100.00,99.00,0,1),(2,1,'中蓝','20180508\\27e740e73dda58f135108507f755652b.png',2,6,1000,100.00,99.00,0,1),(3,1,'小绿','20180508\\27e740e73dda58f135108507f755652b.png',3,5,1000,100.00,99.00,0,1),(4,1,'小蓝','20180508\\27e740e73dda58f135108507f755652b.png',3,6,1000,100.00,99.00,0,1),(5,3,'中','20180509\\e45b2eae275191bc0ef80a6a58654981.png',2,0,1,1.00,1.00,0,1),(6,4,'水','20180509\\ae5a0568a07daece1ec25b846ffcc214.png',7,0,1000,100.00,99.00,0,1),(7,4,'陆','20180509\\ae5a0568a07daece1ec25b846ffcc214.png',8,0,1000,100.00,99.00,0,1),(8,4,'海','20180509\\ae5a0568a07daece1ec25b846ffcc214.png',10,0,1000,100.00,99.00,0,1),(9,4,'飞机','20180509\\ae5a0568a07daece1ec25b846ffcc214.png',11,0,1000,100.00,99.00,0,1);
/*!40000 ALTER TABLE `mj_product_sku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_role`
--

DROP TABLE IF EXISTS `mj_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_role`
--

LOCK TABLES `mj_role` WRITE;
/*!40000 ALTER TABLE `mj_role` DISABLE KEYS */;
INSERT INTO `mj_role` VALUES (1,'超管','*'),(2,'系统维护员','11,12,13,14,27,28'),(3,'仓库管理员','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,27,28,29,30,31,32');
/*!40000 ALTER TABLE `mj_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_sku`
--

DROP TABLE IF EXISTS `mj_sku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_sku` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0' COMMENT '分类ID',
  `level` tinyint(1) unsigned DEFAULT '0' COMMENT '几级属性',
  `name` char(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '属性名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_sku`
--

LOCK TABLES `mj_sku` WRITE;
/*!40000 ALTER TABLE `mj_sku` DISABLE KEYS */;
INSERT INTO `mj_sku` VALUES (1,6,1,'大',1),(2,6,1,'中',1),(3,6,1,'小',1),(4,6,2,'红',1),(5,6,2,'绿',1),(6,6,2,'蓝',1),(7,10,1,'水',1),(8,10,1,'陆',1),(9,10,1,'空',1),(10,10,1,'海',1),(11,10,1,'飞机',1),(15,10,1,'火箭',1);
/*!40000 ALTER TABLE `mj_sku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mj_user`
--

DROP TABLE IF EXISTS `mj_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` varchar(12) DEFAULT NULL COMMENT '电话号码',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `wxname` binary(50) DEFAULT NULL COMMENT '微信名',
  `headimgurl` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `true_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `amoney` decimal(10,2) DEFAULT '0.00' COMMENT 'A积分(每日转账使用)',
  `bmoney` decimal(10,2) DEFAULT '0.00' COMMENT 'B积分(提现使用)',
  `cmoney` decimal(10,2) DEFAULT '0.00' COMMENT 'C积分(购物券)',
  `app_token` varchar(50) DEFAULT NULL COMMENT 'APP软件token 推送使用',
  `pid` int(11) DEFAULT NULL COMMENT '推荐人ID',
  `rank` tinyint(1) DEFAULT '0' COMMENT '会员等级 0=>普通会员 ,1=>推广专员 ,2=>商务代表',
  `server_password` varchar(32) DEFAULT NULL COMMENT '服务密码',
  PRIMARY KEY (`id`),
  KEY `tel` (`tel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户信息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mj_user`
--

LOCK TABLES `mj_user` WRITE;
/*!40000 ALTER TABLE `mj_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `mj_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-10 16:14:46
