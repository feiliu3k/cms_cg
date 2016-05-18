/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.13-MariaDB : Database - cms_cg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cms_cg` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `cms_cg`;

/*Table structure for table `chaocomment` */

CREATE TABLE `chaocomment` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipid` int(10) unsigned NOT NULL,
  `comment` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localrecord` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ctime` timestamp NULL DEFAULT NULL,
  `delflag` int(11) NOT NULL DEFAULT '0',
  `verifyflag` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cid`),
  KEY `chaocomment_tipid_index` (`tipid`),
  KEY `chaocomment_ctime_index` (`ctime`),
  KEY `chaocomment_delflag_index` (`delflag`),
  KEY `chaocomment_verifyflag_index` (`verifyflag`),
  CONSTRAINT `chaocomment_tipid_foreign` FOREIGN KEY (`tipid`) REFERENCES `chaosky` (`tipid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chaocomment` */

/*Table structure for table `chaodep` */

CREATE TABLE `chaodep` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `depname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '单位名称',
  `depid` int(4) DEFAULT NULL COMMENT '单位序号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chaodep` */

insert  into `chaodep`(`id`,`depname`,`depid`) values (1,'汕头城管',1),(5,'橄榄台',2);

/*Table structure for table `chaopro` */

CREATE TABLE `chaopro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proid` int(11) NOT NULL,
  `proname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proimg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `depid` int(11) DEFAULT '1' COMMENT '关联表chaodep的id项',
  `rebellion` int(11) DEFAULT '1' COMMENT '是否有报料功能（1为无，2为有）',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chaopro` */

insert  into `chaopro`(`id`,`proid`,`proname`,`proimg`,`created_at`,`updated_at`,`depid`,`rebellion`) values (7,7,'城管呾你知','','0000-00-00 00:00:00','2016-05-13 14:57:02',1,NULL),(8,8,'图说城管',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(9,9,'城管动态',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(10,10,'通告公告',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(11,11,'法律法规',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',1,1),(12,12,'政民互动','','2016-05-12 15:22:00','2016-05-12 15:22:00',1,2),(13,13,'ABC','','2016-05-17 15:26:25','2016-05-17 15:34:13',5,2);

/*Table structure for table `chaosky` */

CREATE TABLE `chaosky` (
  `tipid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tiptitle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipimg1` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipcontent` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `stime` timestamp NULL DEFAULT NULL,
  `postflag` int(11) NOT NULL DEFAULT '0',
  `posttime` timestamp NULL DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `post_user` int(10) unsigned DEFAULT NULL,
  `readnum` int(11) DEFAULT '0',
  `proid` int(10) unsigned NOT NULL,
  `tipvideo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commentflag` int(11) NOT NULL DEFAULT '0',
  `delflag` int(11) NOT NULL DEFAULT '0',
  `draftflag` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tipid`),
  KEY `chaosky_stime_index` (`stime`),
  KEY `chaosky_posttime_index` (`posttime`),
  KEY `chaosky_userid_index` (`userid`),
  KEY `chaosky_post_user_index` (`post_user`),
  KEY `chaosky_proid_index` (`proid`),
  KEY `chaosky_delflag_index` (`delflag`),
  KEY `chaosky_draftflag_index` (`draftflag`),
  CONSTRAINT `chaosky_post_user_foreign` FOREIGN KEY (`post_user`) REFERENCES `users` (`id`),
  CONSTRAINT `chaosky_proid_foreign` FOREIGN KEY (`proid`) REFERENCES `chaopro` (`id`),
  CONSTRAINT `chaosky_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=455 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chaosky` */

insert  into `chaosky`(`tipid`,`tiptitle`,`tipimg1`,`tipcontent`,`stime`,`postflag`,`posttime`,`userid`,`post_user`,`readnum`,`proid`,`tipvideo`,`commentflag`,`delflag`,`draftflag`,`created_at`,`updated_at`) values (454,'2323','CEXwz0NHqsfi3JTS.jpg','<p><span style=\"font-family: 微软雅黑;\"><span style=\"font-family: 微软雅黑;\"></span>23232323pp</span><br/></p>','2016-05-12 15:56:33',0,NULL,1,NULL,1,13,'',0,0,0,'2016-05-12 15:56:48','2016-05-17 16:38:53');

/*Table structure for table `jrsx` */

CREATE TABLE `jrsx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '姓名',
  `pic` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  `dh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '电话',
  `comments` text COLLATE utf8_unicode_ci COMMENT '内容',
  `postdate` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '上传时间',
  `delflag` int(11) DEFAULT '0' COMMENT '是否删除（0为未删除，-1为删除）',
  `f1` int(11) DEFAULT '1' COMMENT '新闻报料为1，随手拍为2',
  `ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ip地址',
  `localrecord` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'localStorage',
  PRIMARY KEY (`id`),
  KEY `f1` (`f1`),
  KEY `postdate` (`postdate`),
  KEY `delflag` (`delflag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jrsx` */

/*Table structure for table `jrsxfav` */

CREATE TABLE `jrsxfav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jrsxid` int(11) DEFAULT NULL COMMENT '关联表jrsx的id',
  `userid` int(11) DEFAULT NULL COMMENT '关联用户表id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jrsxfav` */

/*Table structure for table `jrsxremark` */

CREATE TABLE `jrsxremark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jrsxid` int(11) DEFAULT NULL COMMENT '关联表jrsx的id',
  `remark` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '备注',
  `userid` int(11) DEFAULT NULL COMMENT '关联用户表id',
  `rtime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '备注时间',
  PRIMARY KEY (`id`),
  KEY `jrsxid` (`jrsxid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `jrsxremark` */

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`migration`,`batch`) values ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_04_07_090128_create_chao_pros_table',1),('2016_04_07_094013_create_chao_skies_table',1),('2016_04_07_143255_create_chao_comments_table',1),('2016_04_12_005533_create_tags_table',2),('2016_04_12_011105_create_chaosky_tag_pivot',2),('2016_04_24_230412_create_permissions_and_roles',3);

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values (3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(15,2),(16,2),(16,3),(17,2),(17,3),(18,2),(18,3),(19,2),(19,3),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(29,3),(30,2),(30,3),(31,2),(31,3),(32,2),(32,3);

/*Table structure for table `permissions` */

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`label`,`description`,`created_at`,`updated_at`) values (3,'edit-user','edit-user','edit-user','2016-04-26 09:30:22','2016-04-26 09:30:22'),(4,'create-user','create-user','create-user','2016-04-26 09:30:44','2016-04-26 09:30:44'),(5,'delete-user','delete-user','delete-user','2016-04-26 09:31:06','2016-04-26 09:31:06'),(6,'list-user','list-user','list-user','2016-04-26 09:31:22','2016-04-26 09:31:22'),(7,'list-role','list-role','list-role','2016-04-26 09:31:40','2016-04-26 09:31:40'),(8,'create-role','create-role','create-role','2016-04-26 09:31:58','2016-04-26 09:31:58'),(9,'edit-role','edit-role','edit-role','2016-04-26 09:32:13','2016-04-26 09:32:13'),(10,'delete-role','delete-role','delete-role','2016-04-26 09:32:28','2016-04-26 09:32:28'),(11,'list-permission','list-permission','list-permission','2016-04-26 09:33:10','2016-04-26 09:33:10'),(12,'create-permission','create-permission','create-permission','2016-04-26 09:33:28','2016-04-26 09:33:28'),(13,'edit-permission','edit-permission','edit-permission','2016-04-26 09:33:45','2016-04-26 09:33:45'),(15,'delete-permission','delete-permission','delete-permission','2016-04-26 09:35:01','2016-04-26 09:35:01'),(16,'create-post','create-post','create-post','2016-04-26 09:41:26','2016-04-26 09:41:26'),(17,'edit-post','edit-post','edit-post','2016-04-26 09:41:42','2016-04-26 09:41:42'),(18,'delete-post','delete-post','delete-post','2016-04-26 09:42:04','2016-04-26 09:42:04'),(19,'list-post','list-post','list-post','2016-04-26 09:42:17','2016-04-26 09:42:17'),(20,'upload','upload','upload','2016-04-26 09:42:37','2016-04-26 09:42:37'),(21,'list-pro','list-pro','list-pro','2016-04-26 09:42:50','2016-04-26 09:42:50'),(22,'create-pro','create-pro','create-pro','2016-04-26 09:43:38','2016-04-26 09:43:38'),(23,'edit-pro','edit-pro','edit-pro','2016-04-26 09:43:52','2016-04-26 09:43:52'),(24,'delete-pro','delete-pro','delete-pro','2016-04-26 09:44:05','2016-04-26 09:44:05'),(25,'list-comment','list-comment','list-comment','2016-04-26 09:44:24','2016-04-26 09:44:24'),(26,'create-comment','create-comment','create-comment','2016-04-26 09:44:40','2016-04-26 09:44:40'),(27,'edit-comment','edit-comment','edit-comment','2016-04-26 09:44:53','2016-04-26 09:44:53'),(28,'delete-comment','delete-comment','delete-comment','2016-04-26 09:45:14','2016-04-26 09:45:14'),(29,'list-jrsx','list-jrsx','list-jrsx','2016-05-13 09:45:38','2016-05-13 09:45:38'),(30,'create-jrsx','create-jrsx','create-jrsx','2016-05-13 09:45:55','2016-05-13 09:45:55'),(31,'edit-jrsx','edit-jrsx','edit-jrsx','2016-05-13 09:46:07','2016-05-13 09:46:07'),(32,'delete-jrsx','delete-jrsx','delete-jrsx','2016-05-13 09:46:22','2016-05-13 09:46:22');

/*Table structure for table `pro_user` */

CREATE TABLE `pro_user` (
  `user_id` int(10) unsigned NOT NULL,
  `pro_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`pro_id`,`user_id`),
  KEY `pro_user_user_id_foreign` (`user_id`),
  CONSTRAINT `pro_user_pro_id_foreign` FOREIGN KEY (`pro_id`) REFERENCES `chaopro` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pro_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pro_user` */

insert  into `pro_user`(`user_id`,`pro_id`) values (1,7),(2,7),(1,8),(2,8),(1,9),(2,9),(1,10),(2,10),(2,11),(1,12),(2,12),(1,13);

/*Table structure for table `role_user` */

CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`user_id`,`role_id`) values (1,2),(1,3);

/*Table structure for table `roles` */

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`label`,`description`,`created_at`,`updated_at`) values (2,'admin','超级管理员','超级管理员','2016-04-25 10:47:23','2016-04-25 10:47:23'),(3,'editor','editor','editor','2016-04-26 09:46:38','2016-04-26 09:46:38');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dept_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_deptid` (`dept_id`),
  CONSTRAINT `fk_deptid` FOREIGN KEY (`dept_id`) REFERENCES `chaodep` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`,`dept_id`) values (1,'admin','admin@olive.cn','$2y$10$5pLo/xfwLIq6OwmltgM30eCCr7HgD4acQt9xkR6QFTkmel7p2o3sO','nYulCsLBhdxEX5YIq2m4KdgBFGscNJUr57xPfUppvciv3DoJgeISvy9Qy0g2','2016-04-11 12:42:54','2016-05-17 14:19:25',5),(2,'user','uesr@qq.com','$2y$10$raFRlMQ4ILwdqQ72UGIO1OwBXq6RmjwKDYgfT8g7ukXqKx4h.zTpi',NULL,'2016-04-26 09:48:05','2016-05-17 14:17:16',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
