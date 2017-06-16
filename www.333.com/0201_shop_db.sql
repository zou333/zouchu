/*
Navicat MySQL Data Transfer

Source Server         : 0201
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : 0201_shop_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-06-16 13:10:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(18) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO `admin` VALUES ('2', '123', '123');
INSERT INTO `admin` VALUES ('3', '456', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` char(20) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `drand_name_UNIQUE` (`brand_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('8', '小米', '', '');
INSERT INTO `brand` VALUES ('9', 'oppo', '', '');
INSERT INTO `brand` VALUES ('10', '华为', '', '');
INSERT INTO `brand` VALUES ('12', 'hshhh', '', '');
INSERT INTO `brand` VALUES ('13', '青木', '', '');
INSERT INTO `brand` VALUES ('14', '品牌', '&lt;p&gt;言&lt;br/&gt;&lt;/p&gt;', '');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` char(10) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '连衣裙', '0');
INSERT INTO `category` VALUES ('2', '外套', '0');
INSERT INTO `category` VALUES ('4', '羊毛衫', '0');
INSERT INTO `category` VALUES ('5', '迷你伞', '2');
INSERT INTO `category` VALUES ('6', '普通伞', '5');
INSERT INTO `category` VALUES ('7', '迷你太阳伞', '5');
INSERT INTO `category` VALUES ('8', '小清新', '7');
INSERT INTO `category` VALUES ('15', '上装', '0');

-- ----------------------------
-- Table structure for category2
-- ----------------------------
DROP TABLE IF EXISTS `category2`;
CREATE TABLE `category2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category2
-- ----------------------------
INSERT INTO `category2` VALUES ('1', '手机', '0');
INSERT INTO `category2` VALUES ('2', '智能手机', '1');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` char(255) NOT NULL,
  `level` tinyint(3) unsigned zerofill NOT NULL DEFAULT '005',
  `user_id` int(10) unsigned zerofill NOT NULL,
  `goods_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_comment_user1_idx` (`user_id`),
  KEY `fk_comment_0201_goods1_idx` (`goods_id`),
  CONSTRAINT `fk_comment_0201_goods1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) NOT NULL,
  `phone` bigint(20) unsigned NOT NULL,
  `email` varchar(50) NOT NULL,
  `qq` char(15) NOT NULL,
  `http` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contact
-- ----------------------------
INSERT INTO `contact` VALUES ('1', '广东省广州市某某区', '15698933365', '525635555', '225625632688', 'http://baidu.com');
INSERT INTO `contact` VALUES ('2', '广东省广州市海珠区某某地方', '13685964487', '55886611177', '6584758247', 'http://baidu.com');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` char(60) NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `market_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `shop_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `brand_id` int(10) unsigned NOT NULL,
  `image` char(255) NOT NULL,
  `category_id` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_0201_goods_brand1_idx` (`brand_id`),
  KEY `fk_0201_goods_category1_idx` (`category_id`),
  KEY `image_UNIQUE` (`image`) USING BTREE,
  CONSTRAINT `fk_0201_goods_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_0201_goods_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('20', 'uuuuu', '1497578144', '29.00', '29.00', '12', 'Public/Upload/2017-06-16/594339d72cd33.jpg', '1');
INSERT INTO `goods` VALUES ('21', 'DIY语音', '1497579150', '55.00', '55.00', '12', 'Public/Upload/2017-06-16/59433e8adea34.jpg', '1');
INSERT INTO `goods` VALUES ('22', '和电话费', '1497578198', '55.00', '55.00', '12', 'Public/Upload/2017-06-16/59433abc37244.jpg', '2');
INSERT INTO `goods` VALUES ('23', '和交付该计划', '1497579054', '1500.00', '1344.00', '9', 'Public/Upload/2017-06-16/59433e2b1ceaf.jpg', '1');
INSERT INTO `goods` VALUES ('24', '鱼仔', '1497579519', '121.00', '121.00', '12', 'Public/Upload/2017-06-16/59433ffc1b11e.jpg', '5');
INSERT INTO `goods` VALUES ('25', '商品商品', '1497578315', '5555.00', '5555.00', '10', 'Public/Upload/2017-06-16/59433b476f053.jpg', '1');
INSERT INTO `goods` VALUES ('27', '555', '1497578335', '444.00', '444.00', '10', 'Public/Upload/2017-06-16/59433b5c72cfa.jpg', '1');

-- ----------------------------
-- Table structure for goods_desc
-- ----------------------------
DROP TABLE IF EXISTS `goods_desc`;
CREATE TABLE `goods_desc` (
  `content` text NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`goods_id`),
  CONSTRAINT `fk_goods_details_0201_goods` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_desc
-- ----------------------------
INSERT INTO `goods_desc` VALUES ('\r\n				衣料手感极好				', '20');
INSERT INTO `goods_desc` VALUES ('\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		语音语音												', '21');
INSERT INTO `goods_desc` VALUES ('\r\n		飞机和环境		', '22');
INSERT INTO `goods_desc` VALUES ('\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		\r\n		官方活动														', '23');
INSERT INTO `goods_desc` VALUES ('\r\n		\r\n		给力				', '24');
INSERT INTO `goods_desc` VALUES ('\r\n		555555555555555555555555555555555555		', '25');
INSERT INTO `goods_desc` VALUES ('\r\n		4444		', '27');

-- ----------------------------
-- Table structure for goods_img
-- ----------------------------
DROP TABLE IF EXISTS `goods_img`;
CREATE TABLE `goods_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(2000) NOT NULL,
  `goods_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_goods_img_0201_goods1_idx` (`goods_id`),
  CONSTRAINT `fk_goods_img_0201_goods1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_img
-- ----------------------------
INSERT INTO `goods_img` VALUES ('9', 'Public/Upload/2017-06-08/593942e07a840.jpg', '20');
INSERT INTO `goods_img` VALUES ('10', 'Public/Upload/2017-06-08/593942e08cd3d.jpg', '20');
INSERT INTO `goods_img` VALUES ('13', 'Public/Upload/2017-06-08/5939455f76be4.jpg', '22');
INSERT INTO `goods_img` VALUES ('14', 'Public/Upload/2017-06-08/5939455f88cf8.jpg', '22');
INSERT INTO `goods_img` VALUES ('18', 'Public/Upload/2017-06-10/593bcf0e7801c.gif', '25');
INSERT INTO `goods_img` VALUES ('19', 'Public/Upload/2017-06-10/593bcf0e95cb3.gif', '25');
INSERT INTO `goods_img` VALUES ('20', 'Public/Upload/2017-06-10/593bcf0ea8d67.gif', '25');
INSERT INTO `goods_img` VALUES ('22', 'Public/Upload/2017-06-12/593e0e0a2b41a.png', '27');
INSERT INTO `goods_img` VALUES ('31', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '20');
INSERT INTO `goods_img` VALUES ('32', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '20');
INSERT INTO `goods_img` VALUES ('33', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '20');
INSERT INTO `goods_img` VALUES ('34', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '20');
INSERT INTO `goods_img` VALUES ('37', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '20');
INSERT INTO `goods_img` VALUES ('38', 'Public/Upload/2017-06-16/59433a9e810cb.jpg', '20');
INSERT INTO `goods_img` VALUES ('39', 'Public/Upload/2017-06-16/59433a9e8d41e.jpg', '20');
INSERT INTO `goods_img` VALUES ('40', 'Public/Upload/2017-06-16/59433a9e9b2c9.jpg', '20');
INSERT INTO `goods_img` VALUES ('41', 'Public/Upload/2017-06-16/59433abc4aeb0.jpg', '22');
INSERT INTO `goods_img` VALUES ('42', 'Public/Upload/2017-06-16/59433ad3de4e9.jpg', '22');
INSERT INTO `goods_img` VALUES ('46', 'Public/Upload/2017-06-16/59433b47605f0.jpg', '25');
INSERT INTO `goods_img` VALUES ('47', 'Public/Upload/2017-06-16/59433b47805af.jpg', '25');
INSERT INTO `goods_img` VALUES ('48', 'Public/Upload/2017-06-16/59433b5c592cc.jpg', '27');
INSERT INTO `goods_img` VALUES ('49', 'Public/Upload/2017-06-16/59433b5c8a400.jpg', '27');
INSERT INTO `goods_img` VALUES ('62', 'Public/Upload/2017-06-16/59433e214509b.jpg', '23');
INSERT INTO `goods_img` VALUES ('69', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '21');
INSERT INTO `goods_img` VALUES ('70', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '24');
INSERT INTO `goods_img` VALUES ('71', 'Public/Upload/2017-06-10/593b9c6e528ba.gif', '24');

-- ----------------------------
-- Table structure for goods_spec
-- ----------------------------
DROP TABLE IF EXISTS `goods_spec`;
CREATE TABLE `goods_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned NOT NULL,
  `spec_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `spec_key` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_spec
-- ----------------------------
INSERT INTO `goods_spec` VALUES ('5', '20', '29.00', '2,11');
INSERT INTO `goods_spec` VALUES ('6', '20', '29.00', '2,12');
INSERT INTO `goods_spec` VALUES ('7', '20', '29.00', '11,14');
INSERT INTO `goods_spec` VALUES ('8', '20', '29.00', '12,14');
INSERT INTO `goods_spec` VALUES ('9', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('10', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('11', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('12', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('13', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('14', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('15', '24', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('16', '25', '33.00', '2,11');
INSERT INTO `goods_spec` VALUES ('17', '25', '33.00', '2,12');
INSERT INTO `goods_spec` VALUES ('18', '25', '33.00', '2,13');
INSERT INTO `goods_spec` VALUES ('19', '25', '33.00', '11,14');
INSERT INTO `goods_spec` VALUES ('20', '25', '33.00', '12,14');
INSERT INTO `goods_spec` VALUES ('21', '25', '33.00', '13,14');
INSERT INTO `goods_spec` VALUES ('22', '27', '11111.00', '2,11');
INSERT INTO `goods_spec` VALUES ('23', '20', '29.00', '2,11');
INSERT INTO `goods_spec` VALUES ('24', '20', '29.00', '2,12');
INSERT INTO `goods_spec` VALUES ('25', '20', '29.00', '11,14');
INSERT INTO `goods_spec` VALUES ('26', '20', '29.00', '12,14');
INSERT INTO `goods_spec` VALUES ('27', '20', '29.00', '2,11');
INSERT INTO `goods_spec` VALUES ('28', '20', '29.00', '2,12');
INSERT INTO `goods_spec` VALUES ('29', '20', '29.00', '11,14');
INSERT INTO `goods_spec` VALUES ('30', '20', '29.00', '12,14');
INSERT INTO `goods_spec` VALUES ('31', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('32', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('33', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('34', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('35', '20', '29.00', '2,11');
INSERT INTO `goods_spec` VALUES ('36', '20', '29.00', '2,12');
INSERT INTO `goods_spec` VALUES ('37', '20', '29.00', '11,14');
INSERT INTO `goods_spec` VALUES ('38', '20', '29.00', '12,14');
INSERT INTO `goods_spec` VALUES ('39', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('40', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('41', '24', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('42', '25', '33.00', '2,11');
INSERT INTO `goods_spec` VALUES ('43', '25', '33.00', '2,12');
INSERT INTO `goods_spec` VALUES ('44', '25', '33.00', '2,13');
INSERT INTO `goods_spec` VALUES ('45', '25', '33.00', '11,14');
INSERT INTO `goods_spec` VALUES ('46', '25', '33.00', '12,14');
INSERT INTO `goods_spec` VALUES ('47', '25', '33.00', '13,14');
INSERT INTO `goods_spec` VALUES ('48', '27', '11111.00', '2,11');
INSERT INTO `goods_spec` VALUES ('49', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('50', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('51', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('52', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('53', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('54', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('55', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('56', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('57', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('58', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('59', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('60', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('61', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('62', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('63', '23', '49.00', '2,11');
INSERT INTO `goods_spec` VALUES ('64', '23', '56.00', '2,12');
INSERT INTO `goods_spec` VALUES ('65', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('66', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('67', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('68', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('69', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('70', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('71', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('72', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('73', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('74', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('75', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('76', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('77', '21', '55.00', '2,11');
INSERT INTO `goods_spec` VALUES ('78', '21', '55.00', '2,12');
INSERT INTO `goods_spec` VALUES ('79', '21', '55.00', '11,14');
INSERT INTO `goods_spec` VALUES ('80', '21', '55.00', '12,14');
INSERT INTO `goods_spec` VALUES ('81', '24', '55.00', '2,11');

-- ----------------------------
-- Table structure for goods_type
-- ----------------------------
DROP TABLE IF EXISTS `goods_type`;
CREATE TABLE `goods_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` char(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods_type
-- ----------------------------
INSERT INTO `goods_type` VALUES ('1', 'gdgdgsh');
INSERT INTO `goods_type` VALUES ('2', '手机');
INSERT INTO `goods_type` VALUES ('3', '网络');

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
INSERT INTO `message` VALUES ('1', '1497445387', '成功', '成功成功成功成功成功成功成功成功成功成功成功成功成功成功成功成功成功', '13645678945');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_name` varchar(200) NOT NULL,
  `create_time` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('2', '夏季新品即将上市耶耶', '0', '&lt;p&gt;\r\n		&amp;lt;p&amp;gt;\r\n		&amp;amp;lt;p&amp;amp;gt;\r\n		&amp;amp;amp;lt;p&amp;amp;amp;gt;好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待好期待&amp;amp;amp;lt;/p&amp;amp;amp;gt;		&amp;amp;lt;/p&amp;amp;gt;		&amp;lt;/p&amp;gt;		&lt;/p&gt;', 'Public/Upload/2017-06-12/593e7933d0786.png');
INSERT INTO `news` VALUES ('4', '比欧体比欧体比欧体比欧体比欧体比欧体比欧体比欧体', '1497528841', '&lt;p&gt;\r\n		&amp;lt;p&amp;gt;\r\n		&amp;amp;lt;p&amp;amp;gt;\r\n		&amp;amp;amp;lt;p&amp;amp;amp;gt;比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧比欧体比欧体比欧体比欧体比欧体比欧&amp;amp;amp;lt;/p&amp;amp;amp;gt;		&amp;amp;lt;/p&amp;amp;gt;		&amp;lt;/p&amp;gt;		&lt;/p&gt;', 'Public/Upload/2017-06-15/59427a07d0bd5.png');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(45) NOT NULL,
  `user_id` int(10) unsigned zerofill NOT NULL,
  `order_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  `numbel` smallint(5) unsigned zerofill NOT NULL DEFAULT '00000',
  `phone` bigint(19) unsigned NOT NULL,
  `address` char(45) NOT NULL,
  `order_status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  `pay_status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  `shipping_status` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `order_sn_UNIQUE` (`order_sn`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  KEY `fk_order_user1_idx` (`user_id`),
  CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_goods
-- ----------------------------
DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE `order_goods` (
  `goods_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned zerofill NOT NULL,
  `number` smallint(5) unsigned zerofill NOT NULL DEFAULT '00000',
  `market_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  `shop_price` decimal(10,2) unsigned zerofill NOT NULL DEFAULT '00000000.00',
  PRIMARY KEY (`goods_id`,`order_id`),
  KEY `fk_0201_goods_has_order_order1_idx` (`order_id`),
  KEY `fk_0201_goods_has_order_0201_goods1_idx` (`goods_id`),
  CONSTRAINT `fk_0201_goods_has_order_0201_goods1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_0201_goods_has_order_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_goods
-- ----------------------------

-- ----------------------------
-- Table structure for spec
-- ----------------------------
DROP TABLE IF EXISTS `spec`;
CREATE TABLE `spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `spec_name` char(20) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `spec_name` (`spec_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spec
-- ----------------------------
INSERT INTO `spec` VALUES ('13', '内存', '2');
INSERT INTO `spec` VALUES ('14', '100M', '3');
INSERT INTO `spec` VALUES ('15', '像素', '2');

-- ----------------------------
-- Table structure for spec_items
-- ----------------------------
DROP TABLE IF EXISTS `spec_items`;
CREATE TABLE `spec_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `items` char(15) NOT NULL,
  `spec_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of spec_items
-- ----------------------------
INSERT INTO `spec_items` VALUES ('2', '16g', '13');
INSERT INTO `spec_items` VALUES ('6', '4', '14');
INSERT INTO `spec_items` VALUES ('11', '1800w', '15');
INSERT INTO `spec_items` VALUES ('12', '10000w', '15');
INSERT INTO `spec_items` VALUES ('13', '15000w', '15');
INSERT INTO `spec_items` VALUES ('14', 'kdjf', '13');
INSERT INTO `spec_items` VALUES ('15', '6666', '14');
INSERT INTO `spec_items` VALUES ('16', '55', '14');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(18) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(45) NOT NULL,
  `qq` bigint(19) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  UNIQUE KEY `password_UNIQUE` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phone` bigint(19) unsigned NOT NULL,
  `address` varchar(45) NOT NULL,
  `name` varchar(25) NOT NULL,
  `user_id` int(10) unsigned zerofill NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `phone_UNIQUE` (`phone`),
  UNIQUE KEY `user_addresscol_UNIQUE` (`address`),
  KEY `fk_user_address_user1_idx` (`user_id`),
  CONSTRAINT `fk_user_address_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_address
-- ----------------------------
