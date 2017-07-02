<?php

namespace Home\Controller;

use Think\Controller;

class ClassController extends Controller
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

    //return array 获得班级列表
    private function getClazzInfo(){
        $clazzModel = M('clazz');
        $clazzList = $clazzModel->getField('id,clazzname,grade,level');
        return $clazzList;
    }
    //获得单个班级信息
    private function getOneClazzInfo($id){
        $clazzModel = M('clazz');
        $clazz = $clazzModel->where('id='.$id)->select();
        return $clazz[0];
    }
    //获得班级事务信息
    private function getClazzWork($id){
        $workModel = M('clazz_work');
        $work = $workModel->where('clazz_id='.$id)->select();
        if($work)
            return $work[0];
        else return $work;
    }
    //获得该班级的所有学生
    private function getClazzStuList($id){
        $stuModel = M('user');
        $stuList = $stuModel->table('acm_user_clazz a, acm_user stu')->where('a.clazz_id='.$id.' and stu.id = a.user_id')->field('stu.id as id, stu.nickname as nickname, stu.stu_img as stu_img,stu.institude')->select();
        return $stuList;
    }
    //获取指导老师信息
    private function getTutorInfo($id){
        $admin = M('admin');
        $info = $admin->where('id='.$id)->getField('id,nickname,email,phonenumber,tecentNumber');
        return $info[$id];
    }

    //显示班级信息，若已经加入，显示所在班级，若没有加入显示班级列表，若正在申请则显示正在等待审批
    public function Index(){
        $id = session('stuid');
        //查询是否已加入班级
        $join = M('user_clazz');
        $joinResult = $join->where('user_id='.$id)->select();
        if($joinResult){
            //如果已加入显示班级信息
            //判断结果
            $this->assign('join',1);
            $this->assign('joinInfo',$joinResult);
            //班级
            $classInfo = $this->getOneClazzInfo($joinResult[0]['clazz_id']);
            $this->assign('classInfo',$classInfo);
            //学生
            $this->assign('stuList',$this->getClazzStuList($joinResult[0]['clazz_id']));
            //事务
            $this->assign('clazzwork',$this->getClazzWork($joinResult[0]['clazz_id']));
            //导师
            $this->assign('tutorInfo',$this->getTutorInfo($classInfo['tutor']));

        } else{
            //如果没有加入查询是否正在申请信息
            $this->assign('join',0);
            //查询是否正在申请
            $check = M('check_clazz');
            $checkResult = $check->where('id_stu='.$id)->select();
            if($checkResult){
                //如果已经申请，但没有审核
                $this->assign('check',1);
                $this->assign('checkInfo',$checkResult);
                $this->assign('classInfo',$this->getOneClazzInfo($checkResult[0]['id_clazz']));
            } else{
                //没有申请
                $this->assign('check',0);
                //获得班级列表 显示可加入班级列表
                $list = $this->getClazzInfo();
                $this->assign('list',$list);
            }
        }
        $this->assign('stuId',$id);
        $this->display();
    }


    //显示一个班级的信息
    public function ShowOneClass(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('clazz');
            $res = $m->where('id='.$id)->select();
            if($res){
                $this->assign('info',$res[0]);
                $this->display();
            } else{
                $this->error('不存在该班级',U('Index/index'));
            }
        } else {
            $this->error('非法访问',U('Index/index'));
        }
    }


    //申请动作
    public function applyClass(){
        if(IS_POST){
            $data['id_clazz'] = I('post.classid', '', 'htmlspecialchars');
            $data['id_stu'] = session('stuid');
            $data['checktime'] = date('Y-m-d H:i:s', time());
            $m = M('check_clazz');
            $res = $m->data($data)->add();
            if($res){
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn('出错了，请重新尝试');
            }
        } else{
            $this->error('非法访问',U('Index/index'));
        }
    }
    //取消申请
    public function cancelApplyClass(){
        if(IS_POST){
            $map['id'] = I('post.checkid', '', 'htmlspecialchars');
            $m = M('check_clazz');
            $res = $m->where($map)->delete();
            if($res){
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn('操作失败');
            }
        } else{
            $this->error('非法访问',U('Index/index'));
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

    //退出班级
    public function quitClass(){
        $id = session('stuid');
        if(IS_POST){
            $m = M('user_clazz');
            $res = $m->where('user_id='.$id)->delete();
            if($res)
                $this->ajaxReturn(1);
            else $this->ajaxReturn("出错了，请重新尝试");
        } else $this->error("非法访问");
    }

}
