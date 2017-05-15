<?php 
        require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'line_edu';
		$left_nav     = 'edu_video_list';
		$title        = '视频管理';  
		$sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'在线课堂'),
            array('fun_str'=>'edu_video_list','fun_name'=>'视频管理'),
		);
        $top_action = array(
            array('action_name'=>'回到列表','action'=>'edu_video_list' ),
        );
        $class_eduList       = D('eduVideoList');
        $class_viewsLog      = D('viewsLog');
        $class_ctl_viewsLog  = C('viewsLog');
        $class_ctl_viewsLog->beginClass();
        $id              = $_GPC['id'];
        $result          = $class_eduList->dataEdit($id);
        $title          .= "【".$result['list_name']."】查看记录";
        if($_GPC['begin_time']){
            $add_time            = strtotime($_GPC['begin_time']);
            $where[]             = " add_time >=  ".$add_time;
        }else{
            $_GPC['begin_time'] = date("Y-m-d H:i:s",time()-3600*7*24);
        }
        if($_GPC['end_time']){
            $add_time_end            = strtotime($_GPC['end_time']);
            $where[]                 = " add_time <=  ".$add_time_end;       
        }else{
            $_GPC['end_time'] = date("Y-m-d H:i:s",time());
        }
        if($where){
            $where_str  = implode(" and ",$where);
        }else{
            $where_str  = false;
        }
        //
        $params[":content_type"] = 'video_look';
        $params[":content_id"]   = $id;
        $result                  = $class_viewsLog->dataList($params,$where_str);
        $list                    = $result['list'];
        foreach($list as $key=> $val){
            $val['add_time'] = date("Y-m-d H:i:s",$val['add_time']);
            $list[$key]      = $class_ctl_viewsLog->decodeOutInfo($val);
        }
        if($_GPC['csv']){
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getProperties()->setCreator("家校通")->setLastModifiedBy("家校通")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '年级')->setCellValue('B1', '班级')->setCellValue("C1",'学生')->setCellValue("D1",'时间');
            $i=2;
            foreach ($list as $kv=> $v) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $v['grade_name'])->setCellValue('B' . $i, $v['class_name'])
                    ->setCellValue('C' . $i, $v['student_name'])->setCellValue('D' . $i, $v['add_time']);
                    $i++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
            $objPHPExcel->getActiveSheet()->setTitle("查看记录");		
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
        }
        include $this->template('../admin/views_log');
		exit();
