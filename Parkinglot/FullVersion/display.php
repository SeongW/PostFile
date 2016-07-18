<?php
    require_once 'parkingCar_fns.php';
    // 显示页面头
    function do_html_header($title)
    {
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title><?php echo $title ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
        <?php

    }

    // 显示登录
    function do_html_login_info()
    {
        ?>
        <div>
            <h1 align="center" margin="10px">停车场管理系统</h1>
        </div>
        <form action="login.php" method="post" style="width:200px;margin:0 auto">
            <input type="text" class="form-control" name="username" placeholder="帐号" style="margin-top:20px" >
            <input type="password" class="form-control" name="password" placeholder="密码" style="margin-top:10px">
            <input type='submit' value='登录' class="btn btn-default" style="margin-top:20px">
        </form>
        <?php

    }

    // 显示页脚
    function do_html_footer()
    {
        ?>
            <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
            <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>

        </body>
        </html>
        <?php

    }

    //显示导航栏
    function do_nav_bar()
    {
        ?>
        <nav class="navbar navbar-default" role="navigation">
           <div class="navbar-header">
              <a class="navbar-brand" >停车场管理系统</a>
           </div>
           <div>
              <ul class="nav navbar-nav">
                 <li><a href="manage.php">车位状态</a></li>
                 <li><a href="usinglot.php">当前使用车位</a></li>
                 <li><a href="vipCar.php">月费车辆</a></li>
                 <li><a href="addvipcar.php">新增月费车辆</a></li>

                 <li style="padding-top:5px"><h4 ><span class="label label-info" >剩余车位:<?php echo 400 - checkUsedLots() ?></span></h4></li>
                 <li style="position:relative;float:right"><a href="logout.php" style="color:#ff7500">退出</a></li>
              </ul>
           </div>
        </nav>
        <?php

    }

    // 显示车位状态
    function show_park_status()
    {
        $res = getParkingInfo();
        echo '<table class="table"  style="width:90%;margin:0 auto;">';
        for ($i = 0; $i < 400; ++$i) {
            if ($res[$i][0] % 10 == 1) {
                echo '<tr>';
            }
            //有车
            if ($res[$i][2] == 1) {
                echo '<td><a href="parkcar.php?id='.$res[$i][0].'"><h4><span class="label label-warning">'.$res[$i][0].':'.$res[$i][1].'</span></h4></a></td>';
            } else {
                echo '<td><a href="parkcar.php?id='.$res[$i][0].'"><h4><span class="label label-success">'.$res[$i][0].':空</span></h4></a></td>';
            }

            if ($res[$i][0] % 10 == 0) {
                echo '</tr>';
            }
        }
        echo '<table>';
    }

    // 显示当前停车车位信息
    function show_parking_car()
    {
        $res = getParkingCar();
        ?>
        <table class="table table-hover"  style="margin-top:100px;width:70%;margin:0 auto;">
        <thead>
            <tr>
                <th>车位</th>
                <th>车牌</th>
                <th>进入时间</th>
                <th>离开</th>
            </tr>
        </thead>
        <?php

        for ($i = 0; $i < count($res); ++$i) {
            ?>
            <tr>
                <td width="200px"><?php echo $res[$i][0]?></td>
                <td><?php echo $res[$i][1] ?></td>
                <td><?php echo $res[$i][2] ?></td>
                <td><a href="leave.php?id=<?php echo $res[$i][0]?>"><button class="btn btn-danger btn-xs" type="submit" name="button">离开</button></a></td>
            </tr>
            <?php

        }
        echo '<table>';
    }

    // 进入停车场，停车登记
    function do_html_parkcar($id)
    {
        ?>
        <form class="form-horizontal" role="form" action="getCarnunber.php" method="post">
           <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">车牌号</label>
              <div class="col-sm-2">
                 <input type="text" class="form-control" name="carnumber"
                    placeholder="输入车牌号">
                <input type="text" name="id" value="<?php echo $id ?>" style="visibility:hidden;">
              </div>
           </div>
           <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-default">登记</button>
                 <a href="manage.php" ><button type="button" class="btn btn-default btn-success" name="">返回</button></a>

              </div>
           </div>
        </form>
        <?php

    }

    // 输出在登记的月费用户
    function do_html_vip_car()
    {
        $res = getAllVipCar();
        $now = @date('y-m-d H:i:s', time());

        ?>
        <table class="table table-hover"  style="margin-top:100px;width:70%;margin:0 auto;">
        <thead>
            <tr>
                <th>车牌号</th>
                <th>剩余天数</th>
                <th>续费</th>
            </tr>
        </thead>
        <?php
        for ($i = 0; $i < count($res); ++$i) {
            $restDays = @floor((strtotime($now) - strtotime($res[$i][2])) / 86400);
            $restDays = 30 * $res[$i][1] - $restDays;
            if ($restDays > 0) {
                ?>
                <tr>
                    <td width="200px"><?php echo $res[$i][0]?></td>
                    <td><?php echo $restDays ?></td>
                    <td><a href="addmonth.php?carnumber=<?php echo $res[$i][0]?>"><button class="btn btn-success btn-xs" type="submit" name="button">续费</button></a></td>
                </tr>
                <?php

            } else {
                deleteOverDateVipCar($res[$i][0]);
            }
        }
        echo '<table>';
    }

    //输出新月费用户登记表
    function do_html_new_vip_car()
    {
        ?>
        <form class="form-horizontal" role="form" action="confirmToAddVip.php" method="post">
           <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">车牌号</label>
              <div class="col-sm-2">
                 <input type="text" class="form-control" name="carnumber" placeholder="输入车牌号">
              </div>
           </div>
           <div class="form-group">
               <label for="firstname" class="col-sm-2 control-label">月数</label>
               <div class="col-sm-2">
                   <input type="text" class="form-control" name="months" placeholder="输入购买月数">
               </div>
           </div>
           <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-success">登记</button>
              </div>
           </div>
        </form>
        <?php

    }

    //显示续费页面
    function do_html_add_month($number)
    {
        ?>
        <form class="form-horizontal" role="form" action="confirmToAddMonths.php" method="post">
            <div class="form-group">
               <label for="firstname" class="col-sm-2 control-label">车牌</label>
               <div class="col-sm-2">
                  <input type="text" class="form-control" name="carnumber" value="<?php echo $number ?>" readOnly="true">
               </div>
            </div>
           <div class="form-group">
              <label for="firstname" class="col-sm-2 control-label">月数</label>
              <div class="col-sm-2">
                 <input type="text" class="form-control" name="months" placeholder="输入月数">
                <input type="text" name="id" value="<?php echo $id ?>" style="visibility:hidden;">
              </div>
           </div>
           <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                 <button type="submit" class="btn btn-default">续费</button>
                 <a href="vipcar.php" ><button type="button" class="btn btn-default btn-success" name="">返回</button></a>

              </div>
           </div>
        </form>
        <?php

    }

    // 显示帐号密码填写错误页面
    function do_html_wrong_login($flag)
    {
        if ($flag == 1) {
            ?>
            <form action="#"  style="width:200px;margin:0 auto">
                <h5 style="color:red">登录成功</h5>
            </form>
            <?php

        } else {
            ?>
            <form action="#"  style="width:200px;margin:0 auto">
                <h5 style="color:red">帐号或者密码有误</h5>
            </form>
            <?php

        }
    }

?>
