/*
Navicat MySQL Data Transfer

Source Server         : outline_中网科技
Source Server Version : 50719
Source Host           : 192.168.0.50:3306
Source Database       : zhonweb

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-10 16:09:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sk_cart
-- ----------------------------
DROP TABLE IF EXISTS `sk_cart`;
CREATE TABLE `sk_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `pro_id` int(11) NOT NULL COMMENT '商品id',
  `pro_ext_id` int(11) unsigned NOT NULL COMMENT '商品扩展id',
  `name` varchar(50) NOT NULL COMMENT '商品名',
  `name_ext` varchar(50) DEFAULT NULL COMMENT '商品规格',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `num` smallint(6) NOT NULL COMMENT '商品数量',
  `img` varchar(50) DEFAULT NULL COMMENT '商品图片',
  PRIMARY KEY (`id`),
  KEY `user_id` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
