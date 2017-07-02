<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function login()
    {
        $this->display();
    }

    public function doLogin()
    {
        if (IS_POST) {
            $username = I('post.username', '', 'htmlspecialchars');
            $password = I('post.password', '', 'htmlspecialchars');
            $md5pwd1 = md5($password);
            $map['username'] = $username;
            $m = M('admin');
            $res = $m->where($map)->select();
            //测试前，先清空之前执行过的所有session参数
            session(null);
            if ($res) {
                $md5pwd2 = md5($res[0]['password']);
                if ($md5pwd2 == $md5pwd1) {
                    // 修改最后一次登陆时间
                    $data['lastLoginTime'] = date('Y-m-d H:i:s',time());
                    $loginTime = $m->where($map)->save($data);
                    if($loginTime){
                        session('username', $res[0]['username']);
                        session('adminid', $res[0]['id']);
                        session('name', $res[0]['nickname']);
                        $this->success('登录成功', U('/Index/index'), 3);
                    } else {
                        $this->error('系统出错了', U('/User/login'));
                    }
                } else {
                    $this->error('密码不正确', U('/User/login'));
                }
            } else {
                $this->error('用户不存在', U('/User/login'));
            }
        } else {
            $this->error('非法访问', U('/User/login'));
        }
    }

    public function doLogout()
    {
        session(null);
        $this->error('退出成功', U('/User/login'), 3);
    }
}
