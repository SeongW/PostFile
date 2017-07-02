<?php

namespace Home\Controller;

use Think\Controller;

class UserAdminController extends Controller
{
    //初始化检测是否登陆
    public function _initialize()
    {
        if (session('stuid') == '') {
            $this->error('未登录！', U('/User/login'));
        } else {
            $this->assign('name', $_SESSION['name']);
        }
    }

    //显示主页
    public function index()
    {
        $rightModel = M('user_clazz');
        $id = session('stuid');
        $rightRes = $rightModel->where('user_id='.$id)->select();
        $user_clazz = $rightRes[0];
        $this->assign('right', $user_clazz);
        // 如果有权限 获取班级信息
        if ($user_clazz['level'] == 1) {
            //获取班级信息id
            $clazzid = $user_clazz['clazz_id'];
            //获取该班级申请加入信息
            $checkModel = M('check_clazz');
            $checkList = $checkModel->table('acm_check_clazz a, acm_user b')->where('a.id_clazz='.$clazzid.' and b.id = a.id_stu')->getField('b.id as stu_id, a.id_clazz as class_id, b.nickname as nickname');
            $this->assign('list', $checkList);
            $this->assign('clazzid', $clazzid);

        }
        $this->display();
    }

    //通过审核
    public function passStuSelect()
    {
        if (IS_POST) {
            $stuid = I('post.stuid', '', 'htmlspecialchars');
            $classid = I('post.classid', '', 'htmlspecialchars');
            $checkModel = M('check_clazz');
            $userClassModel = M('user_clazz');
            //删除
            $del = $checkModel->where('id_stu='.$stuid)->delete();
            //添加
            $data['user_id'] = $stuid;
            $data['clazz_id'] = $classid;
            $data['check_time'] = date('Y-m-d H:i:s', time());
            $add = $userClassModel->data($data)->add();
            if($del&&$add)
                $this->ajaxReturn(1);
            else $this->ajaxReturn('出错了，请重新尝试');
        } else {
            $this->error('非法访问');
        }
    }

    //返回某个学生的信息
    public function returnOneStuInfo()
    {
        if (IS_GET) {
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $stu = $m->where('id='.$id)->getField('id,nickname,institude,class,grade,email,stu_id,sex,phonenumber');
            if ($stu[$id]['sex'] == 1) {
                $stu[$id]['sex'] = "男";
            } else {
                $stu[$id]['sex'] = "女";
            }
            $this->ajaxReturn(json_encode($stu[$id]), 'JSON');
        } else {
            $this->error('非法访问');
        }
    }
}
