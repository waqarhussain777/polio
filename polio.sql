/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50617
 Source Host           : localhost:3306
 Source Schema         : polio

 Target Server Type    : MySQL
 Target Server Version : 50617
 File Encoding         : 65001

 Date: 01/01/2024 15:15:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for assignment
-- ----------------------------
DROP TABLE IF EXISTS `assignment`;
CREATE TABLE `assignment`  (
  `assignmentID` int(11) NOT NULL AUTO_INCREMENT,
  `fkuserID` int(11) NOT NULL,
  `fkunioncouncilID` int(11) NOT NULL,
  PRIMARY KEY (`assignmentID`) USING BTREE,
  INDEX `idx_user_id`(`fkuserID`) USING BTREE,
  INDEX `idx_unioncouncil_id`(`fkunioncouncilID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of assignment
-- ----------------------------
INSERT INTO `assignment` VALUES (1, 2, 1);
INSERT INTO `assignment` VALUES (2, 3, 2);
INSERT INTO `assignment` VALUES (3, 2, 2);
INSERT INTO `assignment` VALUES (4, 3, 1);

-- ----------------------------
-- Table structure for district
-- ----------------------------
DROP TABLE IF EXISTS `district`;
CREATE TABLE `district`  (
  `districtID` int(11) NOT NULL AUTO_INCREMENT,
  `districtName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fkdivisionID` int(11) NOT NULL,
  PRIMARY KEY (`districtID`) USING BTREE,
  INDEX `idx_division_id`(`fkdivisionID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of district
-- ----------------------------
INSERT INTO `district` VALUES (1, 'Rawalpindi', 1);
INSERT INTO `district` VALUES (3, 'Bahawalnagar', 2);

-- ----------------------------
-- Table structure for division
-- ----------------------------
DROP TABLE IF EXISTS `division`;
CREATE TABLE `division`  (
  `divisionID` int(11) NOT NULL AUTO_INCREMENT,
  `divisionName` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fkprovinceID` int(11) NOT NULL,
  PRIMARY KEY (`divisionID`) USING BTREE,
  INDEX `idx_province_id`(`fkprovinceID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of division
-- ----------------------------
INSERT INTO `division` VALUES (1, 'Rawalpindi', 1);
INSERT INTO `division` VALUES (2, 'Bahawalpur', 1);
INSERT INTO `division` VALUES (3, 'Hyderabad', 2);
INSERT INTO `division` VALUES (4, 'Karachi', 2);
INSERT INTO `division` VALUES (5, 'Quetta', 4);
INSERT INTO `division` VALUES (6, 'Sibi', 4);
INSERT INTO `division` VALUES (7, 'Bannu', 3);
INSERT INTO `division` VALUES (8, 'Dera Ismail Khan', 3);
INSERT INTO `division` VALUES (9, 'Mirpur', 5);
INSERT INTO `division` VALUES (10, 'Muzaffarabad', 5);
INSERT INTO `division` VALUES (11, 'Gilgit', 6);
INSERT INTO `division` VALUES (12, 'Baltistan', 6);
INSERT INTO `division` VALUES (13, 'Islamabad', 7);

-- ----------------------------
-- Table structure for householdmember
-- ----------------------------
DROP TABLE IF EXISTS `householdmember`;
CREATE TABLE `householdmember`  (
  `householdmemberID` int(11) NOT NULL AUTO_INCREMENT,
  `householdmemberName` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fkindividualhouseholdID` int(11) NOT NULL,
  PRIMARY KEY (`householdmemberID`) USING BTREE,
  INDEX `idx_individualhousehold_id`(`fkindividualhouseholdID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of householdmember
-- ----------------------------
INSERT INTO `householdmember` VALUES (2, 'Sr 1', 3);
INSERT INTO `householdmember` VALUES (3, 'St 1', 2);
INSERT INTO `householdmember` VALUES (4, 'St 2', 2);

-- ----------------------------
-- Table structure for individualhousehold
-- ----------------------------
DROP TABLE IF EXISTS `individualhousehold`;
CREATE TABLE `individualhousehold`  (
  `individualhouseholdID` int(11) NOT NULL AUTO_INCREMENT,
  `individualhouseholdName` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fkunioncouncilID` int(11) NOT NULL,
  PRIMARY KEY (`individualhouseholdID`) USING BTREE,
  INDEX `idx_unioncouncil_id`(`fkunioncouncilID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of individualhousehold
-- ----------------------------
INSERT INTO `individualhousehold` VALUES (2, 'Satti 1', 2);
INSERT INTO `individualhousehold` VALUES (3, 'Sardar 1', 1);
INSERT INTO `individualhousehold` VALUES (4, 'Raja 1', 1);
INSERT INTO `individualhousehold` VALUES (5, 'Shiekh 1', 3);

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province`  (
  `provinceID` int(11) NOT NULL AUTO_INCREMENT,
  `provinceName` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`provinceID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES (1, 'Punjab');
INSERT INTO `province` VALUES (2, 'Sindh');
INSERT INTO `province` VALUES (3, 'KPK');
INSERT INTO `province` VALUES (4, 'Balochistan');
INSERT INTO `province` VALUES (5, 'Azad Jammu Kashmir');
INSERT INTO `province` VALUES (6, 'Gilgit Baltistan');
INSERT INTO `province` VALUES (7, 'Islamabad');

-- ----------------------------
-- Table structure for tehsil
-- ----------------------------
DROP TABLE IF EXISTS `tehsil`;
CREATE TABLE `tehsil`  (
  `tehsilID` int(11) NOT NULL AUTO_INCREMENT,
  `tehsilName` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fkdistrictID` int(11) NOT NULL,
  PRIMARY KEY (`tehsilID`) USING BTREE,
  INDEX `idx_district_id`(`fkdistrictID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of tehsil
-- ----------------------------
INSERT INTO `tehsil` VALUES (1, 'Kahuta', 1);
INSERT INTO `tehsil` VALUES (2, 'Taxila', 1);

-- ----------------------------
-- Table structure for unioncouncil
-- ----------------------------
DROP TABLE IF EXISTS `unioncouncil`;
CREATE TABLE `unioncouncil`  (
  `unioncouncilID` int(11) NOT NULL AUTO_INCREMENT,
  `unioncouncilName` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fktehsilID` int(11) NOT NULL,
  PRIMARY KEY (`unioncouncilID`) USING BTREE,
  INDEX `idx_tehsil_id`(`fktehsilID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of unioncouncil
-- ----------------------------
INSERT INTO `unioncouncil` VALUES (1, 'Punjar', 1);
INSERT INTO `unioncouncil` VALUES (2, 'Khadiot', 1);
INSERT INTO `unioncouncil` VALUES (3, 'Ghari Sikander', 2);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`userID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', '$2y$10$HzKvyd1zNdWFeCBrDf62Ru2/PKsrcbukxBnkjpEZ23vRBvzQNgRI6', 'admin');
INSERT INTO `user` VALUES (2, 'Waqar', '$2y$10$Gxei7xXaD1dprvkCjUKtoe3zAVsavsOUh0..oVnSeQxqhwmRTQIa.', 'polioworker');
INSERT INTO `user` VALUES (3, 'Jabbar', '$2y$10$c4l41AT7Q1Ajjc97zBG.r.18rbAiVVKjTd.CV85as6vvK5n0gfHuK', 'polioworker');
INSERT INTO `user` VALUES (4, 'test', '$2y$10$LgCgMHaSMlBvtmBX6NmKheHoOCaYW9sVlki5fbExa5BL.lOrugfwm', 'polioworker');

-- ----------------------------
-- Table structure for vaccinationrecord
-- ----------------------------
DROP TABLE IF EXISTS `vaccinationrecord`;
CREATE TABLE `vaccinationrecord`  (
  `recordID` int(11) NOT NULL AUTO_INCREMENT,
  `fkhouseholdmemberID` int(11) NOT NULL,
  `vaccinationdate` date NULL DEFAULT NULL,
  `fkuserID` int(11) NOT NULL,
  PRIMARY KEY (`recordID`) USING BTREE,
  INDEX `idx_householdmember_id`(`fkhouseholdmemberID`) USING BTREE,
  INDEX `idx_user_id`(`fkuserID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of vaccinationrecord
-- ----------------------------
INSERT INTO `vaccinationrecord` VALUES (2, 3, '2024-01-01', 2);
INSERT INTO `vaccinationrecord` VALUES (3, 2, '2024-01-01', 2);

SET FOREIGN_KEY_CHECKS = 1;
