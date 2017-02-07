/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_firdaus

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-02-06 17:40:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_kode` varchar(255) DEFAULT NULL,
  `menu_nama` varchar(255) DEFAULT NULL,
  `menu_ket` text,
  `menu_url` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_paten` char(1) DEFAULT NULL,
  `menu_location` char(10) DEFAULT NULL,
  `menu_active` char(1) DEFAULT 'y',
  `menu_createby` int(11) DEFAULT NULL,
  `menu_createat` datetime DEFAULT NULL,
  `menu_updateby` int(11) DEFAULT NULL,
  `menu_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_menu
-- ----------------------------
INSERT INTO `m_menu` VALUES ('1', 'setting-user', 'Setting User', '', '#', 'fa fa-users', '0', 'y', null, 'y', null, '2016-12-13 20:16:32', null, '2016-12-13 20:16:32');
INSERT INTO `m_menu` VALUES ('2', 'usergroup', 'User Group', null, 'usergroup', 'fa fa-circle-o', '1', 'y', null, 'y', null, '2016-11-08 10:34:26', null, '2016-11-08 10:34:26');
INSERT INTO `m_menu` VALUES ('3', 'user', 'User', null, 'user', 'fa fa-circle-o', '1', 'y', null, 'y', null, '2016-11-08 10:34:45', null, '2016-11-08 10:34:45');
INSERT INTO `m_menu` VALUES ('4', 'menu', 'Menu', null, 'menu', 'fa fa-circle-o', '1', 'y', null, 'y', null, '2016-11-08 10:35:15', null, '2016-11-08 10:35:15');
INSERT INTO `m_menu` VALUES ('5', 'akses', 'Hak Akses', null, 'akses', 'fa fa-circle-o', '1', 'y', null, 'y', null, '2016-11-08 10:35:52', null, '2016-11-08 10:35:52');
INSERT INTO `m_menu` VALUES ('6', 'master', 'Master', '', '#', 'fa fa-wrench', '0', null, null, 'y', null, '2016-12-13 20:18:21', null, null);
INSERT INTO `m_menu` VALUES ('17', 'poklahsar', 'Poklahsar', '', 'poklahsar', 'fa-user-o ', '6', null, null, 'y', null, '2017-01-29 00:46:12', null, null);
INSERT INTO `m_menu` VALUES ('18', 'visi', 'Visi', '', 'master_visi_misi', '', '6', null, null, 'y', null, '2017-01-31 00:39:01', null, null);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_id` int(11) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_paten` char(1) DEFAULT NULL,
  `user_active` char(1) DEFAULT 'y',
  `user_createby` int(11) DEFAULT NULL,
  `user_createat` datetime DEFAULT NULL,
  `user_updateby` int(11) DEFAULT NULL,
  `user_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `usergroup_id` (`usergroup_id`) USING BTREE,
  CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`usergroup_id`) REFERENCES `m_usergroup` (`usergroup_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES ('1', '1', 'super', '1b3231655cebb7a1f783eddf27d254ca', 'y', 'y', null, null, '1', '2016-11-08 13:22:31');
INSERT INTO `m_user` VALUES ('2', '2', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'y', 'y', null, null, null, '2016-11-08 12:56:26');

-- ----------------------------
-- Table structure for m_usergroup
-- ----------------------------
DROP TABLE IF EXISTS `m_usergroup`;
CREATE TABLE `m_usergroup` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_nama` varchar(255) DEFAULT NULL,
  `usergroup_ket` text,
  `usergroup_paten` char(1) DEFAULT NULL,
  `usergroup_active` char(1) DEFAULT 'y',
  `usergroup_createby` int(11) DEFAULT NULL,
  `usergroup_createat` datetime DEFAULT NULL,
  `usergroup_updateby` int(11) DEFAULT NULL,
  `usergroup_updateat` datetime DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of m_usergroup
-- ----------------------------
INSERT INTO `m_usergroup` VALUES ('1', 'Super Admin', null, 'y', 'y', null, null, null, '2016-11-08 12:58:29');
INSERT INTO `m_usergroup` VALUES ('2', 'Admin', null, 'y', 'y', null, null, null, '2016-11-08 12:58:29');
INSERT INTO `m_usergroup` VALUES ('3', 'Bendahara', 'k', 'y', 'y', null, null, '1', '2016-12-13 19:13:18');

-- ----------------------------
-- Table structure for t_akses
-- ----------------------------
DROP TABLE IF EXISTS `t_akses`;
CREATE TABLE `t_akses` (
  `akses_id` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `akses_listfitur` varchar(255) DEFAULT NULL,
  `akses_paten` char(1) DEFAULT NULL,
  `akses_active` char(1) DEFAULT 'y',
  PRIMARY KEY (`akses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_akses
-- ----------------------------
INSERT INTO `t_akses` VALUES ('1', '1', '1', null, 'y', 'y');
INSERT INTO `t_akses` VALUES ('2', '1', '2', '1,2,3,4', 'y', 'y');
INSERT INTO `t_akses` VALUES ('3', '1', '3', '5,6,7,8', 'y', 'y');
INSERT INTO `t_akses` VALUES ('4', '1', '4', '9,10,11,12,13', 'y', 'y');
INSERT INTO `t_akses` VALUES ('5', '1', '5', '14,15,16,17', 'y', 'y');
INSERT INTO `t_akses` VALUES ('6', '2', '2', '1,2,3', null, 'y');
INSERT INTO `t_akses` VALUES ('7', '2', '1', null, null, 'y');
INSERT INTO `t_akses` VALUES ('8', '1', '7', '18,19,20,21', null, 'y');
INSERT INTO `t_akses` VALUES ('9', '1', '6', null, null, 'y');
INSERT INTO `t_akses` VALUES ('11', '1', '9', '26,27,28,29,30', null, 'y');
INSERT INTO `t_akses` VALUES ('12', '1', '10', '31,32,33,34', null, 'y');
INSERT INTO `t_akses` VALUES ('13', '1', '12', '35,36,37,38', null, 'y');
INSERT INTO `t_akses` VALUES ('14', '1', '11', null, null, 'y');
INSERT INTO `t_akses` VALUES ('15', '1', '13', '39,40,41,42', null, 'y');
INSERT INTO `t_akses` VALUES ('16', '1', '16', '45,46,47,48', null, 'y');
INSERT INTO `t_akses` VALUES ('17', '1', '15', null, null, 'y');
INSERT INTO `t_akses` VALUES ('18', '1', '17', '49,50,51,52,56', null, 'y');
INSERT INTO `t_akses` VALUES ('19', '1', '18', '53,54,55', null, 'y');

-- ----------------------------
-- Table structure for t_bahanpoklahsar
-- ----------------------------
DROP TABLE IF EXISTS `t_bahanpoklahsar`;
CREATE TABLE `t_bahanpoklahsar` (
  `bahanpoklahsar_id` int(11) NOT NULL AUTO_INCREMENT,
  `poklahsar_id` int(11) DEFAULT NULL,
  `bahanpoklahsar_nama` varchar(255) DEFAULT NULL,
  `tahun_olahan` date DEFAULT NULL,
  `bahan` text,
  `jumlah` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`bahanpoklahsar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_bahanpoklahsar
-- ----------------------------
INSERT INTO `t_bahanpoklahsar` VALUES ('3', '2', 'mamama', '2017-02-15', 'ksdfksdfsdf', '3');
INSERT INTO `t_bahanpoklahsar` VALUES ('4', '2', 'sakdaksdaskd', null, null, null);
INSERT INTO `t_bahanpoklahsar` VALUES ('5', '2', 'sfskfdl', '2017-02-15', 'kdsfsdkfksdfkds', '2');

-- ----------------------------
-- Table structure for t_fitur
-- ----------------------------
DROP TABLE IF EXISTS `t_fitur`;
CREATE TABLE `t_fitur` (
  `fitur_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `fitur_kode` varchar(255) DEFAULT NULL,
  `fitur_nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fitur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_fitur
-- ----------------------------
INSERT INTO `t_fitur` VALUES ('1', '2', 'xcreate_usergroup', 'Add');
INSERT INTO `t_fitur` VALUES ('2', '2', 'xread_usergroup', 'View');
INSERT INTO `t_fitur` VALUES ('3', '2', 'xupdate_usergroup', 'Edit');
INSERT INTO `t_fitur` VALUES ('4', '2', 'xdelete_usergroup', 'Delete');
INSERT INTO `t_fitur` VALUES ('5', '3', 'xcreate_user', 'Add');
INSERT INTO `t_fitur` VALUES ('6', '3', 'xread_user', 'View');
INSERT INTO `t_fitur` VALUES ('7', '3', 'xupdate_user', 'Edit');
INSERT INTO `t_fitur` VALUES ('8', '3', 'xdelete_user', 'Delete');
INSERT INTO `t_fitur` VALUES ('9', '4', 'xcreate_menu', 'Add');
INSERT INTO `t_fitur` VALUES ('10', '4', 'xread_menu', 'View');
INSERT INTO `t_fitur` VALUES ('11', '4', 'xupdate_menu', 'Edit');
INSERT INTO `t_fitur` VALUES ('12', '4', 'xdelete_menu', 'Delete');
INSERT INTO `t_fitur` VALUES ('13', '4', 'xfitur_menu', 'Fitur');
INSERT INTO `t_fitur` VALUES ('14', '5', 'xcreate_akses', 'Add');
INSERT INTO `t_fitur` VALUES ('15', '5', 'xread_akses', 'View');
INSERT INTO `t_fitur` VALUES ('16', '5', 'xupdate_akses', 'Edit');
INSERT INTO `t_fitur` VALUES ('17', '5', 'xdelete_akses', 'Delete');
INSERT INTO `t_fitur` VALUES ('49', '17', 'xcreate_poklahsar', 'Add');
INSERT INTO `t_fitur` VALUES ('50', '17', 'xread_poklahsar', 'View');
INSERT INTO `t_fitur` VALUES ('51', '17', 'xupdate_poklahsar', 'Update');
INSERT INTO `t_fitur` VALUES ('52', '17', 'xdelete_poklahsar', 'Delete');
INSERT INTO `t_fitur` VALUES ('53', '18', 'xcreate_vsms', 'add');
INSERT INTO `t_fitur` VALUES ('54', '18', 'xupdate_vsms', 'Update');
INSERT INTO `t_fitur` VALUES ('55', '18', 'xdelete_vsms', 'Delete');
INSERT INTO `t_fitur` VALUES ('56', '17', 'xolahan_poklahsar', 'Hasil Olahan');

-- ----------------------------
-- Table structure for t_hasilolah
-- ----------------------------
DROP TABLE IF EXISTS `t_hasilolah`;
CREATE TABLE `t_hasilolah` (
  `hasilolah_id` int(11) NOT NULL AUTO_INCREMENT,
  `bahanpoklahsar_id` int(11) DEFAULT NULL,
  `hasilolah_nama` varchar(255) DEFAULT NULL,
  `hasilolah_date` date DEFAULT NULL,
  PRIMARY KEY (`hasilolah_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_hasilolah
-- ----------------------------

-- ----------------------------
-- Table structure for t_poklahsar
-- ----------------------------
DROP TABLE IF EXISTS `t_poklahsar`;
CREATE TABLE `t_poklahsar` (
  `poklahsar_id` int(11) NOT NULL AUTO_INCREMENT,
  `poklahsar_nama` varchar(255) DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `alamat_poklahsar` text,
  `jumproduk_tahun` varchar(255) DEFAULT NULL,
  `hp_poklahsar` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`poklahsar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_poklahsar
-- ----------------------------
INSERT INTO `t_poklahsar` VALUES ('2', 'dsfsdfkdjs', null, 'sdfsdjfsl', '9999', '08080', '123', '43');

-- ----------------------------
-- Table structure for t_vsms
-- ----------------------------
DROP TABLE IF EXISTS `t_vsms`;
CREATE TABLE `t_vsms` (
  `id_vis` int(11) NOT NULL AUTO_INCREMENT,
  `nm_vis` text,
  `tipe_vs` char(11) DEFAULT NULL,
  PRIMARY KEY (`id_vis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_vsms
-- ----------------------------

-- ----------------------------
-- View structure for v_akses
-- ----------------------------
DROP VIEW IF EXISTS `v_akses`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_akses` AS select `t_akses`.`akses_id` AS `akses_id`,`t_akses`.`usergroup_id` AS `usergroup_id`,`t_akses`.`menu_id` AS `menu_id`,`t_akses`.`akses_listfitur` AS `akses_listfitur`,`t_akses`.`akses_paten` AS `akses_paten`,`t_akses`.`akses_active` AS `akses_active`,`m_usergroup`.`usergroup_nama` AS `usergroup_nama`,`m_menu`.`menu_kode` AS `menu_kode`,`m_menu`.`menu_nama` AS `menu_nama`,`m_menu`.`menu_url` AS `menu_url`,`m_menu`.`menu_icon` AS `menu_icon`,`m_menu`.`menu_parent` AS `menu_parent` from ((`t_akses` left join `m_usergroup` on((`t_akses`.`usergroup_id` = `m_usergroup`.`usergroup_id`))) left join `m_menu` on((`t_akses`.`menu_id` = `m_menu`.`menu_id`))) ;

-- ----------------------------
-- View structure for v_menu
-- ----------------------------
DROP VIEW IF EXISTS `v_menu`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_menu` AS select `a`.`menu_id` AS `menu_id`,`a`.`menu_kode` AS `menu_kode`,`a`.`menu_nama` AS `menu_nama`,`a`.`menu_ket` AS `menu_ket`,`a`.`menu_url` AS `menu_url`,`a`.`menu_icon` AS `menu_icon`,`a`.`menu_parent` AS `menu_parent`,`a`.`menu_paten` AS `menu_paten`,`a`.`menu_active` AS `menu_active`,`a`.`menu_createby` AS `menu_createby`,`a`.`menu_createat` AS `menu_createat`,`a`.`menu_updateby` AS `menu_updateby`,`a`.`menu_updateat` AS `menu_updateat`,`b`.`menu_nama` AS `menu_parent_nama` from (`m_menu` `a` left join `m_menu` `b` on((`a`.`menu_parent` = `b`.`menu_id`))) ;
