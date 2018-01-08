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
-- Records of lamp_attr
-- ----------------------------
INSERT INTO `lamp_attr` VALUES ('1', '露台', '1');
INSERT INTO `lamp_attr` VALUES ('2', '卡拉OK', '1');
INSERT INTO `lamp_attr` VALUES ('3', '榻榻米', '1');

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
-- Records of lamp_banner
-- ----------------------------
INSERT INTO `lamp_banner` VALUES ('16', '20180104/cd5de7402a3e4ead87ffd343c9f3c602.jpg', '1');
INSERT INTO `lamp_banner` VALUES ('17', '20180104/74e948dc1cc75b98ee5a9f6e8438ab93.jpg', '1');

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
-- Records of lamp_category
-- ----------------------------
INSERT INTO `lamp_category` VALUES ('1', '中华盛宴', '0', '0,', '1');
INSERT INTO `lamp_category` VALUES ('2', '日式料理', '0', '0,', '1');
INSERT INTO `lamp_category` VALUES ('3', '韩式料理', '0', '0,', '1');
INSERT INTO `lamp_category` VALUES ('4', '西式餐点', '0', '0,', '1');
INSERT INTO `lamp_category` VALUES ('5', '异域风情', '0', '0,', '1');
INSERT INTO `lamp_category` VALUES ('6', '鲁菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('7', '粤菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('8', '苏菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('9', '浙菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('10', '闽菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('11', '湘菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('12', '徽菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('13', '川菜', '1', '0,1,', '1');
INSERT INTO `lamp_category` VALUES ('14', '日式小火锅', '2', '0,2,', '1');
INSERT INTO `lamp_category` VALUES ('15', '部队火锅', '3', '0,3,', '1');
INSERT INTO `lamp_category` VALUES ('16', '披萨', '4', '0,4,', '1');
INSERT INTO `lamp_category` VALUES ('17', '冬阴功', '5', '0,5,', '1');

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
-- Records of lamp_company
-- ----------------------------
INSERT INTO `lamp_company` VALUES ('1', 'yzw', '上海食品商店', 'e10adc3949ba59abbe56e057f20f883e', '18291042861', '2713497141', 'yinzhanwei1008@163.com', '河北衡水', '2', null);
INSERT INTO `lamp_company` VALUES ('2', 'we', '11', 'e10adc3949ba59abbe56e057f20f883e', '111111111', '11', '11', '11', '2', null);

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
-- Records of lamp_node
-- ----------------------------
INSERT INTO `lamp_node` VALUES ('1', '浏览用户', 'Rabc', 'index', '1');
INSERT INTO `lamp_node` VALUES ('2', '添加用户', 'Rabc', 'add', '1');
INSERT INTO `lamp_node` VALUES ('3', '删除用户', 'Rabc', 'delete', '1');
INSERT INTO `lamp_node` VALUES ('4', '修改用户', 'Rabc', 'edit', '1');
INSERT INTO `lamp_node` VALUES ('5', '浏览角色', 'Role', 'index', '1');
INSERT INTO `lamp_node` VALUES ('6', '添加角色', 'Role', 'add', '1');
INSERT INTO `lamp_node` VALUES ('7', '删除角色', 'Role', 'delete', '1');
INSERT INTO `lamp_node` VALUES ('8', '编辑角色', 'Role', 'edit', '1');
INSERT INTO `lamp_node` VALUES ('9', '浏览节点', 'Jur', 'index', '1');
INSERT INTO `lamp_node` VALUES ('10', '添加节点', 'Jur', 'add', '1');
INSERT INTO `lamp_node` VALUES ('11', '删除节点', 'Jur', 'delete', '1');
INSERT INTO `lamp_node` VALUES ('12', '修改节点', 'Jur', 'edit', '1');
INSERT INTO `lamp_node` VALUES ('13', '浏览角色分配页', 'Role', 'read', '1');
INSERT INTO `lamp_node` VALUES ('14', '执行分配权限', 'Role', 'UpdataNode', '1');
INSERT INTO `lamp_node` VALUES ('15', '浏览分配角色页', 'Rabc', 'read', '1');
INSERT INTO `lamp_node` VALUES ('16', '执行分配角色', 'Rabc', 'UpRole', '1');

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
-- Records of lamp_order
-- ----------------------------

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
-- Records of lamp_role
-- ----------------------------
INSERT INTO `lamp_role` VALUES ('1', '网站管理员', '1', '维护网站');
INSERT INTO `lamp_role` VALUES ('2', '栏目编辑', '1', '负责网站栏目管理');
INSERT INTO `lamp_role` VALUES ('3', '网站客服', '1', '负责客户管理');
INSERT INTO `lamp_role` VALUES ('4', '普通员工', '1', '无');

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
-- Records of lamp_role_node
-- ----------------------------
INSERT INTO `lamp_role_node` VALUES ('2', '1');
INSERT INTO `lamp_role_node` VALUES ('2', '5');
INSERT INTO `lamp_role_node` VALUES ('2', '9');
INSERT INTO `lamp_role_node` VALUES ('3', '1');
INSERT INTO `lamp_role_node` VALUES ('3', '5');
INSERT INTO `lamp_role_node` VALUES ('3', '9');
INSERT INTO `lamp_role_node` VALUES ('4', '1');
INSERT INTO `lamp_role_node` VALUES ('4', '5');
INSERT INTO `lamp_role_node` VALUES ('4', '9');
INSERT INTO `lamp_role_node` VALUES ('1', '1');
INSERT INTO `lamp_role_node` VALUES ('1', '2');
INSERT INTO `lamp_role_node` VALUES ('1', '3');
INSERT INTO `lamp_role_node` VALUES ('1', '4');
INSERT INTO `lamp_role_node` VALUES ('1', '5');
INSERT INTO `lamp_role_node` VALUES ('1', '8');
INSERT INTO `lamp_role_node` VALUES ('1', '9');

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
-- Records of lamp_user
-- ----------------------------
INSERT INTO `lamp_user` VALUES ('1', 'admin', '超级管理员', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `lamp_user` VALUES ('2', 'sunma', '文斌', '202cb962ac59075b964b07152d234b70');

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
-- Records of lamp_user_role
-- ----------------------------
INSERT INTO `lamp_user_role` VALUES ('3', '2');
INSERT INTO `lamp_user_role` VALUES ('1', '1');
INSERT INTO `lamp_user_role` VALUES ('2', '2');

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
-- Records of lamp_ycompany_role
-- ----------------------------
INSERT INTO `lamp_ycompany_role` VALUES ('7', '4');
INSERT INTO `lamp_ycompany_role` VALUES ('7', '9');
INSERT INTO `lamp_ycompany_role` VALUES ('2', '1');
INSERT INTO `lamp_ycompany_role` VALUES ('4', '3');
INSERT INTO `lamp_ycompany_role` VALUES ('4', '5');

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
-- Records of lamp_ynode
-- ----------------------------
INSERT INTO `lamp_ynode` VALUES ('1', '浏览用户', 'user', 'index', '1');
INSERT INTO `lamp_ynode` VALUES ('2', '添加用户', 'user', 'add', '1');
INSERT INTO `lamp_ynode` VALUES ('3', '删除用户', 'user', 'delete', '1');
INSERT INTO `lamp_ynode` VALUES ('4', '修改用户', 'user', 'edit', '1');
INSERT INTO `lamp_ynode` VALUES ('5', '浏览角色', 'role', 'index', '1');
INSERT INTO `lamp_ynode` VALUES ('6', '添加角色', 'role', 'add', '1');
INSERT INTO `lamp_ynode` VALUES ('7', '删除角色', 'role', 'delete', '2');
INSERT INTO `lamp_ynode` VALUES ('8', '编辑角色', 'role', 'edit', '2');
INSERT INTO `lamp_ynode` VALUES ('9', '浏览节点', 'node', 'index', '2');

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
-- Records of lamp_yrole
-- ----------------------------
INSERT INTO `lamp_yrole` VALUES ('2', '项目经理22', '1', '负责所有项目');
INSERT INTO `lamp_yrole` VALUES ('3', '部门主任', '2', '负责当期部门管理');

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
-- Records of lamp_yrole_node
-- ----------------------------
INSERT INTO `lamp_yrole_node` VALUES ('3', '7');
INSERT INTO `lamp_yrole_node` VALUES ('3', '2');
INSERT INTO `lamp_yrole_node` VALUES ('3', '13');
INSERT INTO `lamp_yrole_node` VALUES ('3', '15');
INSERT INTO `lamp_yrole_node` VALUES ('7', '4');
INSERT INTO `lamp_yrole_node` VALUES ('7', '12');
INSERT INTO `lamp_yrole_node` VALUES ('8', '1');
INSERT INTO `lamp_yrole_node` VALUES ('8', '13');
INSERT INTO `lamp_yrole_node` VALUES ('2', '4');
INSERT INTO `lamp_yrole_node` VALUES ('2', '12');
INSERT INTO `lamp_yrole_node` VALUES ('2', '16');
INSERT INTO `lamp_yrole_node` VALUES ('2', '3');
INSERT INTO `lamp_yrole_node` VALUES ('2', '11');
INSERT INTO `lamp_yrole_node` VALUES ('2', '7');
INSERT INTO `lamp_yrole_node` VALUES ('2', '14');
INSERT INTO `lamp_yrole_node` VALUES ('2', '1');
INSERT INTO `lamp_yrole_node` VALUES ('2', '13');
INSERT INTO `lamp_yrole_node` VALUES ('2', '19');
INSERT INTO `lamp_yrole_node` VALUES ('2', '9');
INSERT INTO `lamp_yrole_node` VALUES ('2', '5');
INSERT INTO `lamp_yrole_node` VALUES ('2', '15');
INSERT INTO `lamp_yrole_node` VALUES ('2', '2');
INSERT INTO `lamp_yrole_node` VALUES ('2', '10');
INSERT INTO `lamp_yrole_node` VALUES ('2', '6');
INSERT INTO `lamp_yrole_node` VALUES ('2', '8');
INSERT INTO `lamp_yrole_node` VALUES ('4', '1');

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
-- Records of lamp_yshop
-- ----------------------------
INSERT INTO `lamp_yshop` VALUES ('1', '大渔烧烤', '6', '1', '32', null, '232222', '200', '2', '1', '徐汇区');
INSERT INTO `lamp_yshop` VALUES ('6', '梅亭', '6', '1', '56068888', '', '长乐路', null, '2', '1', '12');
INSERT INTO `lamp_yshop` VALUES ('7', '沪蝶', '9', '1', '56956444', '8点~21点', '新村路', null, '1', '2', '静安');
INSERT INTO `lamp_yshop` VALUES ('8', '21', '14', '1', '21', '12', '21', null, '1', '2', '21');
INSERT INTO `lamp_yshop` VALUES ('9', '21', '6', '2', '12', '21', '12', null, '1', '2', '21');
INSERT INTO `lamp_yshop` VALUES ('11', '21', '14', '1', '13623372463', '21', '21', null, '1', '2', '普陀区');

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
-- Records of lamp_yshop_attr
-- ----------------------------
INSERT INTO `lamp_yshop_attr` VALUES ('1', '2');
INSERT INTO `lamp_yshop_attr` VALUES ('1', '2');
INSERT INTO `lamp_yshop_attr` VALUES ('1', '3');

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
-- Records of lamp_yshop_banner
-- ----------------------------
INSERT INTO `lamp_yshop_banner` VALUES ('28', '6', '20180105\\43c2df5501b98bd6b7b047e5b3286574.PNG', '1', '0');
INSERT INTO `lamp_yshop_banner` VALUES ('29', '7', '20180105\\c03bbc7f7d0bcd23a29643d5d098d280.PNG', '1', '0');
INSERT INTO `lamp_yshop_banner` VALUES ('36', '1', '20180107/a96ff5db4779d11b12b0f814bc61213e.jpg', '2', '2');
INSERT INTO `lamp_yshop_banner` VALUES ('37', '1', '20180107/f62c2a1bc560986b625a01a7fb2052e1.jpg', '2', '2');
INSERT INTO `lamp_yshop_banner` VALUES ('38', '1', '20180107/77729eb6ff4ce8dae71dce2b6eab22ca.jpg', '1', '2');
INSERT INTO `lamp_yshop_banner` VALUES ('39', '1', '20180107/054f63a79e4dd015df59d105aa26c9d7.jpg', '1', '2');

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
-- Records of lamp_yshop_comment
-- ----------------------------
INSERT INTO `lamp_yshop_comment` VALUES ('24', '1', '<p>55555555555555555555</p>', '1');
INSERT INTO `lamp_yshop_comment` VALUES ('25', '1', '<p>32555555555555555555555555555555555555555555555555555555555555555555555555555555555</p>11111111111111111111', '2');

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
-- Records of lamp_yshop_show
-- ----------------------------
INSERT INTO `lamp_yshop_show` VALUES ('24', '1', '日式铁板烧', '20180106/8508b066382ac05d3debbf5ca16ef124.jpg', '1', '1', '1');
INSERT INTO `lamp_yshop_show` VALUES ('25', '6', '日式小火锅', '20180106/38e5325bb9f18f3c9e1d98b41f519af4.jpg', '1', '1', '1');
INSERT INTO `lamp_yshop_show` VALUES ('26', '1', '环境优雅', '20180106/5063b573a59d49b1411a28300c4c8eaa.jpg', '1', '2', '2');
INSERT INTO `lamp_yshop_show` VALUES ('30', '1', '1111', '20180108/4a32fa7be30c10dc47ee993637744faf.jpg', '2', '2', '2');

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

-- ----------------------------
-- Records of lamp_zuser
-- ----------------------------
INSERT INTO `lamp_zuser` VALUES ('23', '18621695842', 'e10adc3949ba59abbe56e057f20f883e', 'wst', '20180107/28f6c0bd1b4468d7b337e86bda3a344d.jpg', '1', '1', '1996-02-18', 'zmj321284', '676499058@qq.com');
SET FOREIGN_KEY_CHECKS=1;
