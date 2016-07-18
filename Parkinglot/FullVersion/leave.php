<?php
    // 离开停车场，收费页面
    require_once 'parkingCar_fns.php';

    session_start();
    date_default_timezone_set('Asia/Chongqing');

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();

    $id = $_GET['id'];
    $res = leaveCarTime($id);
    if ($res[1]) {
        $now = @date('y-m-d H:i:s', time());
        $minutes = @(strtotime($now) - strtotime($res[0])) / 60;
        $isVip = checkVipCar($res[2]);
        if ($isVip) {
            $cost = 0;
        } else {
            if ($minutes < 30) {
                $cost = 0;
            } elseif ($minutes > 600) {
                $cost = 50;
            } else {
                $cost = (floor($minutes / 60) + 1) * 5;
            }
        }
    } else {
        echo '当前位置没有车';
    }
    ?>
        <div class="container">
            <h3>车位: <?php echo $id ?></h3>
            <h3>车牌: <?php echo $res[2] ?></h3>
            <h3>停车时间: <?php echo floor($minutes) ?>分钟</h3>
            <h3>收费:<?php echo $cost ?> 元</h3>
            <a href="confirmToLeave.php?id=<?php echo $id ?>" ><button type="button" class="btn btn-default btn-warning" name="">确认离开</button></a>
            <a href="usinglot.php" ><button type="button" class="btn btn-default btn-success" name="">返回</button></a>

        </div>
    <?php

    do_html_footer();
    ?>
