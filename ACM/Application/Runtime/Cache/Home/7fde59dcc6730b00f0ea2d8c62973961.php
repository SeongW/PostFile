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
            <div class="col-md-12 box box-left-one">
                <!-- 如果已经加入班级 -->
                <?php if(($join == 1)): ?><div class="col-md-6 col-sm-6">
                        <!-- 班级信息 -->
                        <div class="panel panel-default">
                            <div class="panel-heading">所在班级信息</div>
                            <div class="panel-body">
                                <div class="clazz-info">
                                    <h3 class="title"><?php echo ($classInfo["clazzname"]); ?></h3>
                                    <h4>简介：<?php echo ($classInfo["clazz_info"]); ?></h4>
                                    <h4>年级：<?php echo ($classInfo["grade"]); ?></h4>
                                    <h4>等级：
                                        <?php switch($classInfo["level"]): case "1": ?>初级班<?php break;?>
                                        <?php case "2": ?>中级班<?php break;?>
                                        <?php case "3": ?>高级班<?php break;?>
                                        <?php default: ?>未评级<?php endswitch;?>
                                    </h4>
                                    <h4>创建时间：<?php echo date('Y年m月d日',strtotime($classInfo['create_time'])); ?></h4>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <ul class="clazz-info-footer">
                                    <li><a href="#" id="btn-show-tutor">指导老师信息</a></li>
                                    <li><a href="#" id="btn-quit-class">退出班级</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- 班级信息 END-->

                        <div class="panel panel-default">
                            <div class="panel-heading">班级事务</div>
                            <div class="panel-body">
                                <?php if($clazzwork): ?><blockquote>
                                        <p><?php echo ($clazzwork["workcontent"]); ?></p>
                                        <footer><?php echo ($clazzwork["createtime"]); ?></cite></footer>
                                    </blockquote>
                                    <?php else: ?>
                                    <blockquote>
                                        <p>暂无消息</p>
                                    </blockquote><?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- 学生列表 -->
                    <div class="col-md-6 col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">学生列表</div>
                            <div class="panel-body">
                                <div class="dir-info">
                                    <?php if(is_array($stuList)): $i = 0; $__LIST__ = $stuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><div class="row">
                                            <div class="col-xs-3">
                                                <div class="avatar">
                                                    <img src="/sys/Avatar/<?php echo ($list["stu_img"]); ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <h5><?php echo ($list["nickname"]); ?></h5>
                                                <span class="small dir-span"><?php echo ($list["institude"]); ?></span>
                                            </div>
                                            <div class="col-xs-3">
                                                <a class="dir-like btn-stu-info" href="#" value="<?php echo ($list["id"]); ?>">
                                                    <span class="small">查看</span>
                                                    <i class="fa fa-user-o"></i>
                                                </a>
                                            </div>
                                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 学生列表 end -->
                    <!-- <?php p($joinInfo); ?>
                    <?php p($classInfo); ?>
                    <?php p($stuList); ?> -->
                    <!-- 如果已经加入班级  end-->
                    <!-- 如果处于申请状态 -->
                    <?php elseif($check == 1): ?>
                    <div class="col-md-5 col-sm-5">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                等待管理员审核
                            </div>
                            <div class="panel-body">
                                <blockquote>
                                    <p>已申请<?php echo ($classInfo['clazzname']); ?>班</p>
                                    <footer>申请时间：<?php echo ($checkInfo[0]['checktime']); ?></footer>
                                </blockquote>
                            </div>
                            <div class="panel-footer" style="text-align:right;">
                                <a class="cancel" id='btn-cancel-check' value="<?php echo ($checkInfo[0]['id']); ?>"><span>取消申请</span></a>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- 如果不在申请状态，也不在班级状态 -->
                    <div class="box-title">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>未加入兴趣班</strong> 请选择适合的兴趣班申请加入！
                                </div>
                            </div>
                            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><!-- panel start -->
                                <div class="col-sm-3">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <?php echo ($vo["clazzname"]); ?>
                                        </div>
                                        <div class="panel-body">
                                            <p>年级：<?php echo ($vo["grade"]); ?>级</p>
                                            <p>等级：
                                                <?php switch($vo["level"]): case "1": ?>初级班<?php break;?>
                                                    <?php case "2": ?>中级班<?php break;?>
                                                    <?php case "3": ?>高级班<?php break;?>
                                                    <?php default: ?>未评级<?php endswitch;?>
                                            </p>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <button class="btn btn-success btn-sm btn-join" type="submit" value="<?php echo ($vo["id"]); ?>">加入</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <a href="/sys/index.php/ShowOneClass/<?php echo ($vo["id"]); ?>">
                                                        <button class="btn btn-default btn-sm" type="submit">查看</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- panel end --><?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div><?php endif; ?>


            </div>
        </div>
        <!-- 右侧 -->
        <div class="col-md-3 baseRight">
            <?php echo W('Right/Personal');?> <?php echo W('Right/news');?>
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
<!-- 导师 Modal -->
<div class="modal fade bs-example-modal-sm" id="tutorInfoModal" tabindex="-1" role="dialog" aria-labelledby="tutorInfoModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="tutorInfoLabel"><?php echo ($tutorInfo["nickname"]); ?></h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td>E-mail</td>
                        <td><?php echo ($tutorInfo["email"]); ?></td>
                    </tr>
                    <tr>
                        <td>联系电话</td>
                        <td><?php echo ($tutorInfo["phonenumber"]); ?></td>
                    </tr>
                    <tr>
                        <td>QQ</td>
                        <td><?php echo ($tutorInfo["tecentnumber"]); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- 导师 Modal End -->


