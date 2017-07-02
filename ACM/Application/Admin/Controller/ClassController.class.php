<?php
namespace Admin\Controller;

use Think\Controller;

class ClassController extends Controller
{
    //初始化检测是否登陆
    public function _initialize()
    {
        if (session('adminid') == '') {
            $this->error('未登录！', U('/User/login'));
        } else {
            $this->assign('name', $_SESSION['name']);
        }
    }

    //增加班级填写页面
    public function AddClass()
    {
        //获取指导老师列表
        $m = M('admin');
        $tutorList = $m->getField('id,nickname,username');
        $this->assign('list',$tutorList);
        $this->display();
    }

    // 增加班级的动作
    public function doAddClass()
    {
        if (IS_POST) {
            $clazzname = I('post.clazzname', '', 'htmlspecialchars');
            $tutor = I('post.tutor', '', 'htmlspecialchars');
            $grade = I('post.grade', '', 'htmlspecialchars');
            $level = I('post.level', '', 'htmlspecialchars');
            $clazzinfo = I('post.clazzinfo', '', 'htmlspecialchars');
            if (empty($clazzname)||empty($tutor)||empty($grade)||empty($level)||empty($clazzinfo)) {
                $this->ajaxReturn("请将数据填写完整");
            } else {
                $data['clazzname'] = $clazzname;
                $data['tutor'] = $tutor;
                $data['grade'] = $grade;
                $data['level'] = $level;
                $data['clazz_info'] = $clazzinfo;
                $data['create_time'] = date('Y-m-d', time());
                $data['last_time_modify'] = date('Y-m-d', time());
                $m = M('clazz');
                if($m->create()){
                    $res = $m->add($data);
                    if ($res) {
                        $this->ajaxReturn(1);
                    } else {
                        $this->ajaxReturn("数据库出错了，请重新尝试");
                    }
                } else{
                    $this->ajaxReturn("出错了，请重新尝试");
                }
            }
        } else {
            $this->ajaxReturn('非法访问');
        }
    }

    //查看班级详情
    public function ShowClass(){
        $m = M('clazz');
        $count = $m->count();
        $Page = new \Think\Page($count, 12); // 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page -> setConfig('prev', '上一页');
        $Page -> setConfig('next', '下一页');
        $Page -> setConfig('theme', '<li>%HEADER%</li> <li>%FIRST%</li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li> <li>%DOWN_PAGE%</li> <li>%END%</li>');
        $show = $Page->show();              // 分页显示输出
        $list = $m->limit($Page->firstRow.','.$Page->listRows)->getField('id,clazzname,level');
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->assign('list',$list);
        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    //查看单个班级情况(需要统计班级人数)
    public function OneClass(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $map['id'] = $id;
            $clazzModel = M('clazz');
            $res = $clazzModel->where($map)->select();
            //传入班级信息
            $this->assign('info',$res[0]);
            //总人数
            $userClazzModel = M('user_clazz');
            $stuCount = $userClazzModel->where('clazz_id='.$res[0]['id'])->count();
            $this->assign('stuCount',$stuCount);
            //普通学生
            $stuList = $userClazzModel->table('acm_user_clazz a, acm_user stu')->where('a.clazz_id='.$id.' and stu.id = a.user_id and a.level = 0 and stu.is_locked = 0')->field('stu.id as id, stu.nickname as nickname')->select();
            $this->assign('stuList',$stuList);
            //管理员学生
            $adminList = $userClazzModel->table('acm_user_clazz a, acm_user stu')->where('a.clazz_id='.$id.' and stu.id = a.user_id and a.level = 1 and stu.is_locked = 0')->field('stu.id as id, stu.nickname as nickname')->select();
            $this->assign('adminList',$adminList);
            //班级事务
            $work = $this->getClassWork($id);
            $this->assign('classwork',$work);
            //获取导师名字
            $tutor_id = $res[0]['tutor'];
            $tutorModel = M('admin');
            $tutorName = $tutorModel->where('id='.$tutor_id)->select();
            $this->assign('tutorName',$tutorName[0]);
            //获取指导老师列表
            $tutorList = $tutorModel->getField('id,nickname,username');
            $this->assign('tutorList',$tutorList);
        } else {
            $this->error('非法访问',U('Index/index'));
        }
        $this->display();
    }

