<?php 
		$this->registerClassBase();
        $config  = $this->module['config'];
		$hav     = $this->mobile_from_find_student(false);
		$fanid   = getMemberFanid();
    	$uid     = getMemberUid();
		if(!$uid){
			$uid = 	$this->register_member();
		}
		$class_school = D('school');
		if($module != 'add_student'){
            if($hav){
				D("loginlog")->studentLoginLog($hav['student_id'],$hav['class_id']);
                header("Location:".$this->createMobileUrl('home'));
			}
        }
		if($_GPC['submit'] ){
			if(!$_GPC['student_name']){
				$this->myMessage('请填写学生姓名',$this->createMobileUrl('bangding'),'错误');	
			}
			$find[':student_passport'] = $_GPC['student_passport'];
			$find[':student_name']     = $_GPC['student_name']."%";
			$find[':uniacid']  		   = $_W['uniacid'];
            if($config['family_set'] == 'alone_school'){
			     $student=pdo_fetch("select * from ".$this->table_pe."lianhu_student where  xuehao=:student_passport and student_name like :student_name and uniacid=:uniacid ",$find);
            }else{
			     $student=pdo_fetch("select * from ".$this->table_pe."lianhu_student where  student_passport=:student_passport and  student_name like :student_name and uniacid=:uniacid ",$find);
			}
			if($student){
                $class_student  = D('student');
                $relation       = $_GPC['relation'];
                $valid_relation = $class_student->validStduentRelation($student['student_id'],$relation);
                if($valid_relation['errcode']==1){
					$this->myMessage('此为学生的此关系已经被绑定了！',$this->createMobileUrl('bangding'),'错误');	
				}
				if($student['fanid']==$fanid || $student['fanid1']==$fanid  ||$student['fanid2']==$fanid ){
					$this->myMessage('您已经绑定过此位学生了',$this->createMobileUrl('bangding'),'错误');
				}
				$class_school->school_id = $student['school_id'];
				$school_info 			 = $class_school->getSchoolInfo();
				$hi 					 = D('student')->studentBdCount($student);
				if($hi >=$school_info['parents'] ){
					$this->myMessage('绑定名额已满，无法再绑定',$this->createMobileUrl('bangding'),'错误');	
				}
				if(!$student['fanid']){
					$ziduan  ='fanid';
					$ziduan2 ='uid';
				}elseif(!$student['fanid1']){
					$ziduan  ='fanid1';
					$ziduan2 ='uid1';
				}elseif(!$student['fanid2']){
					$ziduan  ='fanid2';
					$ziduan2 ='uid2';
				}else{
					$this->myMessage('该学生的三个账号已经被绑定了，无法再绑定',$this->createMobileUrl('bangding'),'错误');	
				}
				//添加关系
                $class_student->insertStudentRelation($student['student_id'],$relation,$fanid);
				D('student')->school_id = $student['school_id'];
				D('student')->edit(array('student_id'=>$student['student_id']),array($ziduan=>$fanid,$ziduan2=>$uid));
				if($module == 'add_student'){
                    $this->myMessage('添加学生成功，跳转至切换页面！',$this->createMobileUrl('Change_student',array('op'=>'post','sid'=>$student['student_id']) ),'成功');
				}else{
					if (S("system",'getSetContent',array('parents_info',$this->school_info['school_id'])) ==1){
						$up['nickname'] = $_GPC['name'];
						$up['mobile']   = $_GPC['telphone'];
						pdo_update('mc_members',$up,array('uid'=>$uid) );						
					}
                    $this->myMessage('绑定成功',$this->createMobileUrl('home'),'成功');
				}
			}else{
				$this->myMessage('您提交的信息有误，无法绑定学生账号',$this->createMobileUrl('bangding'),'错误');
			}
			exit(1);
		}
		