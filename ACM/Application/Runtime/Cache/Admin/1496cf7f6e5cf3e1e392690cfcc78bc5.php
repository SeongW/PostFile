<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ACM报名管理系统</title>
    <link rel="stylesheet" type="text/css" href="/sys/Public/Bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/sys/Public/Css/base.css" />
    <script type="text/javascript" src="/sys/Public/Js/jquery.min.js"></script>
    <link rel="stylesheet" href="/sys/Public/Css/admin_index.css" media="screen" charset="utf-8">
    <link rel="stylesheet" href="/sys/Public/fontawesome/css/font-awesome.min.css">
    <style media="screen">
        html {
            width: 100%;
            height: 100%;
        }
        body {
            width: 100%;
            height: 100%;
            background-color: #f2f2f2;
            /*background-image: linear-gradient(to top, #6a85b6 0%, #bac8e0 100%);*/
        }
    </style>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
            <div class="navbar-brand" href="#"><span>ACM报名系统</span><span class="houtai">后台管理</span></div>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo ($name); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo U('/Index/personInfo');?>"><span class="glyphicon glyphicon-user"></span><span class="navbar-span">个人信息</span></a></li>
                        <li><a href="<?php echo U('/Index/modpwd');?>"><span class="glyphicon glyphicon-pencil"></span><span class="navbar-span">修改密码</span></a></li>
                        <li><a href="<?php echo U('/User/dologout');?>"><span class="glyphicon glyphicon-log-out"></span><span class="navbar-span">退出登陆</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div id="sidebar-collapse" class="col-sm-2 col-lg-2 sidebar collapse in" >

    <!-- <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-search">搜索</button>
    </form> -->
    <ul class="nav menu">
        <li>
            <a href="<?php echo U('Index/index');?>">
                <span class="glyphicon glyphicon-home"></span>主页
            </a>
        </li>
        <li>
            <a href="<?php echo U('Check/CheckStuSign');?>">
                <span class="glyphicon glyphicon-education"></span>审批学生注册信息<span class="badge"><?php echo W('StuCheckNum/checkStuNum');?></span>
            </a>
        </li>
        <li>
            <a href="<?php echo U('StuInfo/index');?>"><span class="glyphicon glyphicon-user"></span>学生信息</a>
        </li>
        <!-- class management -->
        <li class="parent">
            <a href="#">
                <span class="glyphicon glyphicon-menu-hamburger"></span> 班级管理 <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-option-vertical"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li>
                    <a class="" href="<?php echo U('Class/ShowClass');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 班级信息
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo U('Check/CheckStuSelect');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 审批申请
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo U('Class/AddClass');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 新建班级
                    </a>
                </li>
            </ul>
        </li>
        <!-- memeber management -->
        <li class="parent ">
            <a href="#">
                <span class="glyphicon glyphicon-menu-hamburger"></span> 账号管理 <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-option-vertical"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li>
                    <a class="" href="<?php echo U('Account/index');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 学生
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo U('Manager/index');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 管理员
                    </a>
                </li>
            </ul>
        </li>
        <!-- system management -->
        <li class="parent ">
            <a href="#">
                <span class="glyphicon glyphicon-cog"></span> 系统功能 <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-option-vertical"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-3">
                <li>
                    <a class="" href="<?php echo U('Database/ShowExport');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 系统备份
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo U('Database/ShowImport');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 数据恢复
                    </a>
                </li>
                <li>
                    <a class="" href="<?php echo U('Excel/index');?>">
                        <span class="glyphicon glyphicon-menu-right"></span> 数据导出
                    </a>
                </li>

            </ul>
        </li>
        <li role="presentation" class="divider"></li>
    </ul>
</div>

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <ol class="breadcrumb">
                <li><a href="<?php echo U('Index/index');?>">主页</a></li>
                <li><a href="<?php echo U('StuInfo/index');?>">主页</a></li>
                <li class="active">添加学生</li>
            </ol>
            <div class="col-md-7">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">添加学生</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo U('doAddStu2');?>" class="form-horizontal" method="post">
                            <p class="lead">账号信息</p>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">账号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" placeholder="以小写字母开头，长度为6-18" maxlength="20" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">输入密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pwd1" placeholder="长度为6-18" maxlength="20" name="pwd1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">确认密码</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pwd2" placeholder="长度为6-18" maxlength="20" name="pwd2">
                                </div>
                            </div>
                            <hr>
                            <p class="lead">个人信息</p>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="" maxlength="20">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level-inline" class="col-sm-2 control-label">性别：</label>
                                <div class="radio-inline" >
                                    <label>
                                        <input type="radio" name="sex" id="optionsRadios1" value="1" checked>
                                            男
                                        </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="sex" id="optionsRadios2" value="0">
                                            女
                                        </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">联系电话</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phonenumber" placeholder="" maxlength="11" name="phonenumber">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">邮箱地址</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder="" maxlength="50" name="email">
                                </div>
                            </div>
                            <hr>
                            <p class="lead">在校信息</p>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">学号</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="stu_id" placeholder="" maxlength="11" name="stu_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">学院</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="institude" placeholder="" maxlength="50" name="institude">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">班级</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="clazz" placeholder="" maxlength="20" name="clazz">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">年级</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="grade" placeholder="年份" maxlength="4" name="grade">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-default" type="button" name="button" id="btn-add">添加</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- 修改信息modal end -->
<script type="text/javascript">
    $(function() {
        //确认修改
        $('#btn-add').click(function() {
            var username = $('#username').val();
            var pwd1 = $('#pwd1').val();
            var pwd2 = $('#pwd2').val();
            var nickname = $('#nickname').val();
            var sex = $("input[name='sex'][checked]").val()
            var phonenumber = $('#phonenumber').val();
            var email = $('#email').val();
            var stu_id = $('#stu_id').val();
            var institude = $('#institude').val();
            var clazz = $('#clazz').val();
            var grade = $('#grade').val();
            $.ajax({
                type: 'post',
                url: "<?php echo U('doAddStu');?>",
                data: {
                    username: username,
                    pwd1: pwd1,
                    pwd2: pwd2,
                    nickname: nickname,
                    sex: sex,
                    phonenumber: phonenumber,
                    email: email,
                    stu_id: stu_id,
                    institude: institude,
                    clazz: clazz,
                    grade: grade
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert('添加成功');
                        window.location.reload();
                    } else alert(data);
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

    <!-- 包含bootstrap文件 -->
    <script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>