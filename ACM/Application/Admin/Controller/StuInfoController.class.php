<?php

namespace Admin\Controller;

use Think\Controller;

class StuInfoController extends Controller
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

    //学生信息主页显示
    public function index()
    {
        //创建User模型
        $m = M('user');
        //构建查询结构
        $map['is_passed'] = 1;
        $map['is_locked'] = 0;
        //如果是搜索状态，则添加搜索添加
        if (IS_GET) {
            $serchinfo = I('get.searchinfo', '', 'htmlspecialchars');
            $map['nickname'] = array('LIKE','%'.$serchinfo.'%');
        }
        // 构造分页信息
        $count = $m->where($map)->count();
        // 实例化分页类 传入总记录数和每页显示的记录数(8)
        $Page = new \Think\Page($count, 8);
        $Page -> setConfig('prev', '上一页');
        $Page -> setConfig('next', '下一页');
        $Page -> setConfig('theme', '<li>%HEADER%</li> <li>%FIRST%</li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li> <li>%DOWN_PAGE%</li> <li>%END%</li>');
        // 分页显示输出
        $show = $Page->show();
        $stu = $m->where($map)->limit($Page->firstRow.','.$Page->listRows)->getField('id,nickname,institude,grade');
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->assign('stu', $stu);
        $this->assign('page', $show);
        //输出模版
        $this->display();
    }

    public function OneStuInfo()
    {
        //此方法的路由在Config处有修改
        //判断访问方法
        if (IS_GET) {
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $map['id'] = $id ;
            $stuInfo = $m->where($map)->getField('id,nickname,institude,class,grade,email,stu_id,sex,phonenumber');
            $this->assign('id', $id);
            $this->assign('stuInfo', $stuInfo[$id]);
            $this->display();
        } else {
            $this->error('非法请求');
        }
    }
    //修改学生信息
    public function ModOneStuInfo()
    {
        //判断访问方法
        if (IS_POST) {
            $id = I('post.id', '', 'htmlspecialchars');
            $nickname = I('post.nickname', '', 'htmlspecialchars');
            $institude = I('post.institude', '', 'htmlspecialchars');
            $clazz = I('post.clazz', '', 'htmlspecialchars');
            $stu_id = I('post.stu_id', '', 'htmlspecialchars');
            $phonenumber = I('post.phonenumber', '', 'htmlspecialchars');
            $email = I('post.email', '', 'htmlspecialchars');
            if (!empty($nickname)&&!empty($institude)&&!empty($clazz)&&!empty($stu_id)&&!empty($phonenumber)&&!empty($email)) {
                $m = M('user');
                $map['id'] = $id ;
                $data['nickname'] = $nickname ;
                $data['institude'] = $institude ;
                $data['class'] = $clazz ;
                $data['phonenumber'] = $phonenumber ;
                $data['email'] = $email;
                $data['stu_id'] = $stu_id;
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

    //返回某个学生的信息
    public function getStuInfo()
    {
        if (IS_GET) {
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $stu = $m->where('id='.$id)->getField('id,nickname,institude,class,grade,email,stu_id,sex,phonenumber');
            $this->ajaxReturn(json_encode($stu[$id]), 'JSON');
        } else {
            $this->error('非法访问');
        }
    }

    //添加学生
    public function doAddStu()
    {
        if (IS_POST) {
            $pwd1 =I('post.pwd1', '', 'htmlspecialchars');
            $pwd2 =I('post.pwd2', '', 'htmlspecialchars');
            $data['username'] = I('post.username', '', 'htmlspecialchars');
            $data['password'] = I('post.pwd1', '', 'htmlspecialchars');
            $data['nickname'] = I('post.nickname', '', 'htmlspecialchars');
            $data['institude'] = I('post.institude', '', 'htmlspecialchars');
            $data['class'] = I('post.clazz', '', 'htmlspecialchars');
            $data['sex'] = I('post.sex', '', 'htmlspecialchars');
            $data['stu_id'] = I('post.stu_id', '', 'htmlspecialchars');
            $data['phonenumber'] = I('post.phonenumber', '', 'htmlspecialchars');
            $data['grade'] = I('post.grade', '', 'htmlspecialchars');
            $data['email'] = I('post.email', '', 'htmlspecialchars');
            $data['sign_up_time'] = date('Y-m-d H:i:s', time());
            $data['last_login_time'] = date('Y-m-d H:i:s', time());
            $data['stu_img'] = 'mystery.png';
            $data['is_passed'] = 1;
            $data['is_locked'] = 0;
            $data['level'] = 0;
            //创建MODEL
            $m = M('user');
            //判断登陆账号是否存在数据库
            if ($m->create()) {
                $map['username'] =$data['username'];
                $res = $m->where($map)->select();
            } else {
                $this->ajaxReturn(9); // 数据库出错了
            }
            if (!$res) {
                if (pregUsername($data['username'])) {
                    if ($pwd1 == $pwd2) {
                        if (pregPassword($pwd1)) {
                            if (empty($data['nickname'])&&empty($data['institude'])&&empty($data['class'])&&empty($data['stu_id'])&&empty($data['phonenumber'])&&empty($data['email'])&&empty($data['grade'])) {
                                $this->ajaxReturn('请将资料填写完整');
                            } else {
                                $data['md5pwd'] = md5($pwd1);
                                $addResult = $m->data($data)->add();
                                if($addResult){
                                    $this->ajaxReturn(1);
                                } else{
                                    $this->ajaxReturn('服务器出错了，请重新尝试');
                                }
                            }
                        } else{
                            $this->ajaxReturn('密码格式不正确');
                        }
                    } else {
                        $this->ajaxReturn('两次输入的密码不一致');
                    }
                } else {
                    $this->ajaxReturn('账号格式不正确');
                }
            } else {
                $this->ajaxReturn('账号被占用');
            }
        } else {
            $this->error('非法访问');
        }
    }
    

}
