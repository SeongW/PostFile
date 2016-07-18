<?php
    //显示已停车车位信息
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();
    show_parking_car();
    do_html_footer();
