/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : jqr

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2019-01-18 14:19:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for codepay_order
-- ----------------------------
DROP TABLE IF EXISTS `codepay_order`;
CREATE TABLE `codepay_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) unsigned NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) unsigned NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  UNIQUE KEY `pay_no` (`pay_no`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';

-- ----------------------------
-- Records of codepay_order
-- ----------------------------

-- ----------------------------
-- Table structure for codepay_user
-- ----------------------------
DROP TABLE IF EXISTS `codepay_user`;
CREATE TABLE `codepay_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `user` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `vip` int(1) NOT NULL DEFAULT '0' COMMENT '会员开通',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '会员状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of codepay_user
-- ----------------------------
INSERT INTO `codepay_user` VALUES ('1', 'admin', '0.00', '0', '0');

-- ----------------------------
-- Table structure for ds_about
-- ----------------------------
DROP TABLE IF EXISTS `ds_about`;
CREATE TABLE `ds_about` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(60) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `operator` varchar(45) NOT NULL DEFAULT '' COMMENT '发布人',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=755 ROW_FORMAT=DYNAMIC COMMENT='公告信息表';

-- ----------------------------
-- Records of ds_about
-- ----------------------------
INSERT INTO `ds_about` VALUES ('1', '机器人操作玩法。', '<p>\r\n	<span>每用户限购十台。</span> \r\n</p>\r\n<p>\r\n	每一台智能Al机器人自动刷流量产生佣金，每天可完成600-2000个流量。\r\n</p>\r\n<p>\r\n	后台转播流量6－20的收益（永久）\r\n</p>\r\n<p>\r\n	也就是一台机器人每天返佣6-20元现金不等。\r\n</p>\r\n<p>\r\n	绑定银行卡后选择提现方式（暂不支持微信）\r\n</p>\r\n<p>\r\n	每日提现一次，统一提现时间晚间八点-晚间十点，<span>最低提现额度20。</span> \r\n</p>\r\n<p>\r\n	点击推广码分享二维码邀请好友收益。<br />\r\n一级10％二级5％三级5%直接本到帐户。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<div class=\"paragraph\" style=\"margin:40px 0px 0px;padding:0px;font-size:0.8rem;color:#434343;font-family:\" background-color:#f5f6ee;\"=\"\">\r\n	</div>', 'admin', '1542525927', '1547453866');

-- ----------------------------
-- Table structure for ds_announce
-- ----------------------------
DROP TABLE IF EXISTS `ds_announce`;
CREATE TABLE `ds_announce` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(60) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `operator` varchar(45) NOT NULL DEFAULT '' COMMENT '发布人',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `image` varchar(255) NOT NULL COMMENT '标题图像',
  `viewer` varchar(10) NOT NULL DEFAULT 'all' COMMENT '查看权限 all:所有人  member:会员  center:报单中心 ',
  `tid` int(10) unsigned NOT NULL COMMENT '类别ID',
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=755 ROW_FORMAT=DYNAMIC COMMENT='公告信息表';

-- ----------------------------
-- Records of ds_announce
-- ----------------------------
INSERT INTO `ds_announce` VALUES ('156', '智能Al简介', '<p>\r\n	我们是一个综合信息与个人价值的交互平台。\r\n</p>\r\n<p>\r\n	所有的信息必通过个人的IP地址才能完成交互产生价值，基于IP地址的唯一性，平台要借助大批量的用户IP才能实现批量化操作，所以平台的用户越多流量就越大，用户的收益就越高。\r\n</p>\r\n<p>\r\n	我们的优势就是利用人工智能全面取代手工操作，具有可长时间，自动化及批量性高频操作特点，也有智能化匹配IP，精准的算法任务分解及键托管的技术优势。\r\n</p>', 'admin', '1547085999', '1547452793', '/Public/Uploads/zixun/20190110/5c36a99b0db6b.jpg', 'all', '2');
INSERT INTO `ds_announce` VALUES ('154', '智能Al机器人', '<p>\r\n	大数据时代把人脉变成钱脉就来智能Al机器人，一款把市面上所有热门应用汇集在一起的流量式APP。\r\n</p>\r\n<p>\r\n	智能Al机器人年末巨献，智能Al机器人平台由深圳创客云端科技有限公司创立，其平台所创造价值在于通过桥接的方式给市面上运营平台进行流量筛选引入从而获取流量粉进行变现，根据实时流量大小进行转換为现金，市场用户可进行投资形式进入平台，购买流量机器人来进行流量的自动捕获，每日可获取不定值的流量变现，目前市场机器人单价在100元RMB，随着机器人不断的捕获能量可使机器人能够更加敏捷的获取高流量也就是高回报。\r\n</p>\r\n<p>\r\n	每天挂机即可简单操作实时收益稳定回报。\r\n</p>', 'admin', '1544625077', '1547452326', '/Public/Uploads/zixun/20181212/5c111bc365ee1.png', 'all', '1');

-- ----------------------------
-- Table structure for ds_announcetype
-- ----------------------------
DROP TABLE IF EXISTS `ds_announcetype`;
CREATE TABLE `ds_announcetype` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '类别ID',
  `name` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=24 ROW_FORMAT=DYNAMIC COMMENT='公告类别';

-- ----------------------------
-- Records of ds_announcetype
-- ----------------------------
INSERT INTO `ds_announcetype` VALUES ('1', '新闻资讯');
INSERT INTO `ds_announcetype` VALUES ('2', '新手上路');

-- ----------------------------
-- Table structure for ds_announce_click
-- ----------------------------
DROP TABLE IF EXISTS `ds_announce_click`;
CREATE TABLE `ds_announce_click` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131519 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ds_announce_click
-- ----------------------------

