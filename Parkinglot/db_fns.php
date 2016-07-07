<?php
    include './config.php';

    // 连接数据库
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

        return $conn;
    }

    // 进入车位
    function parkingCar($id, $carnumber)
    {
        $conn = getConnection();
        $date = date('y-m-d H:i:s', time());
        $sql = 'UPDATE parkingplace SET carnumber="'.$carnumber.'",parking=1,intime="'.$date.'" WHERE id='.$id.'';
        $conn->set_charset('utf8');
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // 离开车位
    /**
    * @param  {number} id
    *
    * @return {number} charge
    */
    function leaveCarTime($id)
    {
        $conn = getConnection();
        $conn->set_charset('utf8');
        // 获取停车时间
        $getTimeSQL = 'select intime,parking,carnumber from parkingplace where id ='.$id;
        $result = $conn->query($getTimeSQL);
        if ($result) {
            $res = mysqli_fetch_row($result);

            return $res;
        } else {
            echo '数据获取失败！';
        }
    }

    // 离开停车场
    function leaveParkinglot($id)
    {
        $conn = getConnection();
        $sql = 'UPDATE parkingplace SET carnumber=null,parking=0,intime=null WHERE id='.$id;
        $conn->set_charset('utf8');
        $result = $conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // 查看当前停车信息
    function getParkingInfo()
    {
        $conn = getConnection();
        $conn->set_charset('utf8');

        $sql = 'select id,carnumber,parking from parkingplace';
        $result = $conn->query($sql);
        if ($result) {
            return mysqli_fetch_all($result);
        } else {
            return '无法获取信息';
        }
    }

    // 查看当前停车信息
    function getParkingCar()
    {
        $conn = getConnection();
        $conn->set_charset('utf8');

        $sql = 'select id,carnumber,intime from parkingplace where parking = 1';
        $result = $conn->query($sql);
        if ($result) {
            return mysqli_fetch_all($result);
        } else {
            return '无法获取信息';
        }
    }

    //检查当前用户是否有一个注册会话
    function check_valid_user()
    {
        if (isset($_SESSION['valid_user'])) {
            //echo '<h3>'.$_SESSION['valid_user'].'已经登录</h3><br/>';
        } else {
            //echo 'check_valid_user_fail';
            header('Location:index.php');
            exit;
        }
    }

    // 登录
    function login($username, $password)
    {
        $con = getConnection();
        $con->set_charset('utf8');

        $sql = "select * from user where username='".$username."' and password='".$password."'";
        $result = $con->query($sql);
        if (!$result) {
            throw new Exception('你暂时不能登录,请稍后再尝试');
        }
        if (mysqli_num_rows($result)) {
            return true;
        } else {
            throw new Exception('你暂时不能登录,请稍后再尝试');
        }
    }

    //查看当前位置是否有车
    function checkPosition($id)
    {
        $conn = getConnection();
        $sql = 'select parking from parkingplace where id='.$id;
        $result = $conn->query($sql);
        if ($result) {
            $res = mysqli_fetch_row($result);
            if ($res[0] == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
