/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : ticktock

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-12-30 18:04:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tt_category
-- ----------------------------
DROP TABLE IF EXISTS `tt_category`;
CREATE TABLE `tt_category` (
  `cid` int(2) unsigned NOT NULL AUTO_INCREMENT COMMENT '板块id',
  `cname` varchar(255) DEFAULT NULL COMMENT '板块名称',
  `discription` varchar(255) DEFAULT NULL COMMENT '板块描述',
  `parentid` int(2) DEFAULT NULL COMMENT '父板块id，0为父',
  `classpath` char(20) NOT NULL COMMENT '板块路径',
  `display` int(1) NOT NULL DEFAULT '1' COMMENT '板块是否显示',
  `replycount` int(11) NOT NULL DEFAULT '0' COMMENT '板块回复计数',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_category
-- ----------------------------
INSERT INTO `tt_category` VALUES ('1', '2', 'dsadsad', '11', '123213213123', '1', '0');
INSERT INTO `tt_category` VALUES ('12', '2', 'dsadsad', '11', '123213213123', '1', '0');
INSERT INTO `tt_category` VALUES ('2', '2', 'dsadsad', '12', '123213213123', '1', '0');
INSERT INTO `tt_category` VALUES ('3', '3', 'dsadsad', '13', '123213213123', '1', '0');
INSERT INTO `tt_category` VALUES ('4', '4', 'dsadsad', '14', '123213213123', '1', '0');

-- ----------------------------
-- Table structure for tt_post
-- ----------------------------
DROP TABLE IF EXISTS `tt_post`;
CREATE TABLE `tt_post` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'POST_ID',
  `first` char(1) DEFAULT '0' COMMENT '是否置顶',
  `authorid` int(11) DEFAULT NULL COMMENT '作者ID',
  `title` varchar(255) DEFAULT NULL COMMENT '主题标题',
  `content` mediumtext COMMENT '主题内容',
  `ctime` varchar(20) DEFAULT NULL COMMENT '主题创建时间',
  `cip` varchar(255) DEFAULT NULL COMMENT '主题创建IP',
  `rcount` int(4) DEFAULT '0' COMMENT '主题回复数',
  `display` char(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `nodename` varchar(255) DEFAULT NULL COMMENT '节点名',
  `rid` int(11) DEFAULT '0' COMMENT '回复id，0为主题，数值=主题id',
  `ccount` int(11) DEFAULT '0' COMMENT '主题点击数',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_post
-- ----------------------------
INSERT INTO `tt_post` VALUES ('58', '0', '1', '创意工作者们的社区创意工作者们的社区', '创意工作者们的社区创意工作者们的社区', '1483090191', '2130706433', '5', '1', 'qna', '0', '24');
INSERT INTO `tt_post` VALUES ('59', '0', '1', null, '还没有回复呢还没有回复呢还没有回复呢', '1483090205', '2130706433', '0', '1', null, '58', '0');
INSERT INTO `tt_post` VALUES ('60', '0', '1', null, '收拾收拾收拾收拾收拾收拾', '1483090697', '2130706433', '0', '1', null, '58', '0');
INSERT INTO `tt_post` VALUES ('61', '0', '1', null, '反反复复反反复复方法', '1483090721', '2130706433', '0', '1', null, '58', '0');
INSERT INTO `tt_post` VALUES ('62', '0', '1', null, '哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈', '1483090732', '2130706433', '0', '1', null, '58', '0');
INSERT INTO `tt_post` VALUES ('63', '0', '1', null, '### 哈哈\r\n## 哈哈\r\n* 哈哈\r\n_为_', '1483090795', '2130706433', '0', '1', null, '58', '0');

-- ----------------------------
-- Table structure for tt_user
-- ----------------------------
DROP TABLE IF EXISTS `tt_user`;
CREATE TABLE `tt_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '用户密码',
  `email` varchar(255) DEFAULT NULL COMMENT '注册邮箱',
  `rtime` varchar(255) NOT NULL COMMENT '注册日期',
  `ltime` varchar(255) NOT NULL COMMENT '最后访问日期',
  `hicon` varchar(255) NOT NULL COMMENT '头像路径',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '金币等级 ',
  `usergrant` tinyint(1) NOT NULL COMMENT '用户等级',
  `ip` varchar(255) NOT NULL COMMENT '注册ip',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_user
-- ----------------------------
INSERT INTO `tt_user` VALUES ('1', 'admin', 'e3ceb5881a0a1fdaad01296d7554868d', '2222222222', '1482823487', '1482823487', './imgs/photo.png', '99999', '7', '2130706433');
SET FOREIGN_KEY_CHECKS=1;
