-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 11 月 1 日 18:51
-- 服务器版本: 5.1.63
-- PHP 版本: 5.2.17p1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wall2`
--

-- --------------------------------------------------------

--
-- 表的结构 `weixin_admin`
--

CREATE TABLE IF NOT EXISTS `weixin_admin` (
  `user` text NOT NULL,
  `pwd` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_admin`
--

INSERT INTO `weixin_admin` (`user`, `pwd`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `weixin_cookie`
--

CREATE TABLE IF NOT EXISTS `weixin_cookie` (
  `cookie` text NOT NULL,
  `cookies` text NOT NULL,
  `token` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `weixin_cookie`
--

INSERT INTO `weixin_cookie` (`cookie`, `cookies`, `token`, `id`) VALUES
('', '', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `weixin_flag`
--

CREATE TABLE IF NOT EXISTS `weixin_flag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` varchar(255) NOT NULL,
  `flag` int(11) NOT NULL,
  `vote` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `content` text NOT NULL,
  `fakeid` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `othid` int(11) NOT NULL DEFAULT '0',
  `cjstatu` tinyint(4) NOT NULL DEFAULT '0',
  `datetime` int(10) NOT NULL,
  `verify` varchar(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid` (`openid`),
  UNIQUE KEY `fakeid` (`fakeid`),
  KEY `openid_2` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `weixin_flag`
--


-- --------------------------------------------------------

--
-- 表的结构 `weixin_shake_toshake`
--

CREATE TABLE IF NOT EXISTS `weixin_shake_toshake` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(255) NOT NULL,
  `wecha_id` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `avatar` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wecha_id` (`wecha_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `weixin_shake_toshake`
--


-- --------------------------------------------------------

--
-- 表的结构 `weixin_vote`
--

CREATE TABLE IF NOT EXISTS `weixin_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `res` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `res` (`res`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `weixin_vote`
--

INSERT INTO `weixin_vote` (`id`, `name`, `res`) VALUES
(1, '微信上墙', 3),
(2, '图片上墙', 3),
(3, '签到墙', 2),
(4, '抽奖', 2),
(5, '摇一摇', 2),
(6, '对对碰', 1);

-- --------------------------------------------------------

--
-- 表的结构 `weixin_wall`
--

CREATE TABLE IF NOT EXISTS `weixin_wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageid` int(11) NOT NULL,
  `fakeid` varchar(255) NOT NULL,
  `num` int(11) NOT NULL,
  `content` text NOT NULL,
  `nickname` text NOT NULL,
  `avatar` text NOT NULL,
  `ret` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` text NOT NULL,
  `datetime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `weixin_wall`
--


-- --------------------------------------------------------

--
-- 表的结构 `weixin_wall_config`
--

CREATE TABLE IF NOT EXISTS `weixin_wall_config` (
  `huati` text NOT NULL,
  `huanying1` text NOT NULL,
  `huanying2` text NOT NULL,
  `success` text NOT NULL,
  `endtail` text NOT NULL,
  `acttitle` text NOT NULL,
  `isopen` int(1) NOT NULL,
  `endshake` int(11) NOT NULL,
  `show_num` int(11) NOT NULL,
  `shenghe` int(11) NOT NULL,
  `cjreplay` tinyint(4) NOT NULL DEFAULT '0',
  `timeinterval` int(3) NOT NULL,
  `shakeopen` tinyint(4) NOT NULL DEFAULT '1',
  `shakekeyword` varchar(255) NOT NULL,
  `voteopen` tinyint(4) NOT NULL DEFAULT '1',
  `votekeyword` varchar(255) NOT NULL,
  `votetitle` text NOT NULL,
  `votefresht` tinyint(4) NOT NULL,
  `fusionopen` tinyint(4) NOT NULL DEFAULT '0',
  `fusionkeyword` varchar(255) NOT NULL,
  `fusionurl` varchar(255) NOT NULL,
  `fusiontoken` varchar(255) NOT NULL,
  `circulation` tinyint(1) NOT NULL DEFAULT '0',
  `refreshtime` tinyint(2) NOT NULL,
  `voteshowway` tinyint(1) DEFAULT '1',
  `votecannum` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_wall_config`
--

INSERT INTO `weixin_wall_config` (`huati`, `huanying1`, `huanying2`, `success`, `endtail`, `acttitle`, `isopen`, `endshake`, `show_num`, `shenghe`, `cjreplay`, `timeinterval`, `shakeopen`, `shakekeyword`, `voteopen`, `votekeyword`, `votetitle`, `votefresht`, `fusionopen`, `fusionkeyword`, `fusionurl`, `fusiontoken`, `circulation`, `refreshtime`, `voteshowway`, `votecannum`) VALUES
('', '扫描二维码，按照提示回复即可上墙', '赶快上墙体验吧！！！', '你已经成功发送，等待审核通过即可上墙了', '回复【重置】重新获取信息，回复【帮助】查看帮助信息！', '摇一摇', 1, 200, 10, 0, 0, 3, 0, '摇一摇', 0, '投票', '你最喜欢互动大屏幕的哪个功能？', 5, 0, '', '', '', 0, 2, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `weixin_wall_num`
--

CREATE TABLE IF NOT EXISTS `weixin_wall_num` (
  `num` int(11) NOT NULL,
  `lastmessageid` int(11) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `weixin_wall_num`
--

INSERT INTO `weixin_wall_num` (`num`, `lastmessageid`) VALUES
(1, 0);
