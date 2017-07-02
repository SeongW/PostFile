<?php

namespace Admin\Controller;

use Think\Controller;

class AccountController extends Controller
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

    //显示所有已通过审核的账号,而且账号未被锁定
    public function index(){
        $m = M('user');
        $map['is_passed'] = 1;
        $map['is_locked'] = 0;
        if (IS_GET) {
            $serchinfo = I('get.searchinfo', '', 'htmlspecialchars');
            $map['nickname'] = array('LIKE','%'.$serchinfo.'%');
        }
        $count = $m->where($map)->count();
        $Page = new \Think\Page($count, 8); // 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page -> setConfig('prev', '上一页');
        $Page -> setConfig('next', '下一页');
        $Page -> setConfig('theme', '<li>%HEADER%</li> <li>%FIRST%</li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li> <li>%DOWN_PAGE%</li> <li>%END%</li>');
        $show = $Page->show();              // 分页显示输出
        $account = $m->where($map)->limit($Page->firstRow.','.$Page->listRows)->getField('id,username,nickname,level');
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->assign('list', $account);
        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }
    //显示锁定账号的页面
    public function locked(){
        $m = M('user');
        $map['is_passed'] = 1;
        $map['is_locked'] = 1;
        if (IS_GET) {
            $serchinfo = I('get.searchinfo', '', 'htmlspecialchars');
            $map['nickname'] = array('LIKE','%'.$serchinfo.'%');
        }
        $count = $m->where($map)->count();
        $Page = new \Think\Page($count, 8); // 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page -> setConfig('prev', '上一页');
        $Page -> setConfig('next', '下一页');
        $Page -> setConfig('theme', '<li>%HEADER%</li> <li>%FIRST%</li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li> <li>%DOWN_PAGE%</li> <li>%END%</li>');
        $show = $Page->show();              // 分页显示输出
        $account = $m->where($map)->limit($Page->firstRow.','.$Page->listRows)->getField('id,username,nickname,level');
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->assign('list', $account);
        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    //查看某个学生信息
    public function returnOnePersonInfo(){
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

    //查看某个账号信息
    public function returnOneAccountInfo(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $stu = $m->where('id='.$id)->getField('id,nickname,username,password');
            $this->ajaxReturn(json_encode($stu[$id]),'JSON');
        } else{
            $this->error('非法访问');
        }
    }

    //锁定某个账号
    public function lockOneAccount(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            $m = M('user');
            $data['is_locked'] = 1;
            $res = $m->where('id='.$id)->data($data)->save();
            if($res){
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn('出错了，请重新尝试');
            }
        } else{
            $this->error('非法访问');
        }
    }
    //解锁某个账号
    public function unlockOneAccount(){
        if(IS_PST){
            $id = I('post.id', '', 'htmlspecialchars');
            $m = M('user');
            $data['is_locked'] = 0;
            $res = $m->where('id='.$id)->data($data)->save();
            if($res){
                $this->ajaxReturn(1);
            } else{
                $this->ajaxReturn('出错了，请重新尝试');
            }
        } else{
            $this->error('非法访问');
        }
    }

    //删除某个账号
    public function deleteOneAccount(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            $m = M('user');
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
    //初始化密码
    public function initializePwd(){
        if (IS_POST) {
            $id = I('post.id', '', 'htmlspecialchars');
            $m = M('user');
            $data['password'] = '111111';
            $data['md5pwd'] = md5('111111');
            $res = $m->where('id='.$id)->data($data)->save();
            if($res)
                $this->ajaxReturn(1);
            else $this->ajaxReturn('出错了，请重新尝试');
        } else {
            $this->error('非法访问');
        }
    }

}
