<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title   = $page_title = '编辑管理记录';
    $work_id = $_GPC['id'];
    $class_list = D('record')->getRecordClass();
    if($work_id){
        $result     = D('work')->edit($work_id);
        $student_id = $result['student_id'];
        if($_GPC['submit']){
            if($_GPC['action_do']==10){
                D('work')->delete($work_id);
                $this->myMessage('删除成功',$this->createMobileUrl('SchoolAdminStudentRecordInfo',array("id"=>$student_id)),'成功');           
            }
        }
    }
