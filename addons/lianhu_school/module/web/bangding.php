<?php 
    	$uid    = $_W['member']['uid'];
		$this->registerClassBase();
        $config = $this->module['config'];
		if(empty($uid))
			$uid = $this->register_member();
		$fanid   = $this->class_base->mobileGetFanidByUid($uid);
		$hav     = pdo_fetch("select * from ".$this->table_pe."lianhu_student where fanid={$fanid} or fanid1={$fanid} or fanid2={$fanid} ");
		if($module!='add_student'){
            if($hav)
                header("Location:".$this->createMobileUrl('home'));
            $result  = $this->moneyLimit("bangding");
            if($result)
                return true;
        }
		if($_GPC['submit']){
			$find[':student_passport'] = $_GPC['student_passport'];
			$find[':student_name']     = $_GPC['student_name'];
			$find[":uniacid"]  		   = $_W['uniacid'];
            if($config['family_set']=='alone_school'){
			     $student=pdo_fetch("select * from ".$this->table_pe."lianhu_student where  xuehao=:student_passport and student_name=:student_name and uniacid=:uniacid ",$find);
            }else
			     $student=pdo_fetch("select * from ".$this->table_pe."lianhu_student where  student_passport=:student_passport and student_name=:student_name and uniacid=:uniacid ",$find);
			if($student){
                $class_student  = D('student');
                $relation       = $_GPC['relation'];
                $valid_relation = $class_student->validStduentRelation($student['student_id'],$relation);
                if($valid_relation['errcode']==1)
					message('此为学生的此关系已经被绑定了！',$this->createMobileUrl('bangding'),'error');	
				if($student['fanid']==$fanid || $student['fanid1']==$fanid  ||$student['fanid2']==$fanid )
					message('您已经绑定过此位学生了',$this->createMobileUrl('bangding'),'error');	
				if(!$student['fanid'])
					$ziduan='fanid';
				elseif(!$student['fanid1'])
					$ziduan='fanid1';
				elseif(!$student['fanid2'])
					$ziduan='fanid2';
				else
					message('该学生的三个账号已经被绑定了，无法再绑定',$this->createMobileUrl('bangding'),'error');	
				//添加关系
                $class_student->insertStudentRelation($student['student_id'],$relation,$fanid);
                pdo_update('lianhu_student',array($ziduan=>$fanid),array('student_id'=>$student['student_id']));
				if($module=='add_student')
                    message('添加学生成功，跳转至切换页面！',$this->createMobileUrl('Change_student',array('op'=>'post','sid'=>$student['student_id']) ),'success');
                else
                    message('绑定成功',$this->createMobileUrl('home'),'success');
			}else{
				message('您提交的信息有误，无法绑定学生账号',$this->createMobileUrl('bangding'),'error');
			}
		}