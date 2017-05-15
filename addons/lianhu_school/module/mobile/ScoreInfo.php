<?php 
	$student_info = $this->mobile_from_find_student();
    $student_name = $student_info['student_name'];
	$page_title   = '成绩详情';
	$course_id 	  = $_GPC['course_id'];
	$course_name  = D('course')->courseName($course_id);
	$class_scoreJilv 	 = C('scoreJilv');
	$class_scoreList 	 = C('scoreList');

	$class_scoreJilv->use_class->each_page = 5;
	$params[":grade_id"] = $student_info['grade_id']; 
	$re = $class_scoreJilv->use_class->getList($params);
	if($re['count']){
		$list = $re['list'];
		$num  = count($list); 
		foreach ($list as $key => $value) {
			$out_list[$num-$key-1] = $value;
		}
		ksort($out_list) ;
		$list = $out_list;
		$where["student_id"]   = $student_info["student_id"];
		$where["course_id"]    = $course_id;
		foreach ($list as $key => $value) {
			$where["ji_lv_id"] = $value["scorejilv_id"];
			$score_list[$key]  =  $class_scoreList->use_class->edit($where);
			if(!$score_list[$key]){
				$score_list[$key]['score'] = 0;
			}
		}
	}
