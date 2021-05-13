/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : masterjoy_shop

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 05/04/2018 00:06:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for mj_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `mj_admin_user`;
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

-- ----------------------------
-- Records of mj_admin_user
-- ----------------------------
BEGIN;
INSERT INTO `mj_admin_user` VALUES (1, 'admin', '198f8d7ebed9be5cfa1adf417a1ea2e7', 133, '127.0.0.1', '2018-04-04 22:34:18', 'admin', 1, 1);
INSERT INTO `mj_admin_user` VALUES (8, 'a', 'e4105597fdafa753a6167f4f9020ca8e', 8, '127.0.0.1', '2018-04-02 20:34:42', 'werwqrqwe', 1, 3);
INSERT INTO `mj_admin_user` VALUES (10, '22地方32121', 'ea70bb8aeff0e6ee85f8587ed2c17129', 0, '', '2018-03-28 22:41:35', 'sdfsgsafs', 1, 2);
INSERT INTO `mj_admin_user` VALUES (11, 'fsfafdfasdf', 'f0ef32e7d3d5e0431118bc5036ba1eb7', 0, '', '2018-03-28 22:46:45', 'dsfasfsfasf', 1, 2);
INSERT INTO `mj_admin_user` VALUES (12, 'sdfsafasdfa', 'b96d9f825484859f4f462c3fdd855365', 0, '', '2018-03-28 22:46:56', 'sdfafsafsaf', 1, 2);
INSERT INTO `mj_admin_user` VALUES (13, 'sdfsfasfd', '6d6ae8555db82740f57751f2eb761cfc', 0, '', '2018-03-28 22:47:10', 'sdafsasfas', 1, 3);
INSERT INTO `mj_admin_user` VALUES (14, 'dsafsfasfsaf', '334206bc4ce10de89add72b00c16af6e', 0, '', '2018-03-28 22:47:24', 'sdfasfsfsaf', 0, 3);
INSERT INTO `mj_admin_user` VALUES (15, 'sdfsafsa', 'b96d9f825484859f4f462c3fdd855365', 0, '', '2018-03-28 22:47:36', 'sdfasfsaff', 0, 1);
COMMIT;

-- ----------------------------
-- Table structure for mj_article_cate
-- ----------------------------
DROP TABLE IF EXISTS `mj_article_cate`;
CREATE TABLE `mj_article_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '分类名',
  `pid` int(11) DEFAULT '0' COMMENT '上级ID',
  `sort` tinyint(4) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Records of mj_article_cate
-- ----------------------------
BEGIN;
INSERT INTO `mj_article_cate` VALUES (1, 'dd', 0, 0);
INSERT INTO `mj_article_cate` VALUES (2, '少巴西1', 1, 2);
INSERT INTO `mj_article_cate` VALUES (3, '防守打法', 1, 0);
INSERT INTO `mj_article_cate` VALUES (4, '时代大厦', 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for mj_articles
-- ----------------------------
DROP TABLE IF EXISTS `mj_articles`;
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

-- ----------------------------
-- Table structure for mj_node
-- ----------------------------
DROP TABLE IF EXISTS `mj_node`;
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of mj_node
-- ----------------------------
BEGIN;
INSERT INTO `mj_node` VALUES (1, '用户管理', '#', '#', 2, 0, 'admin', 'fa fa-users');
INSERT INTO `mj_node` VALUES (2, '管理员管理', 'user', 'index', 2, 1, 'admin-user', '');
INSERT INTO `mj_node` VALUES (3, '添加管理员', 'user', 'useradd', 1, 2, '', '');
INSERT INTO `mj_node` VALUES (4, '编辑管理员', 'user', 'useredit', 1, 2, '', '');
INSERT INTO `mj_node` VALUES (5, '删除管理员', 'user', 'userdel', 1, 2, '', '');
INSERT INTO `mj_node` VALUES (6, '角色管理', 'role', 'index', 2, 1, 'admin-role', '');
INSERT INTO `mj_node` VALUES (7, '添加角色', 'role', 'roleadd', 1, 6, '', '');
INSERT INTO `mj_node` VALUES (8, '编辑角色', 'role', 'roleedit', 1, 6, '', '');
INSERT INTO `mj_node` VALUES (9, '删除角色', 'role', 'roledel', 1, 6, '', '');
INSERT INTO `mj_node` VALUES (10, '分配权限', 'role', 'giveaccess', 1, 6, '', '');
INSERT INTO `mj_node` VALUES (11, '系统管理', '#', '#', 2, 0, 'system', 'fa fa-desktop');
INSERT INTO `mj_node` VALUES (12, '数据备份/还原', 'data', 'index', 2, 11, 'database-list', '');
INSERT INTO `mj_node` VALUES (13, '备份数据', 'data', 'backup', 1, 12, '', '');
INSERT INTO `mj_node` VALUES (14, '删除数据库文件', 'data', 'del', 1, 12, '', '');
INSERT INTO `mj_node` VALUES (15, '节点管理', 'node', 'index', 2, 1, 'admin-node', '');
INSERT INTO `mj_node` VALUES (16, '添加节点', 'node', 'nodeadd', 1, 15, '', '');
INSERT INTO `mj_node` VALUES (17, '编辑节点', 'node', 'nodeedit', 1, 15, '', '');
INSERT INTO `mj_node` VALUES (18, '删除节点', 'node', 'nodedel', 1, 15, '', '');
INSERT INTO `mj_node` VALUES (19, '文章管理', 'articles', 'index', 2, 0, '', 'fa fa-book');
INSERT INTO `mj_node` VALUES (20, '文章列表', 'articles', 'index', 2, 19, '', '');
INSERT INTO `mj_node` VALUES (21, '添加文章', 'articles', 'articleadd', 1, 19, '', '');
INSERT INTO `mj_node` VALUES (22, '编辑文章', 'articles', 'articleedit', 1, 19, '', '');
INSERT INTO `mj_node` VALUES (23, '删除文章', 'articles', 'articledel', 1, 19, '', '');
INSERT INTO `mj_node` VALUES (24, '上传图片', 'articles', 'uploadImg', 1, 19, '', '');
INSERT INTO `mj_node` VALUES (27, '系统初始化', 'data', 'initdata', 1, 12, '', '');
INSERT INTO `mj_node` VALUES (28, '数据库下载', 'data', 'download', 1, 12, '', '');
INSERT INTO `mj_node` VALUES (29, '文章分类', 'articlecate', 'index', 2, 19, '', '');
INSERT INTO `mj_node` VALUES (30, '添加分类', 'articlecate', 'articlecateadd', 1, 29, '', '');
INSERT INTO `mj_node` VALUES (31, '编辑分类', 'articlecate', 'editarticlecate', 1, 29, '', '');
INSERT INTO `mj_node` VALUES (32, '删除分类', 'articlecate', 'delarticlecate', 1, 29, '', '');
COMMIT;

-- ----------------------------
-- Table structure for mj_role
-- ----------------------------
DROP TABLE IF EXISTS `mj_role`;
CREATE TABLE `mj_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of mj_role
-- ----------------------------
BEGIN;
INSERT INTO `mj_role` VALUES (1, '超管', '*');
INSERT INTO `mj_role` VALUES (2, '系统维护员', '11,12,13,14,27,28');
INSERT INTO `mj_role` VALUES (3, '仓库管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,27,28,29,30,31,32');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
