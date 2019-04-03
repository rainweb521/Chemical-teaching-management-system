/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : edu

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-07-27 14:58:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(255) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'rain', '123');

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `add_time` char(255) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `username` char(255) DEFAULT NULL,
  `photo` char(255) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL COMMENT '评论的状态，是否显示',
  `status` tinyint(4) DEFAULT NULL COMMENT '评论的类型，主评论，或者是跟随评论',
  `content` char(255) DEFAULT NULL,
  `e_id` int(11) DEFAULT NULL,
  `e_title` char(255) DEFAULT NULL,
  `node` int(11) DEFAULT NULL,
  `type` char(255) DEFAULT NULL COMMENT '显示用户的标识和管理员的标识',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '2017-12-03', '1', 'rain', '', '0', '1', '123', '5', 'wcy', '2', 'User');
INSERT INTO `comment` VALUES ('2', '2017-12-03', '1', 'rain', null, '1', '2', '456', '5', 'wcy', '0', 'Admin');
INSERT INTO `comment` VALUES ('3', '2017-12-03', '1', 'rain', null, '1', '1', '78979', '5', 'wcy', '0', 'User');
INSERT INTO `comment` VALUES ('4', '2017-12-03', '1', 'rain', null, '1', '1', 'wsdrowqr4', '5', 'wcy', '0', 'User');
INSERT INTO `comment` VALUES ('5', '2017-12-03', '1', 'rain', null, '1', '1', '43534534', '5', 'wcy', '0', 'User');
INSERT INTO `comment` VALUES ('6', '2018-02-28', '1', 'rain', '/public/uploads/20171203\\a7843abccbf0837e4a2a0bd3136901d7.png', '1', '1', 'w chil', '4', '123', '0', 'User');
INSERT INTO `comment` VALUES ('7', '2018-05-06', '1', 'rain', '/public/uploads/20171203\\a7843abccbf0837e4a2a0bd3136901d7.png', '1', '1', 'haha', '6', '123', '0', 'User');
INSERT INTO `comment` VALUES ('8', '2018-05-08 05:07:05', '1', 'rain', '/public/uploads/20171203\\a7843abccbf0837e4a2a0bd3136901d7.png', '1', '1', '哈哈', '8', '1', '0', 'User');
INSERT INTO `comment` VALUES ('9', '2018-05-08', '1', 'rain', '/public/uploads/20171203\\a7843abccbf0837e4a2a0bd3136901d7.png', '1', '1', '123', '8', '1', '0', 'User');

-- ----------------------------
-- Table structure for `experiment`
-- ----------------------------
DROP TABLE IF EXISTS `experiment`;
CREATE TABLE `experiment` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '实验信息的表',
  `title` char(255) DEFAULT NULL COMMENT '实验标题',
  `profile` text COMMENT '实验简介',
  `content` text COMMENT '实验内容',
  `add_time` char(255) DEFAULT NULL COMMENT '添加时间',
  `focus` char(255) DEFAULT NULL COMMENT '实验重点',
  `material` char(255) DEFAULT NULL COMMENT '实验器材',
  `picture` char(255) DEFAULT NULL COMMENT '实验图片',
  `video` char(255) DEFAULT NULL COMMENT '实验视频',
  `view` int(11) DEFAULT '0' COMMENT '观看次数',
  `state` tinyint(4) DEFAULT NULL COMMENT '实验状态，能否观看',
  `status` tinyint(4) DEFAULT NULL COMMENT '实验类型',
  `status_grade` tinyint(4) DEFAULT NULL COMMENT '以数字的形式来显示年级',
  `grade` char(255) DEFAULT NULL COMMENT '以文本的形式显示年级',
  `status_react` tinyint(4) DEFAULT NULL COMMENT '化学反应类型的数字形式',
  `react` char(255) DEFAULT NULL COMMENT '化学反应的文字形式',
  `u_id` int(11) DEFAULT NULL,
  `uploader` char(255) DEFAULT NULL COMMENT '上传者',
  `video_time` char(255) DEFAULT NULL COMMENT '视频时长',
  PRIMARY KEY (`e_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of experiment
-- ----------------------------
INSERT INTO `experiment` VALUES ('8', '1', '1', '1', '2018-05-06', '1', '1', '/public/uploads/20180508\\71e58da3850c98566e8ccce8f95ac6d9.jpg', '/public/uploads/20180506\\65c9adda7cee49cfb4cead2b9269919f.mp4', '8', '1', null, '1', null, '1', null, null, '1', null);
INSERT INTO `experiment` VALUES ('9', '432432', '4324', '432', '2018-05-08', '4324', '4324', '/public/uploads/20180508\\ff0c8e644bae9d471303e6881ec58f9b.jpg', '/public/uploads/20180508\\f2ba2930208f76b60691d9dd21ff3167.wmv', '2', '1', null, '1', null, '1', null, null, '4324', null);
INSERT INTO `experiment` VALUES ('10', '11', '11', '11', '2018-05-20', '11', '11', '/public/uploads/20180520\\f8b46d9894fd06eb30b17bb8017e9c31.jpg', '/public/uploads/20180520\\0ae61c33669a8257c4943c69382d15f5.mp4', '0', '1', null, '1', null, '1', null, null, '11', null);

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户与管理员的表',
  `email` char(255) DEFAULT NULL,
  `username` char(255) DEFAULT NULL COMMENT '用户名称',
  `password` char(255) DEFAULT NULL COMMENT '密码',
  `birthday` char(255) DEFAULT NULL COMMENT '生日',
  `grade` char(255) DEFAULT NULL COMMENT '年级',
  `address` char(255) DEFAULT NULL COMMENT '所在地区',
  `sex` char(10) DEFAULT NULL COMMENT '性别',
  `introduce` char(255) DEFAULT NULL COMMENT '个人介绍',
  `registration_time` char(255) DEFAULT NULL COMMENT '注册时间',
  `last_time` char(255) DEFAULT NULL COMMENT '最后一次登录时间',
  `status` tinyint(4) DEFAULT NULL COMMENT '用户类型，1为用户，2为管理员',
  `state` tinyint(4) DEFAULT NULL COMMENT '状态，是否可用',
  `photo` char(255) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'rain@126.com', 'rain', '123456', '28-11-2017', '初二', '北京', '女', '00', null, '2018-05-08', null, null, '/public/uploads/20171203\\a7843abccbf0837e4a2a0bd3136901d7.png');
INSERT INTO `user` VALUES ('3', '123@163.com', '123999', '123', null, null, null, null, null, '2018-05-06', null, '1', '1', null);
INSERT INTO `user` VALUES ('6', '123@163.com', 'rain', '123', null, null, null, null, null, '2018-05-06', null, '1', '1', null);
