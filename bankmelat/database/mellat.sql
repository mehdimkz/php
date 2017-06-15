-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2007 at 06:37 AM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pardakht`
--

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `id` int(12) NOT NULL default '0',
  `refid` varchar(40) default NULL,
  `Amount` int(10) default NULL,
  `times` varchar(30) default NULL,
  `Response` varchar(40) default NULL,
  `payinfo` varchar(200) default NULL,
  `datep` varchar(20) default NULL,
  `datepsh` varchar(20) default NULL,
  `name` text character set utf8 collate utf8_persian_ci,
  `family` text character set utf8 collate utf8_persian_ci,
  `email` varchar(20) default NULL,
  `toz` text character set utf8 collate utf8_persian_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--


-- --------------------------------------------------------

--
-- Table structure for table `table_10`
--

CREATE TABLE IF NOT EXISTS `table_10` (
  `id` int(2) default NULL,
  `outs` varchar(250) collate utf8_persian_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `table_10`
--

INSERT INTO `table_10` (`id`, `outs`) VALUES
(0, 'تراکنش با موفقیت انجام شد'),
(11, 'شماره کارت نامعتبر است'),
(12, 'موجودی کافی نیست'),
(13, 'رمز نادرست است'),
(14, 'تعداد دفعات وارد کردن رمز از حد مجاز بیشتر است'),
(15, 'کارت نامعتبر است'),
(17, 'کاربر از انجام تراکنش منصرف شده است'),
(18, 'تاریخ انتقضای کارت گذشته است'),
(111, 'صادر کننده کارت نامعتبر است'),
(112, 'خطای سوییچ صادر کننده کارت'),
(113, 'پاسخی از صادر کننده کارت دریافت نشد'),
(114, 'دارنده کارت مجاز به انجام این تراکنش نیست'),
(21, 'پذیرنده نامعتبر است'),
(22, 'ترمینال مجوز ارائه سرویس درخواستی را ندارد'),
(23, 'خطای امنیتی رخ داده است'),
(24, 'اطلاعات کاربری پذیرنده نامعتبر است'),
(25, 'مبلغ نامعتبر است'),
(31, 'پاسخ نامعتبر است'),
(32, 'فرمت اطلاعات وارد شده صحیح نمی باشد'),
(33, 'حساب نامعتبر است'),
(34, 'خطای سیستمی'),
(35, 'تاریخ نامعتبر است'),
(41, 'شماره درخواست تکراری است'),
(42, 'تراکنش Sale یافت نشد'),
(43, 'قبلا درخواست Verify داده شده است'),
(44, 'درخواست Verify  یافت نشد'),
(45, 'تراکنش Settle  شده است'),
(46, 'تراکنش Settle نشده است'),
(47, 'تراکنش Settle  یافت نشد'),
(48, 'تراکنش Reverse شده است'),
(49, 'تراکنش Refound یافت نشد'),
(412, 'شناسه قبض نادرست است'),
(413, 'شناسه پرداخت نادرست است'),
(414, 'سازمان صادر کننده قبض نامعتبر است'),
(415, 'زمان جلسه کاری به پایان رسیده است'),
(416, 'خطا در ثبت اطلاعات رخ داده است'),
(417, 'شناسه پرداخت کننده نامعتبر است'),
(418, 'اشکال در تعریف اطلاعات مشتری'),
(419, 'تعداد دفعات ورود اطلاعات از حد مجاز گذشته است'),
(421, 'IP نامعتبر است'),
(51, 'تراکنش تکراری است'),
(52, 'سرویس درخواستی موجود نمی باشد'),
(54, 'تراکنش مرجع موجود نیست'),
(55, 'تراکنش نامعتبر است'),
(61, 'خطا در واریز'),
(80, 'تراكنش موفق عمل نكرده است');
