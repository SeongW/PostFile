<?php
    // 显示停车登记成功页面
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();
    $carnumber = $_POST['carnumber'];
    $id = $_POST['id'];
    echo '<div class="container">';
    if (parkingCar($id, $carnumber)) {
        echo '<h1>完成</h1>';
    } else {
        echo '<h1>出错，请重新尝试</h1>';
    }
    echo '<a href="manage.php"><button type="button" name="button" class="btn btn-defalut btn-success">返回</button></a>';
    echo '</div>';
    do_html_footer();
