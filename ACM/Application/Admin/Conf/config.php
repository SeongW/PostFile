<?php
return array(
    //'配置项'=>'配置值'
    'URL_ROUTER_ON' => true, //开启路由
    // 路由规则
    'URL_ROUTE_RULES'=>array(
        // 'news/read/:id' => '/news/:1',
        'ShowStuInfo/:id' => 'Check/ShowStuInfo',   //查看学生个人信息路由
        'DelStuSign/:id' => 'Check/delStuSign',   //查看学生个人信息路由
        'OneStuInfo/:id' => 'StuInfo/OneStuInfo',   //查看学生个人信息路由
        'OneClass/:id' => 'Class/OneClass',         //查看单个班级信息

    ),
    //数据备份路径
    'DATA_BACKUP_PATH' => './Data/', //保存文件夹
    'DATA_BACKUP_PART_SIZE' => 20971520,
    'DATA_BACKUP_COMPRESS'=> 1,
    'DATA_BACKUP_COMPRESS_LEVEL' => 9,
    //导出excel数据表
    'EXCEL_FILE_PATH' => './Public/Excel/',
    //404
    'TMPL_EXCEPTION_FILE' => './Application/Admin/View/Public/404.html'
);
