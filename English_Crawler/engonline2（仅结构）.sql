/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : engonline2

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-05-25 16:37:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alogin
-- ----------------------------
DROP TABLE IF EXISTS `alogin`;
CREATE TABLE `alogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for aupload
-- ----------------------------
DROP TABLE IF EXISTS `aupload`;
CREATE TABLE `aupload` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `uploadtime` date DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for clozeques
-- ----------------------------
DROP TABLE IF EXISTS `clozeques`;
CREATE TABLE `clozeques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `choiceA` varchar(100) DEFAULT NULL,
  `choiceB` varchar(100) DEFAULT NULL,
  `choiceC` varchar(100) DEFAULT NULL,
  `choiceD` varchar(100) DEFAULT NULL,
  `answer` char(2) DEFAULT NULL,
  `analysis` varchar(255) DEFAULT NULL,
  `typeid` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `textid` int(11) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for qcollection
-- ----------------------------
DROP TABLE IF EXISTS `qcollection`;
CREATE TABLE `qcollection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `typeid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for qtype
-- ----------------------------
DROP TABLE IF EXISTS `qtype`;
CREATE TABLE `qtype` (
  `typeid` tinyint(4) NOT NULL DEFAULT '0',
  `tname` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for readques
-- ----------------------------
DROP TABLE IF EXISTS `readques`;
CREATE TABLE `readques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `choiceA` varchar(100) DEFAULT NULL,
  `choiceB` varchar(100) DEFAULT NULL,
  `choiceC` varchar(100) DEFAULT NULL,
  `choiceD` varchar(100) DEFAULT NULL,
  `answer` char(2) DEFAULT NULL,
  `analysis` varchar(255) DEFAULT NULL,
  `typeid` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `textid` int(11) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for singleques
-- ----------------------------
DROP TABLE IF EXISTS `singleques`;
CREATE TABLE `singleques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `choiceA` varchar(100) DEFAULT NULL,
  `choiceB` varchar(100) DEFAULT NULL,
  `choiceC` varchar(100) DEFAULT NULL,
  `choiceD` varchar(100) DEFAULT NULL,
  `answer` char(2) DEFAULT NULL,
  `analysis` varchar(255) DEFAULT NULL,
  `typeid` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fromid` (`fromid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for textread
-- ----------------------------
DROP TABLE IF EXISTS `textread`;
CREATE TABLE `textread` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `textid` int(11) DEFAULT NULL,
  `texts` text,
  `qnum` int(11) DEFAULT NULL,
  `typeid` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `textid` (`textid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ulogin
-- ----------------------------
DROP TABLE IF EXISTS `ulogin`;
CREATE TABLE `ulogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `pwd` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for urlinfo
-- ----------------------------
DROP TABLE IF EXISTS `urlinfo`;
CREATE TABLE `urlinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) DEFAULT NULL,
  `quesurl` varchar(255) DEFAULT NULL,
  `flag` char(2) DEFAULT NULL,
  `gaintime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quesurl` (`quesurl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for userinfo
-- ----------------------------
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `uid` int(11) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `school` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usertest
-- ----------------------------
DROP TABLE IF EXISTS `usertest`;
CREATE TABLE `usertest` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) DEFAULT '0',
  `num` int(11) DEFAULT '0',
  `stime` int(11) DEFAULT '0',
  `errnum` int(11) DEFAULT '0',
  `ptype` int(11) DEFAULT '0',
  `studyday` date DEFAULT NULL,
  `weekdays` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for voc
-- ----------------------------
DROP TABLE IF EXISTS `voc`;
CREATE TABLE `voc` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `vname` varchar(255) DEFAULT NULL,
  `explains` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
