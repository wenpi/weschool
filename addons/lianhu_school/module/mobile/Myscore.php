<?php 
    $student_info   = $this->mobile_from_find_student();
    $page_title     = '考试成绩';
    $student_name   = $student_info['student_name'];
    $cclass_scoreJilv = C('scoreJilv');
    $cclass_scoreJilv->grade_id = $student_info['grade_id'];
    $grade_info     = D('grade')->getGradeInfo($student_info['grade_id']);
    $re             = $cclass_scoreJilv->getGradeAll();
    $list           = $re['list'];
    $out_list       = $cclass_scoreJilv->partScoreJilv($list);
    
