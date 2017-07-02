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
    table a {
        margin: 0 1rem;
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
                <li class="active">学生账号</li>
            </ol>
            <div class="col-sm-12 col-md-12">

            </div>
            <form class="navbar-form " role="search">
                <div class="navbar-left">
                    <button type="button" class="btn btn-primary">查看正常账号</button>
                    <a href="<?php echo U('locked');?>"><button type="button" class="btn btn-default">查看被锁定账号</button></a>
                </div>
                <div class="navbar-right">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="输入相关姓名" name="searchinfo">
                        <span class="input-group-btn">
                       <button class="btn btn-default" type="button" id="btn-search">查询</button>
                    </span>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div style="height:400px;">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>账号</th>
                                <th>姓名</th>
                                <th>详情</th>
                                <th>锁定账号</th>
                                <th>删除账号</th>
                            </tr>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["username"]); ?></td>
                                    <td><?php echo ($vo["nickname"]); ?></td>
                                    <td><a href="#" class="btn-account" value="<?php echo ($vo["id"]); ?>">账号信息</a>|<a href="#" class="btn-person" value="<?php echo ($vo["id"]); ?>">学生信息</a>|<a href="#" class="btn-initpwd" value="<?php echo ($vo["id"]); ?>">初始化密码</a></td>
                                    <td><a href="#" class="btn-lock" value="<?php echo ($vo["id"]); ?>">锁定</a></td>
                                    <td><a href="#" class="btn-del" value="<?php echo ($vo["id"]); ?>">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </table>
                    </div>
                    <div class="col-sm-6 col-sm-offset-3">
                        <nav aria-label="...">
                            <ul class="pager">
                                <li><?php echo ($page); ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 个人信息 Modal -->
<div class="modal fade bs-example-modal-sm" id="StuInfoModal" tabindex="-1" role="dialog" aria-labelledby="StuInfoModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="StuInfoLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td>性别</td>
                        <td id="stu_sex"></td>
                    </tr>
                    <tr>
                        <td>学号</td>
                        <td id="stu_id"></td>
                    </tr>
                    <tr>
                        <td>学院</td>
                        <td id="stu_institude"></td>
                    </tr>
                    <tr>
                        <td>班级</td>
                        <td id="stu_class"></td>
                    </tr>
                    <tr>
                        <td>年级</td>
                        <td id="stu_grade"></td>
                    </tr>
                    <tr>
                        <td>联系电话</td>
                        <td id="stu_phonenumber"></td>
                    </tr>
                    <tr>
                        <td>邮箱地址</td>
                        <td id="stu_email"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- 账号信息 Modal -->
<div class="modal fade bs-example-modal-sm" id="AccountInfoModal" tabindex="-1" role="dialog" aria-labelledby="AccountInfoModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AccnoutInfoLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td>账号</td>
                        <td id="stu_username"></td>
                    </tr>
                    <tr>
                        <td>密码</td>
                        <td id="stu_pwd"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
        //账号详情
        $('.btn-account').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "get",
                url: "<?php echo U('returnOneAccountInfo');?>",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    var data = eval('(' + data + ')');
                    $('#AccnoutInfoLabel').text(data.nickname);
                    $('#stu_username').text(data.username);
                    $('#stu_pwd').text(data.password);
                    $("#AccountInfoModal").modal('show');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请重新尝试");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                },
            });
        });

        //学生详情
        $('.btn-person').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "get",
                url: "<?php echo U('returnOnePersonInfo');?>",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    var data = eval('(' + data + ')');
                    $('#StuInfoLabel').text(data.nickname);
                    $('#stu_sex').text(data.sex);
                    $('#stu_id').text(data.stu_id);
                    $('#stu_institude').text(data.institude);
                    $('#stu_class').text(data.class);
                    $('#stu_grade').text(data.grade);
                    $('#stu_phonenumber').text(data.phonenumber);
                    $('#stu_email').text(data.email);
                    $("#StuInfoModal").modal('show');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请重新尝试");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                },
            });
        });

        //删除账号
        $('.btn-del').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "post",
                url: "<?php echo U('deleteOneAccount');?>",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("删除成功");
                        window.location.reload();
                    } else alert("未知错误");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请重新尝试");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                },
            });
        });
        //锁定账号
        $('.btn-lock').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "post",
                url: "<?php echo U('lockOneAccount');?>",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("锁定成功");
                        window.location.reload();
                    } else alert("未知错误");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请重新尝试");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                },
            });
        });
        //初始化密码
        $('.btn-initpwd').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "post",
                url: "<?php echo U('initializePwd');?>",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("初始化密码为：111111");
                        window.location.reload();
                    } else alert("未知错误");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请重新尝试");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                },
            });
        });
        //查询
        $('#btn-search').click(function(){
            var searchinfo = $('input[name=searchinfo]').val();
            location.href = '<?php echo U('index');?>?searchinfo='+searchinfo;
        });
    });
</script>

    <!-- 包含bootstrap文件 -->
    <script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>