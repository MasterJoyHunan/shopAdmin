/*
Navicat MySQL Data Transfer

Source Server         : outline_源购优品
Source Server Version : 50719
Source Host           : 192.168.0.50:3306
Source Database       : twy1

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-10 14:26:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sk_order_info
-- ----------------------------
DROP TABLE IF EXISTS `sk_order_info`;
CREATE TABLE `sk_order_info` (
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
