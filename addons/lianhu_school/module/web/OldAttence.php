<?php 
    require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'class_manage';
    $left_nav     = 'attence';
    $title        = '考勤管理';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'班级管理'),
            array('fun_str'=>'attence','fun_name'=>'考勤管理'),
    );
    $top_action = array(
            array('action_name'=>'当日数据','action'=>'attence' ),
            array('action_name'=>'历史数据','action'=>'oldAttence' ),
    );
    $page_name    = '历史数据';

    $admin       = $this->teacher_qx('no');
    $class_list  = $this->teacher_main();
	if($admin == 'teacher'){
		foreach ($class_list as $key => $value) {
			$teacher_class_arr[$key] = $value['class_id'];
		}
	}
    $grades          = $this->grade_class();
    $school_uniacid  = $this->where_uniacid_school;
    $class_card      = D('card');
	$class_grade 	 = D('grade');
	$class_grade->school_id = getSchoolId();
	$grade_list  		    = $class_grade->getSchoolList();
    #验证是否是管理员en shi
    $where[]         = $school_uniacid;
    if($_GPC['begin_time']){
        $params[":add_time"] = strtotime($_GPC['begin_time']);
        $where[]             = " add_time >= :add_time ";
    }else{
        $_GPC['begin_time'] = date("Y-m-d H:i:s",time()-3600*7*24);
    }
    if($_GPC['end_time']){
         $params[":add_time_end"] = strtotime($_GPC['end_time']);
         $where[]                 = " add_time <= :add_time_end ";       
    }else{
        $_GPC['end_time'] = date("Y-m-d H:i:s",time());
    }
    if($_GPC['grade_id']){
          $params[":grade_id"] = $_GPC['grade_id'];
          $where[]             = " grade_id = :grade_id ";          
    }
    if($_GPC['class_id']){
          $params[":class_id"] = $_GPC['class_id'];
          $where[]             = " class_id = :class_id ";          
    }

    $page       = $_GPC['page']?$_GPC['page']:1;
    $where[]    = "teacher_id = 0";
    $where_str  = implode(" and ",$where);
    
    if($_GPC['csv']){
        $result      = $class_card->getAllCardList($where_str,$params,$page,true);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("家校通")->setLastModifiedBy("家校通")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '学生')->setCellValue('B1', '班级')->setCellValue("C1",'年级')->setCellValue("D1",'时间')->setCellValue("E1",'进出');
        $i=2;
        foreach ($result['list'] as $kv=> $v) {
            $student_name = $this->studentName($v['student_id']);
            $class_name   = $this->className($v['class_id']);
            $grade_name   = $this->gradeName($v['grade_id']);
            $add_time     = date("Y-m-d H:i:s",$v['add_time']);
            if($v['up_low']==1){
                $text ='进校';
            }elseif($v['up_low']==2){
                $text='出校';
            }else{
                $text = '异常';
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $student_name)->setCellValue('B' . $i, $class_name)
                ->setCellValue('C' . $i, $grade_name)->setCellValue('D' . $i, $add_time)->setCellValue('E' . $i, $text);
                $i++;
       }
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->setTitle('打卡记录');		
        $objPHPExcel->setActiveSheetIndex(0);
        $base_name = "card_list".time().'.xlsx';
        $file_name = MODULE_ROOT.'/file/'.$base_name;
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file_name);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$base_name.'"');
        header('Cache-Control: max-age=0');
        readfile($file_name);
        exit();       
    }else{
        $result     = $class_card->getAllCardList($where_str,$params,$page);
    }
    $list  = $result['list'];
    $count = $result['count'];
 	$pager = pagination($result['count'],$page,20);
	include $this->template('../admin/web_old_attence');
	exit();   