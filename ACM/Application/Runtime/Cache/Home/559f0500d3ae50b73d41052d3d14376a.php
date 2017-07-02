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
        <div class="col-md-9 baseLeft" style="min-height:400px;">
            <div class="col-md-12 box">
                <?php if($right['level'] == 0 ): ?><!-- 没有权限 -->
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <strong>没有权限!</strong> 你没有加入班级或者没有班级管理权限。
                    </div>
                    <?php else: ?>
                    <!-- 拥有权限 -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">申请加入班级列表</div>
                            <table class="table table-bordered">
                                <?php if($list): ?><tr>
                                        <th>姓名</th>
                                        <th>详情</th>
                                        <th>操作</th>
                                    </tr>
                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr>
                                            <td><?php echo ($item["nickname"]); ?></td>
                                            <td><a href="#" value="<?php echo ($item["stu_id"]); ?>" class="btn-stu-info">查看</a></td>
                                            <td><a href="#" value="<?php echo ($item["stu_id"]); ?>" class="btn-stu-pass">通过</a></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                    <div class="center-block" style="text-align:center;padding:15px 0 0 0;">
                                        <p class="lead">暂无申请</p>
                                    </div><?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <!-- <?php p($right); ?>
                    <?php p($list); ?>
                    <?php p($classid); ?> --><?php endif; ?>
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


<script type="text/javascript">
    $(function(){
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
        //通过神恶化
        $('.btn-stu-pass').click(function(){
            var stuid = $(this).attr('value');
            var classid = <?php echo ($clazzid); ?>;
            $.ajax({
                type: "post",
                url: "<?php echo U('passStuSelect');?>",
                data: {
                    stuid: stuid,
                    classid: classid,
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