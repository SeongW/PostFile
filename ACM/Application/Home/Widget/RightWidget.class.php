<?php
namespace Home\Widget;
use Think\Controller;
class RightWidget extends Controller {
    public function News(){
        $news = M('inform');
        $res = $news->limit(1)->select();
        $this->assign('inform',$res[0]);
        $this->display("Right:news");
    }
    public function Personal(){
        $m = M('user');
        $id = session('stuid');
        $map['id'] = $id;
        $res = $m->where($map)->getField('id,nickname,class,stu_img');
        $this->assign('userinfo',$res[$id]);
        $this->display("Right:Personal");
    }
}
?>
