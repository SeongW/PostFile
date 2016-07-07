<?php
    require_once 'db_fns.php';
    require_once 'display.php';
    header('Content-Type:text/html;charset=utf8');
    function p($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
