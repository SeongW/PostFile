<?php

namespace Admin\Controller;

use Think\Controller;

class ManagerController extends Controller
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
    public function index(){
        $m = M('admin');
        $map['id'] = array('NEQ',session('adminid'));
        $count = $m->where($map)->count();
        $Page = new \Think\Page($count, 8); // 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page -> setConfig('prev', '上一页');
        $Page -> setConfig('next', '下一页');
        $Page -> setConfig('theme', '<li>%HEADER%</li> <li>%FIRST%</li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li> <li>%DOWN_PAGE%</li> <li>%END%</li>');
        $show = $Page->show();              // 分页显示输出
        $list = $m->where($map)->limit($Page->firstRow.','.$Page->listRows)->getField('id,username,nickname');
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->assign('list', $list);
        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    //显示添加管理员页面
    public function addManager(){
        $this->display();
    }
    // 增加管理员动作
    public function doAddManager(){
        if (IS_POST) {
            $username = I('post.username', '', 'htmlspecialchars');
            $pwd1 = I('post.pwd1', '', 'htmlspecialchars');
            $pwd2 = I('post.pwd2', '', 'htmlspecialchars');
            $nickname = I('post.nickname', '', 'htmlspecialchars');
            $position = I('post.position', '', 'htmlspecialchars');
            $phonenumber= I('post.phonenumber', '', 'htmlspecialchars');
            $email = I('post.email', '', 'htmlspecialchars');
            $tecentNumber = I('post.tecentNumber', '', 'htmlspecialchars');
            $check = M('admin');
            $map['username'] = $username;
            if($check->where($map)->select()){
                $this->ajaxReturn("该账号已被占用");
            }
            if (empty($username)||empty($pwd1)||empty($pwd2)||empty($nickname)) {
                $this->ajaxReturn("请将数据填写完整");
            } else {
                if(pregUsername($username)){
                    if($pwd1 == $pwd2){
                        if(pregPassword($pwd1)){
                            $data['username'] = $username;
                            $data['password'] = $pwd1;
                            $data['password_md5'] = md5($pwd1);
                            $data['nickname'] = $nickname;
                            $data['signUpTime'] = date('Y-m-d H:i:s', time());
                            $data['lastLoginTime'] = date('Y-m-d H:i:s', time());
                            $data['phoneNumber'] = $phonenumber | "null";
                            $data['email'] = $email | "null";
                            $data['position'] = $position| "null";
                            $data['tecentNumber'] = $tecentNumber| "null";
                            $m = M('admin');
                            $res = $m->data($data)->add();
                            if($res){
                                $this->ajaxReturn(1);
                            } else{
                                $this->ajaxReturn('服务器出错了，请重新尝试');
                            }

                        } else {
                            $this->ajaxReturn('密码格式不正确');
                        }
                    } else{
                        $this->ajaxReturn('两次输入的密码不一致');
                    }
                } else{
                    $this->ajaxReturn('请正确填写用户名');
                }
            }
        } else {
            $this->ajaxReturn('非法访问');
        }
    }

    //删除管理员
    public function delManager(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            //判断是否是班级导师
            $exist = M('clazz');
            $res = $exist->where('tutor='.$id)->select();
            if($res)
                $this->ajaxReturn('该管理员是'.$res[0]['clazzname'].'班的指导老师，请修改后再删除');
            //开始删除
            $m = M('admin');
            $res = $m->where('id='.$id)->delete();
            if($res){
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn('出错了，请重新尝试');
            }
        } else{
            $this->error('非法访问');
        }
    }

    //修改管理员信息
    public function modAdminInfo(){
        //判断访问方法
        if (IS_POST) {
            $id = I('post.id', '', 'htmlspecialchars');
            $nickname = I('post.nickname', '', 'htmlspecialchars');
            $position = I('post.position', '', 'htmlspecialchars');
            $phonenumber = I('post.phonenumber', '', 'htmlspecialchars');
            $email = I('post.email', '', 'htmlspecialchars');
            if (!empty($nickname)&&!empty($position)&&!empty($phonenumber)&&!empty($email)) {
                $m = M('admin');
                $map['id'] = $id ;
                $data['nickname'] = $nickname ;
                $data['position'] = $position ;
                $data['phonenumber'] = $phonenumber ;
                $data['email'] = $email;
                $res = $m->where($map)->data($data)->save();
                if ($res) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn('出错了，请重新尝试');
                }
            } else {
                $this->ajaxReturn("请填写完整数据");
            }
        } else {
            $this->error('非法请求');
        }
    }
    //返回某个管理员的信息
    public function getAdminInfo()
    {
        if (IS_GET) {
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('admin');
            $admin = $m->where('id='.$id)->getField('id,nickname,phoneNumber,email,position');
            $this->ajaxReturn(json_encode($admin[$id]), 'JSON');
        } else {
            $this->error('非法访问');
        }
    }

    //返回一个管理员的信息
    public function returnOneAdminInfo(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('admin');
            $info = $m->where('id='.$id)->getField('id,username,password,nickname,email,position,tecentNumber,phoneNumber,signUpTime');
            $this->ajaxReturn(json_encode($info[$id]),'JSON');
        } else{
            $this->error('非法访问');
        }
    }



}
