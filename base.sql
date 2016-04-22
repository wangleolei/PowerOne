# Host: localhost  (Version: 5.5.40)
# Date: 2016-03-28 21:55:12
# Generator: MySQL-Front 5.3  (Build 4.120)

/*!40101 SET NAMES utf8 */;
 
#
# Structure for table "base_article"
#

DROP TABLE IF EXISTS `base_article`;
CREATE TABLE `base_article` (
  `ar_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `ar_state` tinyint(3) NOT NULL DEFAULT '1' COMMENT '发布状态 1正常发布 2存稿箱 3已删除',
  `ar_class` int(11) NOT NULL DEFAULT '1' COMMENT '文章的类别 同名class表内容',
  `ar_position` tinyint(3) NOT NULL DEFAULT '1' COMMENT '置顶状态 0正常 1推荐 2置顶 3置顶并推荐',
  `ar_title` varchar(32) NOT NULL DEFAULT '' COMMENT '标题',
  `ar_keywords` varchar(16) NOT NULL DEFAULT '' COMMENT '关键字',
  `ar_description` varchar(128) NOT NULL DEFAULT '' COMMENT '导航语',
  `ar_cover_img` varchar(128) DEFAULT NULL COMMENT '封面图片url',
  `ar_file` int(11) NOT NULL DEFAULT '0' COMMENT '文章附件',
  `ar_source` varchar(16) DEFAULT NULL COMMENT '转载来源',
  `ar_hits` int(11) NOT NULL DEFAULT '0' COMMENT '阅读数',
  `ar_user` int(11) NOT NULL DEFAULT '1' COMMENT '作者ID',
  `ar_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发表时间',
  `ar_last_user` int(11) NOT NULL DEFAULT '0' COMMENT '最后编辑作者ID',
  `ar_last_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后编辑时间ID',
  PRIMARY KEY (`ar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章参数表';

#
# Data for table "base_article"
#

/*!40000 ALTER TABLE `base_article` DISABLE KEYS */;
INSERT INTO `base_article` VALUES (1,1,1,1,'欢迎使用base个人博客程序','base个人博客','这是第一篇文章，欢迎使用base v1.50.20160329','/upload/image/system/thumb2.jpg',0,NULL,4,1,1459158459,1,1459158459);
/*!40000 ALTER TABLE `base_article` ENABLE KEYS */;

#
# Structure for table "base_Articleclass"
# ALTER TABLE  `base_Articleclass` ADD  `ar_parent` INT( 11 ) NOT NULL DEFAULT  '0' COMMENT  '上一层' AFTER  `ar_class`

DROP TABLE IF EXISTS `base_Articleclass`;
CREATE TABLE `base_Articleclass` (
  `ar_class` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `ar_parent`  int(11) NOT NULL DEFAULT  '0' COMMENT  '上一层',
  `ar_c_title` varchar(10) NOT NULL DEFAULT '' COMMENT '类别名',
  `ar_c_number` tinyint(3) NOT NULL DEFAULT '0' COMMENT '该类日志数量',
  PRIMARY KEY (`ar_class`),
  KEY `副索引` (`ar_c_title`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='文章类别表';

#
# Data for table "base_Articleclass"
#

/*!40000 ALTER TABLE `base_Articleclass` DISABLE KEYS */;
INSERT INTO `base_Articleclass` VALUES (1,0,'默认分类',0);
/*!40000 ALTER TABLE `base_Articleclass` ENABLE KEYS */;

#
# Structure for table "base_articledata"
#

DROP TABLE IF EXISTS `base_articledata`;
CREATE TABLE `base_articledata` (
  `ar_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `ar_body` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`ar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章主内容';

#
# Data for table "base_articledata"
#

/*!40000 ALTER TABLE `base_articledata` DISABLE KEYS */;
INSERT INTO `base_articledata` VALUES (1,'<p>欢迎使用base个人博客程序，当前版本为：base v1.50.20160329</p><p>这是一篇测试文章，如果有什么疑问可以访问 <a title=\"base个人博客\" target=\"_self\" href=\"http://base.com\">base个人博客</a><br/></p>');
/*!40000 ALTER TABLE `base_articledata` ENABLE KEYS */;

#
# Structure for table "base_link"
#

DROP TABLE IF EXISTS `base_link`;
CREATE TABLE `base_link` (
  `li_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `li_state` int(11) NOT NULL DEFAULT '1' COMMENT '链接状态 1正常 2审核中 3不通过 4待删除',
  `li_mode` tinyint(3) NOT NULL DEFAULT '1' COMMENT '插入方式 1用户申请 2管理员插入',
  `li_admin` int(11) NOT NULL DEFAULT '1' COMMENT '管理操作人ID',
  `li_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '建立时间',
  `li_url` varchar(64) NOT NULL DEFAULT '' COMMENT '地址链接',
  `li_title` varchar(32) NOT NULL DEFAULT '' COMMENT '链接页面标题',
  `li_description` varchar(64) DEFAULT NULL COMMENT '链接页面描述',
  `li_name` varchar(16) DEFAULT NULL COMMENT '友链站长称呼',
  `li_email` varchar(64) NOT NULL DEFAULT '' COMMENT '站点联系邮箱',
  PRIMARY KEY (`li_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='友情链接表';

#
# Data for table "base_link"
#

/*!40000 ALTER TABLE `base_link` DISABLE KEYS */;
INSERT INTO `base_link` VALUES (1,1,2,1,1459158177,'http://base.com','base个人博客',NULL,NULL,'774694235@qq.com');
/*!40000 ALTER TABLE `base_link` ENABLE KEYS */;

#
# Structure for table "base_notice"
#

DROP TABLE IF EXISTS `base_notice`;
CREATE TABLE `base_notice` (
  `no_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `no_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '类型 1心情说说 2公告 3轮播图',
  `no_title` varchar(32) NOT NULL DEFAULT '' COMMENT '标题',
  `no_content` text COMMENT '发布内容',
  `no_cover_img` varchar(128) DEFAULT NULL COMMENT '轮播图片',
  `no_to_article` int(11) DEFAULT NULL COMMENT '链接至文章',
  `no_user` int(11) NOT NULL DEFAULT '1' COMMENT '发布人ID',
  `no_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `no_ip` varchar(20) DEFAULT NULL COMMENT '发布时IP',
  `no_os` varchar(20) DEFAULT NULL COMMENT '发布时系统',
  PRIMARY KEY (`no_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='心情、轮播、公告';

#
# Data for table "base_notice"
#

/*!40000 ALTER TABLE `base_notice` DISABLE KEYS */;
INSERT INTO `base_notice` VALUES (1,1,'欢迎使用base个人博客程序','<p>欢迎使用base个人博客程序</p>',NULL,NULL,1,1459158544,'0.0.0.0','Win 10'),(2,2,'欢迎使用base个人博客程序','<p>欢迎使用base个人博客程序</p>',NULL,NULL,1,1459158553,'0.0.0.0','Win 10'),(3,3,'欢迎使用base个人博客程序','<p><img alt=\"slider01.jpg\" src=\"/upload/image/20160328/1459158732222732.jpg\" title=\"1459158732222732.jpg\"/></p>','/upload/image/20160328/1459158732222732.jpg',1,1,1459158734,'0.0.0.0','Win 10');
/*!40000 ALTER TABLE `base_notice` ENABLE KEYS */;

#
# Structure for table "base_parameter"
#

DROP TABLE IF EXISTS `base_parameter`;
CREATE TABLE `base_parameter` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `pa_class` int(11) NOT NULL DEFAULT '1' COMMENT '值的类型 同名class表内容',
  `pa_attribute` varchar(64) NOT NULL DEFAULT '' COMMENT '属性',
  `pa_value` text COMMENT '值',
  `pa_explain` varchar(64) NOT NULL DEFAULT '' COMMENT '参数说明',
  `pa_form` int(11) NOT NULL DEFAULT '1' COMMENT '值的类型 1文本 2内容 3密码 4上传 5布尔 6单选 7复选',
  `pa_form_explain` varchar(128) DEFAULT NULL COMMENT '值的格式要求提示文本',
  PRIMARY KEY (`pa_id`),
  UNIQUE KEY `se_attribute` (`pa_attribute`(16))
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='参数信息表';

#
# Data for table "base_parameter"
#

/*!40000 ALTER TABLE `base_parameter` DISABLE KEYS */;
INSERT INTO `base_parameter` VALUES (1,1,'site_url','http://localhost','网站域名',1,'网站域名，带 http:// 前缀'),(2,1,'site_catalog','/base.com','站点目录',1,'站点目录，格式为 /abc ，留空则表示根目录'),(3,1,'site_record','','备案号码',1,'备案号码，使用国内主机域名必须备案'),(4,1,'site_time','','上线时间',1,'网站上线时间，代表网站上线至今的版权'),(5,1,'site_logo','/upload/image/20160324/14587973695.png','站点LOGO',4,'格式：180*50 | 文件不超过1M | PNG / JPG 格式'),(6,1,'site_name','base v1.50 站点','站点名称',1,'站点名称'),(7,1,'site_name_suffix','','站点名称后缀',1,'站点名称后缀，在站点名称后以【-】连接，可留空'),(8,1,'site_keywords','base个人博客,base','SEO关键字',2,'SEO的关键字'),(9,1,'site_description','','SEO说明',2,'SEO说明'),(10,1,'site_version','base v1.50.20160329','站点程序版本',1,'站点当前使用的程序版本'),(11,1,'site_author','base','使用程序名称',1,'站点使用的程序名称'),(12,2,'official_logo','/upload/image/20160301/145681754112.png','官方标识',4,'即站长头像 格式：50*50 | 文件不超过1M | PNG / JPG 格式'),(13,2,'official_name','伊始','官方名称',1,'名称，即站长名称'),(14,2,'official_address','','联系地址',1,'地址'),(15,2,'official_number','','联系号码',1,'联系号码'),(16,2,'official_qq','774694235','官方QQ号码',1,'QQ'),(17,2,'official_code','/upload/image/20160301/145681754117.png','二维码',4,'二维码  格式：50*50 | 文件不超过1M | PNG / JPG 格式'),(18,3,'email_is','true','是否启用',5,'是否启用邮件服务'),(19,3,'email_host','smtp.qq.com','smtp地址',1,'smtp邮件地址，请根据使用的邮箱账户自行百度'),(20,3,'email_name','伊始','发件名称',1,'发件人的名字'),(21,3,'email_from','774694235@qq.com','发件邮箱',1,'发件人的邮箱，可与使用的邮箱账户不同'),(22,3,'email_username','774694235@qq.com','邮箱账户',1,'使用的邮箱账户名'),(23,3,'email_password','qqchendou','邮箱密码',3,'使用的邮箱密码');
/*!40000 ALTER TABLE `base_parameter` ENABLE KEYS */;

#
# Structure for table "base_parameter_class"
# ALTER TABLE  `base_parameter_class` ADD  `pa_map` INT( 11 ) NOT NULL DEFAULT  '0' COMMENT  '映射到Class' AFTER  `pa_class`

DROP TABLE IF EXISTS `base_parameter_class`;
CREATE TABLE `base_parameter_class` (
  `pa_class` int(11) NOT NULL AUTO_INCREMENT COMMENT '键值对类型',
  `pa_map` int( 11 ) NOT NULL DEFAULT  '0' COMMENT  '映射到Class',
  `pa_t_title` varchar(16) NOT NULL DEFAULT '' COMMENT '类型说明',
  PRIMARY KEY (`pa_class`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='参数类别表';

#
# Data for table "base_coded"
#

/*!40000 ALTER TABLE `base_parameter_class` DISABLE KEYS */;
INSERT INTO `base_parameter_class` VALUES (1,0,'站点信息'),(2,0,'官方信息'),(3,0,'邮箱配置');
/*!40000 ALTER TABLE `base_parameter_class` ENABLE KEYS */;

# Structure for table "base_codedvalue"
DROP TABLE IF EXISTS `base_codedvalue`;
CREATE TABLE `base_codedvalue` (
  `seq_number` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识',
  `index` int(5) NOT NULL DEFAULT '0' COMMENT '一个属性的定义',
  `sort_value` int(5) NOT NULL DEFAULT '0' COMMENT '用于排序',
  `int_value` int(11) NOT NULL DEFAULT '0' COMMENT 'internal value',
  `ext_value` varchar(9) NOT NULL DEFAULT '' COMMENT 'external value',
  `oth_value` varchar(9) NOT NULL DEFAULT '' COMMENT 'other value',
  `short_desc` varchar(40) NOT NULL DEFAULT '' COMMENT 'short description',
  `long_desc` varchar(100) NOT NULL DEFAULT '' COMMENT 'long description',
  PRIMARY KEY (`seq_number`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='coded value table';

#
# Data for table "base_parameter"
#

/*!40000 ALTER TABLE `base_parameter` DISABLE KEYS */;
INSERT INTO `base_codedvalue` VALUES (1,10000,1,1,'menu','','首页','菜单'),(2,10000,2,2,'menu','','最新动态','菜单'),(3,10000,3,3,'menu','','技术分享','菜单'),(4,10000,4,4,'menu','','作品分享','菜单'),(5,10000,5,5,'menu','','留言板','菜单'),(6,10000,6,6,'menu','','关于我们','菜单');
/*!40000 ALTER TABLE `base_parameter` ENABLE KEYS */;


#
# Structure for table "base_user"
#

DROP TABLE IF EXISTS `base_user`;
CREATE TABLE `base_user` (
  `us_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `us_type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '用户类型 1普通 2QQ',
  `us_portrait` varchar(128) DEFAULT NULL COMMENT '用户头像URL',
  `us_nickname` varchar(16) DEFAULT NULL COMMENT '用户昵称',
  `us_email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `us_add_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `us_last_os` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登陆OS',
  `us_last_time` int(11) unsigned DEFAULT NULL COMMENT '最后登录时间',
  `us_last_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登陆IP',
  `us_login_sum` int(11) NOT NULL DEFAULT '1' COMMENT '登陆总数',
  PRIMARY KEY (`us_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户信息表';

#
# Data for table "base_user"
#

/*!40000 ALTER TABLE `base_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `base_user` ENABLE KEYS */;

#
# Structure for table "base_useradmin"
#

DROP TABLE IF EXISTS `base_useradmin`;
CREATE TABLE `base_useradmin` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '唯一标识ID',
  `ad_state` tinyint(3) NOT NULL DEFAULT '1' COMMENT '账户状态 1正常 2禁止登陆',
  `ad_group` tinyint(3) DEFAULT '2' COMMENT '用户组 1超级管理员 2正常组 3黑名单',
  `ad_username` varchar(16) DEFAULT NULL COMMENT '账户名',
  `ad_password` varchar(32) DEFAULT NULL COMMENT '密码 MD5加密',
  `ad_email` varchar(64) DEFAULT NULL COMMENT '邮箱',
  `ad_nickname` varchar(16) DEFAULT NULL COMMENT '用户昵称',
  `ad_portrait` varchar(128) DEFAULT NULL COMMENT '用户头像',
  `ad_last_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `ad_last_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登陆IP',
  `ad_last_os` varchar(20) NOT NULL DEFAULT '' COMMENT '最后登陆OS',
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='管理员账户';

#
# Data for table "base_useradmin"
#

/*!40000 ALTER TABLE `base_useradmin` DISABLE KEYS */;
INSERT INTO `base_useradmin` VALUES (1,1,1,'leo','leo',NULL,NULL,NULL,1459157368,'0.0.0.0','Win 10');
/*!40000 ALTER TABLE `base_useradmin` ENABLE KEYS */;

DROP TABLE IF EXISTS `base_parameter`;
DROP TABLE IF EXISTS `base_parameter_class`;