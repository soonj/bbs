/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : ticktock

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2017-01-09 20:53:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tt_banip
-- ----------------------------
DROP TABLE IF EXISTS `tt_banip`;
CREATE TABLE `tt_banip` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_banip
-- ----------------------------

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
-- Table structure for tt_friend
-- ----------------------------
DROP TABLE IF EXISTS `tt_friend`;
CREATE TABLE `tt_friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL COMMENT '友情链接',
  `level` int(2) DEFAULT NULL COMMENT '等级',
  `info` varchar(255) DEFAULT NULL COMMENT '友链详情',
  `ctime` char(255) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_friend
-- ----------------------------
INSERT INTO `tt_friend` VALUES ('1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for tt_post
-- ----------------------------
DROP TABLE IF EXISTS `tt_post`;
CREATE TABLE `tt_post` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'POST_ID',
  `first` char(1) DEFAULT '0' COMMENT '是否置顶',
  `lastuser` varchar(255) DEFAULT NULL,
  `authorid` int(11) DEFAULT NULL COMMENT '作者ID',
  `title` varchar(255) DEFAULT NULL COMMENT '主题标题',
  `content` mediumtext COMMENT '主题内容',
  `retime` varchar(20) DEFAULT NULL COMMENT '最后回复时间',
  `ctime` varchar(20) DEFAULT NULL COMMENT '主题创建时间',
  `cip` varchar(255) DEFAULT NULL COMMENT '主题创建IP',
  `rcount` int(4) DEFAULT '0' COMMENT '主题回复数',
  `display` char(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `nodename` varchar(255) DEFAULT NULL COMMENT '节点名',
  `rid` int(11) DEFAULT '0' COMMENT '回复id，0为主题，数值=主题id',
  `ccount` int(11) DEFAULT '0' COMMENT '主题点击数',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=319 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_post
-- ----------------------------
INSERT INTO `tt_post` VALUES ('78', '0', null, '44', '444444', '', '1483600936', '1483600936', '2130706433', '53', '1', 'qna', '0', '108');
INSERT INTO `tt_post` VALUES ('79', '0', null, '44', '33333333333', '', '1483600936', '1483601410', '2130706433', '0', '1', 'qna', '0', '25');
INSERT INTO `tt_post` VALUES ('80', '0', null, '44', '33333333333333333333333333', '', '1483600936', '1483605534', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('81', '0', null, '44', '2222222222222222', '', '1483600936', '1483605818', '2130706433', '0', '1', 'qna', '0', '2');
INSERT INTO `tt_post` VALUES ('82', '0', null, '44', '21345536455526436532', '', '1483600936', '1483606396', '2130706433', '0', '1', 'qna', '0', '0');
INSERT INTO `tt_post` VALUES ('83', '0', null, '44', '21345536455526436532', '', '1483600936', '1483606610', '2130706433', '0', '1', 'qna', '0', '0');
INSERT INTO `tt_post` VALUES ('84', '0', null, '44', '21345536455526436532', '', '1483600936', '1483606647', '2130706433', '0', '1', 'qna', '0', '0');
INSERT INTO `tt_post` VALUES ('85', '0', null, '44', null, '', null, '1483607882', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('86', '0', null, '44', null, '## 哈哈哈\r\n### 哈哈哈', null, '1483608322', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('87', '0', null, '44', null, '哈哈哈哈哈哈', null, '1483668505', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('88', '0', null, '44', 'SDADFFSFSAFSAF', '', '1483600936', '1483673242', '2130706433', '0', '1', 'qna', '0', '2');
INSERT INTO `tt_post` VALUES ('89', '0', null, '44', 'SAFSAFDSGFDSAGFDSAFDSAGDSFA', '', '1483600936', '1483673379', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('90', '0', null, '44', 'ASFAGFSHGHGFHDS', '', '1483600936', '1483673474', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('91', '0', null, '44', 'ASDSAFDSGHYTKFJMNBYG', '', '1483600936', '1483673490', '2130706433', '0', '1', 'qna', '0', '0');
INSERT INTO `tt_post` VALUES ('92', '0', null, '44', 'AFRGTGREFEASDCDSIULK', 'DASFEWTFDS', '1483600936', '1483673510', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('93', '0', null, '44', 'FASFADSFGDSGREG', '', '1483600936', '1483673619', '2130706433', '2', '1', 'qna', '0', '6');
INSERT INTO `tt_post` VALUES ('94', '0', null, '44', null, 'AFJSIOJFEKFLJDSFEWFFDSFDD', null, '1483673635', '2130706433', '0', '1', null, '93', '0');
INSERT INTO `tt_post` VALUES ('95', '0', null, '44', null, 'tttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDDtttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDD', null, '1483673650', '2130706433', '0', '1', null, '93', '0');
INSERT INTO `tt_post` VALUES ('96', '0', null, '44', 'ADSADAFDSGAFSDAFDS', '', '1483600936', '1483673692', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('97', '0', null, '44', 'tttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDD', '', '1483600936', '1483673703', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('98', '0', null, '44', 'tttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDDtttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDDtttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDD', '', '1483600936', '1483673713', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('99', '0', null, '44', 'tttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDDtttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDDtttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDDtttt    2017-01-06,03:33:55\r\nAFJSIOJFEKFLJDSFEWFFDSFDD', '', '1483600936', '1483673723', '2130706433', '1', '1', 'qna', '0', '4');
INSERT INTO `tt_post` VALUES ('100', '0', 'tttttt', '44', '是大大舒服撒打发的事', '', '1483600936', '1483674535', '2130706433', '2', '1', 'qna', '0', '7');
INSERT INTO `tt_post` VALUES ('101', '0', null, '44', 'warwdsafwrfdsfewrwewdfas', '', '1483600936', '1483674728', '2130706433', '0', '1', 'qna', '0', '0');
INSERT INTO `tt_post` VALUES ('102', '0', null, '44', 'sadfsdfadsgasf', '', '1483600936', '1483674839', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('103', '0', null, '44', null, '当前主题没有回复呢~', null, '1483678405', '2130706433', '0', '1', null, '99', '0');
INSERT INTO `tt_post` VALUES ('104', '0', null, '44', 'safsgdsjhgltyrewdcsdcxv', '', null, '1483680971', '2130706433', '1', '1', 'qna', '0', '14');
INSERT INTO `tt_post` VALUES ('105', '0', null, '44', 'safsgdsjhgltyrewdcsdcxv', '', null, '1483680971', '2130706433', '0', '1', 'qna', '0', '5');
INSERT INTO `tt_post` VALUES ('308', '0', null, '47', 'aijhklnk,dslkjfidsnmlkjilasnfkldjsknjlkfjsaiudhnakjfmnsadsfsad', '', null, '1483753982', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('309', '0', null, '47', null, '222222222222222222222222222222222', null, '1483754178', '2130706433', '0', '1', null, '100', '0');
INSERT INTO `tt_post` VALUES ('310', '0', null, '47', null, 'FSAFSAFDSSAFSADFSADFDSA', null, '1483754305', '2130706433', '0', '1', null, '104', '0');
INSERT INTO `tt_post` VALUES ('311', '0', null, '47', '›  创建新主题 ›  创建新主题 ›  创建新主题', '', null, '1483754583', '2130706433', '0', '1', 'qna', '0', '6');
INSERT INTO `tt_post` VALUES ('312', '0', null, '47', 'ssssssdddddd', '', null, '1483778758', '2130706433', '0', '1', 'qna', '0', '1');
INSERT INTO `tt_post` VALUES ('313', '0', 'tttttt', '47', '$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$', '', null, '1483778796', '2130706433', '4', '1', 'qna', '0', '13');
INSERT INTO `tt_post` VALUES ('314', '0', 'tttttt', '44', null, '哈哈哈哈哈哈哈', null, '1483925219', '2130706433', '0', '1', null, '313', '0');
INSERT INTO `tt_post` VALUES ('315', '0', 'tttttt', '44', null, '分萨福萨法说', null, '1483925606', '2130706433', '0', '1', null, '313', '0');
INSERT INTO `tt_post` VALUES ('316', '0', null, '44', null, '发顺丰萨法', null, '1483925804', '2130706433', '0', '1', null, '313', '0');
INSERT INTO `tt_post` VALUES ('317', '0', null, '44', null, '撒丰富的撒发的官方的说法', null, '1483925844', '2130706433', '0', '1', null, '313', '0');
INSERT INTO `tt_post` VALUES ('318', '0', null, '44', null, '发生的范德萨分', null, '1483925861', '2130706433', '0', '1', null, '100', '0');
INSERT INTO `tt_post` VALUES ('256', '0', null, '44', null, 'Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n哈哈哈哈哈哈\r\n\r\n  ›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685744', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('257', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685751', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('258', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685754', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('259', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685758', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('260', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685765', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('261', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685768', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('262', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685773', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('263', '0', null, '44', null, '›  qna\r\n444444\r\n\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击  \r\n15 次点击      忽略主题  \r\n重启 Windows BIOS AMD 3 回复   |  直到 2017-01-06 02:08:25 +08:00\r\n Reply    1 tttttt    2017-01-05,09:18:02\r\n  Reply    2 tttttt    2017-01-05,09:25:22\r\n哈哈哈\r\n\r\n哈哈哈\r\n  Reply    3 tttttt    2017-01-06,02:08:25\r\n哈哈哈哈哈哈', null, '1483685776', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('264', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686105', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('265', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686113', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('266', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686119', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('267', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686123', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('268', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686128', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('269', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686131', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('270', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686133', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('271', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686135', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('272', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686137', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('273', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686139', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('274', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686141', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('275', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686143', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('276', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686144', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('277', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686145', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('278', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686146', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('279', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686147', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('280', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686147', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('281', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686148', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('282', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686149', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('283', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686150', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('284', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686151', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('285', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686152', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('286', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686152', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('287', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686153', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('288', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686154', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('289', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686155', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('290', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686156', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('291', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686157', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('292', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686158', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('293', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686158', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('294', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686159', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('295', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686160', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('296', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686161', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('297', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686162', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('298', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686162', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('299', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686163', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('300', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686164', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('301', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686165', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('302', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686166', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('303', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686166', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('304', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686167', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('305', '0', null, '44', null, '› qna 444444\r\ntttttt · 2017-01-05,07:22:16 发布 · 15 次点击\r\n15 次点击 忽略主题\r\n重启 Windows BIOS AMD 3 回复 | 直到 2017-01-06 02:08:25 +08:00 Reply 1 tttttt 2017-01-05,09:18:02 Reply 2 tttttt 2017-01-05,09:25:22 哈哈哈\r\n哈哈哈 Reply 3 tttttt 2017-01-06,02:08:25 哈哈哈哈哈哈', null, '1483686168', '2130706433', '0', '1', null, '78', '0');
INSERT INTO `tt_post` VALUES ('306', '0', null, '44', 'adstrytiuktrewqdasarteyuiylui', '', null, '1483686515', '2130706433', '1', '1', 'qna', '0', '5');
INSERT INTO `tt_post` VALUES ('307', '0', null, '44', null, 'aetrsytyuliykewqed', null, '1483686525', '2130706433', '0', '1', null, '306', '0');

-- ----------------------------
-- Table structure for tt_tab
-- ----------------------------
DROP TABLE IF EXISTS `tt_tab`;
CREATE TABLE `tt_tab` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tabname` varchar(255) DEFAULT NULL COMMENT '板块名',
  `display` int(1) DEFAULT NULL COMMENT '是否删除',
  `logo` varchar(255) DEFAULT NULL COMMENT '板块图标',
  `info` varchar(255) DEFAULT NULL COMMENT '板块介绍',
  `hidden` int(1) DEFAULT NULL COMMENT '是否隐藏',
  `scythe` varchar(255) DEFAULT NULL COMMENT '版主名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_tab
