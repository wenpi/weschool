<?php 
    $this->checkAdminWeb();
    $admin_result = D('admin')->judeAdminType();
    $left_top     = 'class_manage';
    $left_nav     = 'studentPhoto';
    $title        = '学生相册';  
    $sidebar_list = array(
        array('fun_str'=>'','fun_name'=>'班级事务'),
        array('fun_str'=>'studentPhoto','fun_name'=>'学生相册'),
    );

    $model  = $_GPC['model'] ? $_GPC['model'] :"grade";
    $result = $this->student_standard();
    $uid 	= $_W['uid'];
    $this->teacher_qx('no');

    if($_GPC['model']=='someone' && $_GPC['submit']){
        $student_id = $_GPC['sid'];
        $in['student_id'] = $student_id;
        $in['photo_list'] = C('studentPhoto')->encodePhotos($_GPC['img']);
        $in['title']      = $_GPC['word'];
        $in['db_admin_id']= getDbAdminId();
        D('studentPhoto')->add($in);
        $this->myMessage('新增成功',$this->createWebUrl('studentPhoto',array('sid'=>$student_id,'model'=>'someone')),'成功');
    }
    if($_GPC['model']=='someone' && $_GPC['sid']){
        $year_key   = $_GPC['year_key']?$_GPC['year_key']:0;
        $year_list  = S('time','getYearList',array());
        $begin_time = $year_list[$year_key];
        $end_time   = $begin_time+365*3600*24;
        $params[":begin_time"] = $begin_time;
        $params[":end_time"]   = $end_time;
        $params[":student_id"] = $_GPC['sid'];
        $where_sql             = " status=1 and student_id = :student_id and  add_time between :begin_time and :end_time  ";
        D('studentPhoto')->each_page = 10000;
        $re = D('studentPhoto')->getSqlList($params,$where_sql);
        $list = $re['list'];
        $list = sortArr($list,'add_time','min');
    }
    include $this->template('../admin/StudentPhoto');
    exit();