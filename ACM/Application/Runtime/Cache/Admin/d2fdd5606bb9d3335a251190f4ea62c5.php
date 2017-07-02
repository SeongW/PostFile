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
    a.info-link {
        border-bottom: 1px solid #337ab7;
        font-weight: bolder;
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
            <ul class="children collapse in" id="sub-item-1" aria-expanded="true" style>
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
                <li class="active">审批学生注册信息</li>
            </ol>
            <div class="col-md-12 col-sm-12">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="col-md-4 col-sm-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                申请
                            </div>
                            <div class="panel-body">
                                <p><a href="#" class="info-link"><?php echo ($vo["nickname"]); ?></a>申请加入<a href="" class="info-link"><?php echo ($vo["clazzname"]); ?></a></p>
                                <p>申请时间：2017-05-07 22:57:40</p>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-success" type="submit" value="<?php echo ($vo["id"]); ?>" id="pass">同意</button>
                                <button class="btn btn-warning" type="submit" value="<?php echo ($vo["id"]); ?>" id="del">删除</button>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "$empty" ;endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(function() {
        //通过
        $('#pass').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?php echo U('Check/passStuCheck');?>",
                data: {
                    id: id,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if(data == 1){
                        alert('学生已加入该兴趣班');
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
        //删除
        $('#del').click(function(){
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: "<?php echo U('Check/delStuCheck');?>",
                data: {
                    id: id,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if(data == 1){
                        alert('已删除该学生的申请');
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