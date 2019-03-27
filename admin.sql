/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50555
Source Host           : localhost:3306
Source Database       : admin

Target Server Type    : MYSQL
Target Server Version : 50555
File Encoding         : 65001

Date: 2019-03-27 21:41:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cnwt_department
-- ----------------------------
DROP TABLE IF EXISTS `cnwt_department`;
CREATE TABLE `cnwt_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cnwt_department
-- ----------------------------
INSERT INTO `cnwt_department` VALUES ('1', '行政部');
INSERT INTO `cnwt_department` VALUES ('2', '项目部');

-- ----------------------------
-- Table structure for cnwt_task
-- ----------------------------
DROP TABLE IF EXISTS `cnwt_task`;
CREATE TABLE `cnwt_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `type` varchar(255) NOT NULL,
  `result` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=',
  `created_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cnwt_task
-- ----------------------------

-- ----------------------------
-- Table structure for cnwt_task_record
-- ----------------------------
DROP TABLE IF EXISTS `cnwt_task_record`;
CREATE TABLE `cnwt_task_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `result` tinyint(4) DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cnwt_task_record
-- ----------------------------

-- ----------------------------
-- Table structure for cnwt_user
-- ----------------------------
DROP TABLE IF EXISTS `cnwt_user`;
CREATE TABLE `cnwt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '密码',
  `department` int(11) NOT NULL DEFAULT '0',
  `position` varchar(255) NOT NULL DEFAULT '',
  `level` int(11) NOT NULL DEFAULT '0',
  `dismission_time` int(11) NOT NULL DEFAULT '0',
  `realname` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`(191)) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cnwt_user
-- ----------------------------
INSERT INTO `cnwt_user` VALUES ('1', 'admin', '73e9842e61ebfca195f0b934af4000de', '1', '', '4', '0', '超管');
INSERT INTO `cnwt_user` VALUES ('4', '001', 'ef00724ab59e1a21194dd9967f041a28', '2', '', '0', '0', '测试');

-- ----------------------------
-- Table structure for cnwt_welcome
-- ----------------------------
DROP TABLE IF EXISTS `cnwt_welcome`;
CREATE TABLE `cnwt_welcome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(1024) NOT NULL DEFAULT '',
  `created_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cnwt_welcome
-- ----------------------------
INSERT INTO `cnwt_welcome` VALUES ('5', '这是第一句\r', '1553430414');
INSERT INTO `cnwt_welcome` VALUES ('6', '这是第二句\r', '1553430414');
INSERT INTO `cnwt_welcome` VALUES ('7', '这是第三句', '1553430414');
