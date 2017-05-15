<?php
	$this->registerClassBase();
    $uid    = getMemberUid();
    $result = $this->studentMobileQx();
    $config = $this->module['config'];
    if($result){
		exit();
        // $this->myMessage("您已经绑定了",'','提示');
    }
    if($_GPC['submit']){
			$find[':student_passport'] = $_GPC['student_passport'];
			$find[':student_name']     = $_GPC['student_name'];
			$find[':uniacid']  		   = $_W['uniacid'];
            if($config['family_set'] == 'alone_school'){
			     $student=pdo_fetch("select * from ".$this->table_pe."lianhu_student where  xuehao=:student_passport and student_name=:student_name and uniacid=:uniacid ",$find);
            }else{
			     $student=pdo_fetch("select * from ".$this->table_pe."lianhu_student where  student_passport=:student_passport and student_name=:student_name and uniacid=:uniacid ",$find);
			}
            if($student){
                $class_student  = D('student');
				if($student['student_uid']){
					$this->myMessage('您已经绑定过此位学生了',$this->createMobileUrl('studentBd'),'错误');
				}
				D('student')->school_id = $student['school_id'];
				D('student')->edit(array('student_id'=>$student['student_id']),array('student_uid'=>$uid));
                $this->myMessage('绑定学生成功！','http://edu.vdiy.cn/agreen-h5/html/student/index.html','成功');
			}else{
				$this->myMessage('您提交的信息有误，无法绑定学生账号',$this->createMobileUrl('studentBd'),'错误');
			}
			exit(1);
		}
