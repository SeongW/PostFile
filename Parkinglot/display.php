<?php
    require_once 'parkingCar_fns.php';
    // 显示头
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
        <form action="manage.php" method="post" style="width:200px;margin:0 auto">
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
                 <li style="position:relative;float:right"><a href="logout.php">退出</a></li>
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
?>
