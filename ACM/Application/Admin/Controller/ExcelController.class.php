<?php
namespace Admin\Controller;

use Think\Controller;

class ExcelController extends Controller
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

    public function index()
    {
        $m = M('user');
        $gradeList = $m->distinct(true)->field('grade')->order('grade')->select();
        $this->assign('gradeList',$gradeList);
        $classList = $this->getClassList();
        $this->assign('classList', $classList);
        $this->display();
    }


    //导出某班级信息
    public function doExcelOneClass(){
        if(IS_GET){
            $id = I('get.id', '', 'htmlspecialchars');
            $classArr = $this->getOneClassInfo($id);
            import("Org.Util.PHPExcel");
            import("Org.Util.PHPExcel.Writer.Excel5");
            import("Org.Util.PHPExcel.IOFactory.php");
            import("Org.Util.PHPExcel.Style.php");
            $filename = "excel";
            $headArr = array("学生姓名","所属学院","所属班级","年级","学号","性别","联系电话","邮箱地址");
            $data = $this->getClassStu($id);
            $title = $classArr['clazzname'].$classArr['level'];
            $this->getExcel($filename, $headArr, $data, $title);
        } else {
            $this->error('非法访问');
        }
    }

    //导出所有学生信息
    public function doExcelAllStu()
    {
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");
        import("Org.Util.PHPExcel.Style.php");
        $filename = "excel";
        $headArr = array("学生姓名","所属学院","所属班级","年级","学号","性别","联系电话","邮箱地址");
        $data = $this->getAllStuInfo();
        $title = "学生信息表";
        $this->getExcel($filename, $headArr, $data, $title);
    }

    //导出所有学生信息
    public function doExcelGradeStu()
    {
        if(IS_GET){
            $grade = I('get.grade', '', 'htmlspecialchars');
            import("Org.Util.PHPExcel");
            import("Org.Util.PHPExcel.Writer.Excel5");
            import("Org.Util.PHPExcel.IOFactory.php");
            import("Org.Util.PHPExcel.Style.php");
            $filename = "excel";
            $headArr = array("学生姓名","所属学院","所属班级","年级","学号","性别","联系电话","邮箱地址");
            $data = $this->getGradeStuInfo($grade);
            $title = $grade.'级学生';
            $this->getExcel($filename, $headArr, $data, $title);
        } else {
            $this->error('非法访问');
        }
    }

    //下载文件
    private function getExcel($fileName, $headArr, $data, $title)
    {
        //对数据进行检验
        if (empty($data) || !is_array($data)) {
            $this->error("该班级没有学生",U('Excel/index'));
        }
        //检查文件名
        if (empty($fileName)) {
            exit;
        }

        $date = date("Y_m_d", time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置大标题
        $count = count($headArr);
        $end = chr(ord("A")+$count-1);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:'.$end.'1')->setCellValue('A1', $title);

        $titleStyle = array(
            'font' => array(
                'bold' => true,
                'size' => 18
            ),
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'fill' => array(
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => 'FF67BDFF'),
            ),
        );
        $borderStyle = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );

        $headStyle = array(
            'font' => array(
                'bold' => true,
            ),
            'fill' => array(
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => 'FFFFF68F'),
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FF000000'),
                ),
            ),
            'alignment' => array(
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($titleStyle);
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$end.'1')->applyFromArray($borderStyle);

        //设置表头
        $key = ord("A");
        foreach ($headArr as $v) {
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'2', $v);
            $objPHPExcel->getActiveSheet(0)->getColumnDimension($colum)->setWidth(20);
            $key += 1;
        }
        //设置边框
        $objPHPExcel->getActiveSheet()->getStyle('A2:'.$end.'2')->applyFromArray($headStyle);


        $column = 3;
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach ($data as $key => $rows) { //行写入
            $span = ord("A");
            foreach ($rows as $keyName=>$value) {// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A'.$column.':'.$end.$column)->applyFromArray($borderStyle);
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        // $objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }

    //获取学生信息
    public function getAllStuInfo()
    {
        //获取学生信息
        $m = M('user');
        $stulist = $m->where('is_locked = 0 and is_passed = 1')->getField('nickname,institude,class,grade,stu_id,sex,phonenumber,email');
        foreach ($stulist as &$item) {
            if ($item['sex'] == 1) {
                $item['sex'] = '男';
            } else {
                $item['sex'] = '女';
            }
        }
        return $stulist;
    }
    //获取年级学生
    public function getGradeStuInfo($grade)
    {
        //获取学生信息
        $m = M('user');
        $stulist = $m->where('grade='.$grade.' and is_locked = 0 and is_passed = 1')->getField('nickname,institude,class,grade,stu_id,sex,phonenumber,email');
        foreach ($stulist as &$item) {
            if ($item['sex'] == 1) {
                $item['sex'] = '男';
            } else {
                $item['sex'] = '女';
            }
        }
        return $stulist;
    }


    private function getClassStuInfo()
    {
        if (IS_GET) {
            $classID = I('get.id', '', 'htmlspecialchars');
            p($clazzID);
        } else {
            $this->error('非法访问');
        }
    }
    //获取所有学生信息
    private function getClassList()
    {
        $m = M('clazz');
        $list = $m->getField('id,clazzname,level');
        foreach ($list as &$item) {
            switch ($item['level']) {
                case 1:
                    $item['level'] = "(初级班)";
                    break;
                case 2:
                    $item['level'] = "(中级班)";
                    break;
                case 3:
                    $item['level'] = "(高级班)";
                    break;
                default:
                    $item['level'] = "(未评级)";
                    break;
            }
        }
        return $list;
    }

    //获取某个班级信息
    private function getOneClassInfo($id){
        $m = M('clazz');
        $list = $m->where('id='.$id)->getField('id,clazzname,level');
        foreach ($list as &$item) {
            switch ($item['level']) {
                case 1:
                    $item['level'] = "(初级班)";
                    break;
                case 2:
                    $item['level'] = "(中级班)";
                    break;
                case 3:
                    $item['level'] = "(高级班)";
                    break;
                default:
                    $item['level'] = "(未评级)";
                    break;
            }
        }
        return $list[$id];
    }
    //根据班级id获取班级内所有学生信息
    private function getClassStu($classID){
        $userClazzModel = M('user_clazz');
        $stuList = $userClazzModel->table('acm_user_clazz a, acm_user stu')->where('a.clazz_id='.$classID.' and stu.id = a.user_id and stu.is_locked = 0 and stu.is_passed = 1')->field('stu.nickname as nickname, stu.institude as institude, stu.class as class, stu.grade as grade, stu.stu_id as stu_id, stu.sex as sex, stu.phonenumber as phonenumber, stu.email as email')->select();
        return $stuList;
    }
}
