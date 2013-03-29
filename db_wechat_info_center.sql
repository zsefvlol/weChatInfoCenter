/*
SQLyog v10.2 
MySQL - 5.5.8-log : Database - db_wechat_info_center
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_wechat_info_center` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `db_wechat_info_center`;

/*Table structure for table `tb_message_0` */

CREATE TABLE `tb_message_0` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_1` */

CREATE TABLE `tb_message_1` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_2` */

CREATE TABLE `tb_message_2` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_3` */

CREATE TABLE `tb_message_3` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_4` */

CREATE TABLE `tb_message_4` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_5` */

CREATE TABLE `tb_message_5` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_6` */

CREATE TABLE `tb_message_6` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_7` */

CREATE TABLE `tb_message_7` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_8` */

CREATE TABLE `tb_message_8` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_message_9` */

CREATE TABLE `tb_message_9` (
  `msgId` bigint(64) unsigned NOT NULL,
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `funcType` tinyint(3) unsigned NOT NULL,
  `keyWord` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`msgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tb_raw_log` */

CREATE TABLE `tb_raw_log` (
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `msgId` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `rawData` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tb_response_log` (
  `fromUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `toUserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createTime` int(11) unsigned NOT NULL,
  `msgType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `msgId` varchar(65) COLLATE utf8_unicode_ci NOT NULL,
  `responseData` varchar(5000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
