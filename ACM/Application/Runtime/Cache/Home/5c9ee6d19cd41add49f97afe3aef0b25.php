<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>主页</title>
    <link rel="stylesheet" type="text/css" href="/sys/Public/Bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/sys/Public/Css/user.css" />
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top bg-white" style="background-color:#FFF;">
        <div class="container">
            <div class="navbar-header">
                <!-- <a class="navbar2-brand">
                    <img alt="Brand" src="/sys/Public/Images/ujn.jpg">
                </a> -->
                <p class="navbar-text navbar-left">
                    济南大学 ACM报名系统
                </p>
            </div>

        </div>
    </nav>
    <div class="container top">
        <div class="row">
            <div class="col-md-5 col-md-offset-1 bg-black login-left">
                <div class="index-img"><img src="/sys/Public/Images/icpc.png" alt=""></div>
            </div>
            <div class="col-md-5 bg-green login-right">
                <div class="col-md-8 col-md-offset-2">
                    <div class="login-form">
                        <form action="<?php echo U('User/doLogin');?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" placeholder="账号" name="username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="密码" name="password">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="verify" placeholder="输入下面验证码" maxlength="4" name="verify">
                            </div>
                            <div class="form-group">
                                <div class="verify-img">
                                    <img onclick="this.src=this.src+'?'+Math.random()" src="<?php echo U('selfverify');?>" >
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"><span class="grey">记住密码</span></input>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-default" id="dologin">登陆</button>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo U('User/register');?>"><button type="button" class="btn btn-link">注册账号</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <?php phpinfo(); ?> -->
    <script type="text/javascript" src="/sys/Public/js/jquery.min.js"></script>
    <script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#dologin").click(function(){
                var username = $('#username').val();
                var password = $('#password').val();
                var verify = $('#verify').val();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/doLogin');?>",
                    data: {
                        username: username,
                        password: password,
                        verify: verify,
                    },
                    cache: false,
                    dataType: 'json',
                    timeout: 5000,
                    success: function(data) {
                        if(data == 1){
                            window.location.href="<?php echo U('Index/index');?>";
                        } else {
                            alert(data);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("出错了，请重新尝试");
                        console.log(XMLHttpRequest.status);
                        console.log(XMLHttpRequest.readyState);
                        console.log(textStatus);
                    },
                });
            });
        });
    </script>
</body>

</html>