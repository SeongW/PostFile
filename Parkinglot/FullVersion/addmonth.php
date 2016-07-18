<?php
    /*
    显示续费页面
    */
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();
    $number = $_GET['carnumber'];
    do_html_add_month($number);
    do_html_footer();
