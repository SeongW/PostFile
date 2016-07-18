<?php
    //登录跳转页面
    require_once 'parkingCar_fns.php';

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $res = login($username, $password);

    if ($res == 1) {
        $_SESSION['valid_user'] = $username;
        header('Location:manage.php');
    } else {
        do_html_header('停车场管理系统');

        do_html_login_info();
        do_html_wrong_login($res);
        do_html_footer();
    }
