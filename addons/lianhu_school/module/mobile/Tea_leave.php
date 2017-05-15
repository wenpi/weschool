<?php 
  $teacher_info = $this->teacher_mobile_qx();
  $token        = $this->class_base->tokenForm();
  $student_name = $teacher_info['teacher_realname'];
  $cclass_leave = C('leave');
  if($ac =='list'){
      $list = $cclass_leave->use_class->getTeacherNotDoList($teacher_info['teacher_id']);
  }
  if($ac == 'edit'){
      $where["leave_id"] = $_GPC['id'];
      $result       = pdo_fetch("select * from {$table_pe}lianhu_leave where leave_id=:id ",$where);
      if($_GPC['teacher_text'] ){
          $up['teacher_text'] = $_GPC['teacher_text'];
          if($_GPC['submit'] == '准许'){
                $up['leave_status'] =2;
          } else{
                $up['leave_status'] =3;
          }
          $up['reply_time'] =time();
      }
      $result = $cclass_leave->use_class->edit($where,$up);
      if($up){
            $cclass_leave->leave_id      = $_GPC['id'];
            $cclass_leave->in_class_base = $this->class_base; 
            $cclass_leave->sendLeaveMsg();
            $this->myMessage("处理成功",$this->createMobileUrl('teain'),'成功');
      }
      
  }
