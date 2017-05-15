<?php 
//设置扫码课程 -> 生成 扫码二维码
//增加学生的可参加次数
//数据统计
$ac = $_GPC['ac'];
$class_course = D('course');
$school_id    = getSchoolId();
$teacher_list = $this->class_base->getSchoolTeacherList($school_id);
if(!$ac) 
     $ac='list';
if($ac=='list'){
    if($op=='list'){
        $list         = $class_course->getCourseList(true);
        foreach ($list as $key => $value) {
            $list[$key]['num'] = $class_course->getCourseMuchDo($value['course_id']);
        }
    }
    if($op=='new' && $_GPC['submit']){
        $in['uniacid']      = $_W['uniacid'];
        $in["school_id"]    = $school_id;
        $in['teacher_id']   = $_GPC['teacher_id'];
        $in['course_name']  = $_GPC['course_name'];
        $in['course_contet']= $_GPC['course_contet'];
        $in['buy_url']      = $_GPC['buy_url'];
        $in['add_time']     = time();
        $in['status']       = $_GPC['status'];
        pdo_insert("lianhu_course_scan",$in);
        message("课程添加成功",$this->createWebUrl("course_scan",array("ac"=>'list') ),'success');
    }   
    if($op=='edit'){
        $id = $_GPC['id'];
        $result = pdo_fetch("select * from {$table_pe}lianhu_course_scan where course_id=:id  ",array(":id"=>$id));
        if($_GPC['submit']){
                $in['teacher_id']   = $_GPC['teacher_id'];
                $in['course_name']  = $_GPC['course_name'];
                $in['course_contet']= $_GPC['course_contet'];
                $in['buy_url']      = $_GPC['buy_url'];
                $in['status']       = $_GPC['status'];
                pdo_update("lianhu_course_scan",$in,array("course_id"=>$id) );          
                message("更新成功",$this->createWebUrl("course_scan",array("ac"=>'list') ),'success');
        }

    }
}

if($ac=='student'){
    
}
if($ac=='data'){
    
}

