<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>主页</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="/sys/Public/Bootstrap/css/bootstrap.min.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/sys/Public/Css/admin_login.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/sys/Public/Css/base.css" media="screen" charset="utf-8">

</head>

<body class="linear-bg">
    <div class="wrap">
        <div class="wrap-title">
            <h1 class="page-title block">管理员登陆<small class="beta">Beta</small></h1>
            <hr class="title-light" />
        </div>
        <div class="wrap-content">
            <form class="form-horizontal" role="form" action="<?php echo U('User/doLogin');?>" method="post" >
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" maxlength="20" placeholder="请输入账号" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" maxlength="18" placeholder="请输入密码" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox">记住密码
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-7 col-sm-10">
                        <button type="submit" class="btn btn-default">登录</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="clearfix"></div>
    </div>

    <script type="text/javascript" src="/sys/Public/Bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="/sys/Public/Js/boostrap.min.js"></script>
</body>

</html>