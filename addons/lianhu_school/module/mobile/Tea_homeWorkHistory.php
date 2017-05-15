<?php 

    $teacher_info  = $this->teacher_mobile_qx();
    $student_name  = $teacher_info['teacher_realname'];
    $page_title    = '作业记录';
    //开始正文，我发布的作业记录
     $class_sendRecord       = D('sendRecord');
     $class_look             = D('look');
     $pager                  = $_GPC['pager'];
     $where                  = "(record_type=5 || record_type= 7)";
     $params[":teacher_id"]  = $teacher_info['teacher_id'];
     $result                 = $class_sendRecord->dataList($params,$pager,$where);
     $list                   = $result['list'];

     if($list){
         foreach ($list as $key => $value) {
            $homework           = C("homework")->findHomeWork($value);
            $list[$key]['hid']  = $homework['homework_id'];
         }
     }
     if($ac=='ajax'){
         if($list){
            $template = $this->selectTemplate("Tea_homeWorkHistory_ajax");
            include $this->template($template);
         }else{
             echo 'done';
         }
         exit();
     }