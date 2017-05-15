<?php 
    $teacher_info = $this->teacher_mobile_qx(); 
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '添加记录';
    $class_work         = D('work');
    $recore_class_list = D("record")->getRecordClass();
    $student_info      = D("student")->getStudentInfo($_GPC['sid']);
    if($_GPC['submit']){
        $in['student_id'] = $student_info['student_id'];
        if($_POST['voice_value']){
            $in['voice']  = $this->getWechatMedia($_POST['voice_value'],2,false);
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
        $in['class_id']     = $student_info['class_id'];
        $in['grade_id']     = $student_info['grade_id'];
        $in['word']         = $_GPC['record_title'];
        $in['content']      = $_GPC['record_content'];
        $in['jilv_class']   = $_GPC['record_class_id'];
        $in_id 				= $class_work->add($in);
        $this->sendRecordMsg($student_info['student_id'],'记录','',$_W['siteroot'].'app/'.$this->createMobileUrl('line_article',array('wid'=>$in_id )) );
        $this->myMessage('新增记录成功',$this->createMobileUrl('tea_work_record'),'成功');
    }