<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title>ACM报名管理系统</title>
    <link rel="stylesheet" type="text/css" href="/sys/Public/Bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/sys/Public/Css/base.css" />
    <link rel="stylesheet" type="text/css" href="/sys/Public/Css/user_index.css" />
    <script type="text/javascript" src="/sys/Public/js/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/sys/Public/Css/jquery.Jcrop.min.css" media="all">
    <link rel="stylesheet" type="text/css" href="/sys/Public/Js/uploadify-v3.1/uploadify.css" media="all">
    <link rel="stylesheet" href="/sys/Public/fontawesome/css/font-awesome.min.css">

    <style media="screen">
        body {
            background-repeat: repeat;
            background-position: center;
            background-size: 1500px;
            background-image: url('/sys/Public/Images/blue-circles.svg');
        }
    </style>
</head>

<body>

<style media="screen">
    #header {
        position: fixed;
        top: 0px;
        left: 0;
        width: 100%;
        height: 80px;
        z-index: 1;
    }

    .header-container {
        max-width: 1170px;
    }

    .navbar-default {
        background: #fff;
        border-radius: 0 0 5px 5px;
        border: 0;
        padding: 0;
        -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .2);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .2);
        overflow: hidden;
    }

    .navbar-default .first a {
        border-radius: 0 0 0 5px;
    }

    .navbar-default .navbar-brand {
        margin-top: 5px;
        margin-bottom: 5px;
        margin-right: 50px;
        margin-left: 20px;
        padding: 3px;
        width: 150px;
        height: 68px;
        background: url("/sys/Public/Images/ujn.jpg") no-repeat 0 50%;
        background-size: contain;
    }
    /*.navbar-default .navbar-brand span {
        color: #999;
        line-height: 68px;
        padding-left: 70px;
        font-size: 1.5rem;
    }*/

    .navbar-default .navbar-nav>li {
        margin-left: 1px;
    }

    .navbar-default .navbar-nav>li>a {
        padding: 30px 25px;
        font-size: 16px;
        line-height: 18px;
        color: #555;
    }

    .navbar-default .navbar-nav>li>a>i {
        display: inline-block;
    }

    .navbar-default .navbar-nav>li.active>a,
    .navbar-default .navbar-nav>li.active:focus>a,
    .navbar-default .navbar-nav>li.active:hover>a,
    .navbar-default .navbar-nav>li:hover>a,
    .navbar-default .navbar-nav>li:focus>a,
    .navbar-default .navbar-nav>li.active>a:focus,
    .navbar-default .navbar-nav>li.active:focus>a:focus,
    .navbar-default .navbar-nav>li.active:hover>a:focus,
    .navbar-default .navbar-nav>li:hover>a:focus,
    .navbar-default .navbar-nav>li:focus>a:focus {
        background-color: #52b6ec;
        color: #fff;
    }

    .navbar-default .navbar-nav>li.active:last-child>a,
    .navbar-default .navbar-nav>li.active:last-child:focus>a,
    .navbar-default .navbar-nav>li.active:last-child:hover>a,
    .navbar-default .navbar-nav>li:last-child:hover>a,
    .navbar-default .navbar-nav>li:last-child:focus>a,
    .navbar-default .navbar-nav>li:last-child.active>a:focus,
    .navbar-default .navbar-nav>li:last-child.active:focus>a:focus,
    .navbar-default .navbar-nav>li:last-child.active:hover>a:focus,
    .navbar-default .navbar-nav>li:last-child:hover>a:focus,
    .navbar-default .navbar-nav>li:last-child:focus>a:focus {
        background-color: rgba(255, 101, 68, .8);
        color: #fff;
    }

</style>

