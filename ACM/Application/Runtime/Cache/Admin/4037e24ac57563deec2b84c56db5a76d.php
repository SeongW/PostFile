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


<style media="screen">
    .barcard {
        margin-bottom: 1.5rem;
        border: 1px solid #cfd8dc;
        display: flex;
        flex-direction: column;
        background-color: #fff;
    }

    .barcard a {
        text-decoration: none;
    }

    .barcard .card-block {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .barcard-primary {
        background-color: #20a8d8;
        border-color: #fff;
    }

    .barcard-primary .card-block {
        color: #fff;
    }

    .barcard-default {
        background-color: rgba(255, 255, 255, 0.7);
        border-color: #fff;
    }

    .barcard-default .card-block {
        color: #888;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar collapse in" >

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
            <ul class="children collapse" id="sub-item-1" aria-expanded="false">
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
            <ul class="children collapse in" id="sub-item-2" aria-expanded="true" style>
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
                <li class="active">增加管理员</li>
            </ol>
            <!-- 导航栏 -->
            <div class="col-sm-12 col-md-12">
                <div class="col-sm-3 col-md-3">
                    <div class="barcard barcard-default">
                        <a href="<?php echo U('index');?>">
                            <div class="card-block">
                                <h4 class="mb-0">账号</h4>
                                <p>显示管理员列表</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="barcard barcard-primary">
                        <a href="#">
                            <div class="card-block">
                                <h4 class="mb-0">增加</h4>
                                <p>添加新的管理员</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END 导航栏 -->
            <!-- 内容 -->
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">新增管理员</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6 col-md-6">
                            <form method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">账号</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="登陆账号" maxlength="20">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">密码</label>
                                    <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="登陆密码" maxlength="18">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">确认密码</label>
                                    <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="登陆密码" maxlength="18">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">姓名</label>
                                    <input type="text" class="form-control" id="nickname" name="nickname" placeholder="" maxlength="18">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">职称</label>
                                    <input type="text" class="form-control" id="position" name="position" placeholder="" maxlength="18">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">联系电话</label>
                                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="" maxlength="18">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">邮箱地址</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="" maxlength="18">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">QQ号码</label>
                                    <input type="text" class="form-control" id="tecentNumber" name="tecentNumber" placeholder="" maxlength="18">
                                </div>
                                <button type="button" class="btn btn-default" id="btn-add">新增</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END 内容 -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        //作为时间
        $('#btn-add').click(function(){
            var username = $('input[name=username]').val();
            var pwd1 = $('input[name=pwd1]').val();
            var pwd2 = $('input[name=pwd2]').val();
            var nickname = $('input[name=nickname]').val();
            var position = $('input[name=position]').val();
            var phonenumber = $('input[name=phonenumber]').val();
            var email = $('input[name=email]').val();
            var tecentNumber = $('input[name=tecentNumber]').val();
            $.ajax({
                type: 'post',
                url: "<?php echo U('doAddManager');?>",
                data: {
                    username: username,
                    pwd1: pwd1,
                    pwd2: pwd2,
                    nickname: nickname,
                    position: position,
                    phonenumber: phonenumber,
                    email: email,
                    tecentNumber, tecentNumber,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data){
                    if(data==1){
                        alert('添加成功');
                        window.location.reload();
                    } else {
                        alert(data);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请刷新尝试");
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