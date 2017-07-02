<?php
namespace Admin\Controller;

use Think\Controller;

class CheckController extends Controller
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

    //显示学生注册信息审核界面
    public function CheckStuSign()
    {
        $m = M('user');
        $map['is_passed'] = 0;
        $count = $m->where('is_passed=0')->count();
        $Page = new \Think\Page($count, 8); // 实例化分页类 传入总记录数和每页显示的记录数(4)
        $Page -> setConfig('prev', '上一页');
        $Page -> setConfig('next', '下一页');
        $Page -> setConfig('theme', '<li>%HEADER%</li> <li>%FIRST%</li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li> <li>%DOWN_PAGE%</li> <li>%END%</li>');
        $show = $Page->show();              // 分页显示输出
        $stu = $m->where($map)->limit($Page->firstRow.','.$Page->listRows)->getField('id,nickname,institude,grade');
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->assign('stu', $stu);
        $this->assign('page', $show);// 赋值分页输出
        $this->display();
    }

    //显示学生申请加入兴趣班界面
    public function CheckStuSelect()
    {
        //获取申请信息
        $checkModel = M('check_clazz');
        $checkResult = $checkModel->select();
        $list = $checkModel->table('acm_check_clazz a, acm_user user, acm_clazz clazz')->where('a.id_clazz = clazz.id and a.id_stu = user.id')->field('a.id as id, user.id as userid, user.nickname as nickname, clazz.id as clazzid, clazz.clazzname as clazzname, a.checktime as checktime')->select();
        $this->assign('list',$list);
        $this->assign('empty', '<p class="bg-success" style="padding:15px;">暂时没有新的数据</p>');
        $this->display();
    }

    //显示学生个人详情
    public function ShowStuInfo()
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

    //通过学生个人审核
    public function passStuSign()
    {
        if (IS_GET) {
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $map['id'] = $id;
            $data['is_passed'] = 1;
            if (!empty($id)) {
                $res = $m->where($map)->save($data);
                if ($res) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn("服务器出错了，请重新尝试");
                }
            } else {
                $this->ajaxReturn("请求参数有误");   //
            }
        } else {
            $this->ajaxReturn("非法请求");   //非法请求
        }
    }

    //删除学生注册申请
    public function delStuSign()
    {
        if (IS_GET) {
            $id = I('get.id', '', 'htmlspecialchars');
            $m = M('user');
            $map['id'] = $id;
            if (!empty($id)) {
                $res = $m->where($map)->delete();
                if ($res) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn("服务器出错了，请重新尝试");
                }
            } else {
            }
        } else {
            $this->ajaxReturn("非法请求");   //非法请求
        }
    }

    //通过学生加入兴趣班申请
    public function passStuCheck(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            $checkModel = M('check_clazz');
            $checkInfo = $checkModel->where('id='.$id)->select();
            $data['user_id'] = $checkInfo[0]['id_stu'];
            $data['clazz_id'] = $checkInfo[0]['id_clazz'];
            $data['check_time'] = date('Y-m-d H:i:s', time());
            $passModel = M('user_clazz');
            $res = $passModel->data($data)->add();
            if($res){
                //如果删除成功，需要删除check里面的数据
                $res2 =  $checkModel->where('id='.$id)->delete();
                if($res2){
                    $this->ajaxReturn(1);
                } else{
                    $this->ajaxReturn('出错了，请重新尝试');
                }
            } else{
                $this->ajaxReturn('出错了，请重新尝试');
            }
        } else{
            $this->ajaxReturn('非法访问');
        }
    }
    //删除学生加入兴趣班申请
    public function delStuCheck(){
        if(IS_POST){
            $id = I('post.id', '', 'htmlspecialchars');
            $checkModel = M('check_clazz');
            $res =  $checkModel->where('id='.$id)->delete();
            if($res){
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn('出错了，请重新尝试');
            }
        } else{
            $this->ajaxReturn('非法访问');
        }
    }
}
