<?php
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'school_base_set';
		$left_nav     = 'course_set';
		$title        = '课程设置';  
		$sidebar_list = array(
			array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
			array('fun_str'=>'course','fun_name'=>'课程设置'),
		);
		$top_action = array(
			array('action_name'=>'课程列表','action'=>'course' ),
			array('action_name'=>'添加课程','action'=>'course','arr'=>array('ac'=>'new') ),
		);
		$page_name    = '课程列表';
		if($ac=='new'){
			$page_name    = '添加课程';
		}
		$we7_js = 'no';

		$class_course   = C('course');
		if($ac  == 'new'){
			if($_GPC['submit']=='提交'){
				if($_GPC['course_name']){
					$where["course_name"] = $_GPC['course_name'];
					$where['school_id'] = getSchoolId();
					$result 	     = $class_course->use_class->edit($where);
					if($result){
						$this->myMessage('已经存在这个课程啦！',$this->createWebUrl('course'),'错误');
					}
					$in['course_name'] =$_GPC['course_name'];
					$class_course->use_class->add($in);
					$this->myMessage('新增成功',$this->createWebUrl('course' ),'成功');
				}else{
					$this->myMessage('请输入课程名',$this->createWebUrl('course' ),'错误');
				}				
			}
		}elseif($ac =='edit'){
			$where['course_id'] = $_GPC['cid'];
			$result 			= $class_course->use_class->edit($where);
			if($_GPC['submit']=='提交'){
				if($_GPC['course_name']){
					$find["course_id"] 	 = array("!=",$_GPC['cid']);
					$find["course_name"] = $_GPC['course_name']; 
					$result 			 = $class_course->use_class->edit($find);
					if($result){
						$this->myMessage('已经存在这个课程啦！',$this->createWebUrl('course'),'错误');
					}
					$in['course_name'] = $_GPC['course_name'];
					$class_course->use_class->edit($where,$in);
					$this->myMessage('更新成功',$this->createWebUrl('course'),'成功');
				}else{
					$this->myMessage('请输入课程名',$this->createWebUrl('course'),'错误');
				}				
			}
		}elseif($ac=='delete'){
			if($_GPC['cid']){
				$class_course->use_class->delete(array('course_id'=>$_GPC['cid']));
				$this->delete_course_class($_GPC['cid'],'all');
				$this->delete_course_teacher($_GPC['cid'],'all');
				$class_mcourse = M("course");
				if($class_mcourse){
					$class_mcourse->deleteStatus($_GPC['cid']);
					M("teacherCourse")->deleteCourse($_GPC['cid']);
				}
				$this->myMessage('删除成功',$this->createWebUrl('course'),'成功');
			}
		}elseif($ac=='update'){
            if($_GPC['delete']==1){
                 if($_GPC['cid']){
					$class_course->use_class->edit(array('course_id'=>$_GPC['cid']),array('course_basic'=>0));
                    $this->add_course_class($_GPC['cid'],'all');
                    $this->myMessage('降为普通课程成功',$this->createWebUrl('course'),'成功');

                }               
            }else{
                if($_GPC['cid']){
					$class_course->use_class->edit(array('course_id'=>$_GPC['cid']),array('course_basic'=>1));
                    $this->add_course_class($_GPC['cid'],'all');
                    $this->myMessage('设置为基础课程成功',$this->createWebUrl('course'),'成功');
                }               
            }
		}else{
			$class_course->use_class->each_page = 10000;
			$re  = $class_course->use_class->getList(false);
			$list = $re['list'];
		}
		include $this->template('../admin/web_course');
		exit();