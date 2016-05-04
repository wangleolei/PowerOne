<?php
return array(
	'DB_PREFIX'             => 'wechat_',                      // 数据前缀
	'URL_MODEL' =>2,    //开启路由
	'URL_ROUTER_ON' => true,    //路由规则
	'URL_ROUTE_RULES' => array(
	//查看日志详情路由优化
	'/^lookblog\/(\d{1,})$/'	=>	'lookblog/index?blog_number=:1',
 ),

);