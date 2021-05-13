/*
Navicat MySQL Data Transfer

Source Server         : outline_中网科技
Source Server Version : 50719
Source Host           : 192.168.0.50:3306
Source Database       : zhonweb

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-05-10 16:08:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sk_user
-- ----------------------------
DROP TABLE IF EXISTS `sk_user`;
CREATE TABLE `sk_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` varchar(12) DEFAULT NULL COMMENT '电话号码',
  `password` varchar(32) DEFAULT NULL COMMENT '密码',
  `openid` varchar(50) DEFAULT NULL COMMENT '微信open_id',
  `wxname` binary(50) DEFAULT NULL COMMENT '微信名',
  `headimgurl` text,
  `province` varchar(20) DEFAULT NULL COMMENT '省',
  `city` varchar(20) DEFAULT NULL COMMENT '市',
  `area` varchar(20) DEFAULT NULL COMMENT '区',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `last_login_time` timestamp NULL DEFAULT NULL COMMENT '最后登录时间',
  `true_name` varchar(50) DEFAULT NULL COMMENT '真实姓名',
  `idcard` varchar(18) DEFAULT NULL COMMENT '身份证',
  `amoney` decimal(10,2) DEFAULT '0.00' COMMENT 'A积分(每日转账使用)',
  `bmoney` decimal(10,2) DEFAULT '0.00' COMMENT 'B积分(提现使用)',
  `cmoney` decimal(10,2) DEFAULT '0.00' COMMENT 'C积分(购物券)',
  `app_token` varchar(50) DEFAULT NULL COMMENT 'APP软件token 推送使用',
  `pid` int(11) DEFAULT NULL COMMENT '推荐人ID',
  `rank` tinyint(1) DEFAULT '0' COMMENT '会员等级 0=>普通会员 ,1=>推广专员 ,2=>商务代表',
  `server_password` varchar(32) DEFAULT NULL COMMENT '服务密码',
  `ticket` varchar(50) DEFAULT NULL COMMENT '微信二维码生成',
  `lp_openid` varchar(50) DEFAULT NULL COMMENT '小程序openid',
  `union_id` varchar(50) DEFAULT NULL COMMENT '微信开放平台唯一ID',
  PRIMARY KEY (`id`),
  KEY `tel` (`tel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户信息表';
