/*
Navicat MySQL Data Transfer

Source Server         : s70
Source Server Version : 50637
Source Host           : 47.100.5.188:3306
Source Database       : Toriko

Target Server Type    : MYSQL
Target Server Version : 50637
File Encoding         : 65001

Date: 2018-01-08 09:42:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for lamp_attr
-- ----------------------------
DROP TABLE IF EXISTS `lamp_attr`;
CREATE TABLE `lamp_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attr` varchar(255) DEFAULT NULL COMMENT '店铺所有属性如有如阳台',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态  1-正常 2-取消',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_banner
-- ----------------------------
DROP TABLE IF EXISTS `lamp_banner`;
CREATE TABLE `lamp_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` varchar(50) DEFAULT NULL COMMENT 'banner图片',
  `display` tinyint(1) DEFAULT '1' COMMENT '状态 1-显示 2-隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_category
-- ----------------------------
DROP TABLE IF EXISTS `lamp_category`;
CREATE TABLE `lamp_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL COMMENT '分类名',
  `pid` int(11) NOT NULL COMMENT '父级id',
  `path` varchar(255) NOT NULL COMMENT '分类路径',
  `display` tinyint(1) DEFAULT '2' COMMENT '显示/隐藏  1-显示  2-隐藏',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_company
-- ----------------------------
DROP TABLE IF EXISTS `lamp_company`;
CREATE TABLE `lamp_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '公司名',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `tel` char(11) NOT NULL COMMENT '电话',
  `qq` char(32) NOT NULL COMMENT 'QQ号登陆',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `address` varchar(255) NOT NULL COMMENT '公司地址',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态  1-已注册  2-已通过',
  `display` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `qq` (`qq`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_node
-- ----------------------------
DROP TABLE IF EXISTS `lamp_node`;
CREATE TABLE `lamp_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_order
-- ----------------------------
DROP TABLE IF EXISTS `lamp_order`;
CREATE TABLE `lamp_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderNum` varchar(255) NOT NULL COMMENT '订单号',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `sid` int(11) NOT NULL COMMENT '店铺id',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `tel` char(11) NOT NULL COMMENT '用户电话',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态  1-订单完成 2-订单进行中 3-已评',
  PRIMARY KEY (`id`),
  UNIQUE KEY `orderNum` (`orderNum`),
  UNIQUE KEY `tel` (`tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_role
-- ----------------------------
DROP TABLE IF EXISTS `lamp_role`;
CREATE TABLE `lamp_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) unsigned DEFAULT '1',
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_role_node
-- ----------------------------
DROP TABLE IF EXISTS `lamp_role_node`;
CREATE TABLE `lamp_role_node` (
  `rid` smallint(6) unsigned NOT NULL,
  `nid` smallint(6) unsigned NOT NULL,
  KEY `groupId` (`rid`),
  KEY `nodeId` (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_user
-- ----------------------------
DROP TABLE IF EXISTS `lamp_user`;
CREATE TABLE `lamp_user` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  `userpass` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_user_role
-- ----------------------------
DROP TABLE IF EXISTS `lamp_user_role`;
CREATE TABLE `lamp_user_role` (
  `rid` mediumint(9) unsigned DEFAULT NULL,
  `uid` int(6) unsigned NOT NULL,
  KEY `group_id` (`rid`),
  KEY `user_id` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_ycompany_role
-- ----------------------------
DROP TABLE IF EXISTS `lamp_ycompany_role`;
CREATE TABLE `lamp_ycompany_role` (
  `rid` mediumint(9) unsigned DEFAULT NULL,
  `cid` int(6) unsigned NOT NULL,
  KEY `group_id` (`rid`),
  KEY `user_id` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_ynode
-- ----------------------------
DROP TABLE IF EXISTS `lamp_ynode`;
CREATE TABLE `lamp_ynode` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yrole
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yrole`;
CREATE TABLE `lamp_yrole` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yrole_node
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yrole_node`;
CREATE TABLE `lamp_yrole_node` (
  `rid` smallint(6) unsigned NOT NULL,
  `nid` smallint(6) unsigned NOT NULL,
  KEY `groupId` (`rid`),
  KEY `nodeId` (`nid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yshop
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yshop`;
CREATE TABLE `lamp_yshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '店铺名',
  `gid` int(11) DEFAULT NULL COMMENT '分类id',
  `cid` int(11) NOT NULL COMMENT '公司id',
  `tel` char(11) NOT NULL COMMENT '店铺电话',
  `datetime` varchar(25) DEFAULT NULL COMMENT '营业时间',
  `address` varchar(255) NOT NULL COMMENT '店铺地址',
  `per` char(5) DEFAULT NULL COMMENT '人均消费',
  `hot` tinyint(1) DEFAULT '1' COMMENT '热门 1-普通 2-热门 3-上线',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态  1-等待审核  2-审核通过',
  `area` varchar(64) DEFAULT NULL COMMENT '所属商圈',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`),
  UNIQUE KEY `per` (`per`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yshop_attr
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yshop_attr`;
CREATE TABLE `lamp_yshop_attr` (
  `sid` smallint(6) unsigned NOT NULL,
  `aid` smallint(6) unsigned NOT NULL,
  KEY `shopId` (`sid`),
  KEY `attrId` (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yshop_banner
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yshop_banner`;
CREATE TABLE `lamp_yshop_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` smallint(6) unsigned NOT NULL,
  `icon` varchar(50) DEFAULT NULL COMMENT '商铺banner图片',
  `display` tinyint(1) DEFAULT '1' COMMENT '状态 1-显示 2-隐藏',
  `face` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yshop_comment
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yshop_comment`;
CREATE TABLE `lamp_yshop_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` smallint(6) unsigned NOT NULL,
  `comment` longtext COMMENT '商铺介绍',
  `display` tinyint(1) DEFAULT '1' COMMENT '状态 1-显示 2-隐藏',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_yshop_show
-- ----------------------------
DROP TABLE IF EXISTS `lamp_yshop_show`;
CREATE TABLE `lamp_yshop_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` smallint(6) unsigned NOT NULL,
  `comment` varchar(255) DEFAULT NULL COMMENT '图片介绍',
  `icon` varchar(50) DEFAULT NULL COMMENT '商铺banner图片',
  `display` tinyint(1) DEFAULT '1' COMMENT '状态 1-显示 2-隐藏',
  `face` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1-封面 2-非封面',
  `status` tinyint(1) DEFAULT '2' COMMENT '1-上线 2-未上线',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lamp_zuser
-- ----------------------------
DROP TABLE IF EXISTS `lamp_zuser`;
CREATE TABLE `lamp_zuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` char(11) NOT NULL COMMENT '电话',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `nickname` varchar(30) DEFAULT NULL COMMENT '昵称',
  `icon` varchar(255) DEFAULT NULL COMMENT '头像',
  `sex` tinyint(1) unsigned DEFAULT '1' COMMENT '性别  1-男  2-女 3-保密',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态  1-激活  2-禁用',
  `birthday` date DEFAULT NULL COMMENT '注册时间',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;
