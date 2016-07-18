<?php
    // 确认车辆离开
    require_once 'parkingCar_fns.php';

    session_start();

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();

    $id = $_GET['id'];
    leaveParkinglot($id);
    ?>
        <div class="container">

            <h1>完成</h1>
            <a href="usinglot.php"><button type="button" name="button" class="btn btn-defalut btn-success">返回</button></a>
        </div>
    <?php
    do_html_footer();
