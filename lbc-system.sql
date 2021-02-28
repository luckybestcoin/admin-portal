/*
 Navicat MySQL Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : localhost:3306
 Source Schema         : lbc-system

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 28/02/2021 17:46:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for achievement
-- ----------------------------
DROP TABLE IF EXISTS `achievement`;
CREATE TABLE `achievement`  (
  `achievement_id` bigint NOT NULL AUTO_INCREMENT,
  `rating_id` bigint NULL DEFAULT NULL,
  `member_id` bigint NULL DEFAULT NULL,
  `process` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`achievement_id`) USING BTREE,
  INDEX `peringkat_id`(`rating_id`) USING BTREE,
  INDEX `anggota_id`(`member_id`) USING BTREE,
  CONSTRAINT `achievement_ibfk_1` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`rating_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `achievement_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of achievement
-- ----------------------------
INSERT INTO `achievement` VALUES (2, 1, 1, NULL, '2021-02-23 00:56:25', '2021-02-23 00:56:25', NULL);
INSERT INTO `achievement` VALUES (4, 1, 1, NULL, '2021-02-23 01:00:00', '2021-02-23 01:00:00', NULL);
INSERT INTO `achievement` VALUES (5, 1, 1, NULL, '2021-02-23 01:06:30', '2021-02-23 01:06:30', NULL);
INSERT INTO `achievement` VALUES (6, 1, 1, NULL, '2021-02-23 01:09:02', '2021-02-23 01:09:02', NULL);
INSERT INTO `achievement` VALUES (7, 1, 1, NULL, '2021-02-23 01:14:47', '2021-02-23 01:14:47', NULL);
INSERT INTO `achievement` VALUES (8, 1, 1, NULL, '2021-02-23 01:17:28', '2021-02-23 01:17:28', NULL);
INSERT INTO `achievement` VALUES (9, 1, 1, NULL, '2021-02-23 01:18:34', '2021-02-23 01:18:34', NULL);
INSERT INTO `achievement` VALUES (10, 1, 1, NULL, '2021-02-23 01:26:08', '2021-02-23 01:26:08', NULL);

-- ----------------------------
-- Table structure for coinpayment_transaction_items
-- ----------------------------
DROP TABLE IF EXISTS `coinpayment_transaction_items`;
CREATE TABLE `coinpayment_transaction_items`  (
  `coinpayment_transaction_id` bigint NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `qty` decimal(10, 2) NOT NULL,
  `subtotal` decimal(10, 2) NOT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  INDEX `coinpayment_transaction_id`(`coinpayment_transaction_id`) USING BTREE,
  CONSTRAINT `coinpayment_transaction_items_ibfk_1` FOREIGN KEY (`coinpayment_transaction_id`) REFERENCES `coinpayment_transactions` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coinpayment_transaction_items
-- ----------------------------
INSERT INTO `coinpayment_transaction_items` VALUES (1, 'Lucky Best Coin', 110.00, 2.00, 220.00, 'USD', NULL, NULL, '2021-02-25 08:48:19', '2021-02-25 08:48:19');
INSERT INTO `coinpayment_transaction_items` VALUES (2, 'Lucky Best Coin', 110.00, 10.00, 1100.00, 'USD', NULL, NULL, '2021-02-25 09:51:26', '2021-02-25 09:51:26');

-- ----------------------------
-- Table structure for coinpayment_transactions
-- ----------------------------
DROP TABLE IF EXISTS `coinpayment_transactions`;
CREATE TABLE `coinpayment_transactions`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `txn_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `buyer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `buyer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `time_expires` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amount_total_fiat` decimal(10, 2) NULL DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amountf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `coin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `confirms_needed` int NULL DEFAULT NULL,
  `payment_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `qrcode_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `received` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `receivedf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `recv_confirms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `timeout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `checkout_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `redirect_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancel_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `coinpayment_transactions_uuid_unique`(`uuid`) USING BTREE,
  UNIQUE INDEX `coinpayment_transactions_txn_id_unique`(`txn_id`) USING BTREE,
  UNIQUE INDEX `coinpayment_transactions_order_id_unique`(`order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coinpayment_transactions
-- ----------------------------
INSERT INTO `coinpayment_transactions` VALUES (1, 'c2f811ae-2cc7-4c93-aa6f-7e988f4a4ec4', 'CPFB0NZVGLXQUJLMGMIUTX0NCX', '60376422282b9', 'fajar', 'fajar@gmail.com', 'USD', '1614257294', '0x62d4b39f2aaa2d9c03dca9064f3d255804926c31', 220.00, '13609000', '0.13609000', 'ETH', 3, '0x62d4b39f2aaa2d9c03dca9064f3d255804926c31', 'https://www.coinpayments.net/qrgen.php?id=CPFB0NZVGLXQUJLMGMIUTX0NCX&key=dd1c3d57544719dd23f5a81890eb8d4b', '0', '0.00000000', '0', '0', 'Waiting for buyer funds...', 'https://www.coinpayments.net/index.php?cmd=status&id=CPFB0NZVGLXQUJLMGMIUTX0NCX&key=dd1c3d57544719dd23f5a81890eb8d4b', '14400', 'http://lbc-member.test/coinpayment/make/eyJpdiI6IkFOVnFYTDh6RmNFREFIdFJXY1Q4c0E9PSIsInZhbHVlIjoiSUVaaDNZUjVERFNuSlA4R3VhNHZ2QVpLV0Q0TFNOS0FJTDFrRGdmTkU2SFN3N3RoVnZ1UHlyeE9Cejk1bloyNklvRGdtQnhJcDNyVkdNaDJaMnVaN3lGekNYRzZVSWZBT2VwdWNMZ2FIRTMwK2NuTUZVaFM2aFd0UzZkUXFHRWhmaUlLY08xM0F1WkxURzFaWElWWmRhTDcvNTNNTWF2dnlxcE11b0IrMmt0ZXpjR0JIYmJDYnQzcm81dUMraGRGMHBYVWIyVGpWc3ppWEk5THNRd0x5M2Q3OE5TTGdJSmNNWkZaOVVTN3pRZnpPdWl6NStxK2g0a0xwU0Q3K1Nmc1NkQzJkVm5GK09raE0xN1gwNFN2cDZRRmtTMlpjK0xYdnhKTkg0ZnNtTi95ak1GZy9MY001MmgrK2dVQWNOS1hZNFlRelBJWlFrdU5tRVVZVUdDQkRLbVJ2enFYL29sQlJvTEJyemNQc0FkSElJZkQ0M25KQytHM1VRWm12TmgybkZHNWRWUWtNczRZQmxaejJ2bjNzUkdvTzdiUXJyUHRGbHFWK05RWFNwS1ZRUkM1M2c5OG53K3N6TnB2SXlLNHNCL2N2RGdXd3EyN1FZRXlTTDNEa1BCWWJLNDhieGN3aThGVit1Q25JTEJYbXUxbkhpdkVIeHlkWlhLazl3WXBDUVhVUWhzeUNqVCtqdWhXK01pWm5QWmZJSHRRa3huTzB2cllQNGVsMy9kYmw0R01TK21sTzl2T1llb0dHS0J4ZGJPMVkvU2JDMGZtOEFKZnBvb2dGb1UxR3hVWVI0YmNlY0d6RVQwNGNVSUV6VFc5cUV1ZUVWWXFOSFNGMEZiSGFnUWNwOXRKY1VDRjdyU0J1VytiV3VRRHNCS2Qrc1RmbTNGZy9RWlZuWTFUdWJ6SUpoUHAvckNaRUo2dHl3TXgiLCJtYWMiOiJiMDczNzIyNmFkM2RjODc0MzNmNDI5MThkYTZkYmIyODVjZDM1NTZmMjQzNWYzMTkyNWFmNDZmOTI3NmI1N2NlIn0=', 'http://lbc-member.test/wallet/deposit', 'http://lbc-member.test/wallet/deposit', 'coins', '{\"foo\":{\"bar\":\"baz\"}}', '2021-02-25 08:48:19', '2021-02-25 08:48:19');
INSERT INTO `coinpayment_transactions` VALUES (2, 'd106749d-cc62-4c3c-ab35-1b4960748b36', 'CPFB7LC4EUNEQRFBC0LK4PEOCO', '603772fb0b30f', 'fajar', 'fajar@gmail.com', 'USD', '1614343882', '3P98Hs7cna1pq2rnqbUZZbYBqeEayYjWuL', 1100.00, '2246000', '0.02246000', 'BTC', 2, '3P98Hs7cna1pq2rnqbUZZbYBqeEayYjWuL', 'https://www.coinpayments.net/qrgen.php?id=CPFB7LC4EUNEQRFBC0LK4PEOCO&key=a33b3d04e0cd280a6010d36ac33832d0', '0', '0.00000000', '0', '0', 'Waiting for buyer funds...', 'https://www.coinpayments.net/index.php?cmd=status&id=CPFB7LC4EUNEQRFBC0LK4PEOCO&key=a33b3d04e0cd280a6010d36ac33832d0', '97200', 'http://lbc-member.test/coinpayment/make/eyJpdiI6IjVSd1BCNk4ySHlXSUp0Z3NqNGcyTVE9PSIsInZhbHVlIjoiZzErMnh4bDVHaEwwQytNcG9oTjVHOWl4WjNVWTc2cXpiS0FnMzdvQytYWlVHVDhwcVo5NGdBcTJvRytXdEVUZGxzVUdCaXNFRVNXelVsajJNanozeGJYV1hYVWdMZElQZmIwVWhqMm43V1d0M1ZBdEhodWE5NFAwS0lkRU1YSFRpZnF3MzlVYzBmY0RjVHIrSDV5VDlGR0d5TzYzcFNyYzkyUFhtbzNudTQ3WHFpNGVIRWV2MHVGblJZQWhjelBFbGVsYkJUSmJVbU5ibDNDRjgrNGZJa04vUG43NnJScVZVRDBBSUJnMDlXWDAzNU9RbmhRaS90ajNKVklNcVR1cE1WSzdyTGFmQTRPUmVXakdEeTlJZk1kMjFmcmZRQnQxVnFWaDFNRWUwR2FjdlZzN21HUUpiTkdVRkM0TEp0Q05OV2JpV1BuQ0l2SVFsdmJ6aXQwd3hUMUppeFVMMlAwOHo0U2NKbGxXbFV2NVNsZW5lM3RDeUJiMjVZM09UTEtCd0pUNVN4TFFJcFZONGRtWHZzMTVGVmxnRS9jNXdsaVFNT0JMOE9jK1lOa3Zub3k2cnJ3NnNaSWJxMHhNM1p6TnJwYVFIaXUxV1F5SjFvZGY3Wit5YjdTLzdpckdHMlJBbWNXdXMyV3NvK1o5YUpkQi9hclltdWExMEx0WmJyblBCeUsrR252blBneVhXOHB6dExXNkg5WXJkajdraXNkZ1ZVU2w0a0xpOGRMR3BrU3grdWhHQTEwV0RHSFFoVWRpb2pPQWxEalBza09RY2o4TVA5ODcweVQ3WVpjVXZ4R05tdkh2MExzM3g0M3l2cHViam9FSUhaU0pnL21qZTJ0VTg1UXN6QlVuUEVJWkl1amxGSVQ2Mk1yQXlZY0R2b2xRRktvbnRidURRdkpaRjJxYVJhL3RwUnVySjUvRUhiYWMiLCJtYWMiOiJlY2FkYjA1ZDQyNmNjOTM4ZGE1YWRjMDNjNDUwZWZkYWJkZmMxMGY4ZWVjZDgwNzE4YjhhODQyNWJhYzI0Y2FkIn0=', 'http://lbc-member.test/wallet/deposit', 'http://lbc-member.test/wallet/deposit', 'coins', '{\"foo\":{\"bar\":\"baz\"}}', '2021-02-25 09:51:26', '2021-02-25 09:51:26');

-- ----------------------------
-- Table structure for contract
-- ----------------------------
DROP TABLE IF EXISTS `contract`;
CREATE TABLE `contract`  (
  `contract_id` bigint NOT NULL AUTO_INCREMENT,
  `contract_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `contract_price` decimal(65, 2) NOT NULL,
  `contract_pin` tinyint NOT NULL,
  `contract_reward_exchange_fee` decimal(60, 2) NULL DEFAULT NULL,
  `contract_reward_exchange_min` decimal(60, 2) NULL DEFAULT NULL,
  `contract_reward_exchange_max` decimal(60, 2) NULL DEFAULT NULL,
  `contract_pin_reward_exchange_fee` decimal(60, 2) NULL DEFAULT NULL,
  `contract_pin_reward_exchange_min` decimal(60, 2) NULL DEFAULT NULL,
  `contract_pin_reward_exchange_max` decimal(60, 2) NULL DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`contract_id`) USING BTREE,
  INDEX `pengguna_id`(`user_id`) USING BTREE,
  CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contract
-- ----------------------------
INSERT INTO `contract` VALUES (1, 'PREMIUM', 100.00, 1, 2.00, 10.00, 100.00, 3.00, 10.00, 100.00, 1, '2021-01-15 03:09:38', '2021-01-24 12:41:50', NULL);
INSERT INTO `contract` VALUES (2, 'BRONZE', 200.00, 1, 3.00, 20.00, 200.00, 3.00, 10.00, 200.00, 1, '2021-01-15 03:13:35', '2021-01-24 12:41:57', NULL);
INSERT INTO `contract` VALUES (3, 'SILVER', 500.00, 1, 4.00, 50.00, 500.00, 3.00, 10.00, 500.00, 1, '2021-01-15 03:14:11', '2021-01-24 12:41:58', NULL);
INSERT INTO `contract` VALUES (4, 'GOLD', 1000.00, 1, 7.00, 100.00, 1000.00, 3.00, 10.00, 1000.00, 1, '2021-01-15 10:39:09', '2021-01-24 12:41:59', NULL);
INSERT INTO `contract` VALUES (5, 'PLATINUM', 2000.00, 3, 7.00, 100.00, 2000.00, 3.00, 10.00, 1000.00, 1, '2021-01-17 00:30:00', '2021-01-24 12:42:00', NULL);
INSERT INTO `contract` VALUES (6, 'DIAMOND', 5000.00, 5, 7.00, 250.00, 5000.00, 3.00, 10.00, 1000.00, 1, '2021-01-17 00:30:35', '2021-01-24 12:42:01', NULL);
INSERT INTO `contract` VALUES (7, 'CROWN', 10000.00, 9, 7.00, 500.00, 10000.00, 3.00, 10.00, 1000.00, 1, '2021-01-24 13:26:44', '2021-01-24 13:26:44', NULL);

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country`  (
  `country_id` bigint NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `country_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `user_id` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`country_id`) USING BTREE,
  INDEX `pengguna_id`(`user_id`) USING BTREE,
  CONSTRAINT `country_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 197 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES (1, 'Afganistan', '93', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (2, 'Afrika Selatan', '27', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (3, 'Afrika Tengah', '236', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (4, 'Albania', '355', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (5, 'Algeria', '213', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (6, 'Amerika Serikat', '1', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (7, 'Andorra', '376', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (8, 'Angola', '244', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (9, 'Antigua & Barbuda', '1-268', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (10, 'Arab Saudi', '966', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (11, 'Argentina', '54', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (12, 'Armenia', '374', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (13, 'Australia', '61', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (14, 'Austria', '43', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (15, 'Azerbaijan', '994', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (16, 'Bahama', '1-242', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (17, 'Bahrain', '973', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (18, 'Bangladesh', '880', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (19, 'Barbados', '1-246', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (20, 'Belanda', '31', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (21, 'Belarus', '375', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (22, 'Belgia', '32', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (23, 'Belize', '501', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (24, 'Benin', '229', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (25, 'Bhutan', '975', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (26, 'Bolivia', '591', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (27, 'Bosnia & Herzegovina', '387', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (28, 'Botswana', '267', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (29, 'Brasil', '55', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (30, 'Britania Raya (Inggris)', '44', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (31, 'Brunei Darussalam', '673', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (32, 'Bulgaria', '359', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (33, 'Burkina Faso', '226', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (34, 'Burundi', '257', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (35, 'Ceko', '420', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (36, 'Chad', '235', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (37, 'Chili', '56', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (38, 'China', '86', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (39, 'Denmark', '45', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (40, 'Djibouti', '253', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (41, 'Domikia', '1-767', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (42, 'Ekuador', '593', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (43, 'El Salvador', '503', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (44, 'Eritrea', '291', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (45, 'Estonia', '372', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (46, 'Ethiopia', '251', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (47, 'Fiji', '679', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (48, 'Filipina', '63', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (49, 'Finlandia', '358', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (50, 'Gabon', '241', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (51, 'Gambia', '220', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (52, 'Georgia', '995', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (53, 'Ghana', '233', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (54, 'Grenada', '1-473', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (55, 'Guatemala', '502', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (56, 'Guinea', '224', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (57, 'Guinea Bissau', '245', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (58, 'Guinea Khatulistiwa', '240', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (59, 'Guyana', '592', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (60, 'Haiti', '509', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (61, 'Honduras', '504', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (62, 'Hongaria', '36', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (63, 'Hongkong', '852', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (64, 'India', '91', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (65, 'Indonesia', '62', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (66, 'Irak', '964', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (67, 'Iran', '98', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (68, 'Irlandia', '353', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (69, 'Islandia', '354', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (70, 'Israel', '972', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (71, 'Italia', '39', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (72, 'Jamaika', '1-876', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (73, 'Jepang', '81', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (74, 'Jerman', '49', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (75, 'Jordan', '962', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (76, 'Kamboja', '855', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (77, 'Kamerun', '237', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (78, 'Kanada', '1', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (79, 'Kazakhstan', '7', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (80, 'Kenya', '254', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (81, 'Kirgizstan', '996', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (82, 'Kiribati', '686', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (83, 'Kolombia', '57', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (84, 'Komoro', '269', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (85, 'Republik Kongo', '243', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (86, 'Korea Selatan', '82', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (87, 'Korea Utara', '850', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (88, 'Kosta Rika', '506', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (89, 'Kroasia', '385', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (90, 'Kuba', '53', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (91, 'Kuwait', '965', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (92, 'Laos', '856', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (93, 'Latvia', '371', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (94, 'Lebanon', '961', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (95, 'Lesotho', '266', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (96, 'Liberia', '231', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (97, 'Libya', '218', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (98, 'Liechtenstein', '423', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (99, 'Lituania', '370', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (100, 'Luksemburg', '352', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (101, 'Madagaskar', '261', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (102, 'Makao', '853', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (103, 'Makedonia', '389', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (104, 'Maladewa', '960', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (105, 'Malawi', '265', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (106, 'Malaysia', '60', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (107, 'Mali', '223', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (108, 'Malta', '356', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (109, 'Maroko', '212', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (110, 'Marshall (Kep.)', '692', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (111, 'Mauritania', '222', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (112, 'Mauritius', '230', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (113, 'Meksiko', '52', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (114, 'Mesir', '20', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (115, 'Mikronesia (Kep.)', '691', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (116, 'Moldova', '373', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (117, 'Monako', '377', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (118, 'Mongolia', '976', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (119, 'Montenegro', '382', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (120, 'Mozambik', '258', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (121, 'Myanmar', '95', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (122, 'Namibia', '264', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (123, 'Nauru', '674', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (124, 'Nepal', '977', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (125, 'Niger', '227', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (126, 'Nigeria', '234', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (127, 'Nikaragua', '505', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (128, 'Norwegia', '47', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (129, 'Oman', '968', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (130, 'Pakistan', '92', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (131, 'Palau', '680', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (132, 'Panama', '507', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (133, 'Pantai Gading', '225', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (134, 'Papua Nugini', '675', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (135, 'Paraguay', '595', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (136, 'Perancis', '33', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (137, 'Peru', '51', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (138, 'Polandia', '48', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (139, 'Portugal', '351', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (140, 'Qatar', '974', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (141, 'Rep. Dem. Kongo', '242', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (142, 'Republik Dominika', '1-809; 1-829', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (143, 'Rumania', '40', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (144, 'Rusia', '7', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (145, 'Rwanda', '250', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (146, 'Saint Kitts and Nevis', '1-869', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (147, 'Saint Lucia', '1-758', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (148, 'Saint Vincent & the Grenadines', '1-784', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (149, 'Samoa', '685', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (150, 'San Marino', '378', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (151, 'Sao Tome & Principe', '239', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (152, 'Selandia Baru', '64', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (153, 'Senegal', '221', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (154, 'Serbia', '381', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (155, 'Seychelles', '248', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (156, 'Sierra Leone', '232', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (157, 'Singapura', '65', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (158, 'Siprus', '357', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (159, 'Slovenia', '386', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (160, 'Slowakia', '421', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (161, 'Solomon (Kep.)', '677', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (162, 'Somalia', '252', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (163, 'Spanyol', '34', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (164, 'Sri Lanka', '94', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (165, 'Sudan', '249', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (166, 'Sudan Selatan', '211', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (167, 'Suriah', '963', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (168, 'Suriname', '597', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (169, 'Swaziland', '268', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (170, 'Swedia', '46', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (171, 'Swiss', '41', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (172, 'Tajikistan', '992', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (173, 'Tanjung Verde', '238', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (174, 'Tanzania', '255', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (175, 'Taiwan', '886', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (176, 'Thailand', '66', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (177, 'Timor Leste', '670', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (178, 'Togo', '228', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (179, 'Tonga', '676', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (180, 'Trinidad & Tobago', '1-868', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (181, 'Tunisia', '216', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (182, 'Turki', '90', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (183, 'Turkmenistan', '993', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (184, 'Tuvalu', '688', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (185, 'Uganda', '256', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (186, 'Ukraina', '380', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (187, 'Uni Emirat Arab', '971', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (188, 'Uruguay', '598', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (189, 'Uzbekistan', '998', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (190, 'Vanuatu', '678', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (191, 'Venezuela', '58', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (192, 'Vietnam', '84', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (193, 'Yaman', '967', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (194, 'Yunani', '30', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (195, 'Zambia', '260', 1, NULL, NULL, NULL);
INSERT INTO `country` VALUES (196, 'Zimbabwe', '263', 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for holiday
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday`  (
  `holiday_id` bigint NOT NULL AUTO_INCREMENT,
  `holiday_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `holiday_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pengguna_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`holiday_id`) USING BTREE,
  UNIQUE INDEX `hari_besar_hari_besar_tanggal_idx`(`holiday_date`) USING BTREE,
  INDEX `pengguna_id`(`pengguna_id`) USING BTREE,
  CONSTRAINT `holiday_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of holiday
-- ----------------------------
INSERT INTO `holiday` VALUES (1, '2020-10-12', 'tesa', 1, '2021-01-17 00:42:55', '2021-01-17 00:49:30');
INSERT INTO `holiday` VALUES (2, '2020-11-21', 'res', 1, '2021-01-17 00:49:44', '2021-01-17 00:55:45');

-- ----------------------------
-- Table structure for invalid_turnover
-- ----------------------------
DROP TABLE IF EXISTS `invalid_turnover`;
CREATE TABLE `invalid_turnover`  (
  `invalid_turnover_id` bigint NOT NULL AUTO_INCREMENT,
  `invalid_turnover_amount` decimal(65, 2) NOT NULL,
  `invalid_turnover_position` tinyint(1) NOT NULL,
  `invalid_turnover_from` bigint NULL DEFAULT NULL,
  `member_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`invalid_turnover_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of invalid_turnover
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `member_id` bigint NOT NULL AUTO_INCREMENT,
  `member_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `member_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `member_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `member_network` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `member_parent` bigint NULL DEFAULT NULL,
  `member_position` smallint NULL DEFAULT NULL,
  `contract_id` bigint NOT NULL,
  `contract_price` decimal(65, 2) NOT NULL,
  `country_id` bigint NOT NULL,
  `due_date` date NULL DEFAULT NULL,
  `extension` int NOT NULL DEFAULT 1,
  `rating_id` bigint NULL DEFAULT NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`member_id`) USING BTREE,
  INDEX `anggota_paket_id_fkey`(`contract_price`) USING BTREE,
  INDEX `anggota_peringkat_id_fkey`(`rating_id`) USING BTREE,
  INDEX `paket_id`(`contract_id`) USING BTREE,
  CONSTRAINT `anggota_peringkat_id_fkey` FOREIGN KEY (`rating_id`) REFERENCES `rating` (`rating_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`contract_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, '$2y$10$N3WaDbRehALzPMTbrght3epbST1HFqtY3W.gAQqHzRU6r74KOivIS', 'fajar', 'fajar@gmail.com', '080808080808', '', NULL, NULL, 1, 10000.00, 65, NULL, 1, 1, NULL, '2021-01-31 00:00:00', '2021-02-23 11:45:28', NULL);
INSERT INTO `member` VALUES (8, '$2y$10$KAP8YOAK/dz2ddd4tDGt/u3EdFZVBOs9zmD6FKrrbex2PSvsED2eW', 'Andi Fajar Nugraha', 'andifajarlah@gmail.com', '62081803747336', '1ka', 1, 1, 5, 2000.00, 65, NULL, 1, NULL, NULL, '2021-02-22 13:16:03', '2021-02-23 00:56:25', NULL);
INSERT INTO `member` VALUES (9, '$2y$10$Ulib8czNU5/5VMfgP2s/luS5rC5X1uuKOoCaVxpQyrmvixLG6SlZa', 'andi', 'andi@gmail.com', '62081803747336', '1ki', 1, 0, 5, 2000.00, 65, NULL, 1, NULL, NULL, '2021-02-22 21:41:09', '2021-02-23 01:26:08', NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_01_26_221915_create_coinpayment_transactions_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_11_30_030150_create_coinpayment_transaction_items_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` int UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `model_id` bigint NOT NULL,
  PRIMARY KEY (`permission_id`, `model_type`, `model_id`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_type`) USING BTREE,
  INDEX `izin_pengguna_fk`(`model_id`) USING BTREE,
  CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `model_has_permissions_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` int UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `model_id` bigint NOT NULL,
  PRIMARY KEY (`role_id`, `model_type`, `model_id`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_type`) USING BTREE,
  INDEX `level_pengguna_fk`(`model_id`) USING BTREE,
  CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `model_has_roles_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\Pengguna', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payment_method
-- ----------------------------
DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method`  (
  `payment_method_id` bigint NOT NULL AUTO_INCREMENT COMMENT ' ',
  `payment_method_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `payment_method_abbrevation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `payment_method_price` decimal(60, 10) NULL DEFAULT NULL,
  `user_id` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_method_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payment_method
-- ----------------------------
INSERT INTO `payment_method` VALUES (1, 'BitCoin', 'BTC', 0.0020000000, 1, '2021-01-30 00:00:00', '2021-01-30 00:00:00', NULL);
INSERT INTO `payment_method` VALUES (2, 'Etherium', 'ETH', 0.1000000000, 1, '2021-01-30 00:00:00', '2021-01-30 00:00:00', NULL);
INSERT INTO `payment_method` VALUES (4, 'Binance', 'BNB', 0.0030000000, 1, NULL, NULL, NULL);
INSERT INTO `payment_method` VALUES (5, 'Tron', 'TRX', 0.0003000000, 1, NULL, NULL, NULL);
INSERT INTO `payment_method` VALUES (6, 'USD Tether', 'USDT', 1.0000000000, 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `guard_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------

-- ----------------------------
-- Table structure for rate
-- ----------------------------
DROP TABLE IF EXISTS `rate`;
CREATE TABLE `rate`  (
  `rate_id` bigint NOT NULL AUTO_INCREMENT,
  `rate_price` decimal(65, 2) NOT NULL,
  `rate_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp(6) NOT NULL,
  `updated_at` timestamp(6) NOT NULL,
  PRIMARY KEY (`rate_id`) USING BTREE,
  INDEX `pengguna_id`(`user_id`) USING BTREE,
  CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rate
-- ----------------------------
INSERT INTO `rate` VALUES (2, 150.00, 'USD', 1, '2021-01-20 00:02:00.023000', '2021-01-20 00:00:00.000000');
INSERT INTO `rate` VALUES (3, 7500.00, 'IDR', 1, '2021-01-20 00:01:00.000000', '2021-01-20 00:00:00.000000');
INSERT INTO `rate` VALUES (4, 120.00, 'USD', 1, '2021-01-20 00:22:01.020000', '2021-01-21 00:00:00.000000');
INSERT INTO `rate` VALUES (5, 110.00, 'USD', 1, '2021-02-10 02:00:00.120000', '2021-01-30 00:00:00.000000');

-- ----------------------------
-- Table structure for rating
-- ----------------------------
DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating`  (
  `rating_id` bigint NOT NULL AUTO_INCREMENT,
  `rating_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rating_min_turnover` decimal(65, 2) NOT NULL,
  `rating_reward` decimal(65, 2) NOT NULL,
  `rating_order` tinyint(1) NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rating_id`) USING BTREE,
  UNIQUE INDEX `rating_order`(`rating_order`) USING BTREE,
  INDEX `pengguna_id`(`user_id`) USING BTREE,
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rating
-- ----------------------------
INSERT INTO `rating` VALUES (1, 'Bronze', 10000.00, 350.00, 1, 1, '2021-01-27 00:00:00', '2021-01-27 00:00:00', NULL);
INSERT INTO `rating` VALUES (2, 'Silver', 100000.00, 3500.00, 2, 1, '2021-01-27 00:00:00', '2021-01-27 00:00:00', NULL);
INSERT INTO `rating` VALUES (3, 'Gold', 350000.00, 10000.00, 3, 1, '2021-01-27 00:00:00', '2021-01-27 00:00:00', NULL);
INSERT INTO `rating` VALUES (4, 'Platinum', 3500000.00, 35000.00, 4, 1, '2021-01-27 00:00:00', '2021-01-27 00:00:00', NULL);

-- ----------------------------
-- Table structure for referral
-- ----------------------------
DROP TABLE IF EXISTS `referral`;
CREATE TABLE `referral`  (
  `referral_id` bigint NOT NULL AUTO_INCREMENT,
  `referral_token` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `member_id` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`referral_id`) USING BTREE,
  UNIQUE INDEX `referal_ibfk_1`(`member_id`) USING BTREE,
  UNIQUE INDEX `referal_token`(`referral_token`) USING BTREE,
  CONSTRAINT `referral_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of referral
-- ----------------------------
INSERT INTO `referral` VALUES (53, 'EleNCZVooeNQU4QvM8pQ8A1a8SgCRjtsahaFOQcS8', 8, '2021-02-22 13:16:03', '2021-02-23 00:56:25', '2021-02-23 00:56:25');
INSERT INTO `referral` VALUES (54, 'ZgWhmeAZhxriujIxkX0jmF4xwgatQCnfKjMMmWK39', 9, '2021-02-22 21:41:09', '2021-02-23 01:26:08', '2021-02-23 01:26:08');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `guard_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'super-admin', 'web', '2019-04-24 03:38:59', '2019-04-24 03:38:59');
INSERT INTO `roles` VALUES (2, 'user', 'web', '2019-04-24 03:38:59', '2019-04-24 03:38:59');
INSERT INTO `roles` VALUES (3, 'guest', 'web', '2019-04-24 03:38:59', '2019-04-24 03:38:59');

-- ----------------------------
-- Table structure for transaction_exchange
-- ----------------------------
DROP TABLE IF EXISTS `transaction_exchange`;
CREATE TABLE `transaction_exchange`  (
  `transaction_exchange_amount` decimal(65, 30) NOT NULL,
  `rate_id` bigint NOT NULL,
  `wallet_id` bigint NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  INDEX `wallet_id`(`wallet_id`) USING BTREE,
  INDEX `kurs_id`(`rate_id`) USING BTREE,
  INDEX `transaction_id`(`transaction_id`) USING BTREE,
  CONSTRAINT `transaction_exchange_ibfk_1` FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`wallet_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `transaction_exchange_ibfk_2` FOREIGN KEY (`rate_id`) REFERENCES `rate` (`rate_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transaction_exchange_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_exchange
-- ----------------------------

-- ----------------------------
-- Table structure for transaction_extension
-- ----------------------------
DROP TABLE IF EXISTS `transaction_extension`;
CREATE TABLE `transaction_extension`  (
  `member_id` bigint NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  INDEX `reinvest_pengguna_id_fkey`(`member_id`) USING BTREE,
  INDEX `reinvest_ibfk_1`(`transaction_id`) USING BTREE,
  CONSTRAINT `transaction_extension_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transaction_extension_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_extension
-- ----------------------------

-- ----------------------------
-- Table structure for transaction_income
-- ----------------------------
DROP TABLE IF EXISTS `transaction_income`;
CREATE TABLE `transaction_income`  (
  `transaction_income_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_income_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_income_amount` decimal(65, 2) NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  INDEX `pendapatan_ibfk_1`(`transaction_id`) USING BTREE,
  CONSTRAINT `transaction_income_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_income
-- ----------------------------
INSERT INTO `transaction_income` VALUES ('Buy 02 PINs by fajar@gmail.com', 'Pin', 6.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220431441613968304145', '2021-02-22 04:31:44', '2021-02-22 04:31:44');
INSERT INTO `transaction_income` VALUES ('Buy 2 PINs by fajar@gmail.com', 'Pin', 6.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220435561613968556511', '2021-02-22 04:35:56', '2021-02-22 04:35:56');
INSERT INTO `transaction_income` VALUES ('Buy 10 PINs by fajar@gmail.com', 'Pin', 30.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220437521613968672475', '2021-02-22 04:37:52', '2021-02-22 04:37:52');

-- ----------------------------
-- Table structure for transaction_payment
-- ----------------------------
DROP TABLE IF EXISTS `transaction_payment`;
CREATE TABLE `transaction_payment`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `from_currency` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entered_amount` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_currency` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_id` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_payment
-- ----------------------------
INSERT INTO `transaction_payment` VALUES (2, 'andifajarlah@gmail.com', 'ETH', '10', 'ETH', '10.00000000', 'CPFB1GXSOKSJVSST5AEBDAGLL0', 'https://www.coinpayments.net/index.php?cmd=status&id=CPFB1GXSOKSJVSST5AEBDAGLL0&key=48f1f184cc4a7f1f90f8a690f5dfa826', 'initilaized', '2021-02-03 12:33:56', '2021-02-03 12:33:56');

-- ----------------------------
-- Table structure for transaction_pin
-- ----------------------------
DROP TABLE IF EXISTS `transaction_pin`;
CREATE TABLE `transaction_pin`  (
  `transaction_pin_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_pin_amount` int NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  INDEX `pin_pengguna_id_fkey`(`member_id`) USING BTREE,
  INDEX `pin_ibfk_1`(`transaction_id`) USING BTREE,
  CONSTRAINT `transaction_pin_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaction_pin_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_pin
-- ----------------------------
INSERT INTO `transaction_pin` VALUES ('Buy 02 PINs', 2, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220431441613968304145', 1, '2021-02-22 04:31:44', '2021-02-22 04:31:44');
INSERT INTO `transaction_pin` VALUES ('Buy 2 PINs', 2, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220435561613968556511', 1, '2021-02-22 04:35:56', '2021-02-22 04:35:56');
INSERT INTO `transaction_pin` VALUES ('Buy 10 PINs', 10, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220437521613968672475', 1, '2021-02-22 04:37:52', '2021-02-22 04:37:52');
INSERT INTO `transaction_pin` VALUES ('Member registration on behalf of Andi Fajar Nugraha', -3, 'kvPTb6YBQx-202102220116031613999763411', 1, '2021-02-22 13:16:03', '2021-02-22 13:16:03');
INSERT INTO `transaction_pin` VALUES ('Member registration on behalf of Andi Fajar Nugraha', -3, '4D2oveVHUC-202102220941091614030069324', 1, '2021-02-22 21:41:09', '2021-02-22 21:41:09');

-- ----------------------------
-- Table structure for transaction_reward
-- ----------------------------
DROP TABLE IF EXISTS `transaction_reward`;
CREATE TABLE `transaction_reward`  (
  `transaction_reward_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_reward_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_reward_amount` decimal(65, 2) NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  INDEX `bagi_hasil_pengguna_id_fkey`(`member_id`) USING BTREE,
  INDEX `transaksi_id`(`transaction_id`) USING BTREE,
  CONSTRAINT `transaction_reward_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaction_reward_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_reward
-- ----------------------------
INSERT INTO `transaction_reward` VALUES ('Member registration on behalf of Andi Fajar Nugraha', 'Referral', 200.00, 'kvPTb6YBQx-202102220116031613999763411', 1, '2021-02-22 13:16:03', '2021-02-22 13:16:03');
INSERT INTO `transaction_reward` VALUES ('Member registration on behalf of Andi Fajar Nugraha', 'Referral', 200.00, '4D2oveVHUC-202102220941091614030069324', 1, '2021-02-22 21:41:09', '2021-02-22 21:41:09');
INSERT INTO `transaction_reward` VALUES ('Exchange reward $ 100 to 0.89090909090909 LBC', 'Exchange', -100.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102230640131614062413609', 1, '2021-02-23 06:40:13', '2021-02-23 06:40:13');
INSERT INTO `transaction_reward` VALUES ('Exchange reward $ 100 to 0.89090909090909 LBC', 'Exchange', -100.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102230641361614062496801', 1, '2021-02-23 06:41:36', '2021-02-23 06:41:36');
INSERT INTO `transaction_reward` VALUES ('Exchange reward $ 100 to 0.89090909090909 LBC', 'Exchange', -100.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102230642471614062567019', 1, '2021-02-23 06:42:47', '2021-02-23 06:42:47');
INSERT INTO `transaction_reward` VALUES ('Exchange reward $ 50 to 0.43636363636364 LBC', 'Exchange', -50.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102250851351614243095352', 1, '2021-02-25 08:51:35', '2021-02-25 08:51:35');

-- ----------------------------
-- Table structure for transaction_reward_pin
-- ----------------------------
DROP TABLE IF EXISTS `transaction_reward_pin`;
CREATE TABLE `transaction_reward_pin`  (
  `transaction_reward_pin_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_reward_pin_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `transaction_reward_pin_amount` decimal(65, 2) NOT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  INDEX `bonus_pin_pengguna_id_fkey`(`member_id`) USING BTREE,
  INDEX `bonus_pin_ibfk_1`(`transaction_id`) USING BTREE,
  CONSTRAINT `transaction_reward_pin_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaction_reward_pin_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`member_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaction_reward_pin
-- ----------------------------
INSERT INTO `transaction_reward_pin` VALUES ('Buy 02 PINs by fajar@gmail.com', NULL, 14.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220431441613968304145', 1, '2021-02-22 04:31:44', '2021-02-22 04:31:44');
INSERT INTO `transaction_reward_pin` VALUES ('Buy 2 PINs by fajar@gmail.com', NULL, 14.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220435561613968556511', 1, '2021-02-22 04:35:56', '2021-02-22 04:35:56');
INSERT INTO `transaction_reward_pin` VALUES ('Buy 10 PINs by fajar@gmail.com', NULL, 70.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102220437521613968672475', 1, '2021-02-22 04:37:52', '2021-02-22 04:37:52');
INSERT INTO `transaction_reward_pin` VALUES ('Conversion reward $ 10 to 0.072727272727273 LBC', 'Conversion', -10.00, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq202102230701551614063715001', 1, '2021-02-23 07:01:55', '2021-02-23 07:01:55');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `user_nick` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `pengguna_uid`(`user_nick`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'administrator', '$2y$10$/iTYSlIju6KCIbKl2VAjY.ZPXD8XXoLqwCoTbFnYEeQZYlNjm19Xe', 'Administrator', NULL, 'F7kKqdrqEXv4xebxpuESSrQJUSt4VvTn6S', NULL, '2021-01-14 00:00:00', '2021-02-28 08:59:29', NULL);

-- ----------------------------
-- Table structure for wallet
-- ----------------------------
DROP TABLE IF EXISTS `wallet`;
CREATE TABLE `wallet`  (
  `wallet_id` bigint NOT NULL AUTO_INCREMENT,
  `wallet_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `main` tinyint(1) NOT NULL DEFAULT 1,
  `member_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`wallet_id`) USING BTREE,
  UNIQUE INDEX `wallet_wallet_kode_idx`(`wallet_address`) USING BTREE,
  INDEX `wallet_ibfk_1`(`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wallet
-- ----------------------------
INSERT INTO `wallet` VALUES (2, 'F8Jm1woE86V49u5wztimuTN4rAs8o8R8aq', 1, 1, '2021-02-20 00:00:00', '2021-02-20 00:00:00', NULL);
INSERT INTO `wallet` VALUES (3, 'FHzHgDHBPJw6Jphfs1xPfCTWHfAyiYiVe6', 1, 9, '2021-02-23 01:26:08', '2021-02-23 01:26:08', NULL);

SET FOREIGN_KEY_CHECKS = 1;
