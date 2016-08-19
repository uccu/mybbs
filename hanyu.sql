-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2016 at 12:10 下午
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hanyu`
--

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_anli`
--

CREATE TABLE `hanyu_anli` (
  `aid` int(10) UNSIGNED NOT NULL COMMENT '案例ID',
  `ctime` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `name` varchar(200) NOT NULL DEFAULT '' COMMENT '标题/名字',
  `des` text NOT NULL COMMENT '描述',
  `thumb` varchar(200) NOT NULL DEFAULT '' COMMENT '缩略图',
  `tid` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '分类',
  `type` varchar(20) NOT NULL DEFAULT '',
  `header` varchar(100) NOT NULL DEFAULT '',
  `background` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_anli`
--

INSERT INTO `hanyu_anli` (`aid`, `ctime`, `name`, `des`, `thumb`, `tid`, `type`, `header`, `background`) VALUES
(1, 765501, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', 'pic/pc/banner.png', '总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号\r\n成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源'),
(2, 2887145, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'app', 'pic/app/banner.png', '总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号\n'),
(3, 139222, 'ceshi2~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'wx', 'pic/app/banner.png', '总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号世外桃源总部坐落于成都市武侯区科华北路65号2'),
(4, 1034675, 'ceshi~~', '让生活更美好3', 'pic/case/anli_1.png', 5, 'pc', '', ''),
(5, 1755709, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(6, 2674522, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(7, 2105482, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(8, 2503845, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(9, 202780, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(10, 2502364, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(11, 2903483, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(12, 1010324, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(13, 2341169, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(14, 2674876, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(15, 350874, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL),
(16, 2729741, 'ceshi~~', '让生活更美好', 'pic/case/anli_1.png', 5, 'pc', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_anli_app`
--

CREATE TABLE `hanyu_anli_app` (
  `aid` int(11) NOT NULL,
  `prama1` varchar(200) NOT NULL DEFAULT '',
  `prama2` varchar(200) NOT NULL DEFAULT '',
  `suport` varchar(200) NOT NULL DEFAULT '',
  `website` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_anli_app`
--

INSERT INTO `hanyu_anli_app` (`aid`, `prama1`, `prama2`, `suport`, `website`) VALUES
(2, 'R&D：这是一个地址~', 'S&D：这是一个地址~', '支持：安卓，IOS', 'http://www.baidu.com');

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_anli_pc`
--

CREATE TABLE `hanyu_anli_pc` (
  `aid` int(11) NOT NULL,
  `prama1` varchar(200) NOT NULL DEFAULT '',
  `prama2` varchar(200) NOT NULL DEFAULT '',
  `contract` varchar(200) NOT NULL DEFAULT '',
  `website` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_anli_pc`
--

INSERT INTO `hanyu_anli_pc` (`aid`, `prama1`, `prama2`, `contract`, `website`) VALUES
(1, '周期：1970-01-01至1971-05-31', '兼容：1IE、搜狗、谷歌、360、火狐等主流浏览器', 'pic/pc/banner.png', 'http://www.baidu.com');

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_anli_pic`
--

CREATE TABLE `hanyu_anli_pic` (
  `pid` int(10) UNSIGNED NOT NULL,
  `aid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `path` varchar(200) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_anli_pic`
--

INSERT INTO `hanyu_anli_pic` (`pid`, `aid`, `path`, `priority`) VALUES
(1, 1, 'pic/anli/201608/17/1', 0),
(2, 1, 'pic/anli/201608/17/2', 0),
(3, 2, 'pic/app/anli_1.png', 0),
(4, 2, 'pic/app/anli_1.png', 0),
(5, 3, 'pic/app/anli_1.png', 0),
(6, 3, 'pic/app/anli_1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_anli_wx`
--

CREATE TABLE `hanyu_anli_wx` (
  `aid` int(11) NOT NULL,
  `prama1` varchar(200) NOT NULL DEFAULT '',
  `prama2` varchar(200) NOT NULL DEFAULT '',
  `download` varchar(200) NOT NULL DEFAULT '',
  `suport` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_anli_wx`
--

INSERT INTO `hanyu_anli_wx` (`aid`, `prama1`, `prama2`, `download`, `suport`) VALUES
(3, 'R&D：这是一个地址~', 'S&D：这是一个地址~', 'pic/pc/banner.png', '支持：安卓，IOS');

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_cache`
--

CREATE TABLE `hanyu_cache` (
  `type` varchar(100) NOT NULL,
  `des` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_cache`
--

INSERT INTO `hanyu_cache` (`type`, `des`) VALUES
('handleException', 'a:4:{s:7:"message";s:30:"tplfile not exist: updanli.php";s:4:"file";s:83:"/Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/template/base.php";s:4:"line";i:11;s:5:"trace";s:1244:"#0 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/template/base.php(52): template\\base::ifexist(\'/Applications/X...\')\n#1 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/template/base.php(129): template\\base::ttoc(\'updanli\', \'\', \'testadmin\')\n#2 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/function/core.php(21): template\\base::load(\'updanli\', true)\n#3 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/function/core.php(25): template(\'updanli\', true)\n#4 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/plugin/testadmin/class/control/index.control.php(82): T(\'updanli\')\n#5 [internal function]: plugin\\testadmin\\control\\index->updanli(\'1\')\n#6 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/base/init.php(54): call_user_func_array(Array, Array)\n#7 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/base/init.php(16): base\\init->_init_input()\n#8 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/core.php(24): base\\init->__construct()\n#9 /Applications/XAMPP/xamppfiles/vhosts/baka-a/source/Library/class/core.php(15): core::init()\n#10 /Applications/XAMPP/xamppfiles/vhosts/baka-a/d.php(14): require(\'/Applications/X...\')\n#11 {main}";}'),
('handleError', 'a:4:{i:0;i:2;i:1;s:16:"Division by zero";i:2;s:100:"/Applications/XAMPP/xamppfiles/vhosts/baka-a/source/plugin/testadmin/class/control/index.control.php";i:3;i:38;}');

-- --------------------------------------------------------

--
-- Table structure for table `hanyu_subnav`
--

CREATE TABLE `hanyu_subnav` (
  `tid` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `sid` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hanyu_subnav`
--

INSERT INTO `hanyu_subnav` (`tid`, `name`, `sid`) VALUES
(1, '移动APP', 0),
(2, 'AR/VR', 0),
(3, 'PC网站', 0),
(4, '微信网站', 0),
(5, '生活服务O2O', 1),
(6, '电子商务', 1),
(7, '社区服务', 1),
(8, '智能硬件', 1),
(9, '企业商业', 1),
(10, '社交通讯', 1),
(11, '房产装饰', 1),
(12, '视频直播', 1),
(13, '金融理财', 1),
(14, '教育招聘', 1),
(15, '汽车物流', 1),
(16, '文化艺术', 1),
(17, '医疗健康', 1),
(18, '智慧旅游', 1),
(19, '女性时尚/宠物', 1),
(20, '游戏娱乐', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hanyu_anli`
--
ALTER TABLE `hanyu_anli`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `hanyu_anli_app`
--
ALTER TABLE `hanyu_anli_app`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `hanyu_anli_pc`
--
ALTER TABLE `hanyu_anli_pc`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `hanyu_anli_pic`
--
ALTER TABLE `hanyu_anli_pic`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `aid` (`aid`);

--
-- Indexes for table `hanyu_anli_wx`
--
ALTER TABLE `hanyu_anli_wx`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `hanyu_cache`
--
ALTER TABLE `hanyu_cache`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `hanyu_subnav`
--
ALTER TABLE `hanyu_subnav`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `name` (`name`),
  ADD KEY `sid` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hanyu_anli`
--
ALTER TABLE `hanyu_anli`
  MODIFY `aid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '案例ID', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hanyu_anli_pic`
--
ALTER TABLE `hanyu_anli_pic`
  MODIFY `pid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `hanyu_subnav`
--
ALTER TABLE `hanyu_subnav`
  MODIFY `tid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
