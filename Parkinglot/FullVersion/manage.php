<?php
    //主页
    require_once 'parkingCar_fns.php';

    session_start();

    if (!@$_SESSION['valid_user']) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if ($username && $password) {
            try {
                login($username, $password);
            } catch (Exception $e) {
                header('Location:index.php');
                exit;
            }
            try {
                $_SESSION['valid_user'] = $username;
            } catch (Exception $e) {
                echo '出错啦';
            }
        }
    }

    do_html_header('停车场管理系统');
    check_valid_user();
    do_nav_bar();
    show_park_status();
    do_html_footer();
