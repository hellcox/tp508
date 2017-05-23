/*
Navicat MySQL Data Transfer

Source Server         : 本地服务器
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp58

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-23 14:16:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_group
-- ----------------------------
DROP TABLE IF EXISTS `auth_group`;
CREATE TABLE `auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_group
-- ----------------------------
INSERT INTO `auth_group` VALUES ('1', '超级管理员', '1', '1,6,7,5,10');
INSERT INTO `auth_group` VALUES ('3', '普通管理员', '1', '1,3');

-- ----------------------------
-- Table structure for auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `auth_group_access`;
CREATE TABLE `auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_group_access
-- ----------------------------
INSERT INTO `auth_group_access` VALUES ('1', '1');
INSERT INTO `auth_group_access` VALUES ('2', '1');
INSERT INTO `auth_group_access` VALUES ('4', '1');
INSERT INTO `auth_group_access` VALUES ('5', '3');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('1', 'admin/Index/index', '后台首页', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('3', 'admin/Index/test', '首页测试', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('5', 'admin/Rule/index', '权限规则列表', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('6', 'admin/Rule/add', '权限规则添加', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('7', 'admin/Rule/del', '权限规则单条删除', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('8', 'admin/Rule/edit', '权限规则编辑', '1', '1', '');
INSERT INTO `auth_rule` VALUES ('9', 'admin/Rule/delList', '权限规则选中删除', '1', '1', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user_name` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `reg_time` int(10) unsigned NOT NULL COMMENT '注册时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', 'qweasd', '0', '1');
INSERT INTO `user` VALUES ('2', 'test', 'qweasd', '0', '1');
INSERT INTO `user` VALUES ('4', 'test1', 'qweasd', '0', '0');
INSERT INTO `user` VALUES ('5', '1', '1', '0', '1');
INSERT INTO `user` VALUES ('6', '2', '1', '0', '1');
