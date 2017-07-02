<?php
namespace Admin\Widget;
use Think\Controller;
class StuCheckNumWidget extends Controller {
    //获取未通过审核的人数
    function checkStuNum()
    {
        $m = M('user');
        $map['is_passed'] = 0;
        $num = $m->where($map)->count();
        if($num != 0)
            $this->show($num);
    }
    //获取申请加入兴趣班人数
    function checkSelectNum()
    {
        $m = M('check_clazz');
        $select_num = $m->count();
        if($select_num != 0)
            $this->show($select_num);
    }
}
?>
