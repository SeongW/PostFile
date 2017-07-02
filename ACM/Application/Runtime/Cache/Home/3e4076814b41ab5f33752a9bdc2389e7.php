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


<div class="container-fluid" id="base">
    <div class="row wrap">
        <!-- 左侧 -->
        <div class="col-md-9 baseLeft">
            <div class="col-md-12 box">
                <div class="box-title">
                    <p class="bg-primary lead">班级信息<span class="pull-right btn-mod" id="personInfo"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>修改</span>
                    </p>
                </div>
                <div class="col-md-12">
                    <p class="lead">名称：<span class="btm-dot"><?php echo ($info["clazzname"]); ?>
                        <?php switch($$info["level"]): case "1": ?>初级班<?php break;?>
                            <?php case "2": ?>中级班<?php break;?>
                            <?php case "3": ?>高级班<?php break;?>
                            <?php default: endswitch;?>
                    </span></p>
                    <p class="lead">班级简介：<span class="btm-dot"><?php echo ($info["clazz_info"]); ?></span></p>
                    <p class="lead">年级：<span class="btm-dot"><?php echo ($info["grade"]); ?>级</span></p>
                    <p class="lead">班级人数：12人<span class="btm-dot"></span></p>
                    <p class="lead">创建时间：<span class="btm-dot"><?php echo ($info["create_time"]); ?></span></p>
                    <p class="lead">指导老师：<span class="btm-dot"><?php echo ($info["tutor"]); ?></span></p>


                    <button type="button" class="btn btn-submit" id="btn-join">申请加入</button>
                    <a href="<?php echo U('Class/Index');?>"><button type="button" class="btn btn-back" >返回</button></a>

                </div>
                <?php p($info); ?>
            </div>
        </div>
        <!-- 右侧 -->
        <div class="col-md-3 baseRight">
            <?php echo W('Right/Personal');?> <?php echo W('Right/news');?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('#btn-join').click(function(){
            var classid = <?php echo ($info["id"]); ?>;
            //ajax
            $.ajax({
                'type': 'post',
                'url': "<?php echo U('Class/applyClass');?>",
                'data': {
                    classid: classid,
                },
                'success': function(data){
                    if(data == 1){
                        alert('申请成功，请等待管理员审批');
                        document.location.href = "<?php echo U('Class/index');?>";
                    } else{
                        alert(data);
                    }
                },
                'error': function(){
                    alert("未知错误");
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