<header id="header" role="banner">
    <div class="container header-container">
        <div id="navbar" class="navbar navbar-default">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
                <!-- <a class="navbar-brand" href="#"><span>ACM报名系统</span></a> -->
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo U('Index/index');?>"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
                    <li><a href="<?php echo U('Index/Person');?>">我的资料</a></li>
                    <li><a href="<?php echo U('Class/Index');?>">我的班级</a></li>
                    <li><a href="<?php echo U('UserAdmin/index');?>">审核信息</a></li>
                    <li><a href="<?php echo U('Index/ModPwd');?>">密码更改</a></li>
                    <li><a href="<?php echo U('User/dologout');?>">退出登陆</a></li>
                </ul>
            </div>

        </div>
    </div>
</header>
<div style="height:78px;"></div>

<style media="screen">
    .head-wrap {
        padding: 0px 10px 15px 15px;
    }

    .head-btn {
        color: #666;
        border: 0;
        border-radius: 0;
        background-color: #d2d2d2;
        font-weight: 300;
        border: 0;
        transition: all .3s;
    }

    .box-content-bg {
        background-color: #FFF;
        padding-top: 15px;
    }

    .box-content-title {
        padding: 5px;
        background: #7BC0F4;
        border-left: 4px solid #146BBB;
        color: #fff;
        margin-top: 0px;
        margin-bottom: 0px;
    }
    .thumbnail img{
        width: 105px;
    }
</style>
<div class="container-fluid" id="base">
    <div class="row wrap">
        <div class="col-md-9 baseLeft">
            <div class="col-md-12 box">

                <h3 class="box-content-title">个人信息<span class="pull-right btn-mod" id="personInfo"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>修改</span></h3>
                <div class="col-md-12 box-content-bg">
                    <p class="lead">姓名：<span class="btm-dot"><?php echo ($userinfo['nickname']); ?></span></p>
                    <p class="lead">性别：<span class="btm-dot"><?php echo ($userinfo['sex']==1?'男':'女'); ?></span></p>
                    <p class="lead">联系电话：<span class="btm-dot"><?php echo ($userinfo['phonenumber']); ?></span></p>
                    <p class="lead">E-mail：<span class="btm-dot"><?php echo ($userinfo['email']); ?></span></p>
                    <p class="lead"><a href="<?php echo U('headimg');?>">修改个人头像</a></span></p>

                </div>

                <div class="clearfix"></div>

                <h3 class="box-content-title">在校信息<span class="pull-right btn-mod" id="schoolInfo"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>修改</span></h3>
                <div class="col-md-12 box-content-bg">
                    <p class="lead">学号：<span class="btm-dot"><?php echo ($userinfo['stu_id']); ?></span></p>
                    <p class="lead">学院：<span class="btm-dot"><?php echo ($userinfo['institude']); ?></span></p>
                    <p class="lead">班级：<span class="btm-dot"><?php echo ($userinfo['class']); ?></span></p>
                </div>
                <div class="clearfix"></div>
                <h3 class="box-content-title">账号信息</h3>
                <div class="col-md-12 box-content-bg">
                    <p class="lead">账号：<span class="btm-dot"><?php echo ($userinfo['username']); ?></span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 baseRight">
            <!-- 个人信息模版 -->
            <?php echo W('Right/Personal');?>
            <!-- 通知模版 -->
            <?php echo W('Right/news');?>
        </div>
    </div>
</div>

