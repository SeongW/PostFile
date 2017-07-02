<?php if (!defined('THINK_PATH')) exit();?><style media="screen">
    .designation {
        margin-top: 10px;
        display: block;
    }
    .personal-wrap{
        text-align: center;
    }
    .check-wrap {
        padding: 0px 30px;
    }

    .check-btn {
        margin-top: 15px;
        border: 0;
        border-radius: 0;
        background-color: #8e44ad;
        font-weight: 300;
        border: 0;
        transition: all .3s;
    }
</style>

<div class="col-md-12 box widget-border box-right">
    <div class="col-md-8 col-md-offset-2 personal-wrap">
        <img src="/sys/Avatar/<?php echo ($userinfo["stu_img"]); ?>" alt="..." class="img-circle img-thumbnail">
        <h3><?php echo ($userinfo["nickname"]); ?><small class="designation"><?php echo ($userinfo["class"]); ?></small></h3>

    </div>
</div>