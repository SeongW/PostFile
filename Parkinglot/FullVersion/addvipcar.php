<?php
    //添加新的月费车辆信息
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();
    do_html_new_vip_car();
    do_html_footer();
