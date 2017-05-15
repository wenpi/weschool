<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'school_base_set';
		$left_nav     = 'attenceSet';
		$title        = '考勤时间设置';  
		$sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'学校基本设置'),
            array('fun_str'=>'attenceSet','fun_name'=>'考勤时间设置'),
		);
        $top_action = array(
            array('action_name'=>'时间规则列表','action'=>'attenceSet' ),
            array('action_name'=>'添加新的时间规则','action'=>'attenceSet','arr'=>array('ac'=>'new') ),
        );
		$page_name    = '时间规则列表';
		if($ac=='new'){
			$page_name    = '添加新的时间规则';
		}		
        $class_attenceTime = D('attenceTime');
        
        if($ac=='list'){
            $result = $class_attenceTime->dataList(false);
            $list   = $result['list'];
        }
        if($ac=='new'){
            if($_GPC['submit']){
                $up = getNewUpdateData($_GPC,$class_attenceTime);
                $class_attenceTime->dataAdd($up);
                $this->myMessage("新增成功",$this->createWebUrl("attenceSet"),'成功');
            }
        }
        if($ac=='edit'){
            $id = $_GPC['id'];
            $up = false;
            if($_GPC['submit']){
                $up = getNewUpdateData($_GPC,$class_attenceTime);
            }
            $result = $class_attenceTime->dataEdit($id,$up);
        }
        if($ac=='delete'){
            $id = $_GPC['id'];
            if($id){
                $where[$class_attenceTime->time_id] = $id;
                $class_attenceTime->delete($where);
                $this->myMessage("删除",$this->createWebUrl("attenceSet"),'成功');
            }
        }
        include $this->template('../admin/web_attenceSet');
		exit();