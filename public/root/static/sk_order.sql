/*
Navicat MySQL Data Transfer

Source Server         : outline_源购优品
Source Server Version : 50719
Source Host           : 192.168.0.50:3306
Source Database       : twy1

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-10 14:26:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sk_order
-- ----------------------------
DROP TABLE IF EXISTS `sk_order`;
CREATE TABLE `sk_order` (
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
  `wx_no` varchar(50) DEFAULT NULL COMMENT '微信订单号',
  `pay_way` tinyint(3) DEFAULT NULL COMMENT '支付方式',
  `reduce` decimal(10,2) DEFAULT '0.00' COMMENT '优惠金额',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`) USING BTREE,
  KEY `no` (`no`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8 COMMENT='订单表';