-- ----------------------------
-- Table structure for ds_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `ds_auth_group`;
CREATE TABLE `ds_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(500) NOT NULL DEFAULT '',
  `description` char(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ds_auth_group
-- ----------------------------
INSERT INTO `ds_auth_group` VALUES ('7', '首页管理员', '1', '13,14,15,16,17,18,19,20,21,22,23,24,25,26,9', '能够管理首页推荐位');
INSERT INTO `ds_auth_group` VALUES ('4', '超级管理员', '1', '13,14,15,16,17,18,19,20,21,22,23,24,25,26,89,27,28,29,30,31,32,80,81,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,50,51,52,82,83,84,85,87,88,9,10,11,12,86,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,7913,14,15,16,17,18,19,20,21,22,23,24,25,26,89,27,28,29,30,31,32,80,81,33,34,35,36,37,38,39,41,42,43,44,45,46,47,48,49,50,51,52,82,83,84,85,87,88,9,10,11,12,86,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79', '拥有所有权限的管理员');
INSERT INTO `ds_auth_group` VALUES ('8', '广告管理员', '1', '27,28,29,30,31,32,9', '管理全部广告');
INSERT INTO `ds_auth_group` VALUES ('9', '分类管理员', '1', '33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,9', '分类管理员');
INSERT INTO `ds_auth_group` VALUES ('10', '优惠券管理', '1', '53,54,55,56,57,58,59,60', '优惠券管理');

-- ----------------------------
-- Table structure for ds_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `ds_auth_group_access`;
CREATE TABLE `ds_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ds_auth_group_access
-- ----------------------------
INSERT INTO `ds_auth_group_access` VALUES ('2651', '4');

