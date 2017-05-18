<?php
	require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'scoreAdmin';
    $left_nav     = 'scoreStudent';
    $title        = '学生成绩';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'学校信息'),
        array('fun_str'=>'scoreStudent','fun_name'=>'学生成绩'),
    );
	$top_action = array(
		array('action_name'=>'成绩统计' ,'action'=>'scoreStudent'),
		array('action_name'=>'导入成绩' ,'action'=>'data_in','arr'=>array('ac'=>'score' ,'from'=>'scoreStudent') ),
	);
	$page_name = '成绩统计';
	if($ac=='new'){
		$page_name = '新增';
	}
    $we7_js = 'no';
    $grade  = D("grade")->getSchoolList();
    $gid    = $_GPC['gid'] ? $_GPC['gid'] : $grade[0]['grade_id'];
    $where_grade             = " grade_id={$gid}";
    C("scoreJilv")->grade_id = $gid;
    $score_jilv_list 		 = C("scoreJilv")->getGradeAll();
    $score_jilv_list 		 = $score_jilv_list['list'];

    if($_GPC['jilv_id']){
        $ji_lv_id = $_GPC['jilv_id'];
    }else{
        $ji_lv_id = $score_jilv_list[0]['scorejilv_id'];
    }
    if(!$ji_lv_id){
        include $this->template('../admin/ScoreStudent');
        exit();       
    }
    $where_jilv  = " and ji_lv_id=".$ji_lv_id;
    if($_GPC['class_id']){
        $where_class = " and class_id=".$_GPC['class_id'];
    }
    $list_jilv = pdo_fetchall("select  *  from {$table_pe}lianhu_scorelist where {$where_grade} {$where_class} {$where_jilv}  group by ji_lv_id order by addtime desc {$sql_limit} ");
    $g 		   = 0;
    foreach ($list_jilv as $key => $value) {
        $list_student[$value['ji_lv_id']] = pdo_fetchall("select  student_id  from {$table_pe}lianhu_scorelist where {$where_grade} {$where_class} and ji_lv_id={$value['ji_lv_id']} 
														  group by student_id order by addtime desc");
        foreach ($list_student[$value['ji_lv_id']] as $k => $v) {
            $list_student[$value['ji_lv_id']][$v['student_id']] = pdo_fetchall("select * from {$table_pe}lianhu_scorelist where 
																					student_id={$v['student_id']} and ji_lv_id={$value['ji_lv_id']} group by course_id order by addtime desc ");
            foreach ($list_student[$value['ji_lv_id']][$v['student_id']] as $kv => $va) {
                $list_student[$value['ji_lv_id']][$v['student_id']]['all_score'] += $va['score'];
                $course_ids[$va['course_id']] 									  = $va['score'];
                $course_id_student[$v['student_id']][$va['course_id']] 			  = $va['score'];
                $course_all[$va['course_id']] += $va['score'];
            }
            if($count_max < count($course_ids)){
                $max_course_arr = $course_ids;
            }
            $out_list[$g]['student_id'] = $v['student_id'];
            $out_list[$g]['course_ids'] = $course_id_student[$v['student_id']];	
            $out_list[$g]['class_id']   = $list_student[$value['ji_lv_id']][$v['student_id']][0]['class_id'];	
            $out_list[$g]['all_score']  = $list_student[$value['ji_lv_id']][$v['student_id']]['all_score'];
            $g++;
      }
    }
    $out_list = $this->sort_arr($out_list,'all_score');
    $total    = count($out_list);
    $kk       = 0;
    if($max_course_arr){
        foreach ($max_course_arr as $key => $value) {
            if($_GPC['course_id']){
                if($key==$_GPC['course_id']){
                    $out_course_arr[$kk]['course_name'] = D("course")->courseName($key);
                    $out_course_arr[$kk]['course_id']   = $key;						
                }
                $new_out_course_arr[$kk]['course_name'] = D("course")->courseName($key);
                $new_out_course_arr[$kk]['course_id']   = $key;					
            }else{
                $out_course_arr[$kk]['course_name'] = D("course")->courseName($key);
                $out_course_arr[$kk]['course_id']   = $key;
                $new_out_course_arr = $out_course_arr;
            }
            $kk++;
        }
    }
    if($out_list){
        foreach ($out_list as $key => $value) {
            $out_list[$key]['class_name']   = $this->class_name_by_id($value['class_id']);
            $out_list[$key]['student_name'] = D("student")->getStudentName($value['student_id']);
        }
    }
    if($_GPC['excel']){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("家校通")->setLastModifiedBy("家校通")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '学生')->setCellValue('B1', '班级');
        foreach ($out_course_arr as $key => $value) {
            $local = 67+$key;
            $local = chr($local);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local."1",$value['course_name']);
        }
        $local     = 67+$key+1;
        $nlocal    = 67+$key+2;
        $local     = chr($local);
        $nlocal    = chr($nlocal);		    
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.'1', '总分')->setCellValue($nlocal.'1', '排名');
        $i = 2;
        foreach ($out_list as $kv=> $v) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $v['student_name'])->setCellValue('B' . $i, $v['class_name']);
            foreach ($out_course_arr as $key => $value) {
                $local = 67+$key;
                $local = chr($local);
                if(!$v['course_ids'][$value['course_id']] ){
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.$i,0);
                }else{
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.$i,$v['course_ids'][$value['course_id']]);
                }
            }
            $local  = 67+$key+1;
            $nlocal = 67+$key+2;
            $local  = chr($local);
            $nlocal = chr($nlocal);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.$i, $v['all_score'])->setCellValue($nlocal.$i, $kv+1);
            $i++;
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, "各科总分")->setCellValue('B' . $i, "");
        foreach ($out_course_arr as $key => $value) {
            $local = 67+$key;
            $local = chr($local);
            if(!$v['course_ids'][$value['course_id']] ){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.$i,0);
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.$i,$course_all[$value['course_id']] );
            }
        }
        $local  = 67+$key+1;
        $nlocal = 67+$key+2;
        $local  = chr($local);
        $nlocal = chr($nlocal);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($local.$i, '')->setCellValue($nlocal.$i,'');
        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
        $objPHPExcel->getActiveSheet()->setTitle('成绩报告');		
        $objPHPExcel->setActiveSheetIndex(0);
        $base_name = "/成绩报告_".time().'.xlsx';
        $file_name = MODULE_ROOT.'/file/'.$base_name;
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($file_name);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=" '.$base_name.'" ');
        header('Cache-Control: max-age=0');
        readfile($file_name);
        exit;		
    }    
    include $this->template('../admin/ScoreStudent');
	exit();