    //踢出某个学生
    public function kickOneStu(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user_clazz');
            $res = $m->where('user_id='.$id)->delete();
            if($res)
            {
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(0);
            }
        } else{
            $this->error('非法访问',U('Index/index'));
        }
    }
    //返回某个学生的信息
    public function returnOneStuInfo(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $stu = $m->where('id='.$id)->getField('id,nickname,institude,class,grade,email,stu_id,sex,phonenumber');
            if($stu[$id]['sex'] == 1)
                $stu[$id]['sex'] = "男";
            else $stu[$id]['sex'] = "女";
            $this->ajaxReturn(json_encode($stu[$id]),'JSON');
        } else{
            $this->error('非法访问');
        }
    }

    //修改班级信息
    public function modClassInfo(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            $clazzname = I('post.clazzname', '', 'htmlspecialchars');
            $tutor = I('post.tutor', '', 'htmlspecialchars');
            $grade = I('post.grade', '', 'htmlspecialchars');
            $level = I('post.level', '', 'htmlspecialchars');
            $clazz_info = I('post.clazzinfo', '', 'htmlspecialchars');
            if (empty($clazzname)||empty($tutor)||empty($grade)||empty($level)||empty($clazz_info)) {
                $this->ajaxReturn("请将数据填写完整");
            } else {
                $data['clazzname'] = $clazzname;
                $data['tutor'] = $tutor;
                $data['grade'] = $grade;
                $data['level'] = $level;
                $data['clazz_info'] = $clazz_info;
                $data['create_time'] = date('Y-m-d', time());
                $data['last_time_modify'] = date('Y-m-d', time());
                $m = M('clazz');
                if($m->create()){
                    $res = $m->where('id='.$id)->data($data)->save();
                    if ($res) {
                        $this->ajaxReturn(1);
                    } else {
                        $this->ajaxReturn("数据库出错了，请重新尝试");
                    }
                } else{
                    $this->ajaxReturn("出错了，请重新尝试");
                }
            }
        }else {
            $this->error("非法访问");
        }
    }

    //删除某个班级
    public function delOneClass(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            //删除班级成员
            $classStu = M('user_clazz');
            $res2 = $classStu->where('clazz_id='.$id)->delete();
            //
            $work = M('clazz_work');
            $res3 = $work->where('clazz_id='.$id)->delete();
            //删除班级
            $m = M('clazz');
            $res = $m->where('id='.$id)->delete();
            //删除事务
            if($res)
                $this->ajaxReturn(1);
            else $this->ajaxReturn("服务器出错，请重新尝试");
        } else {
            $this->error("非法访问");
        }
    }

    //提升权限
    public function doPermitUser(){
        if(IS_POST){
            $stuid = I('post.stuid', '', 'htmlspecialchars');
            $classid = I('post.classid', '', 'htmlspecialchars');
            $data['level'] = 1;
            $classStuModel = M('user_clazz');
            $res = $classStuModel->where("user_id = ".$stuid)->data($data)->save();
            if($res)
                $this->ajaxReturn(1);
            else $this->ajaxReturn('出错了，请重新尝试');
        } else {
            $this->error('非法访问');
        }
    }
    //降权
    public function doDemotionUser(){
        if(IS_POST){
            $stuid = I('post.stuid', '', 'htmlspecialchars');
            $classid = I('post.classid', '', 'htmlspecialchars');
            $data['level'] = 0;
            $classStuModel = M('user_clazz');
            $res = $classStuModel->where("user_id = ".$stuid)->data($data)->save();
            if($res)
                $this->ajaxReturn(1);
            else $this->ajaxReturn('出错了，请重新尝试');
        } else {
            $this->error('非法访问');
        }
    }

    //获取某个班级的事务
    public function getClassWork($id){
        $m =  M('clazz_work');
        $res = $m->where('clazz_id='.$id)->select();
        if($res)
            return $res[0];
        else return $res;
    }
    //新增班级事务
    public function addClassWork(){
        if(IS_GET){
            $classid = I('get.classid', '', 'htmlspecialchars');
            $m =  M('clazz_work');
            $data['workcontent'] = '事务内容';
            $data['createtime'] = date('Y-m-d H:i:s', time());
            $data['clazz_id'] = $classid;
            $res = $m->data($data)->add();
            if($res){
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn("出错了");
            }
        } else {
            $this->error('非法访问');
        }
    }
    //修改班级事务
    public function modClassWork(){
        if(IS_POST){
            $classid = I('post.id', '', 'htmlspecialchars');
            $content = I('post.content', '', 'htmlspecialchars');
            if (empty($content)) {
                $this->ajaxReturn("请将数据填写完整");
            } else {
                $data['workcontent'] = $content;
                $data['createtime'] = date('Y-m-d H:i:s', time());
                $m = M('clazz_work');
                $res = $m->where('clazz_id='.$classid)->data($data)->save();
                if ($res) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn("数据库出错了，请重新尝试");
                }
            }
        }else {
            $this->error("非法访问");
        }
    }
}
