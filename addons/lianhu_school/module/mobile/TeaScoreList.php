<?php

    $student_info  = $this->teacher_mobile_qx();
    $student_name  = $student_info['teacher_realname'];
    $page_title    = '我的积分记录';
    
    if($ac=='list'){
        $begin_time = strtotime(date("Y-01-01",time()));
        $end_time   = time();
    }elseif($ac=='day'){
        $begin_time = strtotime(date("Y-m-d",time()));
        $end_time   = time();
    }elseif($ac=='month'){
        $begin_time = strtotime(date("Y-m-01",time()));
        $end_time   = time();
    }
    $teacher_id = $student_info['teacher_id'];
    C("teacherScore")->setScoreBase($this->school_info['school_id']);
    $result = C("teacherScore")->getScore($teacher_id,$begin_time,$end_time);
    //作业积分明细
    $homework_list = C("teacherScore")->homeworkList($teacher_id,$begin_time,$end_time);
    //班级圈积分明细
    $line_list     = C("teacherScore")->lineList($teacher_id,$begin_time,$end_time);
    //文章积分明细
    $article_list  = C("teacherScore")->articleList($teacher_id,$begin_time,$end_time);
    //登录积分明细
    $login_list    = C("teacherScore")->loginList($teacher_id,$begin_time,$end_time);
