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

    #export {
        color: #fff;
    }
    #btn-export{
        cursor: pointer;
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
            <ul class="children collapse" id="sub-item-2" aria-expanded="false" >
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
            <ul class="children collapse in" id="sub-item-3" aria-expanded="true" style>
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
                <li class="active">备份数据</li>
            </ol>
            <div class="col-sm-12 col-md-12">
            <div class="col-sm-4 col-md-4">
                <div class="barcard barcard-primary" style="color:#fff;" id="btn-export">
                    <div class="card-block">
                        <h4 class="mb-0">备份</h4>
                        <a href="javascript:;" id="export" autocomplete="off">备份所有数据库</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">列表</h3>
                        </div>
                        <!-- 应用列表 -->
                        <div class="data-table table-striped">
                            <form id="export-form" method="post" action="<?php echo U('export');?>">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="48">
                                                <!-- <input class="check-all" checked="chedked" type="checkbox" value=""> -->
                                            </th>
                                            <th>表名</th>
                                            <th width="120">数据量</th>
                                            <th width="120">数据大小</th>
                                            <th width="160">创建时间</th>
                                            <th width="160">备份状态</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr>
                                                <td class="num">
                                                    <input class="ids" checked="chedked" type="checkbox" name="tables[]" value="<?php echo ($table["name"]); ?>">
                                                </td>
                                                <td><?php echo ($table["name"]); ?></td>
                                                <td><?php echo ($table["rows"]); ?></td>
                                                <td><?php echo (format_bytes($table["data_length"])); ?></td>
                                                <td><?php echo ($table["create_time"]); ?></td>
                                                <td class="info">未备份</td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <!-- /应用列表 -->
                    </div>
                </div>
            </div>
            </div>
        </div>

        <script type="text/javascript">
            (function($) {
                // 获取对象
                var $form = $("#export-form"),
                    $export = $("#export"),
                    table;

                $("#btn-export").click(function() {
                    $export.parent().children().addClass("disabled");
                    $export.html("正在发送备份请求...");
                    $.post(
                        $form.attr("action"),
                        $form.serialize(),
                        function(data) {
                            if (data.status) {
                                tables = data.tables;
                                $export.html(data.info + "开始备份，请不要关闭本页面！");
                                backup(data.tab);
                                window.onbeforeunload = function() {
                                    return "正在备份数据库，请不要关闭！"
                                }
                            } else {
                                updateAlert(data.info, 'alert-error');
                                $export.parent().children().removeClass("disabled");
                                $export.html("立即备份");
                                setTimeout(function() {
                                    $('#top-alert').find('button').click();
                                    $(that).removeClass('disabled').prop('disabled', false);
                                }, 1500);
                            }
                        },
                        "json"
                    );
                    return false;
                });

                function backup(tab, status) {
                    status && showmsg(tab.id, "开始备份...(0%)");
                    $.get($form.attr("action"), tab, function(data) {
                        if (data.status) {
                            showmsg(tab.id, data.info);

                            if (!$.isPlainObject(data.tab)) {
                                $export.parent().children().removeClass("disabled");
                                $export.html("备份完成，点击重新备份");
                                window.onbeforeunload = function() {
                                    return null
                                }
                                return;
                            }
                            backup(data.tab, tab.id != data.tab.id);
                        } else {
                            updateAlert(data.info, 'alert-error');
                            $export.parent().children().removeClass("disabled");
                            $export.html("立即备份");
                            setTimeout(function() {
                                $('#top-alert').find('button').click();
                                $(that).removeClass('disabled').prop('disabled', false);
                            }, 1500);
                        }
                    }, "json");

                }
                //显示进度消息
                function showmsg(id, msg) {
                    $form.find("input[value=" + tables[id] + "]").closest("tr").find(".info").html(msg);
                }

            })(jQuery);
        </script>
        
    <!-- 包含bootstrap文件 -->
    <script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>