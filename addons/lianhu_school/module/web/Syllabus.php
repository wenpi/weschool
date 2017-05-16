<?php 
		$this->checkAdminWeb();
		D("newSyllabus")->oldToNew($this->school_info);
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'class_manage';
		$left_nav     = 'syllabus';
		$title        = '课程表';  
		$sidebar_list = array(
			array('fun_str'=>'','fun_name'=>'班级管理'),
			array('fun_str'=>'syllabus','fun_name'=>'课程表'),
		);
		$top_action = array(
			array('action_name'=>'课程表','action'=>'syllabus' ),
			array('action_name'=>'课程时间','action'=>'syllabus','arr'=>array('ac'=>'edit_course_time') ),
		);
		$page_name    = '课程表';
		if($ac=='edit_course_time'){
			$page_name    = '课程时间';
		}		
		$teacher 	= $this->teacher_qx('no');
		$school_id  = getSchoolId();
		if($teacher == 'teacher'){
			$t_id 	= getTeacherId();
			$class_list = D("teacher")->getTeacherClass($t_id);
			$list = $class_list['list'];
		}else{
			$list = D('classes')->getThisAdminClassList();
		}
		$quanxian_class_id_arr = array();
		if($list){
			foreach ($list as $key => $value) {
				if(in_array($value['class_id'], $quanxian_class_id_arr)){
					unset($list[$key]);
					continue;
				}
				$quanxian_class_id_arr[] = $value['class_id'];
			}
		}else{
			$this->myMessage("只有班主任和管理员能够访问，或者暂未设置年级班级");
		}
		#组合list
		if($list){
			$grade_ids = array();
			$new_list  = ''; 
			foreach ($list as $key => $value) {
				if(in_array($value['grade_id'],$grade_ids)){
					array_push($new_list[$value['grade_id']],$value);
				}else{
					$new_list[$value['grade_id']][0] = $value;
					$grade_ids[] = $value['grade_id'];
				}
			}
			$list = $new_list;
		}	

		$school_info  = $this->school_info;
		$on_school    = $school_info['on_school'];
		$begin_course = $school_info['begin_day'];
		$am_much      = $school_info['am_much'];
		$pm_much      = $school_info['pm_much'];
		$ye_much      = $school_info['ye_much'];

		for ($i=0; $i <50 ; $i++) { 
			$loop[$i]=1;
		}
        
		if($ac=='new'){
			if(in_array($_GPC['cid'],$quanxian_class_id_arr)){
				$class_result = D("classes")->edit(array("class_id"=>$_GPC['cid']));
				$course_ids   = unserialize($class_result['course_ids']);
				if($course_ids){
					foreach ($course_ids as $key => $value) {
						$courses[$key]['id'] 	= $value;
						$courses[$key]['name']  = D("course")->courseName($value);
					}
				}
			}else{
				$this->myMessage("非法访问");
			}
		}
		if($ac=='save'){
			if(in_array($_GPC['cid'],$quanxian_class_id_arr)){
				$class_result 		= D("classes")->edit(array("class_id"=>$_GPC['cid']));
				//先删除相关的
				D("newSyllabus")->delete(array("class_id"=>$_GPC['cid']));
				$content['am'] 			= $_GPC['am'];
				$content['pm'] 			= $_GPC['pm'];
				$content['ye'] 			= $_GPC['ye'];
                $content['teacher_am']  = $_GPC['teacher_am'];
                $content['teacher_pm']  = $_GPC['teacher_pm'];
                $content['teacher_ye']  = $_GPC['teacher_ye'];
				$content['aroom_id']   	= $_GPC['aroom_id'];
				$content['proom_id']   	= $_GPC['proom_id'];
				$content['yroom_id']   	= $_GPC['yroom_id'];
				$url     	   		    = $_GPC['url'];
				D("newSyllabus")->decodeContent($this->school_info,$class_result['class_id'],$url,$content);
				$this->myMessage("编辑成功",$this->createWebUrl('syllabus',array('ac'=>'new','cid'=>$_GPC['cid'] )),'成功');
			}else{
				$this->myMessage("非法访问2");
			}
		}
        if($ac=='edit_course_time'){
            if($_GPC['submit']=='提交'){
 				$in['uniacid']=$_W['uniacid'];
				$in['school_id']=$school_id;
                $in['keyword']  ='course_time';
                $content['begin_time']=$_GPC['begin_time'];
                $content['end_time']=$_GPC['end_time'];   
                $in['content']=serialize($content);
                pdo_insert('lianhu_set',$in);               
				$this->myMessage("新增成功",$this->createWebUrl('syllabus',array('ac'=>'edit_course_time','aw'=>1)),'成功');
            }
            $result=pdo_fetch("select * from {$table_pe}lianhu_set where keyword='course_time' and school_id=:school_id order by set_id  desc ",array(":school_id"=>$school_id));
            $result['content']=unserialize($result['content']);
            $result['begin_time']=$result['content']['begin_time'];
            $result['end_time']=$result['content']['end_time'];
        }
		//教室
		$build_re 	= D("teaBuilding")->getList(array(":status"=>1));
		$build_list = $build_re['list'];
		foreach ($build_list as $key => $value) {
			$where[":status"] = 1;
			$where[":tea_building_id"] = $value['building_id'];
			$re = D("teaRoom")->getList($where);
			$build_list[$key]['sec'] = $re['list'];
		}
		include $this->template('../admin/web_syllabus');
		exit();
        