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
                <li class="active">新增班级</li>
            </ol>
            <div class="col-md-7">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">新增班级</h3>
                    </div>
                    <form method="post">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="clazzname">班级名称</label>
                                    <input type="text" class="form-control" id="clazzname" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="tutor">指导老师</label>
                                    <select class="form-control" id="tutor">
                                        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["nickname"]); ?></option><?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="grade">年级</label>
                                    <input type="text" class="form-control" id="grade" placeholder="例如：2017" maxlength="4">
                                </div>
                                <div class="form-group">
                                    <label for="level-inline">等级：</label>
                                    <div class="radio-inline">
                                        <label>
                                    <input type="radio" name="level" id="optionsRadios1" value="1" checked>
                                        初级
                                    </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                    <input type="radio" name="level" id="optionsRadios2" value="2">
                                        中级
                                    </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                    <input type="radio" name="level" id="optionsRadios3" value="3">
                                        高级
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="grade">班级简介</label>
                                    <textarea class="form-control" rows="8" id="clazzinfo" style="resize:none;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" id="btn-add" style="width:25%;">确认</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $("#btn-add").click(function() {
            var clazzname = $('#clazzname').val();
            var tutor = $('#tutor').val();
            var grade = $('#grade').val();
            var level = $('input:radio[name="level"]:checked').val();
            var clazzinfo = $('#clazzinfo').val();
            var checkValue=$("#tutor").val();
            $.ajax({
                type: 'POST',
                url: "<?php echo U('Class/doAddClass');?>",
                data: {
                    clazzname: clazzname,
                    tutor: tutor,
                    grade: grade,
                    level: level,
                    clazzinfo: clazzinfo
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("新增班级成功");
                        document.location.href = "<?php echo U('Class/AddClass');?>";
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

    <!-- 包含bootstrap文件 -->
    <script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>