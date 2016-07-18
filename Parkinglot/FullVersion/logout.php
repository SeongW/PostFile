<?php
    //等出页面
    require_once 'parkingCar_fns.php';
    session_start();

    $old_user = $_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    $result_dest = session_destroy();

    if (!empty($old_user)) {
        if ($result_dest) {
            header('Location:index.php');
        } else {
            echo '出现了小小问题，不能注销帐号';
        }
    } else {
        header('Location:index.php');
    }
