<?php
    $asc = $_SERVER['HTTP_ACCEPT'];
    if(!stristr($asc,"text/html")){
        exit();
    }
    $token          = $this->class_base->tokenForm();
	
	$teacher_info = $this->teacher_mobile_qx(); 
	$student_name = $teacher_info['teacher_realname'];
	$page_title   = '学生记录';
	$recordclass_list   = D('record')->getRecordClass();
	D('student')->class_id = $_GPC['cid'];
	$student_list = D('student')->getClassStudentList();
	D('work')->workUp();
	$class_re     = D("classes")->edit(array("class_id"=>$_GPC['cid'] ));
	$class_work         = D('work');
	$recore_class_list  = D("record")->getRecordClass();
	if($_GPC['submit'] && $_GPC['token'] == $_COOKIE['form_token']){
        $in = array();
        if(!$_GPC['student_ids']){
            $this->myMessage("请至少勾选一个学生哦！",$this->createMobileUrl('TeaStudentWorkRecord',array("id"=>$_GPC['cid'])),'错误');
        }
        $img_arrs         = $_POST['img_value'];
        if($img_arrs){
            foreach ($img_arrs as $key => $value) {
                $img = $this->getWechatMedia($value);
                if($img){
                    $img_in[]= $img;
                }
            }
        }       
        if($img_in){
            $in['img']          = serialize($img_in);
        }
        if($_POST['voice_value']){
            $in['voice']  = $this->getWechatMedia($_POST['voice_value'],2,false);
        }
        $in['class_id']     = $class_re['class_id'];
        $in['grade_id']     = $class_re['grade_id'];
        $in['word']         = $_GPC['record_title'];
        $in['content']      = $_GPC['record_content'];
        $in['jilv_class']   = $_GPC['record_class_id'];
        foreach ($_GPC['student_ids'] as $key => $value) {
            $in['student_id']   = $value;
            $in_id 				= $class_work->add($in);
            $this->sendRecordMsg($in['student_id'],'记录','',$_W['siteroot'].'app/'.$this->createMobileUrl('line_article',array('wid'=>$in_id )) );
        }
        $this->myMessage('新增记录成功',$this->createMobileUrl('tea_work_record'),'成功');
	}
		