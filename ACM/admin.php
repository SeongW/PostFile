<?php

// 应用入口文件
// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}
define('APP_DEBUG', true);
define('BIND_MODULE', 'Admin');
define('APP_PATH', './Application/');
// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';
