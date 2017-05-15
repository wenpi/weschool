<?php

    $class_classes  = D('classes');
    $teacher_info   = $this->teacher_mobile_qx();
    $page_title     = '我的课程';
    $student_name   = $teacher_info['teacher_realname'];
    $class_week     = C('week');
    $re                         = $class_week->inSchoolWeeks($this->school_info['on_school'],$this->school_info['begin_day'] );
    $have_week                  = $re['have_week'];
    $out_weeks                  = $re['weeks'];
    $now_week                   = $re['now_week'];
    foreach ($re['weeks'] as $key => $value) {
        $list[$key]['new'] = $class_week->date_num[$value];
        $list[$key]['old'] = $value;
    }
    $now_week = $class_week->date_num[$now_week];

    $time_result 				= pdo_fetch("select * from ".tablename('lianhu_set')." where keyword='course_time' and school_id=".$this->school_info['school_id']."  order by set_id  desc ");
	$time_result['content'] 	= unserialize($time_result['content']);
	$time_result['begin_time'] 	= $time_result['content']['begin_time'];
	$time_result['end_time'] 	= $time_result['content']['end_time'];
    $week_today    = $_GPC['week'] ? $_GPC['week']:$this->decodeTodayWeek();
    $teacher_class = D("newSyllabus")->getTeacherSyllabus($teacher_info['teacher_id'],$week_today);
    $teacher_class = sortArr($teacher_class,'day_sort','min');
    //不相同class_id分组
    foreach ($teacher_class as $key => $value) {
        $class_courses[$value['class_id']][] = $value;
    }
