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
    .me td {
        text-align: center;
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
                <li><a href="<?php echo U('Class/ShowClass');?>">班级信息</a></li>
                <li class="active"><?php echo ($info["clazzname"]); ?></li>
            </ol>
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><h3>学生信息</h3></h3>
                        </div>
                        <table class="table table-bordered me">
                            <tr>
                                <th>姓名</th>
                                <th>详情</th>
                                <th>用户权限</th>
                                <th>踢出</th>
                            </tr>
                            <?php if(is_array($stuList)): $i = 0; $__LIST__ = $stuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["nickname"]); ?></td>
                                    <td><a href="#" value='<?php echo ($vo["id"]); ?>' class="btn-stu-detail">详情</a></td>
                                    <td>普通-<a href="#" value='<?php echo ($vo["id"]); ?>' class="btn-stu-permit">提升</a></td>
                                    <td><a href="#" value='<?php echo ($vo["id"]); ?>' class="btn-stu-delete">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </table>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><h3>管理者信息</h3></h3>
                        </div>
                        <table class="table table-bordered me">
                            <tr>
                                <th>姓名</th>
                                <th>详情</th>
                                <th>用户权限</th>
                                <th>踢出</th>
                            </tr>
                            <?php if(is_array($adminList)): $i = 0; $__LIST__ = $adminList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($vo["nickname"]); ?></td>
                                    <td><a href="#" value='<?php echo ($vo["id"]); ?>' class="btn-stu-detail">详情</a></td>
                                    <td>管理者-<a href="#" value='<?php echo ($vo["id"]); ?>' class="btn-stu-demotion">降级</a></td>
                                    <td><a href="#" value='<?php echo ($vo["id"]); ?>' class="btn-stu-delete">删除</a></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            <h3><?php echo ($info["clazzname"]); ?></h3>
                            </h3>
                        </div>
                        <div class="panel-body">
                            简介：<?php echo ($info["clazz_info"]); ?>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">创建时间：<?php echo date('Y年m月d日',strtotime($info['create_time'])); ?></li>

                            <li class="list-group-item">指导老师：<?php echo ($tutorName["nickname"]); ?></li>
                            <li class="list-group-item">年级：<?php echo ($info["grade"]); ?>级</li>
                            <li class="list-group-item">等级：
                                <?php switch($info["level"]): case "1": ?>初级<?php break;?>
                                    <?php case "2": ?>中级<?php break;?>
                                    <?php case "3": ?>高级<?php break;?>
                                    <?php default: ?>未评级<?php endswitch;?>
                            </li>
                            <table class="table table-bordered me">
                                <tr>
                                    <td><a href="#" data-toggle="modal" data-target="#modClassModal">修改</a></td>
                                    <td><a href="#" id="btn-del-class">删除</a></td>
                                </tr>
                            </table>
                        </ul>
                    </div>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            <h3>事务信息</h3>
                            </h3>
                        </div>
                        <?php if($classwork): ?><div class="panel-body">
                                <textarea class="form-control" rows="7" id="workcontent"><?php echo ($classwork["workcontent"]); ?></textarea>
                            </div>
                            <div class="panel-footer" style="background-color:#fcf8e3;text-align:center;">
                                <a href="#" value="<?php echo ($classwork["clazz_id"]); ?>" class="btn-mod-work">修改</a>
                            </div>
                            <?php else: ?>
                            <div class="panel-footer" style="background-color:#fcf8e3;text-align:center;">
                                <a href="#" value="<?php echo ($info["id"]); ?>" class="btn-add-work">添加</a>
                            </div><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 学生信息 Modal -->
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
<!-- 学生信息 Modal End -->
<!-- 修改班级信息 Modal -->
<div class="modal fade" id="modClassModal" tabindex="-1" role="dialog" aria-labelledby="modClassModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">修改信息</h4>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="clazzname" class="col-sm-2 control-label">名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mod_classname" placeholder="请输入班级名称" value="<?php echo ($info["clazzname"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mod_tutor" class="col-sm-2 control-label">指导老师</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="mod_tutor">
                                <?php if(is_array($tutorList)): foreach($tutorList as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["nickname"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mod_grade" class="col-sm-2 control-label">年级</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mod_grade" placeholder="输入年份，如：2017" maxlength="4" value="<?php echo ($info["grade"]); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mod_grade" class="col-sm-2 control-label">等级</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                <input type="radio" name="mod_level" id="mod_level1" value="1" <?php echo ($info['level']==1?'checked':''); ?>>
                                初级
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="mod_level" id="mod_level2" value="2" <?php echo ($info['level']==2?'checked':''); ?>>
                                中级
                              </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="mod_level" id="mod_level3" value="3" <?php echo ($info['level']==3?'checked':''); ?>>
                                高级
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mod_clazz_info" class="col-sm-2 control-label">简介</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="3" id="mod_clazz_info" placeholder="最多输入250个字符"><?php echo ($info["clazz_info"]); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" id="btnModClassInfo">确认修改</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- 修改班级信息 Modal End -->

<script type="text/javascript">
    $(function() {
        //学生详情
        $('.btn-stu-detail').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "get",
                url: "<?php echo U('returnOneStuInfo');?>",
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
        //踢出学生
        $('.btn-stu-delete').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "get",
                url: "<?php echo U('kickOneStu');?>",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1){
                        alert("删除成功");
                        window.location.reload();
                    }
                    else alert("未知错误");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("出错了，请重新尝试");
                    console.log(XMLHttpRequest.status);
                    console.log(XMLHttpRequest.readyState);
                    console.log(textStatus);
                },
            });
        });
        //修改班级信息
        $('#btnModClassInfo').click(function() {
            var clazzname = $('#mod_classname').val();
            var tutor = $('#mod_tutor').val();
            var grade = $('#mod_grade').val();
            var level = $('input:radio[name="mod_level"]:checked').val();
            var clazzinfo = $('#mod_clazz_info').val();
            $("#StuInfoModal").modal('hide');

            $.ajax({
                type: 'POST',
                url: "<?php echo U('modClassInfo');?>",
                data: {
                    id: <?php echo ($info["id"]); ?>,
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
                        alert("修改信息完成");
                        window.location.reload();
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
        //删除班级
        $('#btn-del-class').click(function() {
            $.ajax({
                type: 'POST',
                url: "<?php echo U('delOneClass');?>",
                data: {
                    id: <?php echo ($info["id"]); ?>,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("删除成功");
                        document.location.href = "<?php echo U('ShowClass');?>";
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
        //提升权限
        $('.btn-stu-permit').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "post",
                url: "<?php echo U('doPermitUser');?>",
                data: {
                    stuid: id,
                    classid: <?php echo ($info["id"]); ?>,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("操作成功");
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
        //降权
        $('.btn-stu-demotion').click(function() {
            var id = $(this).attr('value');
            $.ajax({
                type: "post",
                url: "<?php echo U('doDemotionUser');?>",
                data: {
                    stuid: id,
                    classid: <?php echo ($info["id"]); ?>,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("操作成功");
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
        //修改班级事务
        $('.btn-mod-work').click(function(){
            var content = $('#workcontent').val();
            $.ajax({
                type: "post",
                url: "<?php echo U('modClassWork');?>",
                data: {
                    content: content,
                    id: <?php echo ($info["id"]); ?>,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("修改成功");
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
        //新增事务
        $('.btn-add-work').click(function(){
            var id = $(this).attr('value');
            $.ajax({
                type: "get",
                url: "<?php echo U('addClassWork');?>",
                data: {
                    classid: id,
                },
                cache: false,
                dataType: 'json',
                timeout: 5000,
                success: function(data) {
                    if (data == 1) {
                        alert("操作成功");
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
    });
</script>


    <!-- 包含bootstrap文件 -->
    <script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>