-- ----------------------------
INSERT INTO `tt_tab` VALUES ('1', '1', '1', '1', '1', '0', '1');

-- ----------------------------
-- Table structure for tt_user
-- ----------------------------
DROP TABLE IF EXISTS `tt_user`;
CREATE TABLE `tt_user` (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` char(255) NOT NULL COMMENT '用户密码',
  `email` varchar(255) DEFAULT NULL COMMENT '注册邮箱',
  `rtime` varchar(255) NOT NULL COMMENT '注册日期',
  `ltime` varchar(255) NOT NULL COMMENT '最后访问日期',
  `hicon` varchar(255) NOT NULL DEFAULT 'http://localhost/document/bbs/public/imgs/photo.png' COMMENT '头像路径',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '金币等级 ',
  `usergrant` int(11) NOT NULL COMMENT '用户等级',
  `gragh` tinytext COMMENT '用户签名',
  `ip` varchar(255) NOT NULL COMMENT '注册ip',
  `info` tinytext COMMENT '用户信息',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tt_user
-- ----------------------------
INSERT INTO `tt_user` VALUES ('46', '888888', '$2y$10$0OM4Kfww5vEbVmrt4Hala.4A3QHnhUSMMRG012MwpYocXwQAuotqC', '88', '1483692264', '1483692264', 'http://localhost/document/bbs/public/imgs/photo.png', '135', '999', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('1', 'admin', 'e3ceb5881a0a1fdaad01296d7554868d', '2222222222', '1482823487', '1482823487', 'http://localhost/document/bbs/public/imgs/photo.png', '99999', '7', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('45', 'nnnnnn', '$2y$10$1L3m6u2H4OjILNdrmzHeJ.mHvObSdmR22nswpkK7lCfTwW...t1H6', 'nnn', '1483617410', '1483617410', 'http://localhost/document/bbs/public/imgs/photo.png', '50', '0', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('44', 'tttttt', '$2y$10$l/POzZzbidQr9SLaGJChIeZWC0OhQEVN8CBlNonjJ.PyBLDMKQvpK', 'tttttt', '1483593303', '1483593303', './upload/imgs/587048498dbc1.png', '100504', '0', 'sdafafsadsa', '2130706433', 'sfadsafdsgaf');
INSERT INTO `tt_user` VALUES ('43', 'rrrrrr', '$2y$10$ZGnUKlRO/z/sUBSb90hdbOQiqlbDWBZAI3ziyCFNhC1Sw5iqCi.0S', 'r', '1483593210', '1483593210', 'http://localhost/document/bbs/public/imgs/photo.png', '50', '0', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('42', 'eeeeee', '$2y$10$XkXN9qYmENO0g2RvNmmIiudcjzA2RmXNBiBOv3I9pr8d6LnkkMOJ6', 'eeeeee', '1483592689', '1483592689', 'http://localhost/document/bbs/public/imgs/photo.png', '50', '0', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('41', 'wwwwww', '$2y$10$UiRmbBWwBcEcxHNi0/.0/OfXnn/m9HCFlIXvE5h660icxK2YMyLrq', 'ww', '1483592631', '1483592631', 'http://localhost/document/bbs/public/imgs/photo.png', '40', '0', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('40', '333333', '$2y$10$g6mDLD0hSaVFAHmVu1eMFepClb/yXgSsQcra/M.EQ0xWKtwjYH41i', '33', '1483592551', '1483592551', 'http://localhost/document/bbs/public/imgs/photo.png', '50', '0', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('39', '222222', '$2y$10$CYs/bB5ATJKLN8Bl.8OmpO9kq4bVcyIsHFXUgM3mPdNLZG13a9UBe', '22', '1483592500', '1483592500', 'http://localhost/document/bbs/public/imgs/photo.png', '50', '0', null, '2130706433', null);
INSERT INTO `tt_user` VALUES ('47', 'pppppp', '$2y$10$QpCKTnLoDkvJlE58RhBaAOnh5y2ydP3voyg4Qq7v0gy3M//uOrHCG', 'pp', '1483753943', '1483753943', 'http://localhost/document/bbs/public/imgs/photo.png', '82', '0', null, '2130706433', '');
SET FOREIGN_KEY_CHECKS=1;
