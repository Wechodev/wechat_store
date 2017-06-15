# Host: localhost  (Version 5.5.53)
# Date: 2017-06-15 18:29:11
# Generator: MySQL-Front 6.0  (Build 1.116)


#
# Structure for table "my_active_details"
#

DROP TABLE IF EXISTS `my_active_details`;
CREATE TABLE `my_active_details` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `big_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_active_details"
#


#
# Structure for table "my_active_form"
#

DROP TABLE IF EXISTS `my_active_form`;
CREATE TABLE `my_active_form` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `low_price` decimal(10,2) DEFAULT NULL,
  `describe` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `type_id` tinyint(3) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_active_form"
#


#
# Structure for table "my_address"
#

DROP TABLE IF EXISTS `my_address`;
CREATE TABLE `my_address` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `specific_place` varchar(255) DEFAULT NULL,
  `add_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_address"
#


#
# Structure for table "my_admin"
#

DROP TABLE IF EXISTS `my_admin`;
CREATE TABLE `my_admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_admin"
#


#
# Structure for table "my_order"
#

DROP TABLE IF EXISTS `my_order`;
CREATE TABLE `my_order` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) DEFAULT NULL COMMENT '0是未付款1是付款未发货2是付款已发货3是付款已签收',
  `much` decimal(10,2) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_order"
#


#
# Structure for table "my_order_message"
#

DROP TABLE IF EXISTS `my_order_message`;
CREATE TABLE `my_order_message` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL COMMENT '如果type为0填入商城为其他按照其他填入',
  `how_much` int(11) DEFAULT '1',
  `type_id` tinyint(3) DEFAULT '0' COMMENT '0为商城产品',
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_order_message"
#


#
# Structure for table "my_product"
#

DROP TABLE IF EXISTS `my_product`;
CREATE TABLE `my_product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sales` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `describe` varchar(255) DEFAULT NULL,
  `big_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_product"
#


#
# Structure for table "my_type"
#

DROP TABLE IF EXISTS `my_type`;
CREATE TABLE `my_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_type"
#


#
# Structure for table "my_users"
#

DROP TABLE IF EXISTS `my_users`;
CREATE TABLE `my_users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `openid` char(29) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `join_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "my_users"
#