<!-- 修改个人信息modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="personInfoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">修改个人信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <!-- 姓名 -->
                    <div class="form-group">
                        <label for="nickname" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo ($userinfo['nickname']); ?>">
                        </div>
                    </div>
                    <!-- 性别 -->
                    <div class="form-group">
                        <label for="姓名" class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-4">
                            <div class="radio pull-left">
                                <label>
                                    <input type="radio" name="sex" id="sex1" value="1" <?php echo ($userinfo['sex']==1?"checked":""); ?>>男
                                </label>
                            </div>
                            <div class="radio pull-left" style="margin-left:15px;">
                                <label>
                                    <input type="radio" name="sex" id="sex2" value="0">女
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- 联系电话 -->
                    <div class="form-group">
                        <label for="phonenumber" class="col-sm-2 control-label">电话号码</label>
                        <div class="col-sm-4">
                            <input type="tel" class="form-control" id="phonenumber" name="phonenumber" maxlength="11" value="<?php echo ($userinfo['phonenumber']); ?>">
                        </div>
                    </div>
                    <!-- 邮箱地址 -->
                    <div class="form-group">
                        <label for="phonenumber" class="col-sm-2 control-label">邮箱地址</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" id="email" name="email" maxlength="50" value="<?php echo ($userinfo['email']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-submit" id="btn-doModPerson">确认修改</button>
                            <button type="button" class="btn btn-back" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end 修改个人信息modal -->



<!-- 修改学校信息modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="schoolInfoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">修改在校信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post">
                    <!-- 学号 -->
                    <div class="form-group">
                        <label for="stu_id" class="col-sm-2 control-label">学号</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="stu_id" name="stu_id" maxlength="12" value="<?php echo ($userinfo['stu_id']); ?>">
                        </div>
                    </div>
                    <!-- 学院 -->
                    <div class="form-group">
                        <label for="institude" class="col-sm-2 control-label">学院</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="institude" name="institude" value="<?php echo ($userinfo['institude']); ?>">
                        </div>
                    </div>
                    <!-- 班级 -->
                    <div class="form-group">
                        <label for="clazz" class="col-sm-2 control-label">班级</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="clazz" name="clazz" value="<?php echo ($userinfo['class']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-submit" id="btn-doModSchool">确认修改</button>
                            <button type="button" class="btn btn-back" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end 修改学校信息modal -->






<script type="text/javascript">
    $(function() {
        //显示修改个人信息窗口
        $("#personInfo").click(function() {
            // 显示modal
            $("#personInfoModal").modal('show');
        });
        //确认修改个人信息按钮
        $('#btn-doModPerson').click(function() {
            //隐藏窗口
            $("#personInfoModal").modal('hide');
            //获取相关数据
            var nickname = $("input[name='nickname']").val();
            var sex = $('input:radio[name="sex"]:checked').val();
            var email = $("input[name='email']").val();
            var phonenumber = $("input[name='phonenumber']").val();
            alert(sex);
            //ajax访问
            $.ajax({
                'type': 'post',
                'url': "<?php echo U('Index/doModPersonalInfo');?>",
                'data': {
                    'nickname': nickname,
                    'sex': sex,
                    'phonenumber': phonenumber,
                    'email': email,
                },
                'success': function(data) {
                    if (data == 1) {
                        alert("修改成功");
                        document.location.href = "<?php echo U('Index/Person');?>";
                    } else if (data == 2)
                        alert("服务器出错了，重新尝试");
                    else if (data == 3)
                        alert("输入数据有误，请正确输入");
                    else alert("未知错误");
                },
                'error': function() {
                    alert('出错了');
                },
                'dataType': 'json',
                'async': false
            });
        });
        //显示修改在校信息窗口
        $("#schoolInfo").click(function() {
            // 显示modal
            $("#schoolInfoModal").modal('show');
        });

        //确认修改在校信息
        $("#btn-doModSchool").click(function() {
            // 隐藏modal
            $("#schoolInfoModal").modal('hide');
            //获取相关数据
            var stu_id = $('#stu_id').val();
            var institude = $('#institude').val();
            var clazz = $('#clazz').val();
            //ajax访问
            $.ajax({
                'type': 'post',
                'url': "<?php echo U('Index/doModSchoolInfo');?>",
                'data': {
                    'stu_id': stu_id,
                    'institude': institude,
                    'class': clazz
                },
                'success': function(data) {
                    if (data == 1) {
                        alert("修改成功");
                        document.location.href = "<?php echo U('Index/Person');?>";
                    } else if (data == 2)
                        alert("服务器出错了，重新尝试");
                    else if (data == 3)
                        alert("输入数据有误，请正确输入");
                    else alert("未知错误");
                },
                'error': function() {
                    alert('出错了');
                },
                'dataType': 'json',
                'async': false
            });
        });
    });
</script>


<!-- 包含bootstrap文件 -->
<script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>

</body>

</html>