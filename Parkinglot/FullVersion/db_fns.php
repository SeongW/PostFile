<?php
    include './config.php';

    // 连接数据库
    function getConnection()
    {
        global $mysql_host;
        global $mysql_user;
        global $mysql_pwd;
        global $mysql_db;

        $con = mysql_connect($mysql_host, $mysql_user, $mysql_pwd);
        if (!$con) {
            die('Could not connect: '.mysql_error());
        }
        mysql_select_db($mysql_db, $con);

        return $con;
    }

    // 进入车位
    function parkingCar($id, $carnumber)
    {
        $conn = getConnection();
        $date = @date('y-m-d H:i:s', time());
        $sql = 'UPDATE parkingplace SET carnumber="'.$carnumber.'",parking=1,intime="'.$date.'" WHERE id='.$id.'';
        mysql_set_charset('utf8', $conn);
        $result = mysql_query($sql, $conn);
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
        mysql_set_charset('utf8', $conn);
        $getTimeSQL = 'select intime,parking,carnumber from parkingplace where id ='.$id;
        $result = mysql_query($getTimeSQL, $conn);
        if ($result) {
            $res = mysql_fetch_row($result);

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
        mysql_set_charset('utf8', $conn);
        $result = mysql_query($sql, $conn);
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
        mysql_set_charset('utf8', $conn);

        $sql = 'select id,carnumber,parking from parkingplace';
        $result = mysql_query($sql, $conn);
        if ($result) {
            $all = array();
            while ($res = mysql_fetch_row($result)) {
                array_push($all, $res);
            }

            return $all;
        } else {
            return '无法获取信息';
        }
    }

    // 查看当前停车信息
    function getParkingCar()
    {
        $conn = getConnection();
        mysql_set_charset('utf8', $conn);

        $sql = 'select id,carnumber,intime from parkingplace where parking = 1';
        $result = mysql_query($sql, $conn);
        if ($result) {
            $all = array();
            while ($res = mysql_fetch_row($result)) {
                array_push($all, $res);
            }

            return $all;
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
            //header('Location:index.php');
            exit;
        }
    }

    // 登录
    function login($username, $password)
    {
        $con = getConnection();
        mysql_set_charset('utf8', $con);

        $sql = "select * from user where username='".$username."' and password='".$password."'";
        $result = mysql_query($sql, $con);
        if (!$result) {
            // 密码错误
            return 0;
        }
        if (mysql_fetch_row($result)) {
            // 验证成功
            return 1;
        } else {
            // 数据库出错
            return -1;
        }
    }

    //查看当前位置是否有车
    function checkPosition($id)
    {
        $conn = getConnection();
        $sql = 'select parking from parkingplace where id='.$id;
        $result = mysql_query($sql, $conn);
        if ($result) {
            $res = mysql_fetch_row($result);
            if ($res[0] == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //查看剩余车位
    function checkUsedLots()
    {
        $conn = getConnection();
        $sql = 'select id from parkingplace where parking=1';
        $result = mysql_query($sql, $conn);
        if ($result) {
            $num = mysql_num_rows($result);

            return $num;
        } else {
            return 0;
        }
    }

    //检查是否是vip用户
    function checkVipCar($carnumber)
    {
        $conn = getConnection();
        $sql = 'select * from vipcar where carnumber="'.$carnumber.'"';
        $result = mysql_query($sql, $conn);
        if ($result) {
            return mysql_fetch_row($result);
        } else {
            return false;
        }
    }

    //查看所有的vip车辆
    function getAllVipCar()
    {
        $conn = getConnection();
        mysql_set_charset('utf8', $conn);
        $sql = 'select * from vipcar';
        $result = mysql_query($sql, $conn);
        if ($result) {
            $all = array();
            while ($res = mysql_fetch_row($result)) {
                array_push($all, $res);
            }

            return $all;
        } else {
            return;
        }
    }

    //新增月费车辆
    function addVipCar($number, $months)
    {
        $conn = getConnection();
        mysql_set_charset('utf8', $conn);
        $now = @date('y-m-d H:i:s', time());
        $sql = 'insert into vipcar values ("'.$number.'",'.$months.',"'.$now.'")';
        $result = mysql_query($sql, $conn);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //月费用户续费
    function addMoths($number, $months)
    {
        $conn = getConnection();
        mysql_set_charset('utf8', $conn);
        $curMonths = getVipCarMonth($number);
        $total = $curMonths + $months;
        $sql = 'UPDATE vipcar SET months ='.$total.' where carnumber = \''.$number.'\'';
        $result = mysql_query($sql, $conn);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //查询购买月份
    function getVipCarMonth($carnumber)
    {
        $conn = getConnection();
        mysql_set_charset('utf-8', $conn);
        $sql = 'select months from vipcar where carnumber = \''.$carnumber.'\'';
        $result = mysql_query($sql, $conn);
        if ($result) {
            $res = mysql_fetch_row($result);

            return $res[0];
        } else {
            return -1;
        }
    }

    //删除过期用户
    function deleteOverDateVipCar($carnumber)
    {
        $conn = getConnection();
        mysql_set_charset('utf8', $conn);
        $sql = 'delete from vipcar where carnumber = "'.$carnumber.'"';
        $result = mysql_query($sql, $conn);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
