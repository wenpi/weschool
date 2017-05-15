<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'aloneCourse';
		$left_nav     = 'aloneCourseClass';
		$title        = '独立课程分类';  
		$sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'独立课程'),
            array('fun_str'=>'aloneCourseClass','fun_name'=>'独立课程分类'),
		);
        $top_action = array(
            array('action_name'=>'分类列表','action'=>'aloneCourseClass' ),
            array('action_name'=>'添加新的分类','action'=>'aloneCourseClass','arr'=>array('ac'=>'new') ),
        );
        $page_name    = '分类列表';
        if($ac=='new'){
            $page_name    = '添加新的分类';
        }        
        $class_courseClass          = C('courseClass');
        if($ac=='list'){
            $list = $class_courseClass->getAllList();
        }elseif($ac=='new'){
            if($_GPC['submit']){
                $in = getNewUpdateData($_GPC,$class_courseClass->use_class);
                $class_courseClass->use_class->add($in);
                $this->myMessage("添加分类",$this->createWebUrl('aloneCourseClass'),'成功');
            }
        }elseif($ac=='edit'){
            $id     = $_GPC['id'];
            $result = $class_courseClass->edit($id);
            if($_GPC['submit']){
                $in = getNewUpdateData($_GPC,$class_courseClass->use_class);
                $class_courseClass->use_class->edit(array('class_id'=>$id),$in);          
                $this->myMessage('修改成功',$this->createWebUrl('aloneCourseClass'),'成功');					
            }    
        }elseif($ac=='delete'){
            $id     = $_GPC['id'];
            $result = $class_courseClass->delete($id);
            $this->myMessage('删除成功',$this->createWebUrl('aloneCourseClass'),'成功');					
        }
        include $this->template('../admin/AloneCourseClass');
		exit();
