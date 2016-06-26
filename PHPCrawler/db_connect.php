<?php
    include './config.php';

    function getConnection()
    {
        global $mysql_host;
        global $mysql_user;
        global $mysql_pwd;
        global $mysql_db;

        $conn = new mysqli($mysql_host, $mysql_user, $mysql_pwd);
        $conn->select_db($mysql_db);
        if (!$conn) {
            throw new Exception('数据库失效');
        }
        echo "mysql connect ok!\n";

        return $conn;
    }

    function insert_url($conn, $url)
    {
        $md5 = md5($url);
    //    echo $url.'<br/>'.$md5.'<hr/>';
        $sql = 'insert into link_url values ("'.$md5.'","'.$var.'")';
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Errorcode: '.mysqli_errno($conn);
        }
    }
