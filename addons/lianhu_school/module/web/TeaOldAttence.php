<?php 
    require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'school_msg';
    $left_nav     = 'TeaAttence';
    $title        = '教师考勤';  
    $sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'班级管校务管理理'),
            array('fun_str'=>'TeaAttence','fun_name'=>'教师考勤'),
    );
    $top_action = array(
            array('action_name'=>'当日数据','action'=>'TeaAttence' ),
            array('action_name'=>'历史数据','action'=>'TeaOldAttence' ),
    );
    $page_name    = '历史数据';
    $class_card   = D("card");
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
    $page       = $_GPC['page']?$_GPC['page']:1;
    $where[]    = "teacher_id != 0";
    $where_str  = implode(" and ",$where);
    
    if($_GPC['csv']){
        $result      = $class_card->getAllCardList($where_str,$params,$page,true);
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("家校通")->setLastModifiedBy("家校通")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '姓名')->setCellValue("B1",'时间')->setCellValue("C1",'进出');
        $i=2;
        foreach ($result['list'] as $kv=> $v) {
            $teacher_name = D("teacher")->teacherName($v['teacher_id']);
            $add_time     = date("Y-m-d H:i:s",$v['add_time']);
            if($v['up_low']==1){
                $text ='进校';
            }elseif($v['up_low']==2){
                $text='出校';
            }else{
                $text = '异常';
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $teacher_name)->setCellValue('B' . $i, $add_time)->setCellValue('C' . $i, $text);
                $i++;
       }
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->setTitle('教师打卡记录');		
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
	include $this->template('../admin/TeaOldAttence');
	exit();   