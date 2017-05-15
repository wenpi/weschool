<?php 
	$result 	  = $this->mobile_from_find_student();
	$week 		  = $_GPC['week'];
	$page_title	  = '课程表';
	$school_id    = getSchoolId();
	$cclass_week  = C('week');
	$student_name = $result['student_name'];
	$school_info  = $this->school_info;
	$am_much      = $school_info['am_much'];
	$pm_much      = $school_info['pm_much'];
	$ye_much      = $school_info['ye_much'];

	for ($i=0; $i <30 ; $i++) { 
			$loop[$i]=1;
	}
	$syllabus_list  = D("newSyllabus")->getClassSyllabus($now_class_id);
	$now_class_id   = getClassId();
	$class_name     = D('classes')->className($now_class_id);
	if($syllabus_list['url']){
		header("Location:".$syllabus_list['url']);
	}
	$time_result 				= pdo_fetch("select * from {$table_pe}lianhu_set where keyword='course_time' and school_id=".$school_id."  order by set_id  desc ");
	$time_result['content'] 	= unserialize($time_result['content']);
	$time_result['begin_time'] 	= $time_result['content']['begin_time'];
	$time_result['end_time'] 	= $time_result['content']['end_time'];
	$begin_course 				= $school_info['begin_day'];

	$re 	   = C("week")->inSchoolWeeks($school_info['on_school'],$begin_course);
	$have_week = $re['have_week'];
	$out_weeks = $re['weeks'];

	if(!$have_week){
		$now_week = $out_weeks[0];
	}else{
		$now_week = $re['now_week'];
	}
	foreach ($out_weeks as $key => $value) {
		if($value == $now_week){
			$g = $key+1;
		}
	}
	$syllabus_list  = D("newSyllabus")->getClassSyllabus($now_class_id,$g);
	foreach ($loop as $key => $value) {
		$do = $key+1;
		if($key<$am_much){
			$info = D("newSyllabus")->getClassSyllabusInfo($now_class_id,$g,$do);
			$ams[$do]['sort']    = $do;
			$ams[$do]['times']   = $time_result['begin_time'][$do].'-'.$time_result['end_time'][$do];
			if($info['course_special']!=0){
				$ams[$do]['course']  = $info['course_special'] == 1 ? "自习":"休息";
			}else{
				$ams[$do]['course']  = $this->courseName( $info['course_id']);
				$ams[$do]['teacher'] = $this->teacherName($info['teacher_id']);			
			}
		}
		if($key<$pm_much){
			$hj   = $do+$am_much;
			$info = D("newSyllabus")->getClassSyllabusInfo($now_class_id,$g,$hj);
			$pms[$do]['sort']    = $hj;
			$pms[$do]['times']   = $time_result['begin_time'][$hj].'-'.$time_result['end_time'][$hj];
			if($info['course_special']!=0){
				$pms[$do]['course']  = $info['course_special'] == 1 ? "自习":"休息";
			}else{
				$pms[$do]['course']  = $this->courseName( $info['course_id']);
				$pms[$do]['teacher'] = $this->teacherName($info['teacher_id']);			
			}	
		}
		if($key<$ye_much){
			$ye   = $do+$am_much+$pm_much;
			$info = D("newSyllabus")->getClassSyllabusInfo($now_class_id,$g,$ye);
			$yms[$do]['sort']    = $ye;
			$yms[$do]['times']   = $time_result['begin_time'][$ye].'-'.$time_result['end_time'][$ye];
			if($info['course_special']!=0){
				$yms[$do]['course']  = $info['course_special'] == 1 ? "自习":"休息";
			}else{
				$yms[$do]['course']  = $this->courseName( $info['course_id']);
				$yms[$do]['teacher'] = $this->teacherName($info['teacher_id']);			
			}					
		}

	}

        
        