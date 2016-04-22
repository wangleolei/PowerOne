<?php
// Home 配置
return array(
    // QQ 登录 API
    'QQ_APP_ID'       => 000000000,                             // 申请的APP ID
    'QQ_APP_KEY'      => '********************************',    // 申请的APP KEY
    'QQ_APP_URL'      => '******************',                  // 申请成功后设置的回调地址
    // 路由规则
    'URL_ROUTER_ON'   => true,                                  // 开启路由规则，下面是规则条目
    'URL_ROUTE_RULES' => array(
        // 文章与文章分页
        '/^article\/(\d{1,})$/'             =>  'article/index?id=:1',
        '/^article\/(\d{1,})_(\d{1,})$/'    =>  'article/index?id=:1&page=:2',
        // 文章类别与分页
        '/^articles\/(\d{1,})$/'            =>  'articles/index?class=:1',
        '/^articles\/(\d{1,})_(\d{1,})$/'   =>  'articles/index?class=:1&page=:2',
        '/^articles_(\d{1,})$/'             =>  'articles/index?page=:1',
        // 说说心情分页
        '/^mood_(\d{1,})$/'                 =>  'mood/index?page=:1',
        // 留言板留言分页
        '/^comment_(\d{1,})$/'              =>  'comment/index?page=:1',
        // 搜索分页
        '/^search\/([^_]{1,})$/'            =>  'search/index?search=:1',
        '/^search\/([^_]{1,})_(\d{1,})$/'   =>  'search/index?search=:1&page=:2',
     ),
);