-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 12 月 31 日 15:00
-- 服务器版本: 5.5.35
-- PHP 版本: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `shmk`
--

-- --------------------------------------------------------

--
-- 表的结构 `shmk_ad_imgs`
--

CREATE TABLE IF NOT EXISTS `shmk_ad_imgs` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `img_id` int(11) NOT NULL COMMENT '图片地址（相对）数据在picture里面',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态  0下架 1上架',
  `time` datetime NOT NULL COMMENT '最后修改的时间',
  `name` varchar(50) NOT NULL COMMENT '商品名称',
  PRIMARY KEY (`id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `shmk_ad_imgs`
--

INSERT INTO `shmk_ad_imgs` (`id`, `img_id`, `status`, `time`, `name`) VALUES
(3, 118, 1, '2018-11-23 17:32:31', '广告1'),
(7, 120, 1, '2018-11-23 18:58:50', '广告2'),
(8, 122, 1, '2018-12-04 20:51:32', '农夫山泉'),
(9, 126, 1, '2018-12-29 15:04:22', '111');

-- --------------------------------------------------------

--
-- 表的结构 `shmk_auth_group`
--

CREATE TABLE IF NOT EXISTS `shmk_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL DEFAULT '' COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `shmk_auth_group`
--

INSERT INTO `shmk_auth_group` (`id`, `module`, `type`, `title`, `description`, `status`, `rules`) VALUES
(1, 'admin', 1, '超级管理员', '超级管理员', 1, '1,2,,3,4,5,6,7,8,9,10,11'),
(4, 'admin', 1, '财务', '财务', 1, '3,7,23');

-- --------------------------------------------------------

--
-- 表的结构 `shmk_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `shmk_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`) USING BTREE,
  KEY `uid` (`uid`) USING BTREE,
  KEY `group_id` (`group_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `shmk_auth_group_access`
--

INSERT INTO `shmk_auth_group_access` (`uid`, `group_id`) VALUES
(13, 4);

-- --------------------------------------------------------

--
-- 表的结构 `shmk_auth_rule`
--

CREATE TABLE IF NOT EXISTS `shmk_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `shmk_auth_rule`
--

INSERT INTO `shmk_auth_rule` (`id`, `module`, `type`, `name`, `title`, `status`, `condition`) VALUES
(1, 'admin', 1, 'Admin/Database/index?type=export', '备份数据库', 1, ''),
(2, 'admin', 1, 'Admin/Database/index?type=import', '还原数据库', 1, ''),
(3, 'admin', 1, 'Admin/Log/cashflow', '用户账单', 1, ''),
(4, 'admin', 1, 'Admin/AuthManager/manager', '管理员', 1, ''),
(5, 'admin', 1, 'Admin/WorkOrders/cashIndex', '提现审核', -1, ''),
(6, 'admin', 1, 'Admin/Member/index', '权限管理', 1, ''),
(7, 'admin', 2, 'Admin/Index/index', '首页', 1, ''),
(8, 'admin', 1, 'Admin/Log/timingLog', '定时日志', -1, ''),
(9, 'admin', 2, 'Admin/Menu/index', '系统', -1, ''),
(10, 'admin', 2, 'Admin/Parameter/type', '设置', -1, ''),
(11, 'admin', 1, 'Admin/Menu/index', '菜单管理', 1, ''),
(12, 'admin', 1, 'Admin/AuthManager/index', '权限管理', 1, ''),
(13, 'admin', 1, 'Admin/Parameter/shop', '广告位管理', 1, ''),
(14, 'admin', 2, 'Admin/Member/index', '用户', 1, ''),
(15, 'admin', 1, 'Admin/Log/cardChangeLog', '银行卡修改记录', -1, ''),
(16, 'admin', 1, 'Admin/WorkOrders/cardChange', '修改银行卡', -1, ''),
(17, 'admin', 1, 'Admin/WorkOrders/cardChangeLog', '银行卡修改记录', -1, ''),
(18, 'admin', 1, 'Admin/AuthManager/ads.html', '广告位管理', -1, ''),
(19, 'admin', 2, 'Admin/AuthManager/index', '系统', 1, ''),
(20, 'admin', 1, 'Admin/Log/drivingrecord', '乘车记录', -1, ''),
(21, 'admin', 1, 'Admin/Log/index', '用户账单', -1, ''),
(22, 'admin', 1, 'Admin/Member/drivingrecord', '乘车记录', 1, ''),
(23, 'admin', 2, 'Admin/Log/cashflow', '账单', 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `shmk_cashflow`
--

CREATE TABLE IF NOT EXISTS `shmk_cashflow` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '条目ID',
  `account_id` int(11) NOT NULL COMMENT '市民卡号',
  `charge` decimal(10,2) NOT NULL COMMENT '交易额',
  `type` tinyint(1) NOT NULL COMMENT '交易类型，0：充值，1：提现 ， 2：支付',
  `paytype` tinyint(1) NOT NULL COMMENT '-1 无 0 零钱 1 银行卡',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '交易时间',
  `info` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '交易信息',
  `status` tinyint(4) DEFAULT '1' COMMENT '0未生效 1生效 -1取消',
  `money` decimal(10,2) DEFAULT NULL COMMENT '余额',
  PRIMARY KEY (`id`),
  KEY `Account_ID` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `shmk_cashflow`
--

INSERT INTO `shmk_cashflow` (`id`, `account_id`, `charge`, `type`, `paytype`, `time`, `info`, `status`, `money`) VALUES
(1, 100001, '100.00', 2, 0, '2018-11-16 00:00:00', '手机充值', 1, '1000.00'),
(2, 100001, '5.00', 2, 0, '2018-11-26 10:36:18', '乘地铁', 1, '25.00'),
(3, 100001, '3.00', 2, 0, '2018-11-26 13:36:18', '乘地铁', 1, '22.00'),
(4, 100001, '4.00', 2, 0, '2018-11-27 11:27:18', '乘地铁', 1, '18.00'),
(5, 100001, '3.00', 2, 0, '2018-11-27 15:27:28', '乘地铁', 1, '15.00'),
(6, 100001, '2.00', 2, 0, '2018-11-27 15:48:28', '乘地铁', 1, '13.00'),
(7, 100001, '5.00', 2, 0, '2018-11-27 16:28:28', '乘地铁', 1, '8.00'),
(8, 100001, '5.00', 2, 0, '2018-08-14 16:28:28', '乘地铁', 1, '3.00');

-- --------------------------------------------------------

--
-- 表的结构 `shmk_dt_record`
--

CREATE TABLE IF NOT EXISTS `shmk_dt_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL COMMENT '市民卡号',
  `in_station` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '进站',
  `out_station` varchar(50) COLLATE utf8_bin NOT NULL COMMENT '出站',
  `in_station_time` datetime DEFAULT NULL COMMENT '进站时间',
  `out_station_time` datetime DEFAULT NULL COMMENT '出站时间',
  `check` decimal(10,2) DEFAULT '0.00' COMMENT '收费',
  `status` tinyint(4) DEFAULT '1' COMMENT '0未生效 1生效 -1取消',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `shmk_dt_record`
--

INSERT INTO `shmk_dt_record` (`id`, `account_id`, `in_station`, `out_station`, `in_station_time`, `out_station_time`, `check`, `status`) VALUES
(1, 100001, '杭州东', '文泽路', '2018-11-06 10:27:00', '2018-11-26 10:36:18', '5.00', 1),
(2, 100001, '文泽路', '金沙湖', '2018-11-06 10:27:00', '2018-11-26 13:36:18', '3.00', 1),
(3, 100001, '金沙湖', '龙翔桥', '2018-11-27 10:27:00', '2018-11-27 11:27:18', '4.00', 1),
(4, 100001, '龙翔桥', '彭埠', '2018-11-27 13:38:00', '2018-11-27 15:27:28', '3.00', 1),
(5, 100001, '彭埠', '杭州东', '2018-11-27 15:38:00', '2018-11-27 15:48:28', '2.00', 1),
(6, 100001, '杭州东', '文泽路', '2018-11-27 15:51:00', '2018-11-27 16:28:28', '5.00', 1),
(7, 100001, '杭州东', '文泽路', '2018-08-14 15:51:00', '2018-08-14 16:28:28', '5.00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `shmk_menu`
--

CREATE TABLE IF NOT EXISTS `shmk_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1000 ;

--
-- 转存表中的数据 `shmk_menu`
--

INSERT INTO `shmk_menu` (`id`, `title`, `pid`, `sort`, `url`, `hide`, `tip`, `group`, `is_dev`, `status`) VALUES
(4, '权限管理', 1, 0, 'AuthManager/index', 0, '', '管理员', 0, 1),
(1, '系统', 0, 1, 'AuthManager/index', 0, '', '', 0, 1),
(7, '菜单管理', 1, 3, 'Menu/index', 1, '', '系统设置', 1, 1),
(8, '备份数据库', 1, 4, 'Database/index?type=export', 0, '', '数据备份', 0, 1),
(9, '还原数据库', 1, 5, 'Database/index?type=import', 0, '', '数据备份', 0, 1),
(12, '用户账单', 3, 1, 'Log/cashflow', 0, '', '账单管理', 0, 1),
(5, '管理员', 1, 1, 'AuthManager/manager', 0, '', '管理员', 0, 1),
(10, '权限管理', 2, 1, 'Member/index', 0, '', '用户管理', 0, 1),
(2, '用户', 0, 2, 'Member/index', 0, '', '', 0, 1),
(11, '乘车记录', 2, 2, 'Member/drivingrecord', 0, '', '消费管理', 0, 1),
(6, '广告位管理', 1, 2, 'Parameter/shop', 0, '', '系统设置', 0, 1),
(0, '首页', 0, 0, 'Index/index', 0, '', '', 0, 1),
(3, '账单', 0, 3, 'Log/cashflow', 0, '', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `shmk_month`
--

CREATE TABLE IF NOT EXISTS `shmk_month` (
  `month` int(2) NOT NULL COMMENT '月份',
  PRIMARY KEY (`month`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `shmk_month`
--

INSERT INTO `shmk_month` (`month`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12);

-- --------------------------------------------------------

--
-- 表的结构 `shmk_picture`
--

CREATE TABLE IF NOT EXISTS `shmk_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=127 ;

--
-- 转存表中的数据 `shmk_picture`
--

INSERT INTO `shmk_picture` (`id`, `path`, `url`, `md5`, `sha1`, `status`, `create_time`) VALUES
(120, '/Uploads/Picture/2018-11-23/5bf791efbf86f.jpg', '', '04a7cb2e07451e9d2f8c193f25940158', '4bbe2f976ba69f94c0aa8096acee564286856a34', 1, 1542951407),
(119, '/Uploads/Picture/2018-11-23/5bf791ea727a7.jpg', '', '7c4bf7ce5475589c9b04dea845ced494', 'b8f66e2976474ff5b1cb3e22681eaa7a206ea443', 1, 1542951402),
(40, '/Uploads/Picture/2018-11-05/5be015544a4d0.jpg', '', '38bcc88bd9cdc807c89d7404681bde0d', '2b59da246f08a919016e79f7ab27e8f9f233520a', 1, 1541412611),
(118, '/Uploads/Picture/2018-11-23/5bf791e459f03.jpg', '', 'f6ae740df57bb411b2c7d1d644d5dfe9', 'd78f1b3b929979e8a5beea16e873c8525a753af0', 1, 1542951396),
(121, '/Uploads/Picture/2018-12-04/5c06510a81c51.jpg', '', 'c34054e6de1e825b2b1825674e8a983d', '64f5b066a73a0efb748f4e8d7a96fa401b0288d6', 1, 1543917834),
(122, '/Uploads/Picture/2018-12-04/5c0652c1636d5.jpg', '', '14b263a7f5d8f9149b6db6132c7ba65f', 'd5ac4f4f601b0ad926c9be5dfa9b859f487161fd', 1, 1543918273),
(123, '/Uploads/Picture/2018-12-11/5c0f7fc1a5326.png', '', 'a89a1ca4f36638a93580126117c72af6', '702e3394225dde6de8dd6e96fb74f8fab3d4cc47', 1, 1544519617),
(124, '/Uploads/Picture/2018-12-28/5c261d4ae8626.png', '', 'e5302648ab7e02ea7ff49f215f52a6c1', 'e7ced8e30f60ee38d50c0a1146e0d329914c6919', 1, 1546001738),
(125, '/Uploads/Picture/2018-12-28/5c262f11eff7b.png', '', '1cc52396538799d62636feae6a413f05', '31d9fd94784055cd9bef25ea26d04a0b9d83de38', 1, 1546006289),
(126, '/Uploads/Picture/2018-12-29/5c271bf1dbfbe.png', '', 'fbcdced1ec63dc5e60ca76d01add5d2d', 'c68ad2e02b5559306189df668a4b498ce1cf4677', 1, 1546066929);

-- --------------------------------------------------------

--
-- 表的结构 `shmk_ucenter_member`
--

CREATE TABLE IF NOT EXISTS `shmk_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL DEFAULT '' COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  `face` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '头像',
  `realname` char(32) DEFAULT NULL COMMENT '姓名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `shmk_ucenter_member`
--

INSERT INTO `shmk_ucenter_member` (`id`, `username`, `password`, `email`, `mobile`, `reg_time`, `reg_ip`, `last_login_time`, `last_login_ip`, `update_time`, `status`, `face`, `realname`) VALUES
(1, 'admin', '4e3988009121972e1b919354e26a1f10', 'qianjianqiang@jiehuolou.com', '', 1482481615, 0, 1546077673, 0, 1482481615, 1, 1482481615, '超级管理员'),
(13, 'caiwu01', '4e3988009121972e1b919354e26a1f10', '', '', 0, 0, 1545977358, 0, 0, 1, 0, '小明'),
(21, 'sssssss', '7a7a91f137336f1b5206ec692d4f7763', '', '', 0, 0, 0, 0, 0, 1, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `shmk_user`
--

CREATE TABLE IF NOT EXISTS `shmk_user` (
  `shmk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '市民卡号',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '用户姓名',
  `tel` char(14) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '手机号码',
  `avatar` char(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '\\Uploads\\Picture\\head-default\\1.png' COMMENT '用户头像',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '用户密码',
  `cardnum` char(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '银行卡号',
  `status` tinyint(1) DEFAULT '1' COMMENT '账号状态',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `lastlogin_time` datetime DEFAULT NULL COMMENT '最后一次登录时间',
  `nick` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '昵称',
  `money` decimal(10,2) DEFAULT '0.00' COMMENT '余额',
  `idcard` char(18) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '身份证号',
  `pay_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '支付密码',
  PRIMARY KEY (`shmk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100002 ;

--
-- 转存表中的数据 `shmk_user`
--

INSERT INTO `shmk_user` (`shmk_id`, `name`, `tel`, `avatar`, `password`, `cardnum`, `status`, `create_time`, `lastlogin_time`, `nick`, `money`, `idcard`, `pay_password`) VALUES
(100001, '咕咕', '15755254565', '/Uploads/Picture/head/1.jpeg', '123456', '6461346546465', 0, '2018-11-08 00:00:00', '2018-11-16 00:00:00', '小咕', '10000.00', '33108545659595', '111');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
