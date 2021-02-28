/*
 Navicat Premium Data Transfer

 Source Server         : Local MySQL
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : luckybit

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 15/01/2021 08:49:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anggota
-- ----------------------------
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `anggota_id` bigint NOT NULL,
  `anggota_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_kata_sandi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `anggota_ktp` smallint NOT NULL,
  `anggota_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `anggota_alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `anggota_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_jaringan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `anggota_parent` bigint DEFAULT NULL,
  `anggota_parent_posisi` smallint DEFAULT NULL,
  `paket_id` bigint DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `peringkat_id` bigint DEFAULT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`anggota_id`),
  UNIQUE KEY `anggota_uid` (`anggota_uid`,`anggota_email`) USING BTREE,
  KEY `anggota_paket_id_fkey` (`paket_id`),
  KEY `anggota_peringkat_id_fkey` (`peringkat_id`),
  CONSTRAINT `anggota_paket_id_fkey` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`paket_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `anggota_peringkat_id_fkey` FOREIGN KEY (`peringkat_id`) REFERENCES `peringkat` (`peringkat_id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for bagi_hasil
-- ----------------------------
DROP TABLE IF EXISTS `bagi_hasil`;
CREATE TABLE `bagi_hasil` (
  `bagi_hasil_id` bigint NOT NULL,
  `bagi_hasil_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagi_hasil_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagi_hasil_debit` decimal(65,30) NOT NULL,
  `bagi_hasil_kredit` decimal(65,30) NOT NULL,
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`bagi_hasil_id`),
  KEY `bagi_hasil_pengguna_id_fkey` (`anggota_id`),
  KEY `transaksi_id` (`transaksi_id`),
  CONSTRAINT `bagi_hasil_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bagi_hasil_pengguna_id_fkey` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for bonus_pin
-- ----------------------------
DROP TABLE IF EXISTS `bonus_pin`;
CREATE TABLE `bonus_pin` (
  `bonus_pin_id` bigint NOT NULL AUTO_INCREMENT,
  `bonus_pin_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonus_pin_debit` decimal(65,30) NOT NULL,
  `bonus_pin_kredit` decimal(65,30) NOT NULL,
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`bonus_pin_id`),
  KEY `bonus_pin_pengguna_id_fkey` (`anggota_id`),
  KEY `bonus_pin_ibfk_1` (`transaksi_id`),
  CONSTRAINT `bonus_pin_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bonus_pin_pengguna_id_fkey` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for hari_besar
-- ----------------------------
DROP TABLE IF EXISTS `hari_besar`;
CREATE TABLE `hari_besar` (
  `hari_besar_id` bigint NOT NULL AUTO_INCREMENT,
  `hari_besar_tanggal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari_besar_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`hari_besar_id`),
  UNIQUE KEY `hari_besar_hari_besar_tanggal_idx` (`hari_besar_tanggal`) USING BTREE,
  KEY `pengguna_id` (`pengguna_id`),
  CONSTRAINT `hari_besar_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`pengguna_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Table structure for kurs
-- ----------------------------
DROP TABLE IF EXISTS `kurs`;
CREATE TABLE `kurs` (
  `kurs_id` bigint NOT NULL,
  `kurs_harga` decimal(65,30) NOT NULL,
  `kurs_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`kurs_id`),
  KEY `pengguna_id` (`pengguna_id`),
  CONSTRAINT `kurs_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`pengguna_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_id` bigint NOT NULL,
  PRIMARY KEY (`permission_id`,`model_type`,`pengguna_id`) USING BTREE,
  KEY `model_has_permissions_model_id_model_type_index` (`model_type`) USING BTREE,
  KEY `izin_pengguna_fk` (`pengguna_id`) USING BTREE,
  CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `model_has_permissions_ibfk_2` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_id` bigint NOT NULL,
  PRIMARY KEY (`role_id`,`model_type`,`pengguna_id`) USING BTREE,
  KEY `model_has_roles_model_id_model_type_index` (`model_type`) USING BTREE,
  KEY `level_pengguna_fk` (`pengguna_id`) USING BTREE,
  CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `model_has_roles_ibfk_2` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`pengguna_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for paket
-- ----------------------------
DROP TABLE IF EXISTS `paket`;
CREATE TABLE `paket` (
  `paket_id` bigint NOT NULL,
  `paket_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `paket_harga` decimal(65,30) NOT NULL,
  `paket_pin` smallint NOT NULL,
  `pengguna_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`paket_id`),
  KEY `pengguna_id` (`pengguna_id`),
  CONSTRAINT `paket_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`pengguna_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for pendapatan
-- ----------------------------
DROP TABLE IF EXISTS `pendapatan`;
CREATE TABLE `pendapatan` (
  `pendapatan_id` bigint NOT NULL AUTO_INCREMENT,
  `pendapatan_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pendapatan_jumlah` decimal(65,30) NOT NULL,
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`pendapatan_id`),
  KEY `pendapatan_ibfk_1` (`transaksi_id`),
  CONSTRAINT `pendapatan_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `pengguna_id` bigint NOT NULL AUTO_INCREMENT,
  `pengguna_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_kata_sandi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_nama` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_foto` text COLLATE utf8mb4_unicode_ci,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`pengguna_id`),
  UNIQUE KEY `pengguna_uid` (`pengguna_uid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
BEGIN;
INSERT INTO `pengguna` VALUES (1, 'administrator', '$2y$10$BVCuZEX/e9kZb10munTfcOCur5M6.tksk.R3cINYNhXzaGlCe3d36', 'Administrator', NULL, NULL, '2021-01-14 00:00:00', '2021-01-14 21:08:57', NULL);
COMMIT;

-- ----------------------------
-- Table structure for peringkat
-- ----------------------------
DROP TABLE IF EXISTS `peringkat`;
CREATE TABLE `peringkat` (
  `peringkat_id` bigint NOT NULL AUTO_INCREMENT,
  `peringkat_nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `peringkat_omset_min` decimal(65,30) NOT NULL,
  `peringkat_omset_max` decimal(65,30) DEFAULT NULL,
  `peringkat_bonus` decimal(65,30) NOT NULL,
  `pengguna_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`peringkat_id`),
  KEY `pengguna_id` (`pengguna_id`),
  CONSTRAINT `peringkat_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`pengguna_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `permissions_name_unique` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for pin
-- ----------------------------
DROP TABLE IF EXISTS `pin`;
CREATE TABLE `pin` (
  `pin_id` bigint NOT NULL AUTO_INCREMENT,
  `pin_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_debit` decimal(65,30) NOT NULL,
  `pin_kredit` decimal(65,30) NOT NULL,
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`pin_id`),
  KEY `pin_pengguna_id_fkey` (`anggota_id`),
  KEY `pin_ibfk_1` (`transaksi_id`),
  CONSTRAINT `pin_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pin_pengguna_id_fkey` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for reinvest
-- ----------------------------
DROP TABLE IF EXISTS `reinvest`;
CREATE TABLE `reinvest` (
  `reinvest_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kurs_id` bigint NOT NULL,
  `anggota_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`reinvest_id`),
  KEY `reinvest_kurs_id_fkey` (`kurs_id`),
  KEY `reinvest_pengguna_id_fkey` (`anggota_id`),
  CONSTRAINT `reinvest_kurs_id_fkey` FOREIGN KEY (`kurs_id`) REFERENCES `kurs` (`kurs_id`),
  CONSTRAINT `reinvest_pengguna_id_fkey` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `roles_name_unique` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES (1, 'super-admin', 'web', '2019-04-24 03:38:59', '2019-04-24 03:38:59');
INSERT INTO `roles` VALUES (2, 'user', 'web', '2019-04-24 03:38:59', '2019-04-24 03:38:59');
INSERT INTO `roles` VALUES (3, 'guest', 'web', '2019-04-24 03:38:59', '2019-04-24 03:38:59');
COMMIT;

-- ----------------------------
-- Table structure for saldo
-- ----------------------------
DROP TABLE IF EXISTS `saldo`;
CREATE TABLE `saldo` (
  `saldo_id` bigint NOT NULL AUTO_INCREMENT,
  `saldo_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `saldo_debit` decimal(65,30) NOT NULL,
  `saldo_kredit` decimal(65,30) NOT NULL,
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`saldo_id`),
  KEY `saldo_wallet_id_fkey` (`wallet_id`),
  KEY `saldo_transaksi_id_fkey` (`transaksi_id`),
  CONSTRAINT `saldo_transaksi_id_fkey` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `saldo_wallet_id_fkey` FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`wallet_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `transaksi_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaksi_keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for wallet
-- ----------------------------
DROP TABLE IF EXISTS `wallet`;
CREATE TABLE `wallet` (
  `wallet_id` bigint NOT NULL AUTO_INCREMENT,
  `wallet_kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`wallet_id`),
  UNIQUE KEY `wallet_wallet_kode_idx` (`wallet_kode`) USING BTREE,
  KEY `wallet_ibfk_1` (`anggota_id`),
  CONSTRAINT `wallet_ibfk_1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for withdraw
-- ----------------------------
DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE `withdraw` (
  `withdraw_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `withdraw_jumlah` decimal(65,30) NOT NULL,
  `kurs_id` bigint NOT NULL,
  `wallet_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_at` timestamp DEFAULT NULL,
  PRIMARY KEY (`withdraw_id`),
  KEY `wallet_id` (`wallet_id`),
  KEY `kurs_id` (`kurs_id`),
  CONSTRAINT `withdraw_ibfk_1` FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`wallet_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `withdraw_ibfk_2` FOREIGN KEY (`kurs_id`) REFERENCES `kurs` (`kurs_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
