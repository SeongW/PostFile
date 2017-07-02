<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload;
use Vendor\ThinkImage\ThinkImage;

class IndexController extends Controller
{
    //初始化检测是否登陆
    public function checklogin()
    {
        if (session('stuid') == '') {
            $this->error('未登录！', U('/User/login'));
        } else {
            $this->assign('name', $_SESSION['name']);
        }
    }



    //登陆时的主界面
    public function index()
    {
        $this->checklogin();
        $id = session('stuid');
        $m = M('user');
        $info = $m->where('id='.$id)->select();
        $this->assign('myname', $info[0]['nickname']);
        $this->display();
    }

    //显示个人信息
    public function Person()
    {
        $this->checklogin();
        $m = M('user');
        $id = session('stuid');
        $map['id'] = $id;
        $res = $m->where($map)->getField('id,nickname,sex,phonenumber,email,stu_id,class,institude,username,stu_img');
        $this->assign('userinfo', $res[$id]);
        $this->display();
    }

    //修改过密码的页面
    public function ModPwd()
    {
        $this->checklogin();
        $this->display();
    }
    //修改密码的动作
    public function doModPwd()
    {
        $this->checklogin();
        if (IS_POST) {
            $pwdold = I('post.passwordOld', '', 'htmlspecialchars');
            $pwdnew1 = I('post.passwordNew1', '', 'htmlspecialchars');
            $pwdnew2 = I('post.passwordNew2', '', 'htmlspecialchars');
            $m = M('user');
            $id = session('stuid');
            $map['id'] = $id;
            $res = $m->where($map)->getField('id,password');
            if (md5($res[$id]) == md5($pwdold)) {
                if ($pwdnew1 == $pwdnew2) {
                    if (strlen($pwdnew1) < 6) {         //密码长度不少于6位
                        $this->ajaxReturn(5);
                    }
                    $md5pwd = md5($pwdnew1);
                    $data['password'] = $pwdnew1;
                    $data['md5pwd'] = md5($pwdnew1);
                    $res = $m->where($map)->save($data);
                    if ($res) {
                        $this->ajaxReturn(1);           //密码已成功更改
                    } else {
                        $this->ajaxReturn(4);           //服务器出错了，请重新尝试
                    }
                } else {
                    $this->ajaxReturn(3);           //两次输入的新密码不一致
                }
            } else {
                $this->ajaxReturn(2);           //旧密码不正确，请重新输入
            }
        } else {
            $this->error("非法访问，请登陆", U('Index/Index'));
        }
    }

    public function doModPersonalInfo()
    {
        $this->checklogin();
        if (IS_POST) {
            $nickname = I('post.nickname', '', 'htmlspecialchars');
            $sex = I('post.sex', '', 'htmlspecialchars');
            $phonenumber = I('post.phonenumber', '', 'htmlspecialchars');
            $email = I('post.email', '', 'htmlspecialchars');
            $m = M('user');

            if (!empty($nickname)&&!empty($sex)&&!empty($phonenumber)&&!empty($email)) {
                $map['id'] = session('stuid');
                $data['nickname'] = $nickname;
                $data['sex'] = $sex;
                $data['phonenumber'] = $phonenumber;
                $data['email'] = $email;
                $res = $m->where($map)->save($data);
                if ($res) {
                    $this->ajaxReturn(1); //成功
                } else {
                    $this->ajaxReturn(2); //数据库出错了
                }
            } else {
                $this->ajaxReturn(3); //输入数据有误，请正确输入
            }
        } else {
            $this->ajaxReturn(0); //非法访问
        }
    }

    //修改在校信息动作
    public function doModSchoolInfo()
    {
        $this->checklogin();
        if (IS_POST) {
            $institude = I('post.institude', '', 'htmlspecialchars');
            $class = I('post.class', '', 'htmlspecialchars');
            $stu_id = I('post.stu_id', '', 'htmlspecialchars');
            $m = M('user');
            if (!empty($institude)&&!empty($class)&&!empty($stu_id)) {
                $map['id'] = session('stuid');
                $data['institude'] = $institude;
                $data['stu_id'] = $stu_id;
                $data['class'] = $class;
                $res = $m->where($map)->save($data);
                if ($res) {
                    $this->ajaxReturn(1); //成功
                } else {
                    $this->ajaxReturn(2); //数据库出错了
                }
            } else {
                $this->ajaxReturn(3); //输入数据有误，请正确输入
            }
        } else {
            $this->ajaxReturn(0); //非法访问
        }
    }

    //显示修改头像页面
    public function headimg()
    {
        $this->checklogin();
        $this->display();
    }

    //上传头像
    public function uploadImg()
    {
        $upload = new Upload(C('UPLOAD_CONFIG'));    // 实例化上传类
        //头像目录地址
        $path = './Avatar/';
        if (!$upload->upload()) {                        // 上传错误提示错误信息
        $this->ajaxReturn(array('status'=>0,'info'=> $upload->getError() ));
        } else {                                            // 上传成功 获取上传文件信息
        $temp_size = getimagesize($path.'temp.jpg');
            if (!$temp_size) {
                $this->ajaxReturn(array('status'=>0,'info'=>'无图'));
            }
            if ($temp_size[0] < 100 || $temp_size[1] < 100) {//判断宽和高是否符合头像要求
            $this->ajaxReturn(array('status'=>0,'info'=>'图片宽或高不得小于100px！'));
            }
            $this->ajaxReturn(array('status'=>1,'path'=>__ROOT__.'/Avatar/'.'temp.jpg'));
        }
    }

    //裁剪并保存用户头像
    public function cropImg()
    {
        //图片裁剪数据
        $params = I('post.');                        //裁剪参数
        if (!isset($params) && empty($params)) {
            $this->ajaxReturn('参数错误！');
        }
        //头像目录地址
        $path = './Avatar/';
        //要保存的图片
        $real_path = $path.'avatar.jpg'; //裁剪后的图片
        //临时图片地址
        $pic_path = $path.'temp.jpg';     //原始图片
        //实例化裁剪类
        $Think_img = new ThinkImage(THINKIMAGE_GD);
        //裁剪原图得到选中区域
        $Think_img->open($pic_path)->crop($params['w'], $params['h'], $params['x'], $params['y'])->save($real_path);
        //生成md5文件名
        $id = session('stuid');
        $name = session('name');
        $rand = mt_rand(10000000, 99999999);
        $imgUrl = md5($id.$name.$rand);
        //生成缩略图
        $Think_img->open($real_path)->thumb(150, 150, 1)->save($path.$imgUrl.'.jpg');
        //存入路径
        $m = M('user');
        $data['stu_img'] = $imgUrl.'.jpg';
        $res = $m->where('id='.$id)->data($data)->save();
        if ($res) {
            $this->ajaxReturn('上传头像成功');
        } else {
            $this->ajaxReturn('操作失败，请重新上传');
        }
    }
}
