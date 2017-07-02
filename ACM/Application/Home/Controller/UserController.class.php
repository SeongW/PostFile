<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{
    //显示登陆界面
    public function login()
    {
        $this->display();
    }
    //今日登陆登记
    public function todaylogin(){
        $m = M('todaylogin');
        $data['datetime'] = date('Y-m-d H:i:s', time());
        $res = $m->data($data)->add();
    }
    //登陆动作
    public function doLogin()
    {
        if (IS_POST) {
            $username = I('post.username', '', 'htmlspecialchars');
            $password = I('post.password', '', 'htmlspecialchars');
            $verify = I('post.verify', '', 'htmlspecialchars');
            $md5pwd1 = md5($password);
            $map['username'] = $username;
            $m = M('user');
            $res = $m->where($map)->select();
            //先清空之前执行过的所有session参数
            session('stuid',null);
            if(!check_verify($verify,1)){
                $this->ajaxReturn('验证码不正确');
            }
            if ($res[0]) {
                //检查账号状态
                if ($res[0]['is_passed'] == 0) {
                    $this->ajaxReturn('你的账号未通过管理员认证');
                }
                if ($res[0]['is_locked'] == 1) {
                    $this->ajaxReturn('你的账号被锁定了，请联系管理员');
                }
                //开始验证密码
                $md5pwd2 = md5($res[0]['password']);
                if ($md5pwd2 == $md5pwd1) {
                    // 修改最后一次登陆时间
                    $data['last_login_time'] = date('Y-m-d H:i:s', time());
                    $loginTime = $m->where($map)->save($data);
                    if ($loginTime) {
                        session('username', $res[0]['username']);
                        session('stuid', $res[0]['id']);
                        session('name', $res[0]['nickname']);
                        //如果登陆成功登记一条信息
                        $this->todaylogin();
                        $this->ajaxReturn(1);
                    } else {
                        $this->ajaxReturn('系统出错了');
                    }
                } else {
                    $this->ajaxReturn('密码不正确');
                }
            } else {
                $this->ajaxReturn('用户不存在');
            }
        } else {
            $this->ajaxReturn('非法访问');
        }
    }

    //显示注册界面
    public function register()
    {
        $this->display();
    }

    //显示注册成功界面
    public function registerSuccess()
    {
        $this->error('注册成功', U('User/login'));
    }

    //注册动作
    public function doRegister()
    {
        if (IS_POST) {
            $pwd1 =I('post.password1', '', 'htmlspecialchars');
            $pwd2 =I('post.password2', '', 'htmlspecialchars');
            $data['username'] = I('post.username', '', 'htmlspecialchars');
            $data['password'] = I('post.password1', '', 'htmlspecialchars');
            $data['nickname'] = I('post.nickname', '', 'htmlspecialchars');
            $data['institude'] = I('post.institude', '', 'htmlspecialchars');
            $data['class'] = I('post.class', '', 'htmlspecialchars');
            $data['sex'] = I('post.sex', '', 'htmlspecialchars');
            $data['stu_id'] = I('post.stu_id', '', 'htmlspecialchars');
            $data['phonenumber'] = I('post.phonenumber', '', 'htmlspecialchars');
            $data['email'] = I('post.email', '', 'htmlspecialchars');
            $data['sign_up_time'] = date('Y-m-d H:i:s', time());
            $data['last_login_time'] = date('Y-m-d H:i:s', time());
            $data['grade'] = I('post.grade', '', 'htmlspecialchars');
            $data['stu_img'] = 'mystery.png';
            $data['is_passed'] = 0;
            $data['is_locked'] = 0;
            $data['level'] = 0;
            $m = M('user');
            //查询用户名是否存在
            $map['username'] =$data['username'];
            $res = $m->where($map)->select();

            if (!$res) {
                if (pregUsername($data['username'])) {
                    if ($pwd1 == $pwd2) {
                        if (pregPassword($pwd1)) {
                            // 判断资料是否填写完整
                            if (empty($data['nickname'])&&empty($data['institude'])&&empty($data['class'])&&empty($data['stu_id'])&&empty($data['phonenumber'])&&empty($data['email'])) {
                                $this->ajaxReturn(11); // 请将个人信息填写完整
                            } else {
                                $data['md5pwd'] = md5($pwd1);
                                $user = M('user');
                                if ($user->create()) {
                                    $addres = $user->data($data)->add();
                                    if ($addres) {
                                        $this->ajaxReturn(10); // 成功了
                                    } else {
                                        $this->ajaxReturn(9); // 数据库出错了
                                    }
                                } else {
                                    $this->ajaxReturn(9); // 数据库出错了
                                }
                            }
                        } else {
                            $this->ajaxReturn(4);//输入密码格式不正确
                        }
                    } else {
                        $this->ajaxReturn(3);//两次输入的密码不一致
                    }
                } else {
                    $this->ajaxReturn(2);//请正确填写用户名
                }
            } else {
                $this->ajaxReturn(1); //该用户名已被占用
            }
        } else {
            // 非法访问
            $this->ajaxReturn(0);
            //$this->error('非法访问', U('User/login'));
        }
    }

    //退出登陆
    public function doLogout()
    {
        session(null);
        $this->error('已退出登陆', U('/User/login'), 3);
    }

    //生成验证码
   public function selfverify(){
        $config = array(
            'fontSize'=> 18,            // 验证码字体大小
            'length'=> 4,               // 验证码位数
            'useNoise'=> false,         // 关闭验证码杂点
            'imageW' => 120,            //验证码宽度
            'imageH' => 40,             //验证码高度
            'expire' => 300,            //有效时间300秒
            'codeSet' => '0123456789',
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry(1);              //表是码为1
   }

}
