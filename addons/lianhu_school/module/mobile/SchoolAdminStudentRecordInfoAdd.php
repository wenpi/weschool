<?php 
    $school_admin  = D('admin')->mobileValidSchoolAdmin();
    if(!$school_admin){
        header("Location:".$this->createMobileUrl("school_bangding"));
    }
    $title = $page_title = '新增记录';
    $student_id = $_GPC['id'];
    $class_list = D('record')->getRecordClass();
    if($student_id){
        $student_info = D('student')->edit(array("student_id"=>$student_id));
        if($_GPC['submit']){
 				if(!strstr($_GPC['img_value'],'images') && $_GPC['img_value']){
						$in['img']          = $this->getWechatMedia($_POST['img_value'],1,true); 
				}
				if($_POST['voice_value']){
						$in['voice']        = $this->getWechatMedia($_POST['voice_value'],2,false);
				}
                $_SESSION['teacher_id'] = 0;
				$in['student_id']   = $student_id;
				$in['class_id']     = $student_info['class_id'];
				$in['grade_id']     = $student_info['grade_id'];
				$in['word']         = $_GPC['word'];
				$in['content']      = $_GPC['content'];
				$in['jilv_class']   = $_GPC['jilv_class'];
				$in_id 				= D('work')->add($in);
                $this->sendRecordMsg($student_id,'记录','',$_W['siteroot'].'app/'.$this->createMobileUrl('line_article',array('wid'=>$in_id )) );
				$this->myMessage('新增记录成功',$this->createMobileUrl('SchoolAdminStudentRecordInfo',array("id"=>$student_id)),'成功');           
        }
    }
