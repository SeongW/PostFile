<?php
/**
 * Created by PhpStorm.
 * User: wujiacheng
 * Date: 16/5/28
 * Time: 00:24
 */
require 'Parsedown.php';

$content = $GLOBALS["HTTP_RAW_POST_DATA"];
$Parsedown = new Parsedown();

echo $Parsedown->parse($content);
