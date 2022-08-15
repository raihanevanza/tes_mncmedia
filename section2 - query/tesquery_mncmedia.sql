/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : tesquery_mncmedia

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 15/08/2022 14:24:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_paket
-- ----------------------------
DROP TABLE IF EXISTS `tbl_paket`;
CREATE TABLE `tbl_paket`  (
  `id` int NOT NULL,
  `salary` float NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_paket
-- ----------------------------
INSERT INTO `tbl_paket` VALUES (1, 6500);
INSERT INTO `tbl_paket` VALUES (2, 4500);
INSERT INTO `tbl_paket` VALUES (3, 5000);
INSERT INTO `tbl_paket` VALUES (4, 5500);

-- ----------------------------
-- Table structure for tbl_siswa
-- ----------------------------
DROP TABLE IF EXISTS `tbl_siswa`;
CREATE TABLE `tbl_siswa`  (
  `id` int NOT NULL,
  `nama` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_siswa
-- ----------------------------
INSERT INTO `tbl_siswa` VALUES (1, 'Raffi');
INSERT INTO `tbl_siswa` VALUES (2, 'Tanty');
INSERT INTO `tbl_siswa` VALUES (3, 'Charles');
INSERT INTO `tbl_siswa` VALUES (4, 'Nawang');

-- ----------------------------
-- Table structure for tbl_teman
-- ----------------------------
DROP TABLE IF EXISTS `tbl_teman`;
CREATE TABLE `tbl_teman`  (
  `id` int NOT NULL,
  `teman_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_teman
-- ----------------------------
INSERT INTO `tbl_teman` VALUES (1, 2);
INSERT INTO `tbl_teman` VALUES (2, 3);
INSERT INTO `tbl_teman` VALUES (3, 4);
INSERT INTO `tbl_teman` VALUES (4, 1);

SET FOREIGN_KEY_CHECKS = 1;
