<?php
	$student_info 	  = $this->mobile_from_find_student();
	$student_name 	  = $student_info['student_name'];
	$cclass_scoreJilv = C('scoreJilv');
	$cclass_scoreList = C('scoreList');

	if($ac=='list'){
		$cclass_scoreJilv->grade_id = $student_info['grade_id'];
		$re   =  $cclass_scoreJilv->getGradeAll();
		$list = $re['list'];
	}
	if($ac=='listall'){
		$page_title = '考试详情';
		$cclass_scoreJilv->scorejilv_id = $op;
		$scorejilv_info = $cclass_scoreJilv->getJilvInfo(array('scorejilv_name'));
		$scorejilv_name = $scorejilv_info['scorejilv_name'];
		$cclass_scoreList->ji_lv_id 	= $op;
		$cclass_scoreList->student_id   = $student_info['student_id'];
		$all_score 						= $cclass_scoreList->getAllScore();
		$average_score 					= $cclass_scoreList->getAverageScore();

		$score_list 					= pdo_fetchall("select score.*,course.course_name from {$table_pe}lianhu_scorelist score left join {$table_pe}lianhu_course course 
									      on course.course_id=score.course_id  where score.ji_lv_id=:id and score.student_id=:sid order by score.addtime desc ",array(':id'=>$op,':sid'=>$student_info['student_id']));
	}
