<?php
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();
    $id = $_GET['id'];
    if (checkPosition($id)) {
        echo '<h1>正在被使用</h1>';
        echo '<a href="manage.php"><button type="button" name="button" class="btn btn-defalut btn-success">返回</button></a>';
    } else {
        do_html_parkcar($id);
    }

    do_html_footer();
