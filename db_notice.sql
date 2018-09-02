-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-09-02 15:45:47
-- 服务器版本： 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_notice`
--

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cusId` bigint(20) NOT NULL AUTO_INCREMENT,
  `wxName` varchar(50) NOT NULL,
  `wxOpenId` varchar(100) NOT NULL,
  `wxPhone` varchar(20) NOT NULL,
  `createDate` int(11) DEFAULT NULL,
  `loginDate` int(11) NOT NULL,
  `satus` int(11) NOT NULL DEFAULT '1',
  `field1` varchar(10) DEFAULT NULL,
  `wxId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cusId`),
  UNIQUE KEY `wxOpenId` (`wxOpenId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`cusId`, `wxName`, `wxOpenId`, `wxPhone`, `createDate`, `loginDate`, `satus`, `field1`, `wxId`) VALUES
(2, 'test', '123456789', '123456', NULL, 1535898831, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `formId` int(11) NOT NULL AUTO_INCREMENT,
  `noticeId` varchar(100) NOT NULL,
  `customerId` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `sendDate` timestamp NOT NULL,
  `sendNum` int(11) NOT NULL DEFAULT '0',
  `field1` int(11) NOT NULL,
  PRIMARY KEY (`formId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `noteId` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `recCustomerId` varchar(100) NOT NULL,
  `recCustomerPhone` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `sendDate` timestamp NULL DEFAULT NULL,
  `sendNum` int(11) NOT NULL DEFAULT '0',
  `field1` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

DROP TABLE IF EXISTS `record`;
CREATE TABLE IF NOT EXISTS `record` (
  `recordId` bigint(20) NOT NULL AUTO_INCREMENT,
  `createDate` int(11) NOT NULL,
  `endDate` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `statusId` int(11) NOT NULL,
  `message` text NOT NULL,
  `customer` varchar(50) NOT NULL,
  `fields` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`recordId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `record_option`
--

DROP TABLE IF EXISTS `record_option`;
CREATE TABLE IF NOT EXISTS `record_option` (
  `optionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `recordId` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `operator` varchar(50) NOT NULL,
  `field1` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`optionId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `system_form`
--

DROP TABLE IF EXISTS `system_form`;
CREATE TABLE IF NOT EXISTS `system_form` (
  `formId` varchar(100) NOT NULL,
  `formTitle` varchar(50) NOT NULL,
  `sendDate` timestamp NOT NULL,
  `content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `field1` varchar(10) NOT NULL,
  PRIMARY KEY (`formId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userId` bigint(20) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loginDate` timestamp NULL DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'administor',
  `status` int(11) NOT NULL DEFAULT '1',
  `field1` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
