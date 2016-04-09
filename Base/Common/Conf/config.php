<?php
return array(
    // 数据库
    'DB_TYPE'               => 'mysql',                         // 数据库类型
    'DB_HOST'               => 'localhost',                     // 服务器地址
    'DB_NAME'               => 'powerone',                       // 数据库名称
    'DB_USER'               => 'root',                          // 用户名
    'DB_PWD'                => 'leo',               // 密码
    'DB_PREFIX'             => 'base_',                      // 数据前缀
    'DB_PORT'               => 3306,                            // 端口
    'DB_CHARSET'            => 'utf8',                          // 字符集
    // 分组配置
    'MODULE_ALLOW_LIST'     => array ('Home','Admin'),          // 默认分组可以省略Home
    'DEFAULT_MODULE'        => 'Home',                          // 默认模块Home
    'DEFAULT_ACTION'        => 'index',                         // 默认操作index
    // 路由模式
    'URL_MODEL'             => 2,                               // 路由模式为2，消除index.php
 
);