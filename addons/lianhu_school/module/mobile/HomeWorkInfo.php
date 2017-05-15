<?php 
    //教师端查看：作业详情
    $teacher_info = $this->teacher_mobile_qx(); 
    $page_title   = '作业详细内容';
    $id           = $_GPC['id'];    
    $where["homework_id"] = $id;
    $result               = D("homework")->edit($where);
    if(!$result){
        $this->myMessage("未选择有效的家庭作业",$this->createMobileUrl("tea_homeWork"),"错误");
    }
    $result['course_name'] = $this->courseName($result['course_id']);
    $his_info_list         = D("homeworkAnswer")->answerList($result['id']);
    
    