-- ----------------------------
-- Table structure for ds_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `ds_auth_rule`;
CREATE TABLE `ds_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `mid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ds_auth_rule
-- ----------------------------
INSERT INTO `ds_auth_rule` VALUES ('9', 'Admin/Index/index', '登录首页', '1', '1', '', '9');
INSERT INTO `ds_auth_rule` VALUES ('10', 'Admin/Websetting/index', '基础配置', '1', '1', '', '9');
INSERT INTO `ds_auth_rule` VALUES ('11', 'Admin/Navsetting/index', '导航配置', '1', '1', '', '9');
INSERT INTO `ds_auth_rule` VALUES ('12', 'Admin/Friendlink/index', '友情链接配置', '1', '1', '', '9');
INSERT INTO `ds_auth_rule` VALUES ('13', 'Admin/Indexset/index', '查看首页管理', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('14', 'Admin/Indexset/addFloor', '添加楼层', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('15', 'Admin/Indexset/modifyFloor', '修改楼层', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('16', 'Admin/Indexset/deleteFloor', '删除楼层', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('17', 'Admin/Indexset/loadData', '显示楼层图片广告', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('18', 'Admin/Indexset/viewClass', '查看可添加楼层', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('19', 'Admin/Indexset/editAd', '修改楼层广告', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('20', 'Admin/Indexset/insertAd', '添加楼层广告', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('21', 'Admin/Indexset/deleteAd', '删除楼层广告', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('22', 'Admin/Indexset/createPic', '添加楼层广告页面', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('23', 'Admin/Indexset/createText', '添加楼层文字广告页面', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('24', 'Admin/Indexset/editPic', '修改楼层广告页面', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('25', 'Admin/Indexset/editText', '修改楼层文字广告页面', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('26', 'Admin/Indexset/loadText', '显示楼层文字广告', '1', '1', '', '1');
INSERT INTO `ds_auth_rule` VALUES ('27', 'Admin/Adset/index', '广告管理首页', '1', '1', '', '2');
INSERT INTO `ds_auth_rule` VALUES ('28', 'Admin/Adset/createAd', '广告添加页面', '1', '1', '', '2');
INSERT INTO `ds_auth_rule` VALUES ('29', 'Admin/Adset/insertAd', '广告添加', '1', '1', '', '2');
INSERT INTO `ds_auth_rule` VALUES ('30', 'Admin/Adset/editAd', '广告修改页面', '1', '1', '', '2');
INSERT INTO `ds_auth_rule` VALUES ('31', 'Admin/Adset/updataAd', '广告修改', '1', '1', '', '2');
INSERT INTO `ds_auth_rule` VALUES ('32', 'Admin/Adset/deleteAd', '广告删除', '1', '1', '', '2');
INSERT INTO `ds_auth_rule` VALUES ('33', 'Admin/GoodsClass/index', '商品分类显示', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('34', 'Admin/GoodsClass/addClass', '商品分类添加页面', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('35', 'Admin/GoodsClass/modifyClass', '商品分类修改页面', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('36', 'Admin/GoodsClass/insertClass', '商品分类添加', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('37', 'Admin/GoodsClass/updataClass', '商品分类修改', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('38', 'Admin/GoodsClass/deleteClass', '商品分类删除', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('39', 'Admin/GoodsClass/viewClassId', '商品分类显示分类id', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('41', 'Admin/Goodsattr/index', '商品属性查看', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('42', 'Admin/Goodsattr/addAttr', '商品属性添加页面', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('43', 'Admin/Goodsattr/modifyAttr', '商品属性修改页面', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('44', 'Admin/Goodsattr/insertAttr', '商品属性添加', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('45', 'Admin/Goodsattr/updataAttr', '商品属性修改', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('46', 'Admin/Goodsattr/deleteAttr', '商品属性删除', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('47', 'Admin/Goodsbrand/index', '商品品牌查看', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('48', 'Admin/Goodsbrand/addBrand', '商品品牌添加页面', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('49', 'Admin/Goodsbrand/modifyBrand', '商品品牌修改页面', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('50', 'Admin/Goodsbrand/insertBrand', '商品品牌添加', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('51', 'Admin/Goodsbrand/updataBrand', '商品品牌修改', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('52', 'Admin/Goodsbrand/deleteBrand', '商品品牌删除', '1', '1', '', '4');
INSERT INTO `ds_auth_rule` VALUES ('53', 'Admin/Couponmanage/index', '显示优惠券组列表', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('54', 'Admin/Couponmanage/coupons', '优惠券详情列表', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('55', 'Admin/Couponmanage/addCoupon', '添加优惠券', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('56', 'Admin/Couponmanage/modifyCoupon', '修改优惠券', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('57', 'Admin/Couponmanage/insertCoupon', '优惠券添加', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('58', 'Admin/Couponmanage/updataCoupon', '优惠券修改', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('59', 'Admin/Couponmanage/deleteCoupon', '删除优惠券', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('60', 'Admin/Couponmanage/couponState', '更新优惠券状态', '1', '1', '', '7');
INSERT INTO `ds_auth_rule` VALUES ('62', 'Admin/Accesslist/index', '权限列表页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('63', 'Admin/Accesslist/addAccess', '权限添加页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('64', 'Admin/Accesslist/modifyAccess', '权限修改页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('65', 'Admin/Accesslist/insertAccess', '权限添加', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('66', 'Admin/Accesslist/updataAccess', '权限修改', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('67', 'Admin/Accesslist/deleteAccess', '权限删除', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('68', 'Admin/Accesslist/accessState', '权限状态更新', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('69', 'Admin/Grouplist/index', '角色管理页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('70', 'Admin/Grouplist/addGroup', '角色添加页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('71', 'Admin/Grouplist/modifyGroup', '角色修改页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('72', 'Admin/Grouplist/insertGroup', '角色添加', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('73', 'Admin/Grouplist/updataGroup', '角色修改', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('74', 'Admin/Grouplist/deleteGroup', '角色删除', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('75', 'Admin/Grouplist/groupState', '角色状态更新', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('76', 'Admin/Grouplist/groupMem', '角色成员管理页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('77', 'Admin/Grouplist/addMem', '角色成员添加页面', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('78', 'Admin/Grouplist/insertMem', '角色成员添加', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('79', 'Admin/Grouplist/deleteMem', '角色成员删除', '1', '1', '', '10');
INSERT INTO `ds_auth_rule` VALUES ('80', 'Admin/Member/index', '用户管理', '1', '1', '', '3');
INSERT INTO `ds_auth_rule` VALUES ('81', 'Admin/Memlevel/index', '用户等级', '1', '1', '', '3');
INSERT INTO `ds_auth_rule` VALUES ('82', 'Admin/Goodsissue/index', '商品发布', '1', '1', '', '5');
INSERT INTO `ds_auth_rule` VALUES ('83', 'Admin/Goodsup/index', '商品上架', '1', '1', '', '5');
INSERT INTO `ds_auth_rule` VALUES ('84', 'Admin/Goodsdown/index', '商品下架', '1', '1', '', '5');
INSERT INTO `ds_auth_rule` VALUES ('85', 'Admin/Ordermanage/index', '订单管理', '1', '1', '', '6');
INSERT INTO `ds_auth_rule` VALUES ('86', 'Admin/Reviewmanage/index', '评价管理', '1', '1', '', '9');
INSERT INTO `ds_auth_rule` VALUES ('87', 'Admin/Articleclasses/index', '文章分类', '1', '1', '', '8');
INSERT INTO `ds_auth_rule` VALUES ('88', 'Admin/Articlemanage/index', '文章管理', '1', '1', '', '8');
INSERT INTO `ds_auth_rule` VALUES ('89', 'Admin/index/mang', '网站管理', '1', '1', '', '1');

-- ----------------------------
-- Table structure for ds_bank
-- ----------------------------
DROP TABLE IF EXISTS `ds_bank`;
CREATE TABLE `ds_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbr` varchar(100) DEFAULT NULL COMMENT '英文缩写',
  `name` varchar(200) DEFAULT NULL COMMENT '中文名',
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=812 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_bank
-- ----------------------------
INSERT INTO `ds_bank` VALUES ('2', 'CCB', '中国建设银行', '/public/wx/wx/img/bank/bank_CCB.png');
INSERT INTO `ds_bank` VALUES ('1', 'BC', '中国银行', '/public/wx/wx/img/bank/bank_china.png');
INSERT INTO `ds_bank` VALUES ('3', 'ABC', '中国农业银行', '/public/wx/wx/img/bank/bank_abc.png');
INSERT INTO `ds_bank` VALUES ('4', 'ICBC ', '中国工商银行', '/public/wx/wx/img/bank/bank_icbc.png');
INSERT INTO `ds_bank` VALUES ('7', 'CMBC', '中国招商银行', '/public/wx/wx/img/bank/bank_cmb.png');
INSERT INTO `ds_bank` VALUES ('8', 'ZFB', '支付宝', '/public/wx/wx/img/bank/zfb.jpg');
INSERT INTO `ds_bank` VALUES ('9', 'WX', '微信', '/public/wx/wx/img/bank/wx.jpg');
INSERT INTO `ds_bank` VALUES ('6', 'PSB', '中国邮政银行', '/public/wx/wx/img/bank/bank_psb.png');
INSERT INTO `ds_bank` VALUES ('5', 'CGB', '广发银行', '/public/wx/wx/img/bank/bank_cgb.png');

-- ----------------------------
-- Table structure for ds_bankcard
-- ----------------------------
DROP TABLE IF EXISTS `ds_bankcard`;
CREATE TABLE `ds_bankcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `abbr` varchar(100) DEFAULT NULL COMMENT '英文缩写',
  `name` varchar(200) DEFAULT NULL COMMENT '中文名',
  `card` varchar(100) DEFAULT NULL,
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_bankcard
-- ----------------------------

-- ----------------------------
-- Table structure for ds_banner
-- ----------------------------
DROP TABLE IF EXISTS `ds_banner`;
CREATE TABLE `ds_banner` (
  `id` int(10) NOT NULL,
  `path` varchar(100) NOT NULL,
  `href` varchar(100) DEFAULT NULL,
  `addtime` int(10) DEFAULT NULL,
  `sort` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ds_banner
-- ----------------------------
INSERT INTO `ds_banner` VALUES ('4', '/Public/Uploads/20181117/3.jpg', '#', null, null);
INSERT INTO `ds_banner` VALUES ('2', '/Public/Uploads/20181117/4.jpg', '#', null, null);
INSERT INTO `ds_banner` VALUES ('3', '/Public/Uploads/20181117/2.jpg', '#', null, null);
INSERT INTO `ds_banner` VALUES ('1', '/Public/Uploads/20181117/1.jpg', '#', null, null);

-- ----------------------------
-- Table structure for ds_emoneydetail
-- ----------------------------
DROP TABLE IF EXISTS `ds_emoneydetail`;
CREATE TABLE `ds_emoneydetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '会员号',
  `mode` varchar(10) NOT NULL COMMENT '描述',
  `amount` decimal(10,0) NOT NULL COMMENT '提现金额',
  `charge` decimal(15,0) DEFAULT NULL COMMENT '手续费',
  `payment` decimal(10,0) DEFAULT NULL COMMENT '实际支付',
  `card` varchar(255) NOT NULL COMMENT '提现银行卡',
  `addtime` int(10) DEFAULT NULL COMMENT '提现时间',
  `type` varchar(100) NOT NULL DEFAULT '0' COMMENT '状态',
  `remark` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_emoneydetail
-- ----------------------------

-- ----------------------------
-- Table structure for ds_jinbidetail
-- ----------------------------
DROP TABLE IF EXISTS `ds_jinbidetail`;
CREATE TABLE `ds_jinbidetail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `tgaward` varchar(255) DEFAULT NULL,
  `member` varchar(255) DEFAULT '' COMMENT '会员编号',
  `adds` decimal(15,5) unsigned DEFAULT '0.00000' COMMENT '添加',
  `reduce` decimal(15,5) unsigned DEFAULT '0.00000' COMMENT '减少',
  `balance` decimal(15,5) unsigned DEFAULT '0.00000' COMMENT '余额',
  `addtime` int(10) DEFAULT '0' COMMENT '操作时间',
  `statustime` int(11) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT '' COMMENT '说明',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `member` (`member`),
  KEY `jid` (`jid`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=68 ROW_FORMAT=DYNAMIC COMMENT='金币明细';

-- ----------------------------
-- Records of ds_jinbidetail
-- ----------------------------
INSERT INTO `ds_jinbidetail` VALUES ('1', '0', '0', null, '13914844955', '1000.00000', '0.00000', '1000.00000', '1547775156', '0', '平台充值', '1');
INSERT INTO `ds_jinbidetail` VALUES ('2', '0', '0', null, '13914844955', '0.00000', '99.00000', '901.00000', '1547775431', '0', '购买转发机器人', '1');
INSERT INTO `ds_jinbidetail` VALUES ('3', '0', '2', '13914844955', '0', '4.95000', '0.00000', '0.00000', '1547775431', '0', '推荐1级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('4', '0', '2', '13914844955', '', '2.47500', '0.00000', '0.00000', '1547775431', '0', '推荐2级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('5', '0', '0', null, '13914844955', '0.00000', '99.00000', '802.00000', '1547775437', '0', '购买转发机器人', '1');
INSERT INTO `ds_jinbidetail` VALUES ('6', '0', '2', '13914844955', '0', '4.95000', '0.00000', '0.00000', '1547775437', '0', '推荐1级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('7', '0', '2', '13914844955', '', '2.47500', '0.00000', '0.00000', '1547775437', '0', '推荐2级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('8', '1', '1', null, '13914844955', '0.00105', '0.00000', '802.00000', '1547775444', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('9', '2', '1', null, '13914844955', '0.00057', '0.00000', '802.00000', '1547775444', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('10', '1', '1', null, '13914844955', '0.04772', '0.00000', '802.05000', '1547776033', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('11', '2', '1', null, '13914844955', '0.04772', '0.00000', '802.10000', '1547776033', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('12', '0', '0', null, '13914844955', '0.00000', '99.00000', '703.10000', '1547776058', '0', '购买转发机器人', '1');
INSERT INTO `ds_jinbidetail` VALUES ('13', '0', '2', '13914844955', '0', '4.95000', '0.00000', '0.00000', '1547776058', '0', '推荐1级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('14', '0', '2', '13914844955', '', '2.47500', '0.00000', '0.00000', '1547776058', '0', '推荐2级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('15', '1', '1', null, '13914844955', '0.00259', '0.00000', '703.10000', '1547776065', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('16', '2', '1', null, '13914844955', '0.00259', '0.00000', '703.10000', '1547776065', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('17', '3', '1', null, '13914844955', '0.00057', '0.00000', '703.10000', '1547776065', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('18', '0', '0', null, '13914844955', '0.00000', '99.00000', '604.10000', '1547776074', '0', '购买转发机器人', '1');
INSERT INTO `ds_jinbidetail` VALUES ('19', '0', '2', '13914844955', '0', '4.95000', '0.00000', '0.00000', '1547776074', '0', '推荐1级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('20', '0', '2', '13914844955', '', '2.47500', '0.00000', '0.00000', '1547776074', '0', '推荐2级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('21', '1', '1', null, '13914844955', '0.00113', '0.00000', '604.10000', '1547776079', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('22', '2', '1', null, '13914844955', '0.00113', '0.00000', '604.10000', '1547776079', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('23', '3', '1', null, '13914844955', '0.00113', '0.00000', '604.10000', '1547776079', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('24', '4', '1', null, '13914844955', '0.00041', '0.00000', '604.10000', '1547776079', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('25', '0', '0', null, '13914844955', '0.00000', '99.00000', '505.10000', '1547776084', '0', '购买转发机器人', '1');
INSERT INTO `ds_jinbidetail` VALUES ('26', '0', '2', '13914844955', '0', '4.95000', '0.00000', '0.00000', '1547776084', '0', '推荐1级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('27', '0', '2', '13914844955', '', '2.47500', '0.00000', '0.00000', '1547776084', '0', '推荐2级奖励', '1');
INSERT INTO `ds_jinbidetail` VALUES ('28', '1', '1', null, '13914844955', '0.00105', '0.00000', '505.10000', '1547776092', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('29', '2', '1', null, '13914844955', '0.00105', '0.00000', '505.10000', '1547776092', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('30', '3', '1', null, '13914844955', '0.00105', '0.00000', '505.10000', '1547776092', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('31', '4', '1', null, '13914844955', '0.00105', '0.00000', '505.10000', '1547776092', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('32', '5', '1', null, '13914844955', '0.00065', '0.00000', '505.10000', '1547776092', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('33', '1', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776095', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('34', '2', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776095', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('35', '3', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776095', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('36', '4', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776095', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('37', '5', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776095', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('38', '1', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776098', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('39', '2', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776098', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('40', '3', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776098', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('41', '4', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776098', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('42', '5', '1', null, '13914844955', '0.00024', '0.00000', '505.10000', '1547776098', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('43', '1', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776100', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('44', '2', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776100', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('45', '3', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776100', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('46', '4', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776100', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('47', '5', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776100', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('48', '1', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('49', '2', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('50', '3', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('51', '4', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('52', '5', '1', null, '13914844955', '0.00016', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('53', '1', '1', null, '13914844955', '0.00000', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('54', '2', '1', null, '13914844955', '0.00000', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('55', '3', '1', null, '13914844955', '0.00000', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('56', '4', '1', null, '13914844955', '0.00000', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('57', '5', '1', null, '13914844955', '0.00000', '0.00000', '505.10000', '1547776102', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('58', '1', '1', null, '13914844955', '0.00073', '0.00000', '505.10000', '1547776111', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('59', '2', '1', null, '13914844955', '0.00073', '0.00000', '505.10000', '1547776111', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('60', '3', '1', null, '13914844955', '0.00073', '0.00000', '505.10000', '1547776111', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('61', '4', '1', null, '13914844955', '0.00073', '0.00000', '505.10000', '1547776111', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('62', '5', '1', null, '13914844955', '0.00073', '0.00000', '505.10000', '1547776111', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('63', '1', '1', null, '13914844955', '0.00032', '0.00000', '505.10000', '1547776115', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('64', '2', '1', null, '13914844955', '0.00032', '0.00000', '505.10000', '1547776115', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('65', '3', '1', null, '13914844955', '0.00032', '0.00000', '505.10000', '1547776115', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('66', '4', '1', null, '13914844955', '0.00032', '0.00000', '505.10000', '1547776115', '0', '机器人收益', '1');
INSERT INTO `ds_jinbidetail` VALUES ('67', '5', '1', null, '13914844955', '0.00032', '0.00000', '505.10000', '1547776115', '0', '机器人收益', '1');

-- ----------------------------
-- Table structure for ds_log
-- ----------------------------
DROP TABLE IF EXISTS `ds_log`;
CREATE TABLE `ds_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作时间',
  `logaccount` varchar(45) NOT NULL DEFAULT '' COMMENT '操作对应的账号',
  `logip` varchar(100) NOT NULL DEFAULT '' COMMENT '操作者IP',
  `logdesc` varchar(200) NOT NULL DEFAULT '' COMMENT '操作描述',
  `logtype` varchar(10) NOT NULL DEFAULT '' COMMENT '日志类型: member:会员日志 admin:管理员日志',
  `logiplocal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logtype` (`logtype`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=68 ROW_FORMAT=DYNAMIC COMMENT='系统操作日志';

-- ----------------------------
-- Records of ds_log
-- ----------------------------
INSERT INTO `ds_log` VALUES ('1', '1547774801', 'admin', '223.104.16.166', '管理员[admin]登录', 'admin', '中国移动');
INSERT INTO `ds_log` VALUES ('2', '1547775082', '', '223.104.16.166', '编辑ID为1的管理员', 'admin', '中国移动');
INSERT INTO `ds_log` VALUES ('3', '1547775086', 'admin', '223.104.16.166', '管理员admin登出', 'admin', '中国移动');
INSERT INTO `ds_log` VALUES ('4', '1547775095', 'admin', '223.104.16.166', '管理员[admin]登录', 'admin', '中国移动');
INSERT INTO `ds_log` VALUES ('5', '1547775448', '', '223.104.16.166', '会员退出', 'member', '中国移动');

-- ----------------------------
-- Table structure for ds_mai_log
-- ----------------------------
DROP TABLE IF EXISTS `ds_mai_log`;
CREATE TABLE `ds_mai_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(11) NOT NULL,
  `number` int(1) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_mai_log
-- ----------------------------
INSERT INTO `ds_mai_log` VALUES ('1', '13914844955', '1', '1547775431');
INSERT INTO `ds_mai_log` VALUES ('2', '13914844955', '1', '1547775437');
INSERT INTO `ds_mai_log` VALUES ('3', '13914844955', '1', '1547776058');
INSERT INTO `ds_mai_log` VALUES ('4', '13914844955', '1', '1547776074');
INSERT INTO `ds_mai_log` VALUES ('5', '13914844955', '1', '1547776084');

-- ----------------------------
-- Table structure for ds_member
-- ----------------------------
DROP TABLE IF EXISTS `ds_member`;
CREATE TABLE `ds_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT '会员编号',
  `password` varchar(32) DEFAULT NULL COMMENT '一级密码',
  `regaddress` varchar(255) DEFAULT NULL COMMENT 'IP地址',
  `regip` varchar(255) DEFAULT '' COMMENT '注册IP',
  `regdate` int(10) DEFAULT NULL COMMENT '注册时间',
  `parent` varchar(255) DEFAULT NULL COMMENT '推荐人',
  `parent_id` int(11) unsigned NOT NULL COMMENT '推荐人ID',
  `dongjie` decimal(15,2) DEFAULT '0.00' COMMENT '冻结金额',
  `parentcount` int(11) DEFAULT '0' COMMENT '推荐人数',
  `money` decimal(15,2) unsigned DEFAULT '0.00' COMMENT '金币数量',
  `truename` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `logintime` int(10) DEFAULT '0' COMMENT '本次登录时间',
  `loginip` varchar(50) DEFAULT '' COMMENT '本次登录IP',
  `robotcount` int(10) DEFAULT '0' COMMENT '机器人总数',
  `logincount` int(10) DEFAULT '0' COMMENT '登录总次数',
  `parentpath` longtext COMMENT '推荐遗传码',
  `online_time` int(10) DEFAULT NULL COMMENT '最后登陆时间',
  `lock` tinyint(4) DEFAULT NULL COMMENT '锁定',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=278 ROW_FORMAT=DYNAMIC COMMENT='会员';

-- ----------------------------
-- Records of ds_member
-- ----------------------------
INSERT INTO `ds_member` VALUES ('1', '13914844955', 'e10adc3949ba59abbe56e057f20f883e', '中国移动', '1', '1547775123', null, '0', '0.00', '0', '505.10', '测试', null, '1547776029', '', '5', '0', '|', '1547776943', null);

-- ----------------------------
-- Table structure for ds_member_award_log
-- ----------------------------
DROP TABLE IF EXISTS `ds_member_award_log`;
CREATE TABLE `ds_member_award_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `send_type` tinyint(1) NOT NULL,
  `userortype_id` int(11) NOT NULL,
  `send_style` tinyint(1) NOT NULL,
  `num` int(11) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_member_award_log
-- ----------------------------

-- ----------------------------
-- Table structure for ds_member_recharge
-- ----------------------------
DROP TABLE IF EXISTS `ds_member_recharge`;
CREATE TABLE `ds_member_recharge` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_sn` varchar(100) NOT NULL,
  `fkzh` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gbc` decimal(15,2) NOT NULL,
  `rmb` decimal(15,2) NOT NULL,
  `bili` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `pay_type` varchar(30) NOT NULL,
  `note` varchar(100) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员充值表';

-- ----------------------------
-- Records of ds_member_recharge
-- ----------------------------

-- ----------------------------
-- Table structure for ds_message
-- ----------------------------
DROP TABLE IF EXISTS `ds_message`;
CREATE TABLE `ds_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(45) NOT NULL DEFAULT '' COMMENT '发件人',
  `pic` varchar(100) DEFAULT NULL COMMENT '头像',
  `truename` varchar(100) DEFAULT NULL,
  `content` text NOT NULL COMMENT '内容',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='站内信息表';

-- ----------------------------
-- Records of ds_message
-- ----------------------------
INSERT INTO `ds_message` VALUES ('23', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '1', '1542953506');
INSERT INTO `ds_message` VALUES ('24', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '2', '1543589074');
INSERT INTO `ds_message` VALUES ('25', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '2', '1543589074');
INSERT INTO `ds_message` VALUES ('26', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '2', '1543589074');
INSERT INTO `ds_message` VALUES ('27', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '2', '1543589074');
INSERT INTO `ds_message` VALUES ('28', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '2', '1543589074');
INSERT INTO `ds_message` VALUES ('29', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '111', '1543668403');
INSERT INTO `ds_message` VALUES ('30', '18888888888', '/public/wx/wx/guanliyuan.jpg', '系统管理员', '你好', '1544015924');
INSERT INTO `ds_message` VALUES ('31', '18295756368', '/Public/touxiang/Uploads/touxiang//1544272504520.png', '张碧莹', '在', '1544274836');
INSERT INTO `ds_message` VALUES ('32', '18295756368', '/Public/touxiang/Uploads/touxiang//1544272504520.png', '张碧莹', '在', '1544274836');
INSERT INTO `ds_message` VALUES ('33', '15581920309', '/Public/Uploads/touxiang/1542770980918.png', '乔运虎', 'nihao', '1544274881');

-- ----------------------------
-- Table structure for ds_node
-- ----------------------------
DROP TABLE IF EXISTS `ds_node`;
CREATE TABLE `ds_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `name` (`name`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=35 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_node
-- ----------------------------
INSERT INTO `ds_node` VALUES ('1', 'systemlogined', '后台应用', '1', '', '1', '0', '1');
INSERT INTO `ds_node` VALUES ('6', 'Rbac', 'Rbac权限控制', '1', '', '6', '1', '2');
INSERT INTO `ds_node` VALUES ('7', 'Index', '后台首页', '1', '', '1', '1', '2');
INSERT INTO `ds_node` VALUES ('10', 'index', '用户列表', '1', '', '1', '6', '3');
INSERT INTO `ds_node` VALUES ('11', 'role', '角色列表', '1', '', '1', '6', '3');
INSERT INTO `ds_node` VALUES ('12', 'node', '节点列表', '1', '', '1', '6', '3');
INSERT INTO `ds_node` VALUES ('16', 'index', '后台首页', '1', '', '1', '7', '3');
INSERT INTO `ds_node` VALUES ('17', 'Member', '会员管理', '1', '', '2', '1', '2');
INSERT INTO `ds_node` VALUES ('18', 'uncheck', '未审核会员', '1', '', '1', '17', '3');
INSERT INTO `ds_node` VALUES ('19', 'check', '会员查询', '1', '', '1', '17', '3');
INSERT INTO `ds_node` VALUES ('20', 'pw_list', '团队排位图', '1', '', '1', '17', '3');
INSERT INTO `ds_node` VALUES ('21', 'shu_list', '团队树形图', '1', '', '1', '17', '3');
INSERT INTO `ds_node` VALUES ('22', 'Jinbidetail', '资金管理', '1', '', '4', '1', '2');
INSERT INTO `ds_node` VALUES ('23', 'index', 'pv明细', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('24', 'paylists', '充值管理', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('25', 'emoneyWithdraw', '提现管理', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('26', 'shop', '商城管理', '1', '', '3', '1', '2');
INSERT INTO `ds_node` VALUES ('27', 'type_list', '分类列表', '1', '', '1', '26', '3');
INSERT INTO `ds_node` VALUES ('28', 'Info', '信息交流', '1', '', '5', '1', '2');
INSERT INTO `ds_node` VALUES ('29', 'announce', '公告管理', '1', '', '1', '28', '3');
INSERT INTO `ds_node` VALUES ('30', 'annType', '公告类别', '1', '', '1', '28', '3');
INSERT INTO `ds_node` VALUES ('31', 'msgReceive', '收件箱', '1', '', '1', '28', '3');
INSERT INTO `ds_node` VALUES ('32', 'msgSend', '发件箱', '1', '', '1', '28', '3');
INSERT INTO `ds_node` VALUES ('33', 'System', '系统设置', '1', '', '7', '1', '2');
INSERT INTO `ds_node` VALUES ('34', 'backUp', '数据备份', '1', '', '1', '33', '3');
INSERT INTO `ds_node` VALUES ('35', 'customSetting', '自定义配置', '1', '', '1', '33', '3');
INSERT INTO `ds_node` VALUES ('36', ' jiangjin', '奖金查询', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('37', 'member_group', '会员等级', '1', '', '1', '17', '3');
INSERT INTO `ds_node` VALUES ('38', 'lists', '商品列表', '1', '', '1', '26', '3');
INSERT INTO `ds_node` VALUES ('39', 'orderlist', '订单列表', '1', '', '1', '26', '3');
INSERT INTO `ds_node` VALUES ('40', 'paylist', '零售管理', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('41', 'jinzhongzi', '重消明细', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('42', 'point', '代金券明细', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('43', 'editPay', '零售操作', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('44', 'editPays', '充值操作', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('45', 'editEmoney', '提现操作', '1', '', '1', '22', '3');
INSERT INTO `ds_node` VALUES ('46', 'editPayhandles', '充值提交操作', '1', '', '1', '22', '3');

-- ----------------------------
-- Table structure for ds_order
-- ----------------------------
DROP TABLE IF EXISTS `ds_order`;
CREATE TABLE `ds_order` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(30) DEFAULT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `project` varchar(30) DEFAULT NULL,
  `count` decimal(10,2) DEFAULT '0.00',
  `sumprice` decimal(10,2) NOT NULL,
  `addtime` varchar(30) DEFAULT NULL,
  `UG_getTime` int(11) unsigned NOT NULL DEFAULT '0',
  `zt` int(10) NOT NULL DEFAULT '0',
  `sid` int(11) DEFAULT NULL,
  `imagepath` text,
  `yxzq` varchar(60) DEFAULT NULL COMMENT '可运行时间小时',
  `shouyi` decimal(15,8) DEFAULT NULL COMMENT '收益每小时',
  `kjbh` varchar(255) DEFAULT NULL,
  `already_profit` decimal(15,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '已经收益',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_order
-- ----------------------------
INSERT INTO `ds_order` VALUES ('1', '13914844955', '1', '转发机器人', '0.00', '99.00', '2019-01-18 09:37:11', '1547776115', '1', '1', '/Public/Uploads/20190115/5c3cb6d289302.jpg', '1440', '0.29166660', 'A187543111', '0.05');
INSERT INTO `ds_order` VALUES ('2', '13914844955', '1', '转发机器人', '0.00', '99.00', '2019-01-18 09:37:17', '1547776115', '1', '1', '/Public/Uploads/20190115/5c3cb6d289302.jpg', '1440', '0.29166660', 'A187543709', '0.05');
INSERT INTO `ds_order` VALUES ('3', '13914844955', '1', '转发机器人', '0.00', '99.00', '2019-01-18 09:47:38', '1547776115', '1', '1', '/Public/Uploads/20190115/5c3cb6d289302.jpg', '1440', '0.29166660', 'A187605870', '0.00');
INSERT INTO `ds_order` VALUES ('4', '13914844955', '1', '转发机器人', '0.00', '99.00', '2019-01-18 09:47:54', '1547776115', '1', '1', '/Public/Uploads/20190115/5c3cb6d289302.jpg', '1440', '0.29166660', 'A187607463', '0.00');
INSERT INTO `ds_order` VALUES ('5', '13914844955', '1', '转发机器人', '0.00', '99.00', '2019-01-18 09:48:04', '1547776115', '1', '1', '/Public/Uploads/20190115/5c3cb6d289302.jpg', '1440', '0.29166660', 'A187608406', '0.00');

-- ----------------------------
-- Table structure for ds_paydetail
-- ----------------------------
DROP TABLE IF EXISTS `ds_paydetail`;
CREATE TABLE `ds_paydetail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(100) NOT NULL,
  `account` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_paydetail
-- ----------------------------

-- ----------------------------
-- Table structure for ds_product
-- ----------------------------
DROP TABLE IF EXISTS `ds_product`;
CREATE TABLE `ds_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `title` char(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` mediumint(9) NOT NULL DEFAULT '0',
  `yxzq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `shouyi` decimal(15,8) unsigned NOT NULL DEFAULT '0.00000000',
  `thumb` char(255) NOT NULL DEFAULT 'pic.png',
  `content` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `inputtime` int(11) unsigned NOT NULL,
  `xiangou` int(11) NOT NULL COMMENT '限购',
  `is_on` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_product
-- ----------------------------
INSERT INTO `ds_product` VALUES ('1', '1', '转发机器人', '99.00', '999877', '1440', '0.29166660', '/Public/Uploads/20190115/5c3cb6d289302.jpg', '转发机器人', '0', '1509817831', '20', '0');

-- ----------------------------
-- Table structure for ds_qjinbidetail
-- ----------------------------
DROP TABLE IF EXISTS `ds_qjinbidetail`;
CREATE TABLE `ds_qjinbidetail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `member` varchar(255) DEFAULT '' COMMENT '会员编号',
  `adds` decimal(12,2) unsigned DEFAULT '0.00' COMMENT '添加',
  `reduce` decimal(12,2) unsigned DEFAULT '0.00' COMMENT '减少',
  `balance` decimal(12,2) unsigned DEFAULT '0.00' COMMENT '余额',
  `addtime` int(10) DEFAULT '0' COMMENT '操作时间',
  `statustime` int(11) unsigned NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT '' COMMENT '说明',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `member` (`member`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=68 ROW_FORMAT=DYNAMIC COMMENT='欠钱明细';

-- ----------------------------
-- Records of ds_qjinbidetail
-- ----------------------------

-- ----------------------------
-- Table structure for ds_session
-- ----------------------------
DROP TABLE IF EXISTS `ds_session`;
CREATE TABLE `ds_session` (
  `session_id` varchar(255) NOT NULL DEFAULT '',
  `session_expire` int(11) NOT NULL,
  `session_data` blob,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=196 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_session
-- ----------------------------

-- ----------------------------
-- Table structure for ds_sms_log
-- ----------------------------
DROP TABLE IF EXISTS `ds_sms_log`;
CREATE TABLE `ds_sms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '表id',
  `mobile` varchar(11) DEFAULT '' COMMENT '手机号',
  `session_id` varchar(128) DEFAULT '' COMMENT 'session_id',
  `add_time` int(11) DEFAULT '0' COMMENT '发送时间',
  `code` varchar(10) DEFAULT '' COMMENT '验证码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_sms_log
-- ----------------------------

-- ----------------------------
-- Table structure for ds_type
-- ----------------------------
DROP TABLE IF EXISTS `ds_type`;
CREATE TABLE `ds_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `path` char(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_type
-- ----------------------------
INSERT INTO `ds_type` VALUES ('1', 'A', '0', '0');
INSERT INTO `ds_type` VALUES ('2', 'B', '0', '0');
INSERT INTO `ds_type` VALUES ('3', 'C', '0', '0');
INSERT INTO `ds_type` VALUES ('4', 'D', '0', '0');
INSERT INTO `ds_type` VALUES ('5', 'E', '0', '0');
INSERT INTO `ds_type` VALUES ('6', 'F', '0', '0');
INSERT INTO `ds_type` VALUES ('7', 'G', '0', '0');
INSERT INTO `ds_type` VALUES ('8', 'H', '0', '0');
INSERT INTO `ds_type` VALUES ('9', 'I', '0', '0');
INSERT INTO `ds_type` VALUES ('10', 'J', '0', '0');
INSERT INTO `ds_type` VALUES ('11', 'K', '0', '0');
INSERT INTO `ds_type` VALUES ('12', 'L', '0', '0');
INSERT INTO `ds_type` VALUES ('13', 'M', '0', '0');
INSERT INTO `ds_type` VALUES ('14', 'N', '0', '0');
INSERT INTO `ds_type` VALUES ('15', 'O', '0', '0');
INSERT INTO `ds_type` VALUES ('16', 'P', '0', '0');
INSERT INTO `ds_type` VALUES ('17', 'Q', '0', '0');
INSERT INTO `ds_type` VALUES ('18', 'R', '0', '0');
INSERT INTO `ds_type` VALUES ('19', 'S', '0', '0');
INSERT INTO `ds_type` VALUES ('20', 'T', '0', '0');
INSERT INTO `ds_type` VALUES ('21', 'U', '0', '0');
INSERT INTO `ds_type` VALUES ('22', 'V', '0', '0');
INSERT INTO `ds_type` VALUES ('23', 'W', '0', '0');
INSERT INTO `ds_type` VALUES ('24', 'X', '0', '0');
INSERT INTO `ds_type` VALUES ('25', 'Y', '0', '0');
INSERT INTO `ds_type` VALUES ('26', 'Z', '0', '0');

-- ----------------------------
-- Table structure for ds_user
-- ----------------------------
DROP TABLE IF EXISTS `ds_user`;
CREATE TABLE `ds_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `logtime` int(10) NOT NULL,
  `loginip` char(30) NOT NULL DEFAULT '',
  `lock` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=256 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of ds_user
-- ----------------------------
INSERT INTO `ds_user` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '1547775095', '223.104.16.166', '0');
