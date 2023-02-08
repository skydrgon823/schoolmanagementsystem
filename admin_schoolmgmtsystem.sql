/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : admin_schoolmgmtsystem

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 09/01/2023 03:48:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for blood_groups
-- ----------------------------
DROP TABLE IF EXISTS `blood_groups`;
CREATE TABLE `blood_groups`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of blood_groups
-- ----------------------------
INSERT INTO `blood_groups` VALUES (1, 'O-', '2022-06-17 00:38:08', '2022-06-17 00:38:08');
INSERT INTO `blood_groups` VALUES (2, 'O+', '2022-06-17 00:38:08', '2022-06-17 00:38:08');
INSERT INTO `blood_groups` VALUES (3, 'A+', '2022-06-17 00:38:08', '2022-06-17 00:38:08');
INSERT INTO `blood_groups` VALUES (4, 'A-', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `blood_groups` VALUES (5, 'B+', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `blood_groups` VALUES (6, 'B-', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `blood_groups` VALUES (7, 'AB+', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `blood_groups` VALUES (8, 'AB-', '2022-06-17 00:38:09', '2022-06-17 00:38:09');

-- ----------------------------
-- Table structure for bom_pa_records
-- ----------------------------
DROP TABLE IF EXISTS `bom_pa_records`;
CREATE TABLE `bom_pa_records`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emp_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `bom_pa_records_code_unique`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bom_pa_records
-- ----------------------------
INSERT INTO `bom_pa_records` VALUES (2, 120, '4TIPg731ODW8ocIoijKy', NULL, NULL, '2022-08-17 16:07:57', '2023-01-09 06:54:18');

-- ----------------------------
-- Table structure for book_requests
-- ----------------------------
DROP TABLE IF EXISTS `book_requests`;
CREATE TABLE `book_requests`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `start_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `returned` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `book_requests_book_id_foreign`(`book_id`) USING BTREE,
  INDEX `book_requests_user_id_foreign`(`user_id`) USING BTREE,
  CONSTRAINT `book_requests_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `book_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_class_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `book_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total_copies` int(11) NULL DEFAULT NULL,
  `issued_copies` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `books_my_class_id_foreign`(`my_class_id`) USING BTREE,
  CONSTRAINT `books_my_class_id_foreign` FOREIGN KEY (`my_class_id`) REFERENCES `my_classes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for calevents
-- ----------------------------
DROP TABLE IF EXISTS `calevents`;
CREATE TABLE `calevents`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `participants` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `specific_teacher` int(10) NULL DEFAULT NULL,
  `specific_form` int(10) NULL DEFAULT NULL,
  `date_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime(0) NULL DEFAULT NULL,
  `start_date` datetime(0) NULL DEFAULT NULL,
  `end_date` datetime(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calevents
-- ----------------------------
INSERT INTO `calevents` VALUES (16, 'parent meeting', 'parent', 1, 1, 'single', '2022-07-01 13:23:00', NULL, NULL, '2022-07-21 15:23:55', '2022-07-21 15:26:28');
INSERT INTO `calevents` VALUES (17, 'teacher meeting', 'teacher', 1, NULL, 'range', NULL, '2022-07-04 13:26:00', '2022-07-07 13:26:00', '2022-07-21 15:26:09', '2022-07-21 15:26:09');
INSERT INTO `calevents` VALUES (18, 'parent meeting3', 'parent', NULL, 2, 'single', '2022-07-19 14:11:00', '2022-07-20 14:10:00', '2022-07-21 14:10:00', '2022-07-21 16:10:41', '2022-07-21 16:11:27');

-- ----------------------------
-- Table structure for class_subjects
-- ----------------------------
DROP TABLE IF EXISTS `class_subjects`;
CREATE TABLE `class_subjects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `my_class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of class_subjects
-- ----------------------------
INSERT INTO `class_subjects` VALUES (20, 51, 10, 6, '2022-06-24 14:26:22', '2022-10-21 15:45:25');
INSERT INTO `class_subjects` VALUES (22, 50, 30, 32, '2022-10-21 06:03:14', '2022-10-29 06:56:27');
INSERT INTO `class_subjects` VALUES (29, 52, 7, 34, '2022-07-07 05:46:27', '2022-10-20 16:50:47');
INSERT INTO `class_subjects` VALUES (30, 52, 8, 32, '2022-07-07 05:46:27', '2022-11-15 08:29:33');
INSERT INTO `class_subjects` VALUES (37, 50, 5, 16, '2022-10-21 06:06:25', '2022-11-03 11:45:08');
INSERT INTO `class_subjects` VALUES (38, 50, 6, 4, '2022-10-21 06:06:25', '2022-11-04 07:14:14');
INSERT INTO `class_subjects` VALUES (39, 50, 7, 15, '2022-10-21 06:06:25', '2022-10-21 19:28:29');
INSERT INTO `class_subjects` VALUES (40, 50, 8, 32, '2022-10-21 06:06:25', '2022-11-07 06:17:40');
INSERT INTO `class_subjects` VALUES (41, 50, 9, 32, '2022-10-21 06:06:25', '2022-11-07 06:17:53');
INSERT INTO `class_subjects` VALUES (42, 50, 13, 8, '2022-10-21 06:06:25', '2022-10-21 19:28:42');
INSERT INTO `class_subjects` VALUES (43, 50, 11, 53, '2022-10-21 06:06:25', '2022-10-21 19:28:44');
INSERT INTO `class_subjects` VALUES (45, 54, 5, 53, '2022-10-29 07:08:49', '2022-10-29 07:09:45');
INSERT INTO `class_subjects` VALUES (46, 54, 6, 34, '2022-10-29 07:08:49', '2022-10-29 07:09:55');
INSERT INTO `class_subjects` VALUES (47, 54, 7, 53, '2022-10-29 07:08:49', '2022-11-01 23:30:39');
INSERT INTO `class_subjects` VALUES (48, 54, 40, 53, '2022-10-29 07:08:49', '2022-11-19 21:32:13');
INSERT INTO `class_subjects` VALUES (49, 54, 10, 8, '2022-10-29 07:08:49', '2022-12-22 17:29:34');
INSERT INTO `class_subjects` VALUES (50, 54, 13, NULL, '2022-10-29 07:08:49', '2022-10-29 07:08:49');
INSERT INTO `class_subjects` VALUES (51, 54, 12, NULL, '2022-10-29 07:08:49', '2022-10-29 07:08:49');
INSERT INTO `class_subjects` VALUES (52, 54, 28, NULL, '2022-10-29 07:08:49', '2022-10-29 07:08:49');
INSERT INTO `class_subjects` VALUES (53, 55, 5, 7, '2022-11-02 03:48:50', '2023-01-04 06:42:19');
INSERT INTO `class_subjects` VALUES (54, 56, 5, NULL, '2022-11-02 03:49:20', '2022-11-02 03:49:20');
INSERT INTO `class_subjects` VALUES (55, 56, 7, NULL, '2022-11-02 03:49:20', '2022-11-02 03:49:20');
INSERT INTO `class_subjects` VALUES (56, 56, 8, NULL, '2022-11-02 03:49:20', '2022-11-02 03:49:20');
INSERT INTO `class_subjects` VALUES (57, 57, 6, NULL, '2022-11-02 03:54:44', '2022-11-02 03:54:44');
INSERT INTO `class_subjects` VALUES (58, 58, 5, NULL, '2022-11-03 11:46:54', '2022-11-03 11:46:54');
INSERT INTO `class_subjects` VALUES (59, 58, 7, NULL, '2022-11-03 11:46:54', '2022-11-03 11:46:54');
INSERT INTO `class_subjects` VALUES (60, 59, 5, 33, '2022-11-03 12:23:01', '2022-11-03 12:37:59');
INSERT INTO `class_subjects` VALUES (61, 59, 6, 14, '2022-11-03 12:23:01', '2022-11-03 12:36:23');
INSERT INTO `class_subjects` VALUES (62, 60, 5, 32, '2022-11-04 07:04:02', '2022-11-15 08:14:13');
INSERT INTO `class_subjects` VALUES (63, 60, 6, NULL, '2022-11-04 07:04:02', '2022-11-04 07:04:02');
INSERT INTO `class_subjects` VALUES (64, 50, 15, 33, '2022-11-04 07:15:11', '2022-11-04 12:09:51');
INSERT INTO `class_subjects` VALUES (65, 61, 5, NULL, '2022-11-04 11:38:02', '2022-11-04 11:38:02');
INSERT INTO `class_subjects` VALUES (67, 53, 5, 32, '2022-11-07 06:19:11', '2022-11-07 06:19:49');
INSERT INTO `class_subjects` VALUES (68, 53, 6, 7, '2022-11-07 06:19:12', '2022-11-07 07:47:43');
INSERT INTO `class_subjects` VALUES (69, 53, 7, 32, '2022-11-07 06:19:12', '2022-11-07 06:34:51');
INSERT INTO `class_subjects` VALUES (70, 53, 8, 8, '2022-11-07 06:19:12', '2022-11-07 07:47:55');
INSERT INTO `class_subjects` VALUES (71, 53, 9, NULL, '2022-11-07 06:19:12', '2022-11-07 06:19:12');
INSERT INTO `class_subjects` VALUES (72, 53, 10, 32, '2022-11-07 06:19:12', '2022-11-07 06:34:58');
INSERT INTO `class_subjects` VALUES (73, 53, 13, NULL, '2022-11-07 06:19:12', '2022-11-07 06:19:12');
INSERT INTO `class_subjects` VALUES (74, 53, 28, NULL, '2022-11-07 06:19:12', '2022-11-07 06:19:12');
INSERT INTO `class_subjects` VALUES (75, 53, 25, NULL, '2022-11-07 06:19:12', '2022-11-07 06:19:12');
INSERT INTO `class_subjects` VALUES (76, 59, 14, 33, '2022-11-16 07:44:43', '2022-11-16 07:44:57');
INSERT INTO `class_subjects` VALUES (77, 59, 13, 33, '2022-11-16 07:44:43', '2022-11-16 07:45:03');
INSERT INTO `class_subjects` VALUES (78, 2, 32, 32, '2022-11-21 08:37:19', '2022-11-21 08:37:53');
INSERT INTO `class_subjects` VALUES (79, 2, 35, 32, '2022-11-21 08:40:30', '2022-11-22 09:49:40');
INSERT INTO `class_subjects` VALUES (80, 2, 26, 32, '2022-11-22 09:52:35', '2022-11-22 09:52:41');
INSERT INTO `class_subjects` VALUES (81, 2, 39, NULL, '2022-11-22 19:16:37', '2022-12-27 19:19:32');
INSERT INTO `class_subjects` VALUES (82, 50, 39, NULL, '2022-11-22 19:19:28', '2022-11-22 19:19:28');

-- ----------------------------
-- Table structure for class_types
-- ----------------------------
DROP TABLE IF EXISTS `class_types`;
CREATE TABLE `class_types`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of class_types
-- ----------------------------
INSERT INTO `class_types` VALUES (22, 'test', 'XKuID', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `class_types` VALUES (26, 'sample', 'E8mVL', '2022-12-02 09:49:09', '2022-12-02 09:49:09');

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES (89, 'Daniel', 'daniel@gmail.com', 'herry', NULL, '2022-10-11 18:58:33', '2022-10-11 18:58:33');

-- ----------------------------
-- Table structure for dorms
-- ----------------------------
DROP TABLE IF EXISTS `dorms`;
CREATE TABLE `dorms`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `dorms_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dorms
-- ----------------------------
INSERT INTO `dorms` VALUES (1, 'Faith Hostel', NULL, NULL, NULL);
INSERT INTO `dorms` VALUES (2, 'Peace Hostel', NULL, NULL, NULL);
INSERT INTO `dorms` VALUES (3, 'Grace Hostel', NULL, NULL, NULL);
INSERT INTO `dorms` VALUES (4, 'Success Hostel', NULL, NULL, NULL);
INSERT INTO `dorms` VALUES (5, 'Trust Hostel', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for exam_forms
-- ----------------------------
DROP TABLE IF EXISTS `exam_forms`;
CREATE TABLE `exam_forms`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `min_subject_cnt` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `state` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 161 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam_forms
-- ----------------------------
INSERT INTO `exam_forms` VALUES (102, 76, 1, 1, '2022-09-19 11:31:46', '2022-10-03 13:09:26', 0);
INSERT INTO `exam_forms` VALUES (115, 76, 3, 8, '2022-09-30 05:52:37', '2022-09-30 05:52:37', 0);
INSERT INTO `exam_forms` VALUES (124, 103, 1, 5, '2022-10-06 09:53:11', '2022-10-06 09:53:24', 1);
INSERT INTO `exam_forms` VALUES (125, 103, 2, 4, '2022-10-06 09:53:11', '2022-12-02 09:57:48', 1);
INSERT INTO `exam_forms` VALUES (126, 103, 3, 6, '2022-10-06 09:53:12', '2022-12-02 09:58:05', 1);
INSERT INTO `exam_forms` VALUES (127, 103, 4, 10, '2022-10-06 09:53:12', '2022-12-02 09:58:24', 1);
INSERT INTO `exam_forms` VALUES (128, 104, 1, 8, '2022-11-16 07:30:28', '2022-11-16 07:30:28', 0);
INSERT INTO `exam_forms` VALUES (129, 104, 2, 7, '2022-11-16 07:30:28', '2022-12-08 13:21:53', 1);
INSERT INTO `exam_forms` VALUES (130, 104, 3, 8, '2022-11-16 07:30:28', '2022-12-08 13:20:08', 1);
INSERT INTO `exam_forms` VALUES (131, 106, 1, 7, '2022-12-01 07:57:20', '2022-12-01 07:57:20', 0);
INSERT INTO `exam_forms` VALUES (132, 106, 2, 7, '2022-12-01 07:57:23', '2022-12-08 13:18:29', 1);
INSERT INTO `exam_forms` VALUES (133, 106, 3, 7, '2022-12-01 07:57:26', '2022-12-08 12:39:39', 1);
INSERT INTO `exam_forms` VALUES (134, 106, 4, 7, '2022-12-01 07:57:28', '2022-12-08 12:39:06', 1);
INSERT INTO `exam_forms` VALUES (135, 107, 1, 7, '2022-12-02 09:53:32', '2022-12-08 13:17:52', 1);
INSERT INTO `exam_forms` VALUES (136, 107, 2, 7, '2022-12-02 09:53:32', '2022-12-09 14:50:06', 1);
INSERT INTO `exam_forms` VALUES (137, 107, 3, 7, '2022-12-02 09:53:32', '2022-12-08 13:22:15', 1);
INSERT INTO `exam_forms` VALUES (138, 107, 4, 7, '2022-12-02 09:53:32', '2022-12-08 12:37:23', 1);
INSERT INTO `exam_forms` VALUES (142, 109, 1, 3, '2022-12-08 13:34:52', '2022-12-08 13:34:52', 0);
INSERT INTO `exam_forms` VALUES (143, 109, 2, 3, '2022-12-08 13:34:53', '2022-12-08 13:34:53', 0);
INSERT INTO `exam_forms` VALUES (144, 109, 3, 3, '2022-12-08 13:34:56', '2022-12-08 13:34:56', 0);
INSERT INTO `exam_forms` VALUES (145, 109, 4, 3, '2022-12-08 13:35:01', '2022-12-08 13:42:58', 1);
INSERT INTO `exam_forms` VALUES (149, 111, 4, 12, '2022-12-09 14:48:57', '2022-12-09 14:48:57', NULL);
INSERT INTO `exam_forms` VALUES (150, 111, 4, 12, '2022-12-09 14:48:57', '2022-12-09 14:48:57', NULL);
INSERT INTO `exam_forms` VALUES (151, 111, 4, 12, '2022-12-09 14:48:57', '2022-12-09 14:48:57', NULL);
INSERT INTO `exam_forms` VALUES (152, 111, 4, 12, '2022-12-09 14:48:59', '2022-12-09 14:48:59', NULL);
INSERT INTO `exam_forms` VALUES (153, 117, 2, 5, '2022-12-09 22:56:37', '2022-12-09 22:56:37', 0);
INSERT INTO `exam_forms` VALUES (154, 118, 1, 5, '2022-12-09 23:00:32', '2022-12-09 23:00:32', 0);
INSERT INTO `exam_forms` VALUES (155, 118, 2, 5, '2022-12-09 23:00:32', '2022-12-09 23:00:32', 0);
INSERT INTO `exam_forms` VALUES (156, 118, 4, 5, '2022-12-09 23:00:32', '2022-12-09 23:00:32', 0);
INSERT INTO `exam_forms` VALUES (157, 119, 1, 5, '2022-12-09 23:01:29', '2022-12-09 23:01:29', 0);
INSERT INTO `exam_forms` VALUES (158, 119, 4, 5, '2022-12-09 23:01:29', '2022-12-09 23:01:29', 0);
INSERT INTO `exam_forms` VALUES (159, 120, 2, 5, '2022-12-09 23:03:46', '2022-12-09 23:03:46', 0);
INSERT INTO `exam_forms` VALUES (160, 120, 3, 4, '2022-12-09 23:03:46', '2022-12-09 23:03:46', 0);

-- ----------------------------
-- Table structure for exam_records
-- ----------------------------
DROP TABLE IF EXISTS `exam_records`;
CREATE TABLE `exam_records`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `my_class_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `total` int(11) NULL DEFAULT NULL,
  `ave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `class_ave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pos` int(11) NULL DEFAULT NULL,
  `af` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ps` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `p_comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `t_comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exam_records
-- ----------------------------
INSERT INTO `exam_records` VALUES (21, 76, 123, 50, 20, NULL, NULL, NULL, 5, '5', NULL, NULL, NULL, '2022', '2022-10-03 05:23:53', '2022-10-03 05:23:53');
INSERT INTO `exam_records` VALUES (22, 76, 124, 50, 20, NULL, NULL, NULL, 5, '5', NULL, NULL, NULL, '2022', '2022-10-03 05:23:53', '2022-10-03 05:23:53');
INSERT INTO `exam_records` VALUES (23, 76, 123, 50, 20, NULL, NULL, NULL, 4, '6', NULL, NULL, NULL, '2022', '2022-10-03 05:40:07', '2022-10-03 05:40:07');
INSERT INTO `exam_records` VALUES (24, 75, 124, 51, 20, NULL, NULL, NULL, 4, '10', NULL, NULL, NULL, '2022', '2022-10-03 05:40:07', '2022-10-03 05:40:07');
INSERT INTO `exam_records` VALUES (25, 103, 123, 50, 20, NULL, NULL, NULL, 13, '30', NULL, NULL, NULL, '2022', '2022-10-26 03:16:05', '2022-10-26 03:16:05');
INSERT INTO `exam_records` VALUES (26, 103, 123, 50, 20, NULL, NULL, NULL, 5, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (27, 103, 126, 50, 20, NULL, NULL, NULL, 4, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (28, 103, 127, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (29, 103, 128, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (30, 103, 129, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (31, 103, 136, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (32, 103, 137, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (33, 103, 138, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (34, 103, 139, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (35, 103, 140, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-16 01:17:29', '2022-11-16 01:17:29');
INSERT INTO `exam_records` VALUES (36, 103, 123, 50, 21, NULL, NULL, NULL, 5, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:34', '2022-11-17 06:11:34');
INSERT INTO `exam_records` VALUES (37, 103, 126, 50, 21, NULL, NULL, NULL, 4, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:35', '2022-11-17 06:11:35');
INSERT INTO `exam_records` VALUES (38, 103, 127, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:35', '2022-11-17 06:11:35');
INSERT INTO `exam_records` VALUES (39, 103, 128, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:36', '2022-11-17 06:11:36');
INSERT INTO `exam_records` VALUES (40, 103, 129, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:36', '2022-11-17 06:11:36');
INSERT INTO `exam_records` VALUES (41, 103, 136, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:36', '2022-11-17 06:11:36');
INSERT INTO `exam_records` VALUES (42, 103, 137, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:36', '2022-11-17 06:11:36');
INSERT INTO `exam_records` VALUES (43, 103, 138, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:37', '2022-11-17 06:11:37');
INSERT INTO `exam_records` VALUES (44, 103, 139, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:37', '2022-11-17 06:11:37');
INSERT INTO `exam_records` VALUES (45, 103, 140, 50, 21, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:11:37', '2022-11-17 06:11:37');
INSERT INTO `exam_records` VALUES (46, 78, 123, 50, 20, NULL, NULL, NULL, 5, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:18', '2022-11-17 06:12:18');
INSERT INTO `exam_records` VALUES (47, 78, 126, 50, 20, NULL, NULL, NULL, 4, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:18', '2022-11-17 06:12:18');
INSERT INTO `exam_records` VALUES (48, 78, 127, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:19', '2022-11-17 06:12:19');
INSERT INTO `exam_records` VALUES (49, 78, 128, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:19', '2022-11-17 06:12:19');
INSERT INTO `exam_records` VALUES (50, 78, 129, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:19', '2022-11-17 06:12:19');
INSERT INTO `exam_records` VALUES (51, 78, 136, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:20', '2022-11-17 06:12:20');
INSERT INTO `exam_records` VALUES (52, 78, 137, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:20', '2022-11-17 06:12:20');
INSERT INTO `exam_records` VALUES (53, 78, 138, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:20', '2022-11-17 06:12:20');
INSERT INTO `exam_records` VALUES (54, 78, 139, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:20', '2022-11-17 06:12:20');
INSERT INTO `exam_records` VALUES (55, 78, 140, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:12:20', '2022-11-17 06:12:20');
INSERT INTO `exam_records` VALUES (56, 103, 123, 50, 22, NULL, NULL, NULL, 10, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:45', '2022-11-17 06:13:45');
INSERT INTO `exam_records` VALUES (57, 103, 126, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:48', '2022-11-17 06:13:48');
INSERT INTO `exam_records` VALUES (58, 103, 127, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:48', '2022-11-17 06:13:48');
INSERT INTO `exam_records` VALUES (59, 103, 128, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:48', '2022-11-17 06:13:48');
INSERT INTO `exam_records` VALUES (60, 103, 129, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:50', '2022-11-17 06:13:50');
INSERT INTO `exam_records` VALUES (61, 103, 136, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:51', '2022-11-17 06:13:51');
INSERT INTO `exam_records` VALUES (62, 103, 137, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:54', '2022-11-17 06:13:54');
INSERT INTO `exam_records` VALUES (63, 103, 138, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:54', '2022-11-17 06:13:54');
INSERT INTO `exam_records` VALUES (64, 103, 139, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:55', '2022-11-17 06:13:55');
INSERT INTO `exam_records` VALUES (65, 103, 140, 50, 22, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:13:55', '2022-11-17 06:13:55');
INSERT INTO `exam_records` VALUES (66, 104, 123, 50, 20, NULL, NULL, NULL, 5, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (67, 104, 126, 50, 20, NULL, NULL, NULL, 5, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (68, 104, 127, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (69, 104, 128, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (70, 104, 129, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (71, 104, 136, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (72, 104, 137, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (73, 104, 138, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (74, 104, 139, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (75, 104, 140, 50, 20, NULL, NULL, NULL, NULL, '30', NULL, NULL, NULL, '2022', '2022-11-17 06:15:28', '2022-11-17 06:15:28');
INSERT INTO `exam_records` VALUES (76, 104, 123, 50, 20, NULL, NULL, NULL, 45, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (77, 104, 126, 50, 20, NULL, NULL, NULL, 32, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (78, 104, 127, 50, 20, NULL, NULL, NULL, 45, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (79, 104, 128, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (80, 104, 129, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (81, 104, 136, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (82, 104, 137, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (83, 104, 138, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (84, 104, 139, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:39', '2022-11-21 07:57:39');
INSERT INTO `exam_records` VALUES (85, 104, 140, 50, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-21 07:57:40', '2022-11-21 07:57:40');
INSERT INTO `exam_records` VALUES (86, 104, 130, 52, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-22 19:47:07', '2022-11-22 19:47:07');
INSERT INTO `exam_records` VALUES (87, 104, 131, 52, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-22 19:47:07', '2022-11-22 19:47:07');
INSERT INTO `exam_records` VALUES (88, 104, 132, 52, 20, NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, '2022', '2022-11-22 19:47:07', '2022-11-22 19:47:07');

-- ----------------------------
-- Table structure for exams
-- ----------------------------
DROP TABLE IF EXISTS `exams`;
CREATE TABLE `exams`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` tinyint(4) NOT NULL,
  `year` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 121 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of exams
-- ----------------------------
INSERT INTO `exams` VALUES (75, 'Ordinary_Exam', 'Test 2022A', 1, '2022', '2022-09-19 11:31:46', '2022-09-19 11:31:46');
INSERT INTO `exams` VALUES (103, 'Ordinary_Exam', 'Math Test', 1, '2022', '2022-10-06 09:53:11', '2022-10-06 09:53:11');
INSERT INTO `exams` VALUES (104, 'Ordinary_Exam', 'ZORAKI', 3, '2022', '2022-11-16 07:30:27', '2022-11-16 07:30:27');
INSERT INTO `exams` VALUES (106, 'Ordinary_Exam', 'TEST 4', 3, '2022', '2022-12-01 07:57:19', '2022-12-01 07:57:19');
INSERT INTO `exams` VALUES (107, 'Ordinary_Exam', 'LATEST EXAM', 3, '2022', '2022-12-02 09:53:32', '2022-12-02 09:53:32');
INSERT INTO `exams` VALUES (109, 'Ordinary_Exam', 'Add Exam', 1, '2022', '2022-12-08 13:34:48', '2022-12-08 13:34:48');
INSERT INTO `exams` VALUES (111, 'Ordinary_Exam', 'EXAM4', 3, '2022', '2022-12-09 14:47:12', '2022-12-09 23:00:06');
INSERT INTO `exams` VALUES (117, 'Ordinary_Exam', 'updated exam', 2, '2022', '2022-12-09 22:56:37', '2022-12-09 22:56:37');
INSERT INTO `exams` VALUES (118, 'Ordinary_Exam', 'updated exam3', 3, '2022', '2022-12-09 23:00:32', '2022-12-09 23:00:32');
INSERT INTO `exams` VALUES (119, 'Ordinary_Exam', 'updated exam2', 2, '2022', '2022-12-09 23:01:29', '2022-12-09 23:01:29');
INSERT INTO `exams` VALUES (120, 'Ordinary_Exam', 'New Month Exam1', 1, '2022', '2022-12-09 23:03:46', '2022-12-09 23:03:46');

-- ----------------------------
-- Table structure for forms
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of forms
-- ----------------------------
INSERT INTO `forms` VALUES (1, 1, 32, '2022-06-18 09:12:48', '2022-12-31 05:41:36');
INSERT INTO `forms` VALUES (2, 2, 33, '2022-06-18 09:12:49', '2023-01-04 07:59:47');
INSERT INTO `forms` VALUES (3, 3, 0, '2022-06-18 09:12:50', '2022-12-27 21:42:05');
INSERT INTO `forms` VALUES (4, 4, 0, '2022-06-18 09:12:54', '2022-12-27 21:29:09');

-- ----------------------------
-- Table structure for grades
-- ----------------------------
DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_type_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `mark_from` tinyint(4) NOT NULL,
  `mark_to` tinyint(4) NOT NULL,
  `remark` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `grades_name_class_type_id_remark_unique`(`class_type_id`, `remark`, `name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 106 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of grades
-- ----------------------------
INSERT INTO `grades` VALUES (1, 'E', NULL, 0, 29, '1', '2022-09-25 00:21:23', '2022-11-22 23:20:52');
INSERT INTO `grades` VALUES (2, 'D-', NULL, 30, 34, '2', '2022-09-25 00:21:23', '2022-11-22 23:20:52');
INSERT INTO `grades` VALUES (3, 'D', NULL, 35, 39, '3', '2022-09-25 00:21:23', '2022-11-22 23:20:52');
INSERT INTO `grades` VALUES (4, 'D+', NULL, 40, 44, '4', '2022-09-25 00:21:23', '2022-11-22 23:20:52');
INSERT INTO `grades` VALUES (5, 'C-', NULL, 45, 49, '5', '2022-09-25 00:21:23', '2022-11-22 23:20:53');
INSERT INTO `grades` VALUES (6, 'C', NULL, 50, 54, '6', '2022-09-25 00:21:23', '2022-11-22 23:20:53');
INSERT INTO `grades` VALUES (56, 'F', 22, 0, 9, '1', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `grades` VALUES (57, 'E', 22, 10, 19, '2', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `grades` VALUES (58, 'D', 22, 20, 29, '3', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `grades` VALUES (59, 'C', 22, 30, 39, '4', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `grades` VALUES (60, 'B', 22, 40, 49, '5', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `grades` VALUES (61, 'A', 22, 50, 60, '6', '2022-10-03 06:19:40', '2022-10-03 06:19:40');
INSERT INTO `grades` VALUES (70, 'C+', NULL, 55, 59, '7', '2022-11-08 10:20:59', '2022-11-22 23:20:53');
INSERT INTO `grades` VALUES (71, 'B-', NULL, 60, 64, '8', '2022-11-08 10:23:54', '2022-11-22 23:20:53');
INSERT INTO `grades` VALUES (72, 'B', NULL, 65, 69, '9', '2022-11-08 10:23:54', '2022-11-22 23:20:53');
INSERT INTO `grades` VALUES (91, 'B+', NULL, 70, 74, '10', '2022-11-21 08:05:02', '2022-11-22 23:20:53');
INSERT INTO `grades` VALUES (92, 'A-', NULL, 75, 79, '11', '2022-11-22 23:21:56', '2022-11-22 23:21:56');
INSERT INTO `grades` VALUES (93, 'A', NULL, 80, 100, '12', '2022-11-22 23:21:57', '2022-11-22 23:21:57');
INSERT INTO `grades` VALUES (94, 'E', 26, 0, 29, '1', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (95, 'D-', 26, 30, 34, '2', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (96, 'D', 26, 35, 39, '3', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (97, 'D+', 26, 40, 44, '4', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (98, 'C-', 26, 45, 49, '5', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (99, 'C', 26, 50, 54, '6', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (100, 'C+', 26, 55, 59, '7', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (101, 'B-', 26, 60, 64, '8', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (102, 'B', 26, 65, 69, '9', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (103, 'B+', 26, 70, 74, '10', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (104, 'A-', 26, 75, 79, '11', '2022-12-02 09:49:09', '2022-12-02 09:49:09');
INSERT INTO `grades` VALUES (105, 'A', 26, 80, 100, '12', '2022-12-02 09:49:09', '2022-12-02 09:49:09');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES (1, 'Group11', '2022-06-24 01:59:50', '2022-10-11 10:29:12');
INSERT INTO `groups` VALUES (2, 'Group2', '2022-06-24 01:59:54', '2022-06-24 22:23:52');
INSERT INTO `groups` VALUES (3, 'Group3', '2022-06-24 01:59:58', '2022-06-24 22:23:53');
INSERT INTO `groups` VALUES (4, 'Group4', '2022-06-23 18:03:26', '2022-06-24 22:23:54');
INSERT INTO `groups` VALUES (5, 'Group5', '2022-06-23 18:06:47', '2022-06-24 22:23:55');
INSERT INTO `groups` VALUES (15, 'test', '2022-07-24 10:34:42', '2022-07-24 10:34:42');

-- ----------------------------
-- Table structure for lgas
-- ----------------------------
DROP TABLE IF EXISTS `lgas`;
CREATE TABLE `lgas`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `lgas_state_id_foreign`(`state_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 775 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lgas
-- ----------------------------
INSERT INTO `lgas` VALUES (1, 1, 'Aba North', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (2, 1, 'Aba South', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (3, 1, 'Arochukwu', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (4, 1, 'Bende', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (5, 1, 'Ikwuano', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (6, 1, 'Isiala Ngwa North', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (7, 1, 'Isiala Ngwa South', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (8, 1, 'Isuikwuato', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `lgas` VALUES (9, 1, 'Obi Ngwa', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (10, 1, 'Ohafia', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (11, 1, 'Osisioma', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (12, 1, 'Ugwunagbo', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (13, 1, 'Ukwa East', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (14, 1, 'Ukwa West', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (15, 1, 'Umuahia North', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (16, 1, 'Umuahia South', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (17, 1, 'Umu Nneochi', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (18, 2, 'Demsa', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (19, 2, 'Fufure', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (20, 2, 'Ganye', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (21, 2, 'Gayuk', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (22, 2, 'Gombi', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (23, 2, 'Grie', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (24, 2, 'Hong', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (25, 2, 'Jada', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (26, 2, 'Larmurde', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (27, 2, 'Madagali', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (28, 2, 'Maiha', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (29, 2, 'Mayo Belwa', '2022-06-17 00:38:23', '2022-06-17 00:38:23');
INSERT INTO `lgas` VALUES (30, 2, 'Michika', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (31, 2, 'Mubi North', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (32, 2, 'Mubi South', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (33, 2, 'Numan', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (34, 2, 'Shelleng', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (35, 2, 'Song', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (36, 2, 'Toungo', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (37, 2, 'Yola North', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (38, 2, 'Yola South', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (39, 3, 'Abak', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (40, 3, 'Eastern Obolo', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (41, 3, 'Eket', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (42, 3, 'Esit Eket', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (43, 3, 'Essien Udim', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (44, 3, 'Etim Ekpo', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (45, 3, 'Etinan', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (46, 3, 'Ibeno', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (47, 3, 'Ibesikpo Asutan', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (48, 3, 'Ibiono-Ibom', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (49, 3, 'Ika', '2022-06-17 00:38:24', '2022-06-17 00:38:24');
INSERT INTO `lgas` VALUES (50, 3, 'Ikono', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (51, 3, 'Ikot Abasi', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (52, 3, 'Ikot Ekpene', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (53, 3, 'Ini', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (54, 3, 'Itu', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (55, 3, 'Mbo', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (56, 3, 'Mkpat-Enin', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (57, 3, 'Nsit-Atai', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (58, 3, 'Nsit-Ibom', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (59, 3, 'Nsit-Ubium', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (60, 3, 'Obot Akara', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (61, 3, 'Okobo', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (62, 3, 'Onna', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (63, 3, 'Oron', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (64, 3, 'Oruk Anam', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (65, 3, 'Udung-Uko', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (66, 3, 'Ukanafun', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (67, 3, 'Uruan', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (68, 3, 'Urue-Offong/Oruko', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (69, 3, 'Uyo', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (70, 4, 'Aguata', '2022-06-17 00:38:25', '2022-06-17 00:38:25');
INSERT INTO `lgas` VALUES (71, 4, 'Anambra East', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (72, 4, 'Anambra West', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (73, 4, 'Anaocha', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (74, 4, 'Awka North', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (75, 4, 'Awka South', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (76, 4, 'Ayamelum', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (77, 4, 'Dunukofia', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (78, 4, 'Ekwusigo', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (79, 4, 'Idemili North', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (80, 4, 'Idemili South', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (81, 4, 'Ihiala', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (82, 4, 'Njikoka', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (83, 4, 'Nnewi North', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (84, 4, 'Nnewi South', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (85, 4, 'Ogbaru', '2022-06-17 00:38:26', '2022-06-17 00:38:26');
INSERT INTO `lgas` VALUES (86, 4, 'Onitsha North', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (87, 4, 'Onitsha South', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (88, 4, 'Orumba North', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (89, 4, 'Orumba South', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (90, 4, 'Oyi', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (91, 5, 'Alkaleri', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (92, 5, 'Bauchi', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (93, 5, 'Bogoro', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (94, 5, 'Damban', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (95, 5, 'Darazo', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (96, 5, 'Dass', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (97, 5, 'Gamawa', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (98, 5, 'Ganjuwa', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (99, 5, 'Giade', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (100, 5, 'Itas/Gadau', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (101, 5, 'Jama\'are', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (102, 5, 'Katagum', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (103, 5, 'Kirfi', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (104, 5, 'Misau', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (105, 5, 'Ningi', '2022-06-17 00:38:27', '2022-06-17 00:38:27');
INSERT INTO `lgas` VALUES (106, 5, 'Shira', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (107, 5, 'Tafawa Balewa', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (108, 5, 'Toro', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (109, 5, 'Warji', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (110, 5, 'Zaki', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (111, 6, 'Brass', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (112, 6, 'Ekeremor', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (113, 6, 'Kolokuma/Opokuma', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (114, 6, 'Nembe', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (115, 6, 'Ogbia', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (116, 6, 'Sagbama', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (117, 6, 'Southern Ijaw', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (118, 6, 'Yenagoa', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (119, 7, 'Agatu', '2022-06-17 00:38:28', '2022-06-17 00:38:28');
INSERT INTO `lgas` VALUES (120, 7, 'Apa', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (121, 7, 'Ado', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (122, 7, 'Buruku', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (123, 7, 'Gboko', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (124, 7, 'Guma', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (125, 7, 'Gwer East', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (126, 7, 'Gwer West', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (127, 7, 'Katsina-Ala', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (128, 7, 'Konshisha', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (129, 7, 'Kwande', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (130, 7, 'Logo', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (131, 7, 'Makurdi', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (132, 7, 'Obi', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (133, 7, 'Ogbadibo', '2022-06-17 00:38:29', '2022-06-17 00:38:29');
INSERT INTO `lgas` VALUES (134, 7, 'Ohimini', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (135, 7, 'Oju', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (136, 7, 'Okpokwu', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (137, 7, 'Oturkpo', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (138, 7, 'Tarka', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (139, 7, 'Ukum', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (140, 7, 'Ushongo', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (141, 7, 'Vandeikya', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (142, 8, 'Abadam', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (143, 8, 'Askira/Uba', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (144, 8, 'Bama', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (145, 8, 'Bayo', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (146, 8, 'Biu', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (147, 8, 'Chibok', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (148, 8, 'Damboa', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (149, 8, 'Dikwa', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (150, 8, 'Gubio', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (151, 8, 'Guzamala', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (152, 8, 'Gwoza', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (153, 8, 'Hawul', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (154, 8, 'Jere', '2022-06-17 00:38:30', '2022-06-17 00:38:30');
INSERT INTO `lgas` VALUES (155, 8, 'Kaga', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (156, 8, 'Kala/Balge', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (157, 8, 'Konduga', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (158, 8, 'Kukawa', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (159, 8, 'Kwaya Kusar', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (160, 8, 'Mafa', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (161, 8, 'Magumeri', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (162, 8, 'Maiduguri', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (163, 8, 'Marte', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (164, 8, 'Mobbar', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (165, 8, 'Monguno', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (166, 8, 'Ngala', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (167, 8, 'Nganzai', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (168, 8, 'Shani', '2022-06-17 00:38:31', '2022-06-17 00:38:31');
INSERT INTO `lgas` VALUES (169, 9, 'Abi', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (170, 9, 'Akamkpa', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (171, 9, 'Akpabuyo', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (172, 9, 'Bakassi', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (173, 9, 'Bekwarra', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (174, 9, 'Biase', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (175, 9, 'Boki', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (176, 9, 'Calabar Municipal', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (177, 9, 'Calabar South', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (178, 9, 'Etung', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (179, 9, 'Ikom', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (180, 9, 'Obanliku', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (181, 9, 'Obubra', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (182, 9, 'Obudu', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (183, 9, 'Odukpani', '2022-06-17 00:38:32', '2022-06-17 00:38:32');
INSERT INTO `lgas` VALUES (184, 9, 'Ogoja', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (185, 9, 'Yakuur', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (186, 9, 'Yala', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (187, 10, 'Aniocha North', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (188, 10, 'Aniocha South', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (189, 10, 'Bomadi', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (190, 10, 'Burutu', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (191, 10, 'Ethiope East', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (192, 10, 'Ethiope West', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (193, 10, 'Ika North East', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (194, 10, 'Ika South', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (195, 10, 'Isoko North', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (196, 10, 'Isoko South', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (197, 10, 'Ndokwa East', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (198, 10, 'Ndokwa West', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (199, 10, 'Okpe', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (200, 10, 'Oshimili North', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (201, 10, 'Oshimili South', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (202, 10, 'Patani', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (203, 10, 'Sapele, Delta', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (204, 10, 'Udu', '2022-06-17 00:38:33', '2022-06-17 00:38:33');
INSERT INTO `lgas` VALUES (205, 10, 'Ughelli North', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (206, 10, 'Ughelli South', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (207, 10, 'Ukwuani', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (208, 10, 'Uvwie', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (209, 10, 'Warri North', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (210, 10, 'Warri South', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (211, 10, 'Warri South West', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (212, 11, 'Abakaliki', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (213, 11, 'Afikpo North', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (214, 11, 'Afikpo South', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (215, 11, 'Ebonyi', '2022-06-17 00:38:34', '2022-06-17 00:38:34');
INSERT INTO `lgas` VALUES (216, 11, 'Ezza North', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (217, 11, 'Ezza South', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (218, 11, 'Ikwo', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (219, 11, 'Ishielu', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (220, 11, 'Ivo', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (221, 11, 'Izzi', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (222, 11, 'Ohaozara', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (223, 11, 'Ohaukwu', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (224, 11, 'Onicha', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (225, 12, 'Akoko-Edo', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (226, 12, 'Egor', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (227, 12, 'Esan Central', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (228, 12, 'Esan North-East', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (229, 12, 'Esan South-East', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (230, 12, 'Esan West', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (231, 12, 'Etsako Central', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (232, 12, 'Etsako East', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (233, 12, 'Etsako West', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (234, 12, 'Igueben', '2022-06-17 00:38:35', '2022-06-17 00:38:35');
INSERT INTO `lgas` VALUES (235, 12, 'Ikpoba Okha', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (236, 12, 'Orhionmwon', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (237, 12, 'Oredo', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (238, 12, 'Ovia North-East', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (239, 12, 'Ovia South-West', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (240, 12, 'Owan East', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (241, 12, 'Owan West', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (242, 12, 'Uhunmwonde', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (243, 13, 'Ado Ekiti', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (244, 13, 'Efon', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (245, 13, 'Ekiti East', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (246, 13, 'Ekiti South-West', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (247, 13, 'Ekiti West', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (248, 13, 'Emure', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (249, 13, 'Gbonyin', '2022-06-17 00:38:36', '2022-06-17 00:38:36');
INSERT INTO `lgas` VALUES (250, 13, 'Ido Osi', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (251, 13, 'Ijero', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (252, 13, 'Ikere', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (253, 13, 'Ikole', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (254, 13, 'Ilejemeje', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (255, 13, 'Irepodun/Ifelodun', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (256, 13, 'Ise/Orun', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (257, 13, 'Moba', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (258, 13, 'Oye', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (259, 14, 'Aninri', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (260, 14, 'Awgu', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (261, 14, 'Enugu East', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (262, 14, 'Enugu North', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (263, 14, 'Enugu South', '2022-06-17 00:38:37', '2022-06-17 00:38:37');
INSERT INTO `lgas` VALUES (264, 14, 'Ezeagu', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (265, 14, 'Igbo Etiti', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (266, 14, 'Igbo Eze North', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (267, 14, 'Igbo Eze South', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (268, 14, 'Isi Uzo', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (269, 14, 'Nkanu East', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (270, 14, 'Nkanu West', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (271, 14, 'Nsukka', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (272, 14, 'Oji River', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (273, 14, 'Udenu', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (274, 14, 'Udi', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (275, 14, 'Uzo Uwani', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (276, 15, 'Abaji', '2022-06-17 00:38:38', '2022-06-17 00:38:38');
INSERT INTO `lgas` VALUES (277, 15, 'Bwari', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (278, 15, 'Gwagwalada', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (279, 15, 'Kuje', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (280, 15, 'Kwali', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (281, 15, 'Municipal Area Council', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (282, 16, 'Akko', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (283, 16, 'Balanga', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (284, 16, 'Billiri', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (285, 16, 'Dukku', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (286, 16, 'Funakaye', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (287, 16, 'Gombe', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (288, 16, 'Kaltungo', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (289, 16, 'Kwami', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (290, 16, 'Nafada', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (291, 16, 'Shongom', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (292, 16, 'Yamaltu/Deba', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (293, 17, 'Aboh Mbaise', '2022-06-17 00:38:39', '2022-06-17 00:38:39');
INSERT INTO `lgas` VALUES (294, 17, 'Ahiazu Mbaise', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (295, 17, 'Ehime Mbano', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (296, 17, 'Ezinihitte', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (297, 17, 'Ideato North', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (298, 17, 'Ideato South', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (299, 17, 'Ihitte/Uboma', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (300, 17, 'Ikeduru', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (301, 17, 'Isiala Mbano', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (302, 17, 'Isu', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (303, 17, 'Mbaitoli', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (304, 17, 'Ngor Okpala', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (305, 17, 'Njaba', '2022-06-17 00:38:40', '2022-06-17 00:38:40');
INSERT INTO `lgas` VALUES (306, 17, 'Nkwerre', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (307, 17, 'Nwangele', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (308, 17, 'Obowo', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (309, 17, 'Oguta', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (310, 17, 'Ohaji/Egbema', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (311, 17, 'Okigwe', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (312, 17, 'Orlu', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (313, 17, 'Orsu', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (314, 17, 'Oru East', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (315, 17, 'Oru West', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (316, 17, 'Owerri Municipal', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (317, 17, 'Owerri North', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (318, 17, 'Owerri West', '2022-06-17 00:38:41', '2022-06-17 00:38:41');
INSERT INTO `lgas` VALUES (319, 17, 'Unuimo', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (320, 18, 'Auyo', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (321, 18, 'Babura', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (322, 18, 'Biriniwa', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (323, 18, 'Birnin Kudu', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (324, 18, 'Buji', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (325, 18, 'Dutse', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (326, 18, 'Gagarawa', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (327, 18, 'Garki', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (328, 18, 'Gumel', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (329, 18, 'Guri', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (330, 18, 'Gwaram', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (331, 18, 'Gwiwa', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (332, 18, 'Hadejia', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (333, 18, 'Jahun', '2022-06-17 00:38:42', '2022-06-17 00:38:42');
INSERT INTO `lgas` VALUES (334, 18, 'Kafin Hausa', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (335, 18, 'Kazaure', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (336, 18, 'Kiri Kasama', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (337, 18, 'Kiyawa', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (338, 18, 'Kaugama', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (339, 18, 'Maigatari', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (340, 18, 'Malam Madori', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (341, 18, 'Miga', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (342, 18, 'Ringim', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (343, 18, 'Roni', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (344, 18, 'Sule Tankarkar', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (345, 18, 'Taura', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (346, 18, 'Yankwashi', '2022-06-17 00:38:43', '2022-06-17 00:38:43');
INSERT INTO `lgas` VALUES (347, 19, 'Birnin Gwari', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (348, 19, 'Chikun', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (349, 19, 'Giwa', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (350, 19, 'Igabi', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (351, 19, 'Ikara', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (352, 19, 'Jaba', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (353, 19, 'Jema\'a', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (354, 19, 'Kachia', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (355, 19, 'Kaduna North', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (356, 19, 'Kaduna South', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (357, 19, 'Kagarko', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (358, 19, 'Kajuru', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (359, 19, 'Kaura', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (360, 19, 'Kauru', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (361, 19, 'Kubau', '2022-06-17 00:38:44', '2022-06-17 00:38:44');
INSERT INTO `lgas` VALUES (362, 19, 'Kudan', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (363, 19, 'Lere', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (364, 19, 'Makarfi', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (365, 19, 'Sabon Gari', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (366, 19, 'Sanga', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (367, 19, 'Soba', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (368, 19, 'Zangon Kataf', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (369, 19, 'Zaria', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (370, 20, 'Ajingi', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (371, 20, 'Albasu', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (372, 20, 'Bagwai', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (373, 20, 'Bebeji', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (374, 20, 'Bichi', '2022-06-17 00:38:45', '2022-06-17 00:38:45');
INSERT INTO `lgas` VALUES (375, 20, 'Bunkure', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (376, 20, 'Dala', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (377, 20, 'Dambatta', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (378, 20, 'Dawakin Kudu', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (379, 20, 'Dawakin Tofa', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (380, 20, 'Doguwa', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (381, 20, 'Fagge', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (382, 20, 'Gabasawa', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (383, 20, 'Garko', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (384, 20, 'Garun Mallam', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (385, 20, 'Gaya', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (386, 20, 'Gezawa', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (387, 20, 'Gwale', '2022-06-17 00:38:46', '2022-06-17 00:38:46');
INSERT INTO `lgas` VALUES (388, 20, 'Gwarzo', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (389, 20, 'Kabo', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (390, 20, 'Kano Municipal', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (391, 20, 'Karaye', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (392, 20, 'Kibiya', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (393, 20, 'Kiru', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (394, 20, 'Kumbotso', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (395, 20, 'Kunchi', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (396, 20, 'Kura', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (397, 20, 'Madobi', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (398, 20, 'Makoda', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (399, 20, 'Minjibir', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (400, 20, 'Nasarawa', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (401, 20, 'Rano', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (402, 20, 'Rimin Gado', '2022-06-17 00:38:47', '2022-06-17 00:38:47');
INSERT INTO `lgas` VALUES (403, 20, 'Rogo', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (404, 20, 'Shanono', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (405, 20, 'Sumaila', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (406, 20, 'Takai', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (407, 20, 'Tarauni', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (408, 20, 'Tofa', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (409, 20, 'Tsanyawa', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (410, 20, 'Tudun Wada', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (411, 20, 'Ungogo', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (412, 20, 'Warawa', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (413, 20, 'Wudil', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (414, 21, 'Bakori', '2022-06-17 00:38:48', '2022-06-17 00:38:48');
INSERT INTO `lgas` VALUES (415, 21, 'Batagarawa', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (416, 21, 'Batsari', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (417, 21, 'Baure', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (418, 21, 'Bindawa', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (419, 21, 'Charanchi', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (420, 21, 'Dandume', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (421, 21, 'Danja', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (422, 21, 'Dan Musa', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (423, 21, 'Daura', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (424, 21, 'Dutsi', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (425, 21, 'Dutsin Ma', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (426, 21, 'Faskari', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (427, 21, 'Funtua', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (428, 21, 'Ingawa', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (429, 21, 'Jibia', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (430, 21, 'Kafur', '2022-06-17 00:38:49', '2022-06-17 00:38:49');
INSERT INTO `lgas` VALUES (431, 21, 'Kaita', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (432, 21, 'Kankara', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (433, 21, 'Kankia', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (434, 21, 'Katsina', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (435, 21, 'Kurfi', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (436, 21, 'Kusada', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (437, 21, 'Mai\'Adua', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (438, 21, 'Malumfashi', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (439, 21, 'Mani', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (440, 21, 'Mashi', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (441, 21, 'Matazu', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (442, 21, 'Musawa', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (443, 21, 'Rimi', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (444, 21, 'Sabuwa', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (445, 21, 'Safana', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (446, 21, 'Sandamu', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (447, 21, 'Zango', '2022-06-17 00:38:50', '2022-06-17 00:38:50');
INSERT INTO `lgas` VALUES (448, 22, 'Aleiro', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (449, 22, 'Arewa Dandi', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (450, 22, 'Argungu', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (451, 22, 'Augie', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (452, 22, 'Bagudo', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (453, 22, 'Birnin Kebbi', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (454, 22, 'Bunza', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (455, 22, 'Dandi', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (456, 22, 'Fakai', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (457, 22, 'Gwandu', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (458, 22, 'Jega', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (459, 22, 'Kalgo', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (460, 22, 'Koko/Besse', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (461, 22, 'Maiyama', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (462, 22, 'Ngaski', '2022-06-17 00:38:51', '2022-06-17 00:38:51');
INSERT INTO `lgas` VALUES (463, 22, 'Sakaba', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (464, 22, 'Shanga', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (465, 22, 'Suru', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (466, 22, 'Wasagu/Danko', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (467, 22, 'Yauri', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (468, 22, 'Zuru', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (469, 23, 'Adavi', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (470, 23, 'Ajaokuta', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (471, 23, 'Ankpa', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (472, 23, 'Bassa', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (473, 23, 'Dekina', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (474, 23, 'Ibaji', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (475, 23, 'Idah', '2022-06-17 00:38:52', '2022-06-17 00:38:52');
INSERT INTO `lgas` VALUES (476, 23, 'Igalamela Odolu', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (477, 23, 'Ijumu', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (478, 23, 'Kabba/Bunu', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (479, 23, 'Kogi', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (480, 23, 'Lokoja', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (481, 23, 'Mopa Muro', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (482, 23, 'Ofu', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (483, 23, 'Ogori/Magongo', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (484, 23, 'Okehi', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (485, 23, 'Okene', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (486, 23, 'Olamaboro', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (487, 23, 'Omala', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (488, 23, 'Yagba East', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (489, 23, 'Yagba West', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (490, 24, 'Asa', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (491, 24, 'Baruten', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (492, 24, 'Edu', '2022-06-17 00:38:53', '2022-06-17 00:38:53');
INSERT INTO `lgas` VALUES (493, 24, 'Ekiti, Kwara State', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (494, 24, 'Ifelodun', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (495, 24, 'Ilorin East', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (496, 24, 'Ilorin South', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (497, 24, 'Ilorin West', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (498, 24, 'Irepodun', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (499, 24, 'Isin', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (500, 24, 'Kaiama', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (501, 24, 'Moro', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (502, 24, 'Offa', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (503, 24, 'Oke Ero', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (504, 24, 'Oyun', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (505, 24, 'Pategi', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (506, 25, 'Agege', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (507, 25, 'Ajeromi-Ifelodun', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (508, 25, 'Alimosho', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (509, 25, 'Amuwo-Odofin', '2022-06-17 00:38:54', '2022-06-17 00:38:54');
INSERT INTO `lgas` VALUES (510, 25, 'Apapa', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (511, 25, 'Badagry', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (512, 25, 'Epe', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (513, 25, 'Eti Osa', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (514, 25, 'Ibeju-Lekki', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (515, 25, 'Ifako-Ijaiye', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (516, 25, 'Ikeja', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (517, 25, 'Ikorodu', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (518, 25, 'Kosofe', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (519, 25, 'Lagos Island', '2022-06-17 00:38:55', '2022-06-17 00:38:55');
INSERT INTO `lgas` VALUES (520, 25, 'Lagos Mainland', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (521, 25, 'Mushin', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (522, 25, 'Ojo', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (523, 25, 'Oshodi-Isolo', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (524, 25, 'Shomolu', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (525, 25, 'Surulere, Lagos State', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (526, 26, 'Akwanga', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (527, 26, 'Awe', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (528, 26, 'Doma', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (529, 26, 'Karu', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (530, 26, 'Keana', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (531, 26, 'Keffi', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (532, 26, 'Kokona', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (533, 26, 'Lafia', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (534, 26, 'Nasarawa', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (535, 26, 'Nasarawa Egon', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (536, 26, 'Obi', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (537, 26, 'Toto', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (538, 26, 'Wamba', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (539, 27, 'Agaie', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (540, 27, 'Agwara', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (541, 27, 'Bida', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (542, 27, 'Borgu', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (543, 27, 'Bosso', '2022-06-17 00:38:56', '2022-06-17 00:38:56');
INSERT INTO `lgas` VALUES (544, 27, 'Chanchaga', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (545, 27, 'Edati', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (546, 27, 'Gbako', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (547, 27, 'Gurara', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (548, 27, 'Katcha', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (549, 27, 'Kontagora', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (550, 27, 'Lapai', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (551, 27, 'Lavun', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (552, 27, 'Magama', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (553, 27, 'Mariga', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (554, 27, 'Mashegu', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (555, 27, 'Mokwa', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (556, 27, 'Moya', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (557, 27, 'Paikoro', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (558, 27, 'Rafi', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (559, 27, 'Rijau', '2022-06-17 00:38:57', '2022-06-17 00:38:57');
INSERT INTO `lgas` VALUES (560, 27, 'Shiroro', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (561, 27, 'Suleja', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (562, 27, 'Tafa', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (563, 27, 'Wushishi', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (564, 28, 'Abeokuta North', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (565, 28, 'Abeokuta South', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (566, 28, 'Ado-Odo/Ota', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (567, 28, 'Egbado North', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (568, 28, 'Egbado South', '2022-06-17 00:38:58', '2022-06-17 00:38:58');
INSERT INTO `lgas` VALUES (569, 28, 'Ewekoro', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (570, 28, 'Ifo', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (571, 28, 'Ijebu East', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (572, 28, 'Ijebu North', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (573, 28, 'Ijebu North East', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (574, 28, 'Ijebu Ode', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (575, 28, 'Ikenne', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (576, 28, 'Imeko Afon', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (577, 28, 'Ipokia', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (578, 28, 'Obafemi Owode', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (579, 28, 'Odeda', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (580, 28, 'Odogbolu', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (581, 28, 'Ogun Waterside', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (582, 28, 'Remo North', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (583, 28, 'Shagamu', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (584, 29, 'Akoko North-East', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (585, 29, 'Akoko North-West', '2022-06-17 00:38:59', '2022-06-17 00:38:59');
INSERT INTO `lgas` VALUES (586, 29, 'Akoko South-West', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (587, 29, 'Akoko South-East', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (588, 29, 'Akure North', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (589, 29, 'Akure South', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (590, 29, 'Ese Odo', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (591, 29, 'Idanre', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (592, 29, 'Ifedore', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (593, 29, 'Ilaje', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (594, 29, 'Ile Oluji/Okeigbo', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (595, 29, 'Irele', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (596, 29, 'Odigbo', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (597, 29, 'Okitipupa', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (598, 29, 'Ondo East', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (599, 29, 'Ondo West', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (600, 29, 'Ose', '2022-06-17 00:39:00', '2022-06-17 00:39:00');
INSERT INTO `lgas` VALUES (601, 29, 'Owo', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (602, 30, 'Atakunmosa East', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (603, 30, 'Atakunmosa West', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (604, 30, 'Aiyedaade', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (605, 30, 'Aiyedire', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (606, 30, 'Boluwaduro', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (607, 30, 'Boripe', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (608, 30, 'Ede North', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (609, 30, 'Ede South', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (610, 30, 'Ife Central', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (611, 30, 'Ife East', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (612, 30, 'Ife North', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (613, 30, 'Ife South', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (614, 30, 'Egbedore', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (615, 30, 'Ejigbo', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (616, 30, 'Ifedayo', '2022-06-17 00:39:01', '2022-06-17 00:39:01');
INSERT INTO `lgas` VALUES (617, 30, 'Ifelodun', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (618, 30, 'Ila', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (619, 30, 'Ilesa East', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (620, 30, 'Ilesa West', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (621, 30, 'Irepodun', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (622, 30, 'Irewole', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (623, 30, 'Isokan', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (624, 30, 'Iwo', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (625, 30, 'Obokun', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (626, 30, 'Odo Otin', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (627, 30, 'Ola Oluwa', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (628, 30, 'Olorunda', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (629, 30, 'Oriade', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (630, 30, 'Orolu', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (631, 30, 'Osogbo', '2022-06-17 00:39:02', '2022-06-17 00:39:02');
INSERT INTO `lgas` VALUES (632, 31, 'Afijio', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (633, 31, 'Akinyele', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (634, 31, 'Atiba', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (635, 31, 'Atisbo', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (636, 31, 'Egbeda', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (637, 31, 'Ibadan North', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (638, 31, 'Ibadan North-East', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (639, 31, 'Ibadan North-West', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (640, 31, 'Ibadan South-East', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (641, 31, 'Ibadan South-West', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (642, 31, 'Ibarapa Central', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (643, 31, 'Ibarapa East', '2022-06-17 00:39:03', '2022-06-17 00:39:03');
INSERT INTO `lgas` VALUES (644, 31, 'Ibarapa North', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (645, 31, 'Ido', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (646, 31, 'Irepo', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (647, 31, 'Iseyin', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (648, 31, 'Itesiwaju', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (649, 31, 'Iwajowa', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (650, 31, 'Kajola', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (651, 31, 'Lagelu', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (652, 31, 'Ogbomosho North', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (653, 31, 'Ogbomosho South', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (654, 31, 'Ogo Oluwa', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (655, 31, 'Olorunsogo', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (656, 31, 'Oluyole', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (657, 31, 'Ona Ara', '2022-06-17 00:39:04', '2022-06-17 00:39:04');
INSERT INTO `lgas` VALUES (658, 31, 'Orelope', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (659, 31, 'Ori Ire', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (660, 31, 'Oyo', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (661, 31, 'Oyo East', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (662, 31, 'Saki East', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (663, 31, 'Saki West', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (664, 31, 'Surulere, Oyo State', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (665, 32, 'Bokkos', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (666, 32, 'Barkin Ladi', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (667, 32, 'Bassa', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (668, 32, 'Jos East', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (669, 32, 'Jos North', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (670, 32, 'Jos South', '2022-06-17 00:39:05', '2022-06-17 00:39:05');
INSERT INTO `lgas` VALUES (671, 32, 'Kanam', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (672, 32, 'Kanke', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (673, 32, 'Langtang South', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (674, 32, 'Langtang North', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (675, 32, 'Mangu', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (676, 32, 'Mikang', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (677, 32, 'Pankshin', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (678, 32, 'Qua\'an Pan', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (679, 32, 'Riyom', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (680, 32, 'Shendam', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (681, 32, 'Wase', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (682, 33, 'Abua/Odual', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (683, 33, 'Ahoada East', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (684, 33, 'Ahoada West', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (685, 33, 'Akuku-Toru', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (686, 33, 'Andoni', '2022-06-17 00:39:06', '2022-06-17 00:39:06');
INSERT INTO `lgas` VALUES (687, 33, 'Asari-Toru', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (688, 33, 'Bonny', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (689, 33, 'Degema', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (690, 33, 'Eleme', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (691, 33, 'Emuoha', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (692, 33, 'Etche', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (693, 33, 'Gokana', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (694, 33, 'Ikwerre', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (695, 33, 'Khana', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (696, 33, 'Obio/Akpor', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (697, 33, 'Ogba/Egbema/Ndoni', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (698, 33, 'Ogu/Bolo', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (699, 33, 'Okrika', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (700, 33, 'Omuma', '2022-06-17 00:39:07', '2022-06-17 00:39:07');
INSERT INTO `lgas` VALUES (701, 33, 'Opobo/Nkoro', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (702, 33, 'Oyigbo', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (703, 33, 'Port Harcourt', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (704, 33, 'Tai', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (705, 34, 'Binji', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (706, 34, 'Bodinga', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (707, 34, 'Dange Shuni', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (708, 34, 'Gada', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (709, 34, 'Goronyo', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (710, 34, 'Gudu', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (711, 34, 'Gwadabawa', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (712, 34, 'Illela', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (713, 34, 'Isa', '2022-06-17 00:39:08', '2022-06-17 00:39:08');
INSERT INTO `lgas` VALUES (714, 34, 'Kebbe', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (715, 34, 'Kware', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (716, 34, 'Rabah', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (717, 34, 'Sabon Birni', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (718, 34, 'Shagari', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (719, 34, 'Silame', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (720, 34, 'Sokoto North', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (721, 34, 'Sokoto South', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (722, 34, 'Tambuwal', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (723, 34, 'Tangaza', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (724, 34, 'Tureta', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (725, 34, 'Wamako', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (726, 34, 'Wurno', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (727, 34, 'Yabo', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (728, 35, 'Ardo Kola', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (729, 35, 'Bali', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (730, 35, 'Donga', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (731, 35, 'Gashaka', '2022-06-17 00:39:09', '2022-06-17 00:39:09');
INSERT INTO `lgas` VALUES (732, 35, 'Gassol', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (733, 35, 'Ibi', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (734, 35, 'Jalingo', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (735, 35, 'Karim Lamido', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (736, 35, 'Kumi', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (737, 35, 'Lau', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (738, 35, 'Sardauna', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (739, 35, 'Takum', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (740, 35, 'Ussa', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (741, 35, 'Wukari', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (742, 35, 'Yorro', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (743, 35, 'Zing', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (744, 36, 'Bade', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (745, 36, 'Bursari', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (746, 36, 'Damaturu', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (747, 36, 'Fika', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (748, 36, 'Fune', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (749, 36, 'Geidam', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (750, 36, 'Gujba', '2022-06-17 00:39:10', '2022-06-17 00:39:10');
INSERT INTO `lgas` VALUES (751, 36, 'Gulani', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (752, 36, 'Jakusko', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (753, 36, 'Karasuwa', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (754, 36, 'Machina', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (755, 36, 'Nangere', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (756, 36, 'Nguru', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (757, 36, 'Potiskum', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (758, 36, 'Tarmuwa', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (759, 36, 'Yunusari', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (760, 36, 'Yusufari', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (761, 37, 'Anka', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (762, 37, 'Bakura', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (763, 37, 'Birnin Magaji/Kiyaw', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (764, 37, 'Bukkuyum', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (765, 37, 'Bungudu', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (766, 37, 'Gummi', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (767, 37, 'Gusau', '2022-06-17 00:39:11', '2022-06-17 00:39:11');
INSERT INTO `lgas` VALUES (768, 37, 'Kaura Namoda', '2022-06-17 00:39:12', '2022-06-17 00:39:12');
INSERT INTO `lgas` VALUES (769, 37, 'Maradun', '2022-06-17 00:39:12', '2022-06-17 00:39:12');
INSERT INTO `lgas` VALUES (770, 37, 'Maru', '2022-06-17 00:39:12', '2022-06-17 00:39:12');
INSERT INTO `lgas` VALUES (771, 37, 'Shinkafi', '2022-06-17 00:39:12', '2022-06-17 00:39:12');
INSERT INTO `lgas` VALUES (772, 37, 'Talata Mafara', '2022-06-17 00:39:12', '2022-06-17 00:39:12');
INSERT INTO `lgas` VALUES (773, 37, 'Chafe', '2022-06-17 00:39:12', '2022-06-17 00:39:12');
INSERT INTO `lgas` VALUES (774, 37, 'Zurmi', '2022-06-17 00:39:12', '2022-06-17 00:39:12');

-- ----------------------------
-- Table structure for marks
-- ----------------------------
DROP TABLE IF EXISTS `marks`;
CREATE TABLE `marks`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `my_class_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NOT NULL,
  `t1` int(11) NULL DEFAULT NULL,
  `t2` int(11) NULL DEFAULT NULL,
  `t3` int(11) NULL DEFAULT NULL,
  `t4` int(11) NULL DEFAULT NULL,
  `tca` int(11) NULL DEFAULT NULL,
  `exm` int(11) NULL DEFAULT NULL,
  `tex1` int(11) NULL DEFAULT NULL,
  `tex2` int(11) NULL DEFAULT NULL,
  `tex3` int(11) NULL DEFAULT NULL,
  `sub_pos` tinyint(4) NULL DEFAULT NULL,
  `cum` int(11) NULL DEFAULT NULL,
  `cum_ave` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `grade_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `marks_student_id_foreign`(`student_id`) USING BTREE,
  INDEX `marks_my_class_id_foreign`(`my_class_id`) USING BTREE,
  INDEX `marks_section_id_foreign`(`section_id`) USING BTREE,
  INDEX `marks_subject_id_foreign`(`subject_id`) USING BTREE,
  INDEX `marks_exam_id_foreign`(`exam_id`) USING BTREE,
  INDEX `marks_grade_id_foreign`(`grade_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) UNSIGNED NOT NULL,
  `message_type` int(11) NOT NULL,
  `receiver_type` int(11) NOT NULL,
  `receiver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 84 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES (14, 1, 1, 11, '+254203570095,+254729891801, +254715223003', 'Meetting', 'testvvvvvvvvvvvvvvvvvvvvv', '2022-08-16 05:58:20', '2022-08-16 05:58:20', 1);
INSERT INTO `messages` VALUES (20, 1, 1, 22, '+254784714863', 'Meetting', 'qqq', '2022-08-16 15:16:47', '2022-12-29 23:14:31', 1);
INSERT INTO `messages` VALUES (21, 1, 1, 23, '+254784714863,+4 444 444 1234,+4 444 444 1234,123', 'Meetting', 'a', '2022-08-16 15:51:50', '2022-08-16 15:51:50', 1);
INSERT INTO `messages` VALUES (22, 1, 1, 23, '+254784714863,+4 444 444 1234,+4 444 444 1234,123', 'Meetting', 'aa', '2022-08-16 15:52:18', '2022-08-16 15:52:18', 1);
INSERT INTO `messages` VALUES (23, 1, 1, 21, '+254784714863,+4 444 444 1234,444444412341234,+4 444 444 1234,123', 'Test', 'aaa', '2022-08-16 18:13:09', '2022-08-16 18:13:09', 1);
INSERT INTO `messages` VALUES (25, 1, 1, 33, '1234566', 'Meetting', 'test', '2022-08-16 18:22:21', '2022-08-16 18:22:21', 0);
INSERT INTO `messages` VALUES (26, 1, 1, 33, '1234566', 'Meetting', 'aaaaaaaaaaaaaaaaaaa', '2022-08-16 18:24:00', '2022-08-16 18:24:00', 0);
INSERT INTO `messages` VALUES (27, 1, 1, 43, '1234566,123,1234566,123,123', 'Test', 'ssss', '2022-08-16 18:31:41', '2022-08-16 18:31:41', 1);
INSERT INTO `messages` VALUES (71, 1, 1, 61, '123456.456789.', 'test', 'test', '2022-08-24 07:51:18', '2022-08-24 07:51:18', 1);
INSERT INTO `messages` VALUES (75, 1, 1, 22, '+254715223003', 'Meetting', 'heyaaaaaaaaaa', '2022-08-24 08:05:13', '2022-08-24 08:05:13', 0);
INSERT INTO `messages` VALUES (76, 1, 1, 61, '+254715223003.+254784714863.', 'Test', 'heloo people', '2022-08-24 08:12:12', '2022-08-24 08:12:12', 1);
INSERT INTO `messages` VALUES (77, 1, 1, 22, '+254715223003', 'All Every body', 'heloo teacher', '2022-08-24 08:14:16', '2022-08-24 08:14:16', 0);
INSERT INTO `messages` VALUES (78, 2, 1, 22, '+254715223003', 'Metting', 'heyyyy.....', '2022-08-24 18:35:19', '2022-08-24 18:35:19', 0);
INSERT INTO `messages` VALUES (79, 2, 1, 22, '+254715223003,123', 'testing', 'heloooo zs', '2022-08-24 18:36:56', '2022-08-24 18:36:56', 1);
INSERT INTO `messages` VALUES (80, 2, 1, 32, '+254745718810,+254715223003', 'test', 'heloo BOM/PA', '2022-08-24 18:38:57', '2022-08-24 18:38:57', 1);
INSERT INTO `messages` VALUES (81, 2, 1, 42, '+254715223003,+254745718810', 'Metting', 'HELOO STAFF', '2022-08-24 18:41:07', '2022-08-24 18:41:07', 1);
INSERT INTO `messages` VALUES (82, 2, 1, 61, '0715223003.', 'test', 'HELOO OTHERS', '2022-08-24 18:41:58', '2022-08-24 18:41:58', 0);
INSERT INTO `messages` VALUES (83, 1, 1, 61, '0784714863', 'Meetting', 'heloooooooooooooooooooo', '2022-08-31 06:04:14', '2022-12-29 23:14:31', 1);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2013_09_20_121733_create_blood_groups_table', 1);
INSERT INTO `migrations` VALUES (2, '2013_09_22_124750_create_states_table', 1);
INSERT INTO `migrations` VALUES (3, '2013_09_22_124806_create_lgas_table', 1);
INSERT INTO `migrations` VALUES (4, '2013_09_26_121148_create_nationalities_table', 1);
INSERT INTO `migrations` VALUES (5, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (6, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (7, '2018_09_20_100249_create_user_types_table', 1);
INSERT INTO `migrations` VALUES (9, '2018_09_22_073005_create_my_classes_table', 1);
INSERT INTO `migrations` VALUES (10, '2018_09_22_073526_create_sections_table', 1);
INSERT INTO `migrations` VALUES (11, '2018_09_22_080555_create_settings_table', 1);
INSERT INTO `migrations` VALUES (12, '2018_09_22_081302_create_subjects_table', 1);
INSERT INTO `migrations` VALUES (13, '2018_09_22_151514_create_student_records_table', 1);
INSERT INTO `migrations` VALUES (14, '2018_09_26_124241_create_dorms_table', 1);
INSERT INTO `migrations` VALUES (16, '2018_10_06_224846_create_marks_table', 1);
INSERT INTO `migrations` VALUES (17, '2018_10_06_224944_create_grades_table', 1);
INSERT INTO `migrations` VALUES (18, '2018_10_06_225007_create_pins_table', 1);
INSERT INTO `migrations` VALUES (19, '2018_10_18_205550_create_skills_table', 1);
INSERT INTO `migrations` VALUES (21, '2018_10_31_191358_create_books_table', 1);
INSERT INTO `migrations` VALUES (22, '2018_10_31_192540_create_book_requests_table', 1);
INSERT INTO `migrations` VALUES (23, '2018_11_01_132115_create_staff_records_table', 1);
INSERT INTO `migrations` VALUES (24, '2018_11_03_210758_create_payments_table', 1);
INSERT INTO `migrations` VALUES (25, '2018_11_03_210817_create_payment_records_table', 1);
INSERT INTO `migrations` VALUES (26, '2018_11_06_083707_create_receipts_table', 1);
INSERT INTO `migrations` VALUES (27, '2018_11_27_180401_create_time_tables_table', 1);
INSERT INTO `migrations` VALUES (28, '2019_09_22_142514_create_fks', 1);
INSERT INTO `migrations` VALUES (29, '2019_09_26_132227_create_promotions_table', 1);
INSERT INTO `migrations` VALUES (30, '2022_06_17_152725_create_forms_table', 2);
INSERT INTO `migrations` VALUES (31, '2022_06_17_152912_create_forms_table', 3);
INSERT INTO `migrations` VALUES (32, '2022_06_17_163441_create_my_classes_table', 4);
INSERT INTO `migrations` VALUES (33, '2022_06_17_174543_create_subjects_table', 5);
INSERT INTO `migrations` VALUES (34, '2022_06_17_175033_create_subject_types_table', 6);
INSERT INTO `migrations` VALUES (35, '2022_06_18_103111_class_subjects', 7);
INSERT INTO `migrations` VALUES (36, '2022_06_18_103509_create_class_subjects_table', 8);
INSERT INTO `migrations` VALUES (38, '2022_06_18_130849_create_forms_table', 10);
INSERT INTO `migrations` VALUES (39, '2022_06_22_122729_create_subject_teachers_table', 11);
INSERT INTO `migrations` VALUES (43, '2022_06_23_140102_create_student_subjects_table', 12);
INSERT INTO `migrations` VALUES (44, '2022_06_23_150108_create_students_table', 12);
INSERT INTO `migrations` VALUES (45, '2022_06_18_125242_create_teachers_table', 13);
INSERT INTO `migrations` VALUES (46, '2022_06_23_222747_create_groups_table', 14);
INSERT INTO `migrations` VALUES (47, '2022_06_28_015022_create_residences_table', 15);
INSERT INTO `migrations` VALUES (48, '2022_06_29_005414_create_test_excels_table', 16);
INSERT INTO `migrations` VALUES (49, '2022_06_29_033414_create_student_temps_table', 17);
INSERT INTO `migrations` VALUES (51, '2018_10_04_224910_create_exams_table', 18);
INSERT INTO `migrations` VALUES (52, '2018_10_18_205842_create_exam_records_table', 18);
INSERT INTO `migrations` VALUES (53, '2022_07_06_043323_create_exam_forms_table', 19);
INSERT INTO `migrations` VALUES (54, '2022_07_21_080945_create_calevents_table', 20);
INSERT INTO `migrations` VALUES (55, '2022_07_21_094806_create_sitecomments_table', 20);
INSERT INTO `migrations` VALUES (56, '2022_07_23_234435_add_column_to_staff_records', 21);
INSERT INTO `migrations` VALUES (57, '2022_07_25_082532_create_bom_pa_records_table', 22);
INSERT INTO `migrations` VALUES (58, '2022_07_29_053502_create_messages_table', 23);
INSERT INTO `migrations` VALUES (59, '2018_09_20_150906_create_class_types_table', 24);
INSERT INTO `migrations` VALUES (63, '2022_09_29_041339_add_column_to_class_subjects_table', 25);
INSERT INTO `migrations` VALUES (64, '2022_09_29_041339_add_column_to_subjects_table', 26);
INSERT INTO `migrations` VALUES (65, '2022_10_03_121016_add_column_to_exam_forms_table', 27);
INSERT INTO `migrations` VALUES (66, '2022_10_06_063900_create_contacts_table', 28);
INSERT INTO `migrations` VALUES (67, '2022_12_24_122544_add_column_to_users_table', 29);
INSERT INTO `migrations` VALUES (68, '2022_12_24_214306_create_schools_table', 30);
INSERT INTO `migrations` VALUES (69, '2022_12_24_215223_add_column_to_schools_table', 31);
INSERT INTO `migrations` VALUES (70, '2022_12_24_222148_add_column_to_users_table', 32);
INSERT INTO `migrations` VALUES (71, '2022_12_26_190824_add_column_to_messages_table', 33);
INSERT INTO `migrations` VALUES (72, '2022_12_29_225427_add_column_to_users_table', 34);
INSERT INTO `migrations` VALUES (74, '2023_01_05_114501_change_field_to_users_table', 35);
INSERT INTO `migrations` VALUES (76, '2023_01_09_064704_change_field_to_bompa_table', 36);
INSERT INTO `migrations` VALUES (77, '2023_01_09_073457_change_field_to_staff_table', 37);
INSERT INTO `migrations` VALUES (78, '2023_01_09_083610_change_field_to_teacher_table', 38);

-- ----------------------------
-- Table structure for my_classes
-- ----------------------------
DROP TABLE IF EXISTS `my_classes`;
CREATE TABLE `my_classes`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NULL DEFAULT NULL,
  `stream` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `teacher_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of my_classes
-- ----------------------------
INSERT INTO `my_classes` VALUES (1, 3, 'Blue1', NULL, '2022-06-23 00:21:20', '2022-12-27 21:42:00');
INSERT INTO `my_classes` VALUES (2, 2, 'West', 2, '2022-06-23 00:21:30', '2022-06-23 14:20:27');
INSERT INTO `my_classes` VALUES (4, 3, 'West111', NULL, '2022-06-23 00:21:40', '2022-12-27 21:39:12');
INSERT INTO `my_classes` VALUES (6, 2, 'qwer qwer', 3, '2022-06-23 00:44:57', '2022-07-08 11:10:51');
INSERT INTO `my_classes` VALUES (50, 2, 'Blue', 4, '2022-06-24 14:16:53', '2022-11-22 19:19:28');
INSERT INTO `my_classes` VALUES (51, 2, 'West', 7, '2022-06-24 14:23:37', '2022-11-01 22:28:48');
INSERT INTO `my_classes` VALUES (52, 1, 'Test', 4, '2022-07-07 05:46:27', '2023-01-04 06:42:07');
INSERT INTO `my_classes` VALUES (53, 1, 'Hello', 6, '2022-07-27 06:12:31', '2022-10-13 22:45:39');
INSERT INTO `my_classes` VALUES (54, 4, 'hero', 8, '2022-10-29 07:08:48', '2022-12-22 17:27:53');
INSERT INTO `my_classes` VALUES (55, 1, 'temp', 32, '2022-11-02 03:48:50', '2023-01-04 06:42:11');
INSERT INTO `my_classes` VALUES (56, 2, 'temp', NULL, '2022-11-02 03:49:20', '2023-01-06 02:44:21');
INSERT INTO `my_classes` VALUES (57, 2, 'temp', 33, '2022-11-02 03:54:44', '2023-01-04 07:59:53');
INSERT INTO `my_classes` VALUES (58, 1, 'temp', 33, '2022-11-03 11:46:54', '2022-11-03 12:27:21');
INSERT INTO `my_classes` VALUES (59, 1, 'Hello', 34, '2022-11-03 12:22:59', '2022-11-03 12:27:23');
INSERT INTO `my_classes` VALUES (60, 1, 'check', NULL, '2022-11-04 07:04:02', '2023-01-04 06:41:17');
INSERT INTO `my_classes` VALUES (61, 1, 'check', 33, '2022-11-04 11:38:02', '2022-11-04 11:38:15');

-- ----------------------------
-- Table structure for nationalities
-- ----------------------------
DROP TABLE IF EXISTS `nationalities`;
CREATE TABLE `nationalities`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 194 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nationalities
-- ----------------------------
INSERT INTO `nationalities` VALUES (1, 'Afghan', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (2, 'Albanian', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (3, 'Algerian', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (4, 'American', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (5, 'Andorran', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (6, 'Angolan', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (7, 'Antiguans', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (8, 'Argentinean', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (9, 'Armenian', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (10, 'Australian', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (11, 'Austrian', '2022-06-17 00:38:09', '2022-06-17 00:38:09');
INSERT INTO `nationalities` VALUES (12, 'Azerbaijani', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (13, 'Bahamian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (14, 'Bahraini', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (15, 'Bangladeshi', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (16, 'Barbadian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (17, 'Barbudans', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (18, 'Batswana', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (19, 'Belarusian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (20, 'Belgian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (21, 'Belizean', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (22, 'Beninese', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (23, 'Bhutanese', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (24, 'Bolivian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (25, 'Bosnian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (26, 'Brazilian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (27, 'British', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (28, 'Bruneian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (29, 'Bulgarian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (30, 'Burkinabe', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (31, 'Burmese', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (32, 'Burundian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (33, 'Cambodian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (34, 'Cameroonian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (35, 'Canadian', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (36, 'Cape Verdean', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (37, 'Central African', '2022-06-17 00:38:10', '2022-06-17 00:38:10');
INSERT INTO `nationalities` VALUES (38, 'Chadian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (39, 'Chilean', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (40, 'Chinese', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (41, 'Colombian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (42, 'Comoran', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (43, 'Congolese', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (44, 'Costa Rican', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (45, 'Croatian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (46, 'Cuban', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (47, 'Cypriot', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (48, 'Czech', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (49, 'Danish', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (50, 'Djibouti', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (51, 'Dominican', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (52, 'Dutch', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (53, 'East Timorese', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (54, 'Ecuadorean', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (55, 'Egyptian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (56, 'Emirian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (57, 'Equatorial Guinean', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (58, 'Eritrean', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (59, 'Estonian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (60, 'Ethiopian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (61, 'Fijian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (62, 'Filipino', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (63, 'Finnish', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (64, 'French', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (65, 'Gabonese', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (66, 'Gambian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (67, 'Georgian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (68, 'German', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (69, 'Ghanaian', '2022-06-17 00:38:11', '2022-06-17 00:38:11');
INSERT INTO `nationalities` VALUES (70, 'Greek', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (71, 'Grenadian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (72, 'Guatemalan', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (73, 'Guinea-Bissauan', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (74, 'Guinean', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (75, 'Guyanese', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (76, 'Haitian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (77, 'Herzegovinian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (78, 'Honduran', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (79, 'Hungarian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (80, 'I-Kiribati', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (81, 'Icelander', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (82, 'Indian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (83, 'Indonesian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (84, 'Iranian', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (85, 'Iraqi', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (86, 'Irish', '2022-06-17 00:38:12', '2022-06-17 00:38:12');
INSERT INTO `nationalities` VALUES (87, 'Israeli', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (88, 'Italian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (89, 'Ivorian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (90, 'Jamaican', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (91, 'Japanese', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (92, 'Jordanian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (93, 'Kazakhstani', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (94, 'Kenyan', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (95, 'Kittian and Nevisian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (96, 'Kuwaiti', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (97, 'Kyrgyz', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (98, 'Laotian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (99, 'Latvian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (100, 'Lebanese', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (101, 'Liberian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (102, 'Libyan', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (103, 'Liechtensteiner', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (104, 'Lithuanian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (105, 'Luxembourger', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (106, 'Macedonian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (107, 'Malagasy', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (108, 'Malawian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (109, 'Malaysian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (110, 'Maldivan', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (111, 'Malian', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (112, 'Maltese', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (113, 'Marshallese', '2022-06-17 00:38:13', '2022-06-17 00:38:13');
INSERT INTO `nationalities` VALUES (114, 'Mauritanian', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (115, 'Mauritian', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (116, 'Mexican', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (117, 'Micronesian', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (118, 'Moldovan', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (119, 'Monacan', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (120, 'Mongolian', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (121, 'Moroccan', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (122, 'Mosotho', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (123, 'Motswana', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (124, 'Mozambican', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (125, 'Namibian', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (126, 'Nauruan', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (127, 'Nepalese', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (128, 'New Zealander', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (129, 'Nicaraguan', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (130, 'Nigerian', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (131, 'Nigerien', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (132, 'North Korean', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (133, 'Northern Irish', '2022-06-17 00:38:14', '2022-06-17 00:38:14');
INSERT INTO `nationalities` VALUES (134, 'Norwegian', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (135, 'Omani', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (136, 'Pakistani', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (137, 'Palauan', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (138, 'Panamanian', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (139, 'Papua New Guinean', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (140, 'Paraguayan', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (141, 'Peruvian', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (142, 'Polish', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (143, 'Portuguese', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (144, 'Qatari', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (145, 'Romanian', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (146, 'Russian', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (147, 'Rwandan', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (148, 'Saint Lucian', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (149, 'Salvadoran', '2022-06-17 00:38:15', '2022-06-17 00:38:15');
INSERT INTO `nationalities` VALUES (150, 'Samoan', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (151, 'San Marinese', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (152, 'Sao Tomean', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (153, 'Saudi', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (154, 'Scottish', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (155, 'Senegalese', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (156, 'Serbian', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (157, 'Seychellois', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (158, 'Sierra Leonean', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (159, 'Singaporean', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (160, 'Slovakian', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (161, 'Slovenian', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (162, 'Solomon Islander', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (163, 'Somali', '2022-06-17 00:38:16', '2022-06-17 00:38:16');
INSERT INTO `nationalities` VALUES (164, 'South African', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (165, 'South Korean', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (166, 'Spanish', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (167, 'Sri Lankan', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (168, 'Sudanese', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (169, 'Surinamer', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (170, 'Swazi', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (171, 'Swedish', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (172, 'Swiss', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (173, 'Syrian', '2022-06-17 00:38:17', '2022-06-17 00:38:17');
INSERT INTO `nationalities` VALUES (174, 'Taiwanese', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (175, 'Tajik', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (176, 'Tanzanian', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (177, 'Thai', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (178, 'Togolese', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (179, 'Tongan', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (180, 'Trinidadian/Tobagonian', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (181, 'Tunisian', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (182, 'Turkish', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (183, 'Tuvaluan', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (184, 'Ugandan', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (185, 'Ukrainian', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (186, 'Uruguayan', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (187, 'Uzbekistani', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (188, 'Venezuelan', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (189, 'Vietnamese', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (190, 'Welsh', '2022-06-17 00:38:18', '2022-06-17 00:38:18');
INSERT INTO `nationalities` VALUES (191, 'Yemenite', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `nationalities` VALUES (192, 'Zambian', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `nationalities` VALUES (193, 'Zimbabwean', '2022-06-17 00:38:19', '2022-06-17 00:38:19');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
INSERT INTO `password_resets` VALUES ('cj@cj.com', '$2y$10$dx/vso7rGF5uqqgwOEf23ei/XQ8FzYNkYzbLrfkDQm4avyjKR6.BO', '2022-10-11 13:37:10');

-- ----------------------------
-- Table structure for payment_records
-- ----------------------------
DROP TABLE IF EXISTS `payment_records`;
CREATE TABLE `payment_records`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `ref_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amt_paid` int(11) NULL DEFAULT NULL,
  `balance` int(11) NULL DEFAULT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT 0,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `payment_records_ref_no_unique`(`ref_no`) USING BTREE,
  INDEX `payment_records_payment_id_foreign`(`payment_id`) USING BTREE,
  INDEX `payment_records_student_id_foreign`(`student_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `ref_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `my_class_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `payments_ref_no_unique`(`ref_no`) USING BTREE,
  INDEX `payments_my_class_id_foreign`(`my_class_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for pins
-- ----------------------------
DROP TABLE IF EXISTS `pins`;
CREATE TABLE `pins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `times_used` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `student_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `pins_code_unique`(`code`) USING BTREE,
  INDEX `pins_user_id_foreign`(`user_id`) USING BTREE,
  INDEX `pins_student_id_foreign`(`student_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for promotions
-- ----------------------------
DROP TABLE IF EXISTS `promotions`;
CREATE TABLE `promotions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` int(10) UNSIGNED NOT NULL,
  `from_class` int(10) UNSIGNED NOT NULL,
  `from_section` int(10) UNSIGNED NOT NULL,
  `to_class` int(10) UNSIGNED NOT NULL,
  `to_section` int(10) UNSIGNED NOT NULL,
  `grad` tinyint(4) NOT NULL,
  `from_session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_session` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `promotions_student_id_foreign`(`student_id`) USING BTREE,
  INDEX `promotions_from_class_foreign`(`from_class`) USING BTREE,
  INDEX `promotions_from_section_foreign`(`from_section`) USING BTREE,
  INDEX `promotions_to_section_foreign`(`to_section`) USING BTREE,
  INDEX `promotions_to_class_foreign`(`to_class`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for receipts
-- ----------------------------
DROP TABLE IF EXISTS `receipts`;
CREATE TABLE `receipts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pr_id` int(10) UNSIGNED NOT NULL,
  `amt_paid` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `receipts_pr_id_foreign`(`pr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for report3
-- ----------------------------
DROP TABLE IF EXISTS `report3`;
CREATE TABLE `report3`  (
  `ComputerDepartmentID` int(11) NULL DEFAULT NULL,
  `ComputerType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `EXPIRATION` date NULL DEFAULT NULL,
  `CerNumber` int(11) NULL DEFAULT NULL,
  `CustomerNumber` int(11) NULL DEFAULT NULL,
  `Office` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for residences
-- ----------------------------
DROP TABLE IF EXISTS `residences`;
CREATE TABLE `residences`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of residences
-- ----------------------------
INSERT INTO `residences` VALUES (19, 'hi', '2022-06-28 03:27:33', '2022-06-28 03:27:33');
INSERT INTO `residences` VALUES (20, 'who1', '2022-06-28 03:27:33', '2022-06-28 03:27:33');
INSERT INTO `residences` VALUES (21, 'who4', '2022-06-28 03:27:33', '2022-06-28 03:27:33');
INSERT INTO `residences` VALUES (22, 'woh', '2022-06-28 03:27:33', '2022-06-28 03:27:33');
INSERT INTO `residences` VALUES (23, 'res1', '2022-06-28 03:27:33', '2022-06-28 03:27:33');

-- ----------------------------
-- Table structure for schools
-- ----------------------------
DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `head_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `title_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `hod_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `postal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `status_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `schools_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sections
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_class_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `sections_name_my_class_id_unique`(`name`, `my_class_id`) USING BTREE,
  INDEX `sections_my_class_id_foreign`(`my_class_id`) USING BTREE,
  INDEX `sections_teacher_id_foreign`(`teacher_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sections
-- ----------------------------
INSERT INTO `sections` VALUES (20, 'Paper1', 50, 3, 0, '2022-10-03 03:24:53', '2022-10-03 03:24:53');
INSERT INTO `sections` VALUES (21, 'Paper2', 50, 3, 0, '2022-10-03 03:32:24', '2022-10-03 03:32:24');
INSERT INTO `sections` VALUES (22, 'Paper3', 50, 2, 0, '2022-11-17 06:13:41', '2022-11-17 06:13:41');

-- ----------------------------
-- Table structure for settings
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO `settings` VALUES (1, 'current_session', '2018-2019', NULL, '2022-12-21 07:24:05');
INSERT INTO `settings` VALUES (2, 'system_title', 'CJIA', NULL, '2022-12-21 07:24:05');
INSERT INTO `settings` VALUES (3, 'system_name', 'School Management System', NULL, '2022-12-21 07:24:05');
INSERT INTO `settings` VALUES (4, 'term_ends', '07/10/2018', NULL, '2022-12-21 07:24:06');
INSERT INTO `settings` VALUES (5, 'term_begins', '7/10/2018', NULL, '2022-12-21 07:24:06');
INSERT INTO `settings` VALUES (6, 'phone', '0123456789', NULL, '2022-12-21 07:24:05');
INSERT INTO `settings` VALUES (7, 'address', '18B North Central Park, Behind Central Square Tourist Center', NULL, '2022-12-21 07:24:06');
INSERT INTO `settings` VALUES (8, 'system_email', 'cjacademy@cj.com', NULL, '2022-12-21 07:24:06');
INSERT INTO `settings` VALUES (9, 'alt_email', '', NULL, NULL);
INSERT INTO `settings` VALUES (10, 'email_host', '', NULL, NULL);
INSERT INTO `settings` VALUES (11, 'email_pass', '', NULL, NULL);
INSERT INTO `settings` VALUES (12, 'lock_exam', '0', NULL, '2022-12-21 07:24:06');
INSERT INTO `settings` VALUES (13, 'logo', 'http://127.0.0.1:8000/storage/uploads/logo.png', NULL, '2022-12-21 07:24:06');
INSERT INTO `settings` VALUES (14, 'next_term_fees_j', '20000', NULL, '2022-06-17 13:21:49');
INSERT INTO `settings` VALUES (15, 'next_term_fees_pn', '25000', NULL, '2022-06-17 13:21:49');
INSERT INTO `settings` VALUES (16, 'next_term_fees_p', '25000', NULL, '2022-06-17 13:21:49');
INSERT INTO `settings` VALUES (17, 'next_term_fees_n', '25600', NULL, '2022-06-17 13:21:49');
INSERT INTO `settings` VALUES (18, 'next_term_fees_s', '15600', NULL, '2022-06-17 13:21:49');
INSERT INTO `settings` VALUES (19, 'next_term_fees_c', '1600', NULL, '2022-06-17 13:21:49');

-- ----------------------------
-- Table structure for sitecomments
-- ----------------------------
DROP TABLE IF EXISTS `sitecomments`;
CREATE TABLE `sitecomments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sitecomments
-- ----------------------------
INSERT INTO `sitecomments` VALUES (1, 1, 'qwerasdf', '2022-07-20 20:54:32', '2022-07-20 20:54:32');
INSERT INTO `sitecomments` VALUES (2, 1, 'qwerasdf', '2022-07-20 20:56:21', '2022-07-20 20:56:21');
INSERT INTO `sitecomments` VALUES (3, 1, 'qwerasdf', '2022-07-20 20:56:45', '2022-07-20 20:56:45');
INSERT INTO `sitecomments` VALUES (4, 1, 'qwerasdf', '2022-07-20 20:56:47', '2022-07-20 20:56:47');
INSERT INTO `sitecomments` VALUES (5, 1, 'qwerasdf', '2022-07-20 20:58:03', '2022-07-20 20:58:03');
INSERT INTO `sitecomments` VALUES (6, 1, 'qwerasdf', '2022-07-20 20:58:04', '2022-07-20 20:58:04');
INSERT INTO `sitecomments` VALUES (7, 1, 'qwerasdf', '2022-07-20 20:58:05', '2022-07-20 20:58:05');
INSERT INTO `sitecomments` VALUES (8, 1, 'qwerasdf', '2022-07-20 20:58:05', '2022-07-20 20:58:05');
INSERT INTO `sitecomments` VALUES (9, 1, 'qwerasdf', '2022-07-20 20:58:05', '2022-07-20 20:58:05');
INSERT INTO `sitecomments` VALUES (10, 1, 'qwerasdf', '2022-07-20 20:58:05', '2022-07-20 20:58:05');
INSERT INTO `sitecomments` VALUES (11, 1, 'qwerasdf', '2022-07-20 20:58:06', '2022-07-20 20:58:06');
INSERT INTO `sitecomments` VALUES (12, 1, 'qwerasdf', '2022-07-20 20:58:58', '2022-07-20 20:58:58');
INSERT INTO `sitecomments` VALUES (13, 1, 'qwerasdf', '2022-07-20 20:59:47', '2022-07-20 20:59:47');
INSERT INTO `sitecomments` VALUES (14, 1, 'I like this site.', '2022-07-20 21:02:20', '2022-07-20 21:02:20');

-- ----------------------------
-- Table structure for skills
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES (1, 'PUNCTUALITY', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (2, 'NEATNESS', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (3, 'HONESTY', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (4, 'RELIABILITY', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (5, 'RELATIONSHIP WITH OTHERS', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (6, 'POLITENESS', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (7, 'ALERTNESS', 'AF', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (8, 'HANDWRITING', 'PS', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (9, 'GAMES & SPORTS', 'PS', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (10, 'DRAWING & ARTS', 'PS', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (11, 'PAINTING', 'PS', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (12, 'CONSTRUCTION', 'PS', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (13, 'MUSICAL SKILLS', 'PS', NULL, NULL, NULL);
INSERT INTO `skills` VALUES (14, 'FLEXIBILITY', 'PS', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for staff_records
-- ----------------------------
DROP TABLE IF EXISTS `staff_records`;
CREATE TABLE `staff_records`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `emp_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `staff_records_code_unique`(`code`) USING BTREE,
  INDEX `staff_records_user_id_foreign`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of staff_records
-- ----------------------------
INSERT INTO `staff_records` VALUES (2, 121, 'H9OFUCxtcqUXU6gIg6JZ', NULL, '2022-07-24 10:32:10', '2023-01-09 07:50:27', '1');

-- ----------------------------
-- Table structure for states
-- ----------------------------
DROP TABLE IF EXISTS `states`;
CREATE TABLE `states`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of states
-- ----------------------------
INSERT INTO `states` VALUES (1, 'Abia', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `states` VALUES (2, 'Adamawa', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `states` VALUES (3, 'Akwa Ibom', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `states` VALUES (4, 'Anambra', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `states` VALUES (5, 'Bauchi', '2022-06-17 00:38:19', '2022-06-17 00:38:19');
INSERT INTO `states` VALUES (6, 'Bayelsa', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (7, 'Benue', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (8, 'Borno', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (9, 'Cross River', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (10, 'Delta', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (11, 'Ebonyi', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (12, 'Edo', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (13, 'Ekiti', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (14, 'Enugu', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (15, 'FCT', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (16, 'Gombe', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (17, 'Imo', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (18, 'Jigawa', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (19, 'Kaduna', '2022-06-17 00:38:20', '2022-06-17 00:38:20');
INSERT INTO `states` VALUES (20, 'Kano', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (21, 'Katsina', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (22, 'Kebbi', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (23, 'Kogi', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (24, 'Kwara', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (25, 'Lagos', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (26, 'Nasarawa', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (27, 'Niger', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (28, 'Ogun', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (29, 'Ondo', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (30, 'Osun', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (31, 'Oyo', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (32, 'Plateau', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (33, 'Rivers', '2022-06-17 00:38:21', '2022-06-17 00:38:21');
INSERT INTO `states` VALUES (34, 'Sokoto', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `states` VALUES (35, 'Taraba', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `states` VALUES (36, 'Yobe', '2022-06-17 00:38:22', '2022-06-17 00:38:22');
INSERT INTO `states` VALUES (37, 'Zamfara', '2022-06-17 00:38:22', '2022-06-17 00:38:22');

-- ----------------------------
-- Table structure for student_subjects
-- ----------------------------
DROP TABLE IF EXISTS `student_subjects`;
CREATE TABLE `student_subjects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_subject_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student_subjects
-- ----------------------------
INSERT INTO `student_subjects` VALUES (4, '12', '20', '2022-06-24 23:34:26', '2022-10-21 16:03:40');
INSERT INTO `student_subjects` VALUES (5, '13', '20', '2022-06-24 23:34:28', '2022-10-21 16:03:43');
INSERT INTO `student_subjects` VALUES (6, '14', '20', '2022-06-24 23:34:29', '2022-10-21 16:03:45');
INSERT INTO `student_subjects` VALUES (7, '15', '20', '2022-06-24 23:34:50', '2022-10-21 16:03:47');
INSERT INTO `student_subjects` VALUES (8, '16', '20', '2022-06-24 23:34:51', '2022-10-21 16:03:56');
INSERT INTO `student_subjects` VALUES (9, '17', '20', '2022-06-24 23:34:53', '2022-10-21 16:03:58');
INSERT INTO `student_subjects` VALUES (10, '23', '20', '2022-06-25 19:32:59', '2022-06-25 19:32:59');
INSERT INTO `student_subjects` VALUES (11, '20', '22', '2022-07-20 20:21:28', '2022-10-21 16:04:05');
INSERT INTO `student_subjects` VALUES (12, '21', '22', '2022-07-20 20:21:33', '2022-10-21 16:04:59');
INSERT INTO `student_subjects` VALUES (13, '22', '22', '2022-07-20 20:21:35', '2022-10-21 16:05:01');
INSERT INTO `student_subjects` VALUES (14, '92', '22', '2022-07-20 20:21:37', '2022-10-21 16:05:13');
INSERT INTO `student_subjects` VALUES (15, '94', '22', '2022-07-20 20:21:39', '2022-10-21 16:05:15');
INSERT INTO `student_subjects` VALUES (16, '95', '22', '2022-07-20 20:21:40', '2022-10-21 16:05:16');
INSERT INTO `student_subjects` VALUES (17, '12', '20', '2022-07-20 20:25:11', '2022-10-21 16:05:28');
INSERT INTO `student_subjects` VALUES (18, '115', '20', '2022-07-20 20:25:19', '2022-07-20 20:26:17');
INSERT INTO `student_subjects` VALUES (19, '13', '20', '2022-07-20 20:25:20', '2022-10-21 16:05:31');
INSERT INTO `student_subjects` VALUES (20, '14', '20', '2022-07-20 20:25:22', '2022-10-21 16:05:32');
INSERT INTO `student_subjects` VALUES (21, '15', '20', '2022-07-20 20:25:23', '2022-10-21 16:05:33');
INSERT INTO `student_subjects` VALUES (22, '16', '20', '2022-07-20 20:25:24', '2022-10-21 16:05:35');
INSERT INTO `student_subjects` VALUES (23, '17', '20', '2022-07-20 20:25:35', '2022-10-21 16:05:37');
INSERT INTO `student_subjects` VALUES (24, '23', '20', '2022-07-20 20:25:36', '2022-10-21 16:05:41');
INSERT INTO `student_subjects` VALUES (25, '20', '20', '2022-07-20 20:25:38', '2022-10-21 16:05:44');
INSERT INTO `student_subjects` VALUES (26, '21', '20', '2022-07-20 20:25:39', '2022-10-21 16:05:45');
INSERT INTO `student_subjects` VALUES (27, '22', '20', '2022-07-20 20:25:43', '2022-10-21 16:05:46');
INSERT INTO `student_subjects` VALUES (28, '92', '22', '2022-07-20 20:26:52', '2022-10-21 16:05:48');
INSERT INTO `student_subjects` VALUES (29, '94', '22', '2022-07-20 20:26:53', '2022-10-21 16:05:49');
INSERT INTO `student_subjects` VALUES (30, '95', '22', '2022-07-20 20:26:54', '2022-10-21 16:05:50');
INSERT INTO `student_subjects` VALUES (31, '12', '22', '2022-07-20 20:26:54', '2022-10-21 16:05:53');
INSERT INTO `student_subjects` VALUES (32, '115', '22', '2022-07-20 20:26:55', '2022-10-21 16:05:57');
INSERT INTO `student_subjects` VALUES (33, '12', '22', '2022-07-20 20:26:55', '2022-10-21 16:05:59');

-- ----------------------------
-- Table structure for student_temps
-- ----------------------------
DROP TABLE IF EXISTS `student_temps`;
CREATE TABLE `student_temps`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adm_no` int(11) NOT NULL,
  `form` int(11) NOT NULL,
  `stream` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `upi` int(11) NOT NULL,
  `dob` date NOT NULL,
  `kcpe` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT 0,
  `my_class_id` int(11) NULL DEFAULT 0,
  `adm_no` int(11) NULL DEFAULT 0,
  `upi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kcpe` decimal(11, 0) NULL DEFAULT 0,
  `destination_class_id` int(11) NULL DEFAULT 0,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 141 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES (13, 14, 51, 1012, NULL, 0, 0, '2022-06-25 01:26:45', '2022-06-27 02:11:34');
INSERT INTO `students` VALUES (14, 15, 51, 1013, NULL, 0, 0, '2022-06-25 01:26:45', '2022-06-27 02:11:34');
INSERT INTO `students` VALUES (15, 16, 51, 1014, NULL, 0, 0, '2022-06-25 01:26:46', '2022-06-25 01:27:16');
INSERT INTO `students` VALUES (16, 17, 51, 1015, NULL, 0, 0, '2022-06-25 01:26:47', '2022-06-25 01:27:18');
INSERT INTO `students` VALUES (19, 20, 51, 1018, NULL, 0, 0, '2022-06-25 01:26:49', '2022-06-25 01:27:23');
INSERT INTO `students` VALUES (20, 21, 51, 1019, NULL, 0, 0, '2022-06-25 01:27:55', '2022-06-25 01:28:18');
INSERT INTO `students` VALUES (24, 92, 1, 1059, NULL, 0, 0, '2022-06-27 01:11:46', '2022-06-27 01:11:46');
INSERT INTO `students` VALUES (102, 94, 1, 1061, NULL, 0, 0, '2022-06-29 14:12:42', '2022-06-29 14:12:42');
INSERT INTO `students` VALUES (103, 95, 1, 1062, NULL, 0, 0, '2022-06-29 14:12:42', '2022-06-29 14:12:42');
INSERT INTO `students` VALUES (123, 115, 50, 1110, NULL, 0, 0, '2022-06-30 19:42:56', '2022-06-30 19:42:56');
INSERT INTO `students` VALUES (126, 152, 50, 1000, NULL, 0, 0, '2022-11-04 07:09:51', '2022-11-04 07:09:51');
INSERT INTO `students` VALUES (127, 153, 50, 1189, NULL, 0, 0, '2022-11-07 06:13:39', '2022-11-07 06:13:39');
INSERT INTO `students` VALUES (128, 155, 50, 3526, NULL, 0, 0, '2022-11-07 06:15:05', '2022-11-07 06:15:05');
INSERT INTO `students` VALUES (129, 156, 50, 567, NULL, 0, 0, '2022-11-07 06:15:24', '2022-11-07 06:15:24');
INSERT INTO `students` VALUES (130, 157, 52, 657, NULL, 0, 0, '2022-11-07 06:15:55', '2022-11-07 06:15:55');
INSERT INTO `students` VALUES (131, 158, 52, 897, NULL, 0, 0, '2022-11-07 06:16:18', '2022-11-07 06:16:18');
INSERT INTO `students` VALUES (132, 159, 52, 7485, NULL, 0, 0, '2022-11-07 06:16:38', '2022-11-07 06:16:38');
INSERT INTO `students` VALUES (133, 160, 55, 3245, NULL, 0, 0, '2022-11-07 07:20:05', '2022-11-07 07:20:05');
INSERT INTO `students` VALUES (134, 161, 55, 898, NULL, 0, 0, '2022-11-07 07:20:30', '2022-11-07 07:20:30');
INSERT INTO `students` VALUES (135, 162, 55, 4546, NULL, 0, 0, '2022-11-07 07:20:55', '2022-11-07 07:20:55');
INSERT INTO `students` VALUES (136, 163, 50, 662, NULL, 0, 0, '2022-11-07 07:43:13', '2022-11-07 07:43:13');
INSERT INTO `students` VALUES (137, 164, 50, 904, NULL, 0, 0, '2022-11-07 07:43:41', '2022-11-07 07:43:41');
INSERT INTO `students` VALUES (138, 165, 50, 687, NULL, 0, 0, '2022-11-07 07:44:02', '2022-11-07 07:44:02');
INSERT INTO `students` VALUES (139, 166, 50, 761, NULL, 0, 0, '2022-11-07 07:44:25', '2022-11-07 07:44:25');
INSERT INTO `students` VALUES (140, 167, 50, 606, NULL, 0, 0, '2022-11-07 07:44:54', '2022-11-07 07:44:54');

-- ----------------------------
-- Table structure for subject_teachers
-- ----------------------------
DROP TABLE IF EXISTS `subject_teachers`;
CREATE TABLE `subject_teachers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for subject_types
-- ----------------------------
DROP TABLE IF EXISTS `subject_types`;
CREATE TABLE `subject_types`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subject_types
-- ----------------------------
INSERT INTO `subject_types` VALUES (1, 'Language', '2022-06-17 13:53:06', '2022-06-17 13:53:06');
INSERT INTO `subject_types` VALUES (2, 'Mathematics', '2022-06-17 13:53:16', '2022-06-17 13:53:16');
INSERT INTO `subject_types` VALUES (3, 'Sciences', '2022-06-17 13:53:21', '2022-06-17 13:53:21');
INSERT INTO `subject_types` VALUES (4, 'Humanities', '2022-06-17 13:53:28', '2022-06-17 13:53:28');
INSERT INTO `subject_types` VALUES (5, 'Technicals', '2022-06-17 13:53:35', '2022-06-17 13:53:35');
INSERT INTO `subject_types` VALUES (6, 'Optionals', '2022-06-17 13:53:46', '2022-06-17 13:53:46');

-- ----------------------------
-- Table structure for subjects
-- ----------------------------
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_type_id` int(50) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `out_x` int(11) NOT NULL,
  `out_y` int(11) NOT NULL,
  `out_z` int(11) NOT NULL,
  `con_x` int(11) NOT NULL,
  `con_y` int(11) NOT NULL,
  `con_z` int(11) NOT NULL,
  `status_x` tinyint(1) NOT NULL,
  `status_y` tinyint(1) NOT NULL,
  `status_z` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subjects
-- ----------------------------
INSERT INTO `subjects` VALUES (5, 1, 'English', '2022-06-17 13:49:41', '2022-12-28 18:31:00', 50, 50, 0, 50, 50, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (6, 1, 'Kiswahili', '2022-06-17 13:49:20', '2022-06-24 22:52:04', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (7, 2, 'Mathematics', '2022-06-17 13:49:24', '2022-06-24 22:52:03', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (8, 3, 'Chemistry', '2022-06-17 13:49:30', '2022-12-28 18:30:59', 10, 10, 10, 10, 10, 10, 0, 0, 0);
INSERT INTO `subjects` VALUES (9, 3, 'Physics', '2022-06-17 13:49:36', '2022-06-24 22:52:02', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (10, 3, 'Biology', '2022-06-24 22:45:36', '2022-06-24 22:45:58', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (11, 4, 'Histofy and Government', '2022-06-24 22:46:18', '2022-06-24 22:46:18', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (12, 4, 'Geography', '2022-06-24 22:46:29', '2022-06-24 22:46:32', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (13, 4, 'C.R.E', '2022-06-24 22:46:42', '2022-06-24 22:46:42', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (14, 4, 'I.R.E', '2022-06-24 22:46:50', '2022-06-24 22:46:50', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (15, 4, 'H.R.E', '2022-06-24 22:46:57', '2022-06-24 22:46:57', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (16, 5, 'Home Science', '2022-06-24 22:47:33', '2022-06-24 22:47:33', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (17, 5, 'Art and Design', '2022-06-24 22:47:41', '2022-12-28 18:30:59', 1, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (18, 5, 'Woodwork', '2022-06-24 22:48:13', '2022-06-24 22:48:13', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (19, 5, 'Metalwork', '2022-06-24 22:48:20', '2022-06-24 22:49:21', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (20, 5, 'Building Construction', '2022-06-24 22:48:29', '2022-06-24 22:49:20', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (21, 5, 'Power Mechanics', '2022-06-24 22:48:40', '2022-06-24 22:49:20', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (22, 5, 'Electricity', '2022-06-24 22:48:45', '2022-06-24 22:49:19', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (23, 5, 'Drawing andDesign', '2022-06-24 22:48:50', '2022-06-24 22:49:19', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (24, 5, 'Aviation', '2022-06-24 22:48:54', '2022-12-28 18:30:59', 100, 100, 0, 50, 50, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (25, 5, 'Computer Studies', '2022-06-24 22:49:00', '2022-06-24 22:49:18', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (26, 5, 'Music', '2022-06-24 22:49:03', '2022-06-24 22:49:18', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (27, 5, 'Braille', '2022-06-24 22:49:07', '2022-06-24 22:49:17', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (28, 5, 'Business Studies', '2022-06-24 22:49:14', '2022-06-24 22:49:17', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (29, 6, 'Mathematics - Option B', '2022-06-24 22:49:42', '2022-06-24 22:51:47', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (30, 6, 'Fasihi', '2022-06-24 22:49:48', '2022-12-28 18:31:00', 10, 10, 10, 10, 10, 10, 0, 0, 0);
INSERT INTO `subjects` VALUES (31, 6, 'Literature', '2022-06-24 22:49:52', '2022-06-24 22:51:46', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (32, 6, 'Bilogy for the Blind', '2022-06-24 22:49:59', '2022-12-28 18:30:59', 100, 100, 0, 100, 100, 100, 0, 0, 0);
INSERT INTO `subjects` VALUES (33, 6, 'General Science', '2022-06-24 22:50:07', '2022-06-24 22:51:45', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (34, 6, 'French', '2022-06-24 22:50:13', '2022-06-24 22:51:44', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (35, 6, 'German', '2022-06-24 22:50:18', '2022-06-24 22:51:44', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (36, 6, 'Kenya Sign Language', '2022-06-24 22:50:32', '2022-06-24 22:51:44', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (37, 6, 'Arabic', '2022-06-24 22:50:35', '2022-12-28 18:30:58', 100, 90, 100, 100, 90, 100, 0, 0, 0);
INSERT INTO `subjects` VALUES (38, 6, 'Mandrin', '2022-06-24 22:50:39', '2022-06-24 22:51:43', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (39, 6, 'Computer Literacy', '2022-06-24 22:50:47', '2022-12-28 18:31:00', 100, 100, 0, 50, 50, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (40, 6, 'Adapted Home Science', '2022-06-24 22:50:55', '2022-12-28 18:30:58', 10, 10, 10, 9, 10, 9, 0, 0, 0);
INSERT INTO `subjects` VALUES (41, 6, 'Adapted Agriculture', '2022-06-24 22:51:01', '2022-12-28 18:30:56', 50, 50, 0, 50, 50, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (42, 6, 'P.E', '2022-06-24 22:51:04', '2022-06-24 22:51:41', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (43, 6, 'Library', '2022-06-24 22:51:24', '2022-06-24 22:51:40', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (44, 6, 'Postoral', '2022-06-24 22:51:30', '2022-06-24 22:51:40', 0, 0, 0, 0, 0, 0, 0, 0, 0);
INSERT INTO `subjects` VALUES (45, 6, 'Life Skills', '2022-06-24 22:51:36', '2022-06-24 22:51:39', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- ----------------------------
-- Table structure for teachers
-- ----------------------------
DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '0',
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of teachers
-- ----------------------------
INSERT INTO `teachers` VALUES (2, 51, '1', '2022-06-24 22:23:12', '2022-06-24 22:24:03');
INSERT INTO `teachers` VALUES (3, 52, '1', '2022-06-24 22:23:13', '2022-06-24 22:24:03');
INSERT INTO `teachers` VALUES (4, 53, '1', '2022-06-24 22:23:15', '2022-06-24 22:24:03');
INSERT INTO `teachers` VALUES (5, 54, '1', '2022-06-24 22:23:16', '2022-06-24 22:24:04');
INSERT INTO `teachers` VALUES (6, 55, '1', '2022-06-24 22:23:17', '2022-06-24 22:24:04');
INSERT INTO `teachers` VALUES (7, 56, '1', '2022-06-24 22:23:18', '2022-06-24 22:24:06');
INSERT INTO `teachers` VALUES (8, 57, '2', '2022-06-24 22:23:18', '2022-06-24 22:24:06');
INSERT INTO `teachers` VALUES (9, 58, '2', '2022-06-24 22:23:19', '2022-06-24 22:24:07');
INSERT INTO `teachers` VALUES (11, 60, '2', '2022-06-24 22:23:22', '2022-06-24 22:24:08');
INSERT INTO `teachers` VALUES (13, 62, '3', '2022-06-24 22:23:27', '2022-06-24 22:24:09');
INSERT INTO `teachers` VALUES (14, 63, '3', '2022-06-24 22:23:28', '2022-06-24 22:24:19');
INSERT INTO `teachers` VALUES (15, 64, '3', '2022-06-24 22:23:29', '2022-06-24 22:24:10');
INSERT INTO `teachers` VALUES (16, 90, '1', '2022-06-24 13:25:33', '2022-06-24 13:25:33');
INSERT INTO `teachers` VALUES (31, 147, '1', '2022-09-30 05:22:50', '2022-09-30 05:22:50');
INSERT INTO `teachers` VALUES (32, 148, '1,2', '2022-10-04 18:09:51', '2023-01-09 08:47:34');
INSERT INTO `teachers` VALUES (33, 149, '1', '2022-10-04 19:06:13', '2022-10-04 19:06:13');
INSERT INTO `teachers` VALUES (34, 150, '1', '2022-10-11 18:35:50', '2022-10-11 18:35:50');
INSERT INTO `teachers` VALUES (53, 151, '1', '2022-10-14 06:25:13', '2022-10-14 05:40:57');
INSERT INTO `teachers` VALUES (55, 168, '1', '2023-01-05 11:38:06', '2023-01-05 11:38:06');
INSERT INTO `teachers` VALUES (56, 169, '1', '2023-01-05 11:52:26', '2023-01-05 11:52:26');
INSERT INTO `teachers` VALUES (58, 175, '1,2', '2023-01-09 08:48:11', '2023-01-09 08:48:11');

-- ----------------------------
-- Table structure for test_excels
-- ----------------------------
DROP TABLE IF EXISTS `test_excels`;
CREATE TABLE `test_excels`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 99 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of test_excels
-- ----------------------------
INSERT INTO `test_excels` VALUES (77, 1, 'Creche', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (78, 2, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (79, 3, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (80, 4, 'Creche', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (81, 5, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (82, 6, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (83, 7, 'Creche', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (84, 8, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (85, 9, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (86, 10, 'Creche', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (87, 11, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (88, 12, 'Junior Secondary', '2022-06-28 13:40:28', '2022-06-28 13:40:28');
INSERT INTO `test_excels` VALUES (89, 1, 'a', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (90, 2, 'b', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (91, 3, 'c', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (92, 4, 'd', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (93, 5, 'e', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (94, 6, 'f', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (95, 7, 'g', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (96, 8, 'h', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (97, 9, 'i', '2022-06-29 13:08:49', '2022-06-29 13:08:49');
INSERT INTO `test_excels` VALUES (98, 10, 'j', '2022-06-29 13:08:49', '2022-06-29 13:08:49');

-- ----------------------------
-- Table structure for time_slots
-- ----------------------------
DROP TABLE IF EXISTS `time_slots`;
CREATE TABLE `time_slots`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ttr_id` int(10) UNSIGNED NOT NULL,
  `hour_from` tinyint(4) NOT NULL,
  `min_from` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meridian_from` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hour_to` tinyint(4) NOT NULL,
  `min_to` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meridian_to` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_from` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_to` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp_from` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp_to` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `time_slots_timestamp_from_timestamp_to_ttr_id_unique`(`timestamp_from`, `timestamp_to`, `ttr_id`) USING BTREE,
  INDEX `time_slots_ttr_id_foreign`(`ttr_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for time_table_records
-- ----------------------------
DROP TABLE IF EXISTS `time_table_records`;
CREATE TABLE `time_table_records`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `my_class_id` int(10) UNSIGNED NOT NULL,
  `exam_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `year` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `time_table_records_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `time_table_records_my_class_id_exam_id_year_unique`(`my_class_id`, `exam_id`, `year`) USING BTREE,
  INDEX `time_table_records_exam_id_foreign`(`exam_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for time_tables
-- ----------------------------
DROP TABLE IF EXISTS `time_tables`;
CREATE TABLE `time_tables`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ttr_id` int(10) UNSIGNED NOT NULL,
  `ts_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `exam_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `timestamp_from` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp_to` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `day_num` tinyint(4) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `time_tables_ttr_id_ts_id_day_unique`(`ttr_id`, `ts_id`, `day`) USING BTREE,
  UNIQUE INDEX `time_tables_ttr_id_ts_id_exam_date_unique`(`ttr_id`, `ts_id`, `exam_date`) USING BTREE,
  INDEX `time_tables_ts_id_foreign`(`ts_id`) USING BTREE,
  INDEX `time_tables_subject_id_foreign`(`subject_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for user_types
-- ----------------------------
DROP TABLE IF EXISTS `user_types`;
CREATE TABLE `user_types`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO `user_types` VALUES (1, 'staff', 'Staff', '5', NULL, NULL);
INSERT INTO `user_types` VALUES (2, 'student', 'Student', '4', NULL, NULL);
INSERT INTO `user_types` VALUES (3, 'teacher', 'Teacher', '3', NULL, NULL);
INSERT INTO `user_types` VALUES (4, 'admin', 'Admin', '2', NULL, NULL);
INSERT INTO `user_types` VALUES (5, 'super_admin', 'Super Admin', '1', NULL, NULL);
INSERT INTO `user_types` VALUES (6, 'bom/pa', 'BOM/PA', '6', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT 1,
  `dob` int(11) NULL DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `sign` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `photo_by` enum('admission_number','index_number') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admission_number',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `national_id_no` int(255) NULL DEFAULT NULL,
  `tsc_no` int(255) NULL DEFAULT NULL,
  `bg_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `state_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `lga_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `nal_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `school_short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `school_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `school_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `school_head_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `school_title_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `school_hod_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `school_postal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `school_gender_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `school_status_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `school_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `state` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_code_unique`(`code`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE,
  UNIQUE INDEX `users_school_email_unique`(`school_email`) USING BTREE,
  INDEX `users_state_id_foreign`(`state_id`) USING BTREE,
  INDEX `users_lga_id_foreign`(`lga_id`) USING BTREE,
  INDEX `users_bg_id_foreign`(`bg_id`) USING BTREE,
  INDEX `users_nal_id_foreign`(`nal_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 176 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'CJ Inspired', 'cj@cj.com', 'gzsvL', 5, NULL, 'male', 'user.png', '', 'admission_number', '+254203570012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ftKx60gZMnFAeQv47XD1auuEAwr9Cxxe2TwX1Dfd42xxqnpYXtn.u', 'y5Lo1r4ZBeZBlc8QnPf85BF85kqWnvZwKRnUTdg4sxObcnVxosEzEvPYSksl', NULL, '2022-10-31 02:47:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (2, 'Admin KORA', 'admin@admin.com', 'LHAUKN3VEJ', 4, NULL, 'male', '1000.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$l32lzLBEJJqxi8MsMDcsquSWVFpZnSnBxMeEE021xaiPzk5oGXT3y', 'qCpD7jYiYuF2crwrIkZ9q32P3GhcDxyOrttlb3PRbSZBbsHuTaFEYdZOEKPz', NULL, '2022-07-04 21:21:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (3, 'Teacher Chike', 'teacher@teacher.com', 'GFOF7IWZSW', 3, NULL, 'male', '1001.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$q0BXwTlzEpn7gOzF8ZMFMesrnFGH1.eewvyFOV3Z0SwCKTKn4e.2O', 'd3ldakU127', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (4, 'Parent Kaba', 'parent@parent.com', 'IDMTBFJJKD', 2, NULL, 'male', '1002.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$q0BXwTlzEpn7gOzF8ZMFMesrnFGH1.eewvyFOV3Z0SwCKTKn4e.2O', 'cQ40MnofnFmRYJZfgVJFXD523nQpP1djaoHzvZgHBSIOWeeM3gMf5o4Swrwq', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (5, 'Accountant Jeff', 'accountant@accountant.com', 'TYQLFQOIGR', 1, NULL, 'male', '1003.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$q0BXwTlzEpn7gOzF8ZMFMesrnFGH1.eewvyFOV3Z0SwCKTKn4e.2O', 'FBKHE4zxRNIeNCG8aHi4AM3M7mFHH1ePGpt3o8EyRTz8TDRouvElbxBS8gzM', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (6, 'Admin 1', 'admin1@admin.com', 'BX9VUM0JYA', 2, NULL, 'male', '1004.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$68ZNnd1ezPdbBWH8AQNGV.jMFoflLX7Od3GIW9/Js8NVZ1024iBf.', '2iCotpcUzZ', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (7, 'Teacher 1', 'teacher1@teacher.com', 'JQS2ZCYWC3', 2, NULL, 'male', '1005.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$LUBkPCmt5vSYSIbbFij//ecwJ43Q0qJ0fDB/QtnYoK3CyqY.05Br6', 'Vixsmg7pVr', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (8, 'Accountant 1', 'accountant1@accountant.com', 'HWKJJAHPAS', 2, NULL, 'female', '1006.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$wIoJqObddtwLqbojI/uFFuIdG4JFqNEJFGVxEq/RPRqvXVvj512A2', '8Ynkc5WNVT', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (9, 'Parent 1', 'parent1@parent.com', 'LTJHHC9YAZ', 2, NULL, 'male', '1007.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$e5Q8BaqPOgtZIOpIptdRGuVH3iYu20W6NWmoExBmaGaRE.FxW/bk.', 'ui8VHPlyZ0', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (10, 'Admin 2', 'admin2@admin.com', 'K8QLDRLERA', 2, NULL, 'female', '1008.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$xLZ6POMlEpE4O21iwZsHmOVidyg6aIiHxN4i1TbcXrT7QNILd.pDa', 'QqkW3HFDBK', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (11, 'Teacher 2', 'teacher2@teacher.com', '6I9ZILG2MK', 2, NULL, 'male', '1009.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$0oCZLrZFY6/3erJOPS3lweRB0AnsFK6AWrWnsTZLPgZ6xEqzGoSla', 'yHGsXJilqD', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (12, 'Accountant 2', 'accountant2@accountant.com', 'MIADAC4KZS', 2, NULL, 'female', '1010.jpg', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$m0I8uIC5SfjrqVWWYJjQyeszIvZAFNe9oY827s/j2ElZJol4pVzVy', 'fK2ReQ4dOj', NULL, '2022-07-07 05:52:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (13, 'Parent 2', 'parent2@parent.com', 'E1LNDJ2KPZ', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$hZVjTFiezV9NulCNu0vIiuJEwW3pZXdbcMy8xucbN6yk1xyMuI0KC', 'vebXZMf0Qf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (14, 'Admin 3', 'admin3@admin.com', '9HBUF9PRVC', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$mPcBbXWxgAVgRHK5ue8Dc.wzgWjiMvZID8N258TRW5HRDKKipqiUW', 'zGrSp5IMko', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (15, 'Teacher 3', 'teacher3@teacher.com', 'KIUYMUDVHT', 2, NULL, 'male', 'user.png', '', 'admission_number', '+254203570095', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IOaMJVovOLj4RfnmWt8RAObUyXjuxHbYM29.ARVGhRj7/pFyuaYyO', 'enns7EWgY3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (16, 'Accountant 3', 'accountant3@accountant.com', 'JSE2JLWII9', 2, NULL, 'male', 'user.png', '', 'admission_number', '+254729891801', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$cHS452dAF6mLl2IpyxbbRuIyIZ0euNUlF9rBZ7mr6LqowKjhznVhu', 'HQbmdzlToB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (17, 'Parent 3', 'parent3@parent.com', '0TJRMRQVLK', 2, NULL, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$XWDA6UzOyQ/CJ.W3fBwaduJDFETdcSw8OKvIEkgpSrkXtSKhuk30e', 'vWlsaPdyIF', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (18, 'Student CJ', 'student@student.com', '2ZE80JZYCL', 2, NULL, 'female', 'user.png', '', 'admission_number', '+2547152223003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$mhZKOx7QY.O9nzXqKZYls.AeY/SAHwGv4zIv3yPaePTfiOkctz1ou', 'tMtDTL7M2u', '2022-06-17 00:39:15', '2022-06-17 00:39:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (19, 'Esmeralda Bradtke', 'kody.green@example.com', 'YJ3VRIRN32', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$tzjAjuiSK5zND0Wd7gVEp.VAeS/C04MZksVr929o7Pku7UT3S2UPi', 'oar9yGsJ1c', '2022-06-17 00:39:16', '2022-06-17 00:39:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (20, 'Audreanne Weissnat', 'cormier.rebekah@example.net', 'OR5Q1KE1QC', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$tzjAjuiSK5zND0Wd7gVEp.VAeS/C04MZksVr929o7Pku7UT3S2UPi', 'EecwXxckII', '2022-06-17 00:39:16', '2022-06-17 00:39:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (21, 'Candace Kub', 'mateo86@example.org', 'R8GW9IMAVJ', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$tzjAjuiSK5zND0Wd7gVEp.VAeS/C04MZksVr929o7Pku7UT3S2UPi', 'rYyFupNjRH', '2022-06-17 00:39:16', '2022-06-17 00:39:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (22, 'Ephraim O\'Kon', 'oleffler@example.com', 'TIJ7J3WCEV', 2, NULL, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$BXbk3MrHoGmOm2h/fF9Viu1iGdlt9/aCmT9tpakK1hPmUQlNU3FB2', 'iXh0t32chC', '2022-06-17 00:39:17', '2022-06-17 00:39:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (23, 'Retha Bailey DVM', 'ureichert@example.net', 'AXI6QRYYGZ', 2, NULL, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$BXbk3MrHoGmOm2h/fF9Viu1iGdlt9/aCmT9tpakK1hPmUQlNU3FB2', '2Qv98rwbKC', '2022-06-17 00:39:17', '2022-06-17 00:39:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (24, 'Ayana Shields', 'zchristiansen@example.net', 'WXIED1A5T9', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$BXbk3MrHoGmOm2h/fF9Viu1iGdlt9/aCmT9tpakK1hPmUQlNU3FB2', '5MWfbhjQMW', '2022-06-17 00:39:17', '2022-06-17 00:39:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (25, 'Bobby Terry', 'marielle.herzog@example.com', '4BWOHAQLKJ', 2, NULL, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$r/VAckZm61fl0kOsakKpGu1Gvs6vq5SKCHiuKm9xghynmXqHQmiUu', 'vPO4rNu3Vg', '2022-06-17 00:39:18', '2022-06-17 00:39:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (26, 'Bobby Terry1', 'wisozk.angelita@example.net', 'K5IBTRYWNA', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$r/VAckZm61fl0kOsakKpGu1Gvs6vq5SKCHiuKm9xghynmXqHQmiUu', 'x3VMkFyA8j', '2022-06-17 00:39:18', '2022-06-17 00:39:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (27, 'Bobby Terry4', 'kassulke.peggie@example.com', '5PTU1N49IC', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$r/VAckZm61fl0kOsakKpGu1Gvs6vq5SKCHiuKm9xghynmXqHQmiUu', 'cO6AHkBju2', '2022-06-17 00:39:19', '2022-06-17 00:39:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (28, 'Dr. Dion Mosciski', 'xfay@example.org', 'HFGKC9692M', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$JsA5vDtQB8Hk9a873T9H8.Hss5WQ7wu9DKWL3E5vaXnwy746J7XNG', 'xFSx2Sh9cD', '2022-06-17 00:39:19', '2022-06-17 00:39:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (29, 'Omari Stanton IV', 'qprohaska@example.org', 'GZQQRLY6DR', 3, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$JsA5vDtQB8Hk9a873T9H8.Hss5WQ7wu9DKWL3E5vaXnwy746J7XNG', 'VSItOfX6q8', '2022-06-17 00:39:19', '2022-08-31 00:27:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (30, 'Nasir Jerde', 'obarton@example.org', 'VNNXQAKVPD', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$JsA5vDtQB8Hk9a873T9H8.Hss5WQ7wu9DKWL3E5vaXnwy746J7XNG', 'mKszZIn047', '2022-06-17 00:39:20', '2022-06-17 00:39:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (31, 'Jennings Robel', 'cormier.amya@example.com', 'HVVBSKAO3X', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$cjwrMXV8dT8bORPV8yiTbOYO20mRuufLk9Zi6tGH5ciCSmKHJRLju', 'HBKEyZEigc', '2022-06-17 00:39:20', '2022-06-17 00:39:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (32, 'Keyshawn Hettinger', 'fshanahan@example.net', '6VNHVBNENR', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$cjwrMXV8dT8bORPV8yiTbOYO20mRuufLk9Zi6tGH5ciCSmKHJRLju', 'LYcrbYA8tM', '2022-06-17 00:39:20', '2022-06-17 00:39:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (33, 'Frank Parker', 'hhermiston@example.org', 'QI4NFK4ECP', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$cjwrMXV8dT8bORPV8yiTbOYO20mRuufLk9Zi6tGH5ciCSmKHJRLju', 'qRxZ54Wvcn', '2022-06-17 00:39:20', '2022-06-17 00:39:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (34, 'Cheyenne Prohaska', 'ziemann.tina@example.org', '1REGPBCVCU', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$HVzCZ3dYQ1TVErmk2pfdEuiT0k4vfgBUxT53yejALI.6HAjeG.Qq2', 'emrrDYkUid', '2022-06-17 00:39:21', '2022-06-17 00:39:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (35, 'Evangeline Hane Sr.', 'corine89@example.net', 'RRYQW3ZASZ', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$HVzCZ3dYQ1TVErmk2pfdEuiT0k4vfgBUxT53yejALI.6HAjeG.Qq2', 'pnAoIPUKAA', '2022-06-17 00:39:21', '2022-06-17 00:39:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (36, 'Judah Skiles', 'otto.becker@example.net', 'UPUYIKFUGG', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$HVzCZ3dYQ1TVErmk2pfdEuiT0k4vfgBUxT53yejALI.6HAjeG.Qq2', 'qXRmjiLXeb', '2022-06-17 00:39:21', '2022-06-17 00:39:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (37, 'Freda Bode', 'kuhic.newton@example.org', '0EQTGK0CFF', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Kw2RJHqkZZNCuWxsF1OgOuz9ROIYwON/mTqq.xxPJF8xQKDIoUYIW', 'wL0i4ILH6Y', '2022-06-17 00:39:21', '2022-06-17 00:39:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (38, 'Mr. Eduardo Rowe Jr.', 'andreane.hills@example.net', 'JNWO05KBGK', 2, NULL, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Kw2RJHqkZZNCuWxsF1OgOuz9ROIYwON/mTqq.xxPJF8xQKDIoUYIW', '6Uw5yrVNNC', '2022-06-17 00:39:21', '2022-06-17 00:39:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (39, 'Darrell Ebert', 'grimes.myron@example.net', 'JKY9LRH5RE', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Kw2RJHqkZZNCuWxsF1OgOuz9ROIYwON/mTqq.xxPJF8xQKDIoUYIW', 'bZ7uHZ1GGc', '2022-06-17 00:39:21', '2022-06-17 00:39:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (40, 'Mrs. Yessenia Parisian', 'kaya92@example.com', '0LNQ9NGVPO', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$7/x9hKWEAWX39HvMA2DfCOZ4KO4OzDLVRNAMJJhI8zM7c2hbdqp.i', 'xtoPteNkCR', '2022-06-17 00:39:22', '2022-06-17 00:39:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (41, 'Ms. Name Turcotte', 'stroman.daphne@example.net', 'LGVMFLX192', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$7/x9hKWEAWX39HvMA2DfCOZ4KO4OzDLVRNAMJJhI8zM7c2hbdqp.i', 'Kkl9gyOrxG', '2022-06-17 00:39:22', '2022-06-17 00:39:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (42, 'Prof. Bernie Rogahn', 'slarkin@example.org', 'CHMRMT8CCN', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$7/x9hKWEAWX39HvMA2DfCOZ4KO4OzDLVRNAMJJhI8zM7c2hbdqp.i', '9eC9Y9pZXG', '2022-06-17 00:39:22', '2022-06-17 00:39:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (43, 'Giovanni Mertz', 'cschowalter@example.com', 'VGO9R7HFKM', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ncIlRS9pnEIEaLj42I41oOg6lvUxO3LrmHxZ5WyEynEVNbCcvhUMW', 'KAAetYLjNU', '2022-06-17 00:39:22', '2022-06-17 00:39:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (44, 'Willow Koss', 'lee26@example.org', 'HMAVNQ8ISE', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ncIlRS9pnEIEaLj42I41oOg6lvUxO3LrmHxZ5WyEynEVNbCcvhUMW', 'IPzN3kgetm', '2022-06-17 00:39:23', '2022-06-17 00:39:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (45, 'Mr. Conrad Hickle DVM', 'tlittel@example.net', 'XYGGXJFJLA', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ncIlRS9pnEIEaLj42I41oOg6lvUxO3LrmHxZ5WyEynEVNbCcvhUMW', 'SK3bzmgGPg', '2022-06-17 00:39:23', '2022-06-17 00:39:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (46, 'Nikki Armstrong DDS', 'elroy12@example.com', '2DID7Y5XXW', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Te/..68do8hMDMlH24m09erQc6o151W6OrqQfd0JDMQx7OkSRgM46', 'HfeVUdR36l', '2022-06-17 00:39:23', '2022-06-17 00:39:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (47, 'Celia Hintz', 'cormier.mae@example.net', 'IBBNC9MQX9', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Te/..68do8hMDMlH24m09erQc6o151W6OrqQfd0JDMQx7OkSRgM46', '5fCfvLsZvv', '2022-06-17 00:39:23', '2022-06-17 00:39:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (48, 'Miss Rachel King', 'miller.georgiana@example.net', 'GZIQUGKAAR', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Te/..68do8hMDMlH24m09erQc6o151W6OrqQfd0JDMQx7OkSRgM46', 'WROenTYa0b', '2022-06-17 00:39:24', '2022-06-17 00:39:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (49, 'Shad Willms', 'newton.hoeger@example.net', 'NSIAQSX16R', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$25VmfhewvpgbUPWJoBAJDetMvT15gs8vsR.BqsUuQPe.rXufjHxc6', 'O5rLKKkjEv', '2022-06-17 00:39:24', '2022-06-17 00:39:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (50, 'Constance Lueilwitz', 'stanton.leonor@example.com', 'AQPKVXZTCW', 3, NULL, 'male', 'user.png', '', 'admission_number', '+254715233003', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$25VmfhewvpgbUPWJoBAJDetMvT15gs8vsR.BqsUuQPe.rXufjHxc6', 'FWRldWS1Jh', '2022-06-17 00:39:24', '2022-08-27 05:10:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (51, 'Wendy Brakus V', 'esteban48@example.com', 'A6IOJECIJS', 4, NULL, 'male', 'user.png', '', 'admission_number', '+4 444 444 1234', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$25VmfhewvpgbUPWJoBAJDetMvT15gs8vsR.BqsUuQPe.rXufjHxc6', 'wg1XVb5o3f', '2022-06-17 00:39:24', '2022-12-29 07:44:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (52, 'Sydnie Okuneva', 'unolan@example.net', 'SEP7TXBP4V', 3, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$kyd6Ewd3fQuUr2pzS2TimeY9To3xK3ihBC/J7gO9jtTnuN2Vqr6gW', 'jiYUCT9MFN', '2022-06-17 00:39:24', '2022-06-17 00:39:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (53, 'Ross Walter', 'janiya.mohr@example.com', 'YUBUF2HX4N', 3, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, 123466, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$kyd6Ewd3fQuUr2pzS2TimeY9To3xK3ihBC/J7gO9jtTnuN2Vqr6gW', 'GLyraWjAJD', '2022-06-17 00:39:25', '2022-06-23 13:57:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (54, 'Savion Feest', 'aaron.bergstrom@example.com', '09MFK3D2EM', 3, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$kyd6Ewd3fQuUr2pzS2TimeY9To3xK3ihBC/J7gO9jtTnuN2Vqr6gW', 'iWNONgWzBE', '2022-06-17 00:39:25', '2022-06-17 00:39:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (55, 'Leonid Fedoro11421', 'susansaffasdf@email.com', 'nUJMNS1BC4GY60feiDxZ', 3, NULL, 'male', 'user.png', '', 'admission_number', '', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Y79BYQ9gT4SVnHHD.p9C7.KiZBw.K54QYhbHZROmbuSH.LrxGt6CW', NULL, '2022-06-24 03:22:10', '2022-06-24 03:22:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (56, 'Leonid Fedoro114134', 'Leonid Fedoro114134@bibirionihigh', '5uU0eYI07Vimh11dy2Rl', 4, NULL, 'male', 'user.png', '', 'admission_number', '+254784714863', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vrf.6hM80ke1npkzHeFrLumEmq0bbjHnz15LrJ8zE/y8163O/83em', NULL, '2022-06-23 09:30:48', '2022-12-29 23:14:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (57, 'MakSim', 'Gender@email.com', 'j2EJcIPBsK2F1M1DmSBQ', 3, NULL, 'male', 'user.png', '', 'admission_number', '444444412341234', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$zvDA2RoW26b2Nn2c5N7hDO9lv4eH1U4bFg0VJ9/sJkj5.Ublxqfxm', NULL, '2022-06-24 03:22:52', '2022-06-24 15:47:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (58, 'Leonid Fedoro124', 'mykrsolovlo1@gmail.com', 'aCVdmfEbLDdEHoI3MBzv', 3, NULL, 'male', 'user.png', '', 'admission_number', '', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$t4/jzwRajMK1wwTz4rBtm.ra61OxJZW8xPwQEoYoclDXPD09JVTh6', NULL, '2022-06-23 09:35:27', '2022-06-23 09:35:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (59, 'Andrey Teterin', 'andrey@email.com', 'Y2KpPQArEllLFMgpFPzr', 3, NULL, 'male', 'user.png', '', 'admission_number', '', NULL, NULL, 123466, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Sct2VFm7N4fXhbAZ6FqICeh7FRnoYd.dlQn7DvUKcFMTzptB9NsKq', NULL, '2022-06-23 09:36:15', '2022-06-23 14:10:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (60, 'Leonid Fedoro114321', 'susadsan@email.com', 'SQx8EyCTSvAq4ZmMRx1J', 3, NULL, 'male', 'user.png', '', 'admission_number', '', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$kiqGjGCRKHinDSHxcJCLNeCPuB7F7DD7LjW4J8IEYVmLsnH79666W', NULL, '2022-06-24 03:24:44', '2022-06-24 03:24:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (62, 'Leonid Fedoro511', 'admin@email.com', 'gNM4BmRNxenFpWY2x266', 3, NULL, 'male', 'user.png', '', 'admission_number', '', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$VdxC3de0gd0hgUYfEWUGSOuvPEvkRmjp7BLwjnrFVp/63493MmiVC', NULL, '2022-06-23 09:39:47', '2022-06-23 09:39:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (63, 'Leonid Fedoro114', 'Leonid Fedoro114@bibirionihigh', 'rAmoJ0PjWvBC2RPsmT8p', 3, NULL, 'male', 'user.png', '', 'admission_number', '0784714863', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$g63zJZRSKYG502T8R.r80.XeeBzFHEfjNK1G8odCFBKwvy.kzTDPy', NULL, '2022-06-23 09:44:50', '2023-01-09 07:53:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (64, 'Leonid Fedoro51132', 'susan@email.com', 'E1BOatrRnPcttYsQlceA', 3, NULL, 'male', 'user.png', '', 'admission_number', '', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$iJ83pX1J2BIDHM5WCbdP.e./ABNw2VvYRXPeOkdtARoc84nAMsQ4S', NULL, '2022-06-23 09:46:56', '2022-06-23 09:46:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (85, 'denis90', 'denis90@email.com', 'ekJfkFchj1jtWPr3Zu5z', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$6/eu/8ycZ.KqEl2YFavnxOVR479ZCKq1FwJxuWzxQxtuV70kdgA26', NULL, '2022-06-24 02:01:01', '2022-06-24 02:01:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (89, 'Leonid dgfhFedoro114', 'sdfghusan@email.com', 'ahIC3xazt2nyru4WP8hq', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vXJbyECsRs2hEspe4Xb/X.M3vINT01abCLZ3l1KrIdSg.NhzP/97C', NULL, '2022-06-24 03:44:41', '2022-06-24 03:44:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (90, 'Denis Davydov 2022', 'Denis Davydov 2022@bibirionihigh', 'mnjB6fwnbadwElNBeUGT', 3, NULL, 'male', 'user.png', '', 'admission_number', '+4 444 444 1232', NULL, 1234, 1234, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Ra73HFJ26Fw9OVp1GW2rhuFJon7gnzDt3dg3b5uyQeRSCbr1AvXJG', NULL, '2022-06-24 13:25:33', '2022-12-31 05:37:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (91, 'Alexandra', 'alex@email.com', 'yfkrULL0N86YX5D0Chgz', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$VsWHt/3kMUW1FKGnH3.3kutPTgwXP/LbvOCjArTbnSWO9UKFoHj.y', NULL, '2022-06-25 10:31:34', '2022-06-25 10:31:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (92, 'Student59', 'student59@email.com', 'vK6alYpc6BGGEqxbmI5T', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$jWPNVEkxoBRR.NzLpHQsS.Itileo0WfwTjhGeNxS1sTu8rSS1EDZ2', NULL, '2022-06-27 01:11:46', '2022-06-27 01:11:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (93, 'Student60', 'Student60@email.com', '6kYgWQPsUastv99KefKl', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$2IuFSJ63.W99SfnlMFrOBOSE6n24aMzW0RKq6fG9kx1fuGTNmtYyG', NULL, '2022-06-27 01:12:26', '2022-06-27 01:12:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (94, 'Student61', 'Student61@email.com', 'IV7SiewhONR5ijMkvbw8', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$uqNMhHAZRj1GzOS/V9xQTu0E7rt1eWGp4Ac9RdOImVPP73RRxq58C', NULL, '2022-06-27 01:12:48', '2022-06-27 01:12:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (95, 'Student62', 'Student62@email.com', '4vKTqT95ZPl89zYbFJFH', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$IzZZWnaARQtoM5Ozpe8mqeMdXC.bALOJGzdHr1ZIKYunMrmnqsxXG', NULL, '2022-06-27 01:14:20', '2022-06-27 01:14:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (106, 'name1', 'name1@email.com', 'vOEocvaX07ByxlGfnGMp', 2, 44755, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$wmTwxEG9chJheZr5xJp6oOWbHApdeq7VAvp.AOUxsPHmObjflh.fK', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (107, 'name2', 'name2@email.com', 'b9oSETy9AE5WeYAmwNJO', 2, 44755, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$13NEjMYPNCVBLiBj.vZu/.vYH/CbxtGU1is5caoypq5Un60NEDa.y', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (108, 'name3', 'name3@email.com', 'u7NwMTncn8ljBnD2velf', 2, 44755, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$dsL67whOJXBGVm2fRhzIEuilhIjtvsDUPV5VMzJOg/gw8kgfv96gO', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (109, 'name4', 'name4@email.com', 'mojtP4WvyVArZsy8Tm9I', 2, 44755, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$C3xd9KNjoGJqpctpB4WxPuGkdY6Nzq/3L5c8bmWmX1SfSZMtTnfcO', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (110, 'name5', 'name5@email.com', 'Hmltc7kRBhUJ2mgsOOPT', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$dsJJD4NCJitPPLjNyUQMLOqwE.2X3qQtZFttWjKcGl4mDjq3XGy2i', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (111, 'name6', 'name6@email.com', 'Bwq7noeBgU7ULDHsTnRo', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$2zTb7/aqlR8jeG6C4y1FJeKCB03JanMG8UhhFUxrgGwhzr15YRrdO', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (112, 'name7', 'name7@email.com', 'cUhgaPfHYkPKUg5quUgk', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$hJ.R2ARJazlyUhFU6ZXnJOCXhjB7AEKaFYFKeiHOrOzAx7zxH1Uou', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (113, 'name8', 'name8@email.com', 'mZSngGvsiP2W0bPJwAm2', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ExbS700ypw3vhlyneiRRPu.1voKOALqVagVm4iUeCWWPVXCpirxvi', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (114, 'name9', 'name9@email.com', 'ooKK2ehRvlZEAv3Im2bj', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$WUqgwJhYN08gLRjf9yyKnecMLLfNyJ1IgviIxAF33JZjH/4z9NLnC', NULL, '2022-06-30 19:42:55', '2022-06-30 19:42:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (115, 'name10', 'name10@email.com', 'gZU3Cfar6W7XBjMIXvHC', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$CwlJsvc943eG6dZrWfMFz.QkEWVuLBOBxAGvX4sPQuW01L80IXJna', NULL, '2022-06-30 19:42:56', '2022-06-30 19:42:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (117, 'name11', 'name11@email.com', 'Z52M69iLboT7Gp6xxCFq', 2, 44755, 'female', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$3wka0d0rEOf8vRMT8STEK.saTQ9I5WzFEzfoN25M3mp9Bopq4Oxi6', NULL, '2022-06-30 20:12:14', '2022-06-30 20:12:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (119, 'Jarret', 'jarretporter091@gmail.com', 'mBPxWkp0eaLE2wrj9EpF', 2, NULL, 'male', 'user.png', '', 'admission_number', '1234566', NULL, 12345, 1234567, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$s40Wx/UVbvTRNwwYhifoFu9Flg76gPLUq6y9Sf3NM118EskKxvC3K', NULL, '2022-07-24 10:20:24', '2022-07-24 10:20:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (120, 'Jarret', 'jarretporter093@gmail.com', '0c4AzimhbTNuqdOIH3yr', 6, NULL, 'male', 'user.png', '', 'admission_number', '1234566', NULL, 1234, 123467, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$aUOv8sCoJnsEb5ZvJSjKA.BMCgsvUzapCagtL.YbwDXBBQNvqgEsm', NULL, '2022-07-24 10:30:43', '2022-10-14 11:37:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (121, 'Jarret', 'arsenii.pro86@gmail.com', 'Ee5DqUp1fKHunb82n2ts', 1, NULL, 'male', 'user.png', '', 'admission_number', '+254715323013', NULL, 1234, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Xg7emLKMAPKQ3TP7aRLTiOeLMYvqbKSPiT4QPB7/rzKrCdxp7KKMm', NULL, '2022-07-24 10:32:10', '2023-01-09 07:50:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (146, 'lorex', 'lorex@bibirionihigh', '3ge4Q', 3, NULL, 'male', 'user.png', '', 'admission_number', '+254715223003', NULL, 748745, 74584, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$0UqmDhLmjTQEuqBK.1H/heiqavhLiWjYSPnzfXac76IGoOsnbZMQu', NULL, '2022-08-31 05:53:53', '2022-08-31 07:38:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (147, 'berex', 'berex@bibirionihigh', '2WUYZ', 3, NULL, 'male', 'user.png', '', 'admission_number', '0715223003', NULL, 7843, 64435, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$MbqqHgCHvqQOuD4CQz8H1O2/mL90VWxY604jaiEDXTUo6.AMM7nqm', NULL, '2022-09-30 05:22:50', '2022-10-14 06:22:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (148, 'Dell', 'Dell@bibirionihigh', 'nLQKS', 4, NULL, 'male', '148.png', '148.png', 'admission_number', '+254784714863', NULL, 4634, 43564, NULL, NULL, NULL, 123456, '63 Broad St', NULL, '$2y$10$ObLKGHmbv1jfpJE8XOcxlut7T9yErFsFVUQA5V6kBPQdBac7nRNUq', NULL, '2022-10-04 18:09:50', '2022-12-29 06:58:35', 'BIBIRIONI HIGH SCHOOL-LIMURU', 'BBHS', 'bibirioniboyz@gmail.com', '00', 16, 2, 7, '63 Broad St', 1, 2, '148.png', 0);
INSERT INTO `users` VALUES (149, 'Mane', 'mane@bibirionihigh', 'r91mx', 4, NULL, 'male', '149.jpg', '149.png', 'admission_number', '0715223003', NULL, 676, 3233, NULL, NULL, NULL, 123456, NULL, NULL, '$2y$10$VRLgXazXMTSg6zRDEdSEYuMBelNwpHhoED0ric7B1XqaFpoYgmtdK', NULL, '2022-10-04 19:06:13', '2023-01-04 08:02:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (150, 'lexus', 'lexus@bibirionihigh', '29S8X', 4, NULL, 'male', 'user.png', '', 'admission_number', '0784714863', NULL, 7878, 6745, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$wUAmK3ByiDzYXLbqfVko9.t758yNG.r78NcLxxFO1dZyh.Z9zOFBe', NULL, '2022-10-11 18:35:49', '2022-12-29 07:30:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (151, 'alma', 'alma@bibirionihigh', 'Su82c', 3, NULL, 'male', 'user.png', '', 'admission_number', '0715223003', NULL, 787878787, 6734, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$LR7GHae4o7/NyWBz8ARihOWuZiii5UJfgdEBGZs7jIyO1pfz.LPHO', NULL, '2022-10-14 06:25:13', '2022-10-21 11:56:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (152, 'test', 'test@test.com', '7MIDQ', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Aj2BWlht2Y3haSRBTVdPKehNf.fcVxtjQvLP0Zc6IybmDVKX9OSIm', NULL, '2022-11-04 07:09:49', '2022-11-04 07:09:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (153, 'alex', 'monathcorey@gmail.come', 'Hn3kH', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$XBjwSSDKHdm1iPE/vy0dvu6JD/OGpVQM9j8OPd0W2yJ6bnipWPtpu', NULL, '2022-11-07 06:13:39', '2022-11-07 06:13:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (155, 'man', 'moreeey@gmail.come', 'JHf72', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$fAt/1DEQEPOn2RdtxU5WcOlxUZgvrRNaDmdhPaV3sS1ASLq3D8tuG', NULL, '2022-11-07 06:15:05', '2022-11-07 06:15:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (156, 'dell', 'monatryrey@gmail.come', '8FyTP', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$gLVHCAnNS1eRRx93qmvxH.kxSn/SaH0OUOwDGPntM/sSkl3GNBZBi', NULL, '2022-11-07 06:15:24', '2022-11-07 06:15:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (157, 'bern', 'rteathcorey@gmail.come', 'ZeBq5', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$/3/8gv.075AYJjp1z3TUSewEkP/NNx.jmFc2Tm6iDFXsD37jvbSCC', NULL, '2022-11-07 06:15:55', '2022-11-07 06:15:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (158, 'bisil', 'teyy@gmail.come', 'Grzpj', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vS4gMBNWqPlzYyL5XeG1RO6OotU.U.X33WOrc8ZPwtsUnoeRdkYBC', NULL, '2022-11-07 06:16:18', '2022-11-07 06:16:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (159, 'galito', 'galitohcorey@gmail.come', 'qwQDb', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vqg02568/yXFfAIzK1P1aeqOtiixvIYY3a.MUR9cj7sLSz7FOkc4m', NULL, '2022-11-07 06:16:38', '2022-11-07 06:16:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (160, 'inda', 'indacorey@gmail.come', 'XmBui', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Krt9WLviy0d7WbMdy2CKeuvVKVAUYb0CdpKb2EXlP2R/vp8IdKkRq', NULL, '2022-11-07 07:20:05', '2022-11-07 07:20:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (161, 'perly', 'perlrey@gmail.come', '6XAmh', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$vx8mjagy3cj6dqTUtmWy8uUraZ0lNVzYXK2ss3SE33PlGgT3bKUS.', NULL, '2022-11-07 07:20:30', '2022-11-07 07:20:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (162, 'zar', 'zarthcorey@gmail.come', 'prAQY', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$LGM9BcMS382JFNtGHa8vreUUx7KGL2w4xtqaF/5iiZz7d6DDGSJIq', NULL, '2022-11-07 07:20:55', '2022-11-07 07:20:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (163, 'don', 'dionhcorey@gmail.come', 'fxT2E', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$1gG0a/LXX3UkRtzLRlJE9eQxqlZW9tyrBGLjIEPcPq3ikuea5.Ib2', NULL, '2022-11-07 07:43:12', '2022-11-07 07:43:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (164, 'kxcon', 'kxchcorey@gmail.come', '3T3KQ', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$VdFQiJ1Rqw9M/ApjJ2dd4ehFPQ3LcASFN2flM9/uPIBiGAYmuOici', NULL, '2022-11-07 07:43:41', '2022-11-07 07:43:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (165, 'berr', 'berrhcorey@gmail.come', 'vL3RF', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$em7Eb6QbtjU1rGXuXZAsn.UVJR4lN6x1w2nMvNh9ReebltSfr8t1i', NULL, '2022-11-07 07:44:02', '2022-11-07 07:44:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (166, 'bruno', 'brunothcorey@gmail.come', 'Qkw2F', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$w8MaRc7iWBMDhcO06jW4JusAR0UVqlvVwPxix23qfxhHHrOk1Lpsu', NULL, '2022-11-07 07:44:24', '2022-11-07 07:44:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (167, 'kent', 'kentrey@gmail.come', 'chxoL', 2, NULL, 'male', 'user.png', '', 'admission_number', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$W4gpxSNmLmoxAekylGFF4u5g1yceXAcOcFoM9XalIv9vTLn3uya2m', NULL, '2022-11-07 07:44:54', '2022-11-07 07:44:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (168, 'Ombori', 'Ombori@bibirionihigh', '3hwUp', 3, NULL, 'male', 'user.png', '', 'admission_number', '0712345786', NULL, 2333, 679, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2023-01-05 11:38:06', '2023-01-05 11:39:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0);
INSERT INTO `users` VALUES (169, 'Ombori1', 'Ombori1@bibirionihigh', 'sbkXw', 3, NULL, 'male', 'user.png', NULL, 'admission_number', '0712345787', NULL, 2334, 678, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2023-01-05 11:52:26', '2023-01-05 11:52:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (170, 'Ombori2', 'Ombori2@bibirionihigh', 'cx5Pu', 3, NULL, 'male', 'user.png', NULL, 'admission_number', '0712345788', NULL, 2335, 680, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2023-01-05 12:31:57', '2023-01-05 12:31:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `users` VALUES (175, 'kk', 'kk@bibirionihigh', '2W2zk', 3, NULL, 'male', 'user.png', NULL, 'admission_number', '0712345786', NULL, 2333, 678, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2023-01-09 08:48:11', '2023-01-09 08:48:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Procedure structure for test
-- ----------------------------
DROP PROCEDURE IF EXISTS `test`;
delimiter ;;
CREATE PROCEDURE `test`()
BEGIN
DROP TABLE If Exists Report3;
CREATE TABLE Report3(ComputerDepartmentID 		INT,ComputerType VARCHAR(255),EXPIRATION DATE,CerNumber 	INT,CustomerNumber INT,Office VARCHAR(255));
	END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
