<?php
    require_once 'parkingCar_fns.php';
    session_start();

    @$old_user = $_SESSION['valid_user'];
    unset($_SESSION['valid_user']);
    $result_dest = session_destroy();

    do_html_header('已注销帐号');

    if (!empty($old_user)) {
        if ($result_dest) {
            echo '注销帐号<br/>';
            header('Location:index.php');
        } else {
            echo '出现了小小问题，不能注销帐号';
        }
    } else {
        header('Location:index.php');
    }

    do_html_footer();
