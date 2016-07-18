<?php
    // 确认续费页面
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();

    $number = $_POST['carnumber'];
    $months = $_POST['months'];
    $res = addMoths($number, $months);
    if ($res) {
        ?>
        <div class="container">
            <h1>完成</h1>
            <a href="vipCar.php"><button type="button" name="button" class="btn btn-defalut btn-success">返回</button></a>
        </div>
    <?php

    } else {
        ?>
        <div class="container">
            <h1>网络出错了，请重新登记</h1>
            <a href="vipCar.php"><button type="button" name="button" class="btn btn-defalut btn-success">返回</button></a>
        </div>
        <?php

    }
    do_html_footer();
