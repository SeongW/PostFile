<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller
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

    //显示主页
    public function index()
    {
        //学生注册数量
        $stu = M('user');
        $stuCount = $stu->count();
        $this->assign('stuCount', $stuCount);
        //班级数量
        $clazz = M('clazz');
        $clazzCount = $clazz->count();
        $this->assign('clazzCount', $clazzCount);
        //管理员数量
        $admin = M('admin');
        $adminCount = $admin->count();
        $this->assign('adminCount', $adminCount);
        //今日访问
        $today = M('todaylogin');
        $todayCount = $today->where("to_days(datetime) = to_days(now())")->count();
        $this->assign('todayCount', $todayCount);
        //通知信息
        $inform = M('inform');
        $informRes = $inform->select();
        $this->assign('inform', $informRes[0]);
        $this->display();
    }

    // 个人信息
    public function personInfo()
    {
        $userId = session('adminid');
        $userName = session('name');
        $Admin = M("admin");
        $info = $Admin->where("id=".$userId)->getField('id,nickname,phoneNumber,email,position,tecentNumber,lastLoginTime');
        $this->assign("info", $info);
        $this->assign("name", $userName);
        $this->display();
    }
    // 修改个人信息
    public function modPersonal()
    {
        if (IS_POST) {
            $nickname = I('post.nickname', '', 'htmlspecialchars');
            $position = I('post.position', '', 'htmlspecialchars');
            $phoneNumber = I('post.phoneNumber', '', 'htmlspecialchars');
            $tecentNumber = I('post.tecentNumber', '', 'htmlspecialchars');
            $email = I('post.email', '', 'htmlspecialchars');
            //输入过滤
            if (!empty($nickname)&&!empty($position)&&!empty($phoneNumber)&&!empty($tecentNumber)&&!empty($email)) {
                $m = M("admin");
                $map['id'] = session('adminid');
                $data['nickname'] = $nickname;
                $data['phoneNumber'] = $phoneNumber;
                $data['tecentNumber'] = $tecentNumber;
                $data['email'] = $email;
                $data['position'] = $position;
                $res = $m->where($map)->save($data);
                if ($res) {
                    $this->success('修改成功', U('/Index/personInfo'));
                } else {
                    $this->error('服务器出错了！请重新填写。', U('/Index/modPersonal'));
                }
            } else {
                $this->error('请完整填写信息', U('/Index/modPersonal'));
            }
        } else {
            $this->display();
        }
    }

    // 修改密码
    public function modPwd()
    {
        if (IS_POST) {
            $oldpwd = I('post.oldPassword1', '', 'htmlspecialchars');
            $newpwd1 = I('post.newPassword2', '', 'htmlspecialchars');
            $newpwd2 = I('post.newPassword2', '', 'htmlspecialchars');
            $m = M('admin');
            $id = session('adminid');
            $map['id'] = $id;
            $res = $m->where($map)->getField('id,password');
            if (md5($oldpwd) == md5($res[$id])) {
                if ($newpwd1 == $newpwd2) {
                    $md5pwd = md5($newpwd1);
                    $data['password'] = $newpwd1;
                    $data['password_md5'] = $md5pwd;
                    $res = $m->where($map)->save($data);
                    if ($res) {
                        $this->success('密码修改成功', U('/Index/personInfo'));
                    } else {
                        $this->error('服务器出错了!', U('/Index/modPwd'));
                    }
                } else {
                    $this->error('两次输入的新密码不一致!', U('/Index/modPwd'));
                }
            } else {
                $this->error('旧密码不正确', U('/Index/modPwd'));
            }
        } else {
            $this->display();
        }
    }

    // 修改通知
    public function doModInform(){
        if (IS_POST) {
            $title = I('post.title', '', 'htmlspecialchars');
            $content = I('post.content', '', 'htmlspecialchars');
            $id = I('post.id', '', 'htmlspecialchars');
            if(empty($title)||empty($content)){
                $this->ajaxReturn("不能为空");
            } else{
                $m = M('inform');
                $data['title'] = $title;
                $data['content'] = $content;
                $data['datatime'] = date('Y-m-d H:i:s', time());
                $res = $m->where('id='.$id)->data($data)->save();
                if($res)
                    $this->ajaxReturn(1);
                else $this->ajaxReturn("服务器出错了");
            }
        } else {
            $this->error('非法访问');
        }
    }
}
