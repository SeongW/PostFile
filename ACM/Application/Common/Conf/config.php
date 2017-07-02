<?php

return array(
    'LOAD_EXT_CONFIG' => 'db,user', //额外配置
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'), //只允许访问的模块，其他模块均不能访问
    'DEFAULT_MODULE' => 'Home',    //默认模块
    'URL_404_REDIRECT' => './Public/404.html',
    'URL_CASE_INSENSITIVE' =>true, //不区分大小写
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__.'/Public',
        '__JS__' => __ROOT__.'/Public/Js',
        '__CSS__' => __ROOT__.'/Public/Css',
        '__IMAGE__' => __ROOT__.'/Public/Image',
        ),
);
