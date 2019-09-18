-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Aug 28, 2015, 10:39 AM
-- 伺服器版本: 6.0.4
-- PHP 版本: 6.0.0-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `xanxus`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `bag`
-- 

CREATE TABLE `bag` (
  `id` smallint(9) DEFAULT NULL,
  `relatedID` smallint(9) DEFAULT NULL,
  `t_number` int(11) NOT NULL AUTO_INCREMENT COMMENT '序號',
  `t_condate` date DEFAULT NULL COMMENT '發包日期',
  `t_project` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '專案別',
  `t_projector` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '發案者',
  `t_category` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '委外類別',
  `t_outsourcing_content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci COMMENT '委外工作內容',
  `t_outpeople` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '外包人員',
  `t_outmoney` int(20) DEFAULT NULL COMMENT '外包金額',
  `t_installment` int(20) DEFAULT NULL COMMENT '分期',
  `t_proportion` float(5,2) DEFAULT NULL COMMENT '比例',
  `t_installment_mon` float(7,2) DEFAULT NULL COMMENT '分期金額',
  `t_debit` int(20) DEFAULT NULL COMMENT '扣款',
  `t_debit_reason` char(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL COMMENT '扣款事由',
  `t_paidmon` int(20) DEFAULT NULL COMMENT '實付金額',
  `t_subdate` date DEFAULT NULL COMMENT '交件日期',
  `t_reqdate` date DEFAULT NULL COMMENT '請款日期',
  `t_paydate` date DEFAULT NULL COMMENT '付款日期',
  `t_receipt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci COMMENT '請款憑據',
  `t_remark` text COLLATE utf8_unicode_ci COMMENT '備註',
  PRIMARY KEY (`t_number`),
  KEY `caseid` (`id`),
  KEY `relatedID` (`relatedID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=97 ;

-- 
-- 列出以下資料庫的數據： `bag`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `bag_data_store`
-- 

CREATE TABLE `bag_data_store` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `store_category` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=54 ;

-- 
-- 列出以下資料庫的數據： `bag_data_store`
-- 

INSERT INTO `bag_data_store` VALUES (1, '無');
INSERT INTO `bag_data_store` VALUES (2, '影音後製');
INSERT INTO `bag_data_store` VALUES (3, '內容專家');
INSERT INTO `bag_data_store` VALUES (4, '腳本設計');
INSERT INTO `bag_data_store` VALUES (5, '程式設計');
INSERT INTO `bag_data_store` VALUES (6, '錄影錄音');
INSERT INTO `bag_data_store` VALUES (7, '動畫製作');
INSERT INTO `bag_data_store` VALUES (8, '視覺設計');
INSERT INTO `bag_data_store` VALUES (53, '其他項目');

-- --------------------------------------------------------

-- 
-- 資料表格式： `case`
-- 

CREATE TABLE `case` (
  `id` smallint(9) NOT NULL AUTO_INCREMENT,
  `relatedID` smallint(9) NOT NULL,
  `caseid` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relatedID` (`relatedID`),
  KEY `caseid` (`caseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=223 ;

-- 
-- 列出以下資料庫的數據： `case`
-- 


-- --------------------------------------------------------

-- 
-- 資料表格式： `member_table`
-- 

CREATE TABLE `member_table` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `lv` int(20) NOT NULL,
  `username` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` char(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=67 ;

-- 
-- 列出以下資料庫的數據： `member_table`
-- 

INSERT INTO `member_table` VALUES (41, 1, 'a1', '123');
INSERT INTO `member_table` VALUES (42, 2, 'a2', '123');
INSERT INTO `member_table` VALUES (43, 3, 'a3', '123');
INSERT INTO `member_table` VALUES (44, 4, 'a4', '123');

-- --------------------------------------------------------

-- 
-- 資料表格式： `year`
-- 

CREATE TABLE `year` (
  `relatedID` smallint(9) NOT NULL AUTO_INCREMENT,
  `yearid` char(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`relatedID`),
  KEY `yearid` (`yearid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC AUTO_INCREMENT=106 ;

-- 
-- 列出以下資料庫的數據： `year`
-- 


-- 
-- 備份資料表限制
-- 

-- 
-- 資料表限制 `bag`
-- 
ALTER TABLE `bag`
  ADD CONSTRAINT `bag_ibfk_1` FOREIGN KEY (`id`) REFERENCES `case` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- 資料表限制 `case`
-- 
ALTER TABLE `case`
  ADD CONSTRAINT `case_ibfk_1` FOREIGN KEY (`relatedID`) REFERENCES `year` (`relatedID`) ON DELETE CASCADE ON UPDATE CASCADE;