<script type="text/javascript">
    $(function() {
        //学生详情
        $('.btn-stu-info').click(function() {
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
        //加入班级
        $('.btn-join').click(function() {
            var classid = $(this).val();
            //ajax
            $.ajax({
                'type': 'post',
                'url': "<?php echo U('Class/applyClass');?>",
                'data': {
                    classid: classid,
                },
                'success': function(data) {
                    if (data == 1) {
                        alert('申请成功，请等待管理员审批');
                        document.location.href = "<?php echo U('Class/index');?>";
                    } else {
                        alert(data);
                    }
                },
                'error': function() {
                    alert("未知错误");
                },
                'dataType': 'json',
                'async': false
            });
        });
        //申请
        $('#btn-cancel-check').click(function() {
            var checkid = $('#btn-cancel-check').attr('value');
            //ajax
            $.ajax({
                'type': 'POST',
                'url': "<?php echo U('Class/cancelApplyClass');?>",
                'data': {
                    checkid: checkid,
                },
                'success': function(data) {
                    if (data == 1) {
                        alert('取消成功');
                        document.location.href = "<?php echo U('Class/index');?>";
                    } else {
                        alert(data);
                    }
                },
                'error': function() {
                    alert("未知错误");
                },
                'dataType': 'json',
                'async': false
            });
        });
        //退出班级
        $('#btn-quit-class').click(function(){
            $.ajax({
                'type': 'POST',
                'url': "<?php echo U('quitClass');?>",
                'data': {
                },
                'success': function(data) {
                    if (data == 1) {
                        alert('退出成功');
                        document.location.href = "<?php echo U('Class/index');?>";
                    } else {
                        alert(data);
                    }
                },
                'error': function() {
                    alert("未知错误");
                },
                'dataType': 'json',
                'async': false
            });
        })
        //显示导师信息
        $('#btn-show-tutor').click(function(){
            $("#tutorInfoModal").modal('show');
        });
    });
</script>


<!-- 包含bootstrap文件 -->
<script type="text/javascript" src="/sys/Public/Bootstrap/js/bootstrap.min.js"></script>

</body>

</html>