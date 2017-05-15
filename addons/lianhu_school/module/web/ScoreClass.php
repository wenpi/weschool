<?php
	
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'scoreAdmin';
    $left_nav     = 'scoreClass';
    $title        = '考试记录';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'学校信息'),
        array('fun_str'=>'scoreClass','fun_name'=>'考试记录'),
    );
	$top_action = array(
		array('action_name'=>'考试记录' ,'action'=>'scoreClass'),
		array('action_name'=>'新建考试记录' ,'action'=>'scoreClass','arr'=>array('ac'=>'new') ),
	);
	$page_name = '考试记录';
	if($ac=='new'){
		$page_name = '新建考试记录';
	}
    $we7_js     = 'no';
    $order_self = '[0,"desc"]';
	if($ac=='list'){
		$school_uniacid_jilv = " and jilv.school_id=".$this->school_info['school_id'];
		$list                = pdo_fetchall("select jilv.*,grade.grade_name from ".tablename('lianhu_scorejilv')." jilv 
										left join ".tablename('lianhu_grade')." grade on grade.grade_id=jilv.grade_id where jilv.status !=2  {$school_uniacid_jilv} order by addtime ");
				
	}elseif($ac=='edit'){
		if($_GPC['submit']){
			$in['status']  			= $_GPC['status'];
			$in['scorejilv_name']   = $_GPC['scorejilv_name'];
            D("scoreJilv")->edit(array('scorejilv_id'=>$_GPC['jilv_id']),$in);
			$this->myMessage('更新成功',$this->createWebUrl('scoreClass'),'成功');
		}
        $result     = D("scoreJilv")->edit(array('scorejilv_id'=>$_GPC['jilv_id']));
        $grade_list = D("grade")->getSchoolList();
	}elseif($ac=='new'){
        $grade_list = D("grade")->getSchoolList();
		if($_GPC['submit']){
			$in['status']  			= $_GPC['status'];
			$in['scorejilv_name']   = $_GPC['scorejilv_name'];
			$in['grade_id'] 		= $_GPC['grade_id'];
			$in['addtime'] 			= TIMESTAMP;
            D("scoreJilv")->add($in);
			$this->myMessage('新增成功',$this->createWebUrl('scoreClass'),'成功');
		}
	}elseif($ac=='delete'){
		if($_GPC['jilv_id']){
			$where['scorejilv_id'] = $_GPC['jilv_id'];
            D("scoreJilv")->delete($where);
			$this->myMessage('删除',$this->createWebUrl('scoreClass'),'成功');
		}
	}    
    include $this->template('../admin/ScoreClass');
	exit();