<?php
$school_id = getSchoolId();
//报名历史
if($ac=='booking_list_history'){
    $cclass_bookingList = C('bookingList');
    $class_booking      = D('booking');
    $uid                = getMemberUid();
    $re                 = $cclass_bookingList->getUserBookingList($uid);
    if($re['count']>0){
        foreach ($re['list'] as $key => $value) {
                $result = $class_booking->dataEdit($value['booking_id']);
                if($result){
                    $re['list'][$key]['info'] = $result;
                }else{
                    unset($re['list'][$key]);
                }
        }
        include $this->template('booking_list_history');
    }else{
        echo 'no';
    }
    exit();
}
//家长查看视频
if($ac=='video_look'){
    $class_edulist = D('eduVideoList');
    $result        = $this->mobile_from_find_student();
    $list_id       = $_GPC['list_id']; 
    $list_re       = $class_edulist->dataEdit($list_id);
    $up['views']   = $list_re['views']+1;
    $class_edulist->dataEdit($list_id,$up);
    $class_ctl_viewsLog = C('viewsLog');
    $class_ctl_viewsLog->content_id = $list_id;
    $id = $class_ctl_viewsLog->add($result['student_id'],'video_look');
    outJson(array('id'=>$id));
}
//教师审核请假的列表
if($ac=='tea_leave_list'){
    $class_leave    = D("leave");
    $teacher_info   = $this->teacher_mobile_qx();
    $pager          = $_GPC['pager'];  
    $list           = $class_leave->getTeacherDoList($teacher_info['teacher_id'],$pager);
    if($list)
        include $this->template('student_leave_list');
     else 
        echo 'no';
     exit();   
}
//学生的请假
if($ac=='student_leave_list'){
    $class_leave    = D("leave");
    $result         = $this->mobile_from_find_student();
    $list           = $class_leave->getStudentLeaveList($result['student_id']);
     if($list)
        include $this->template('student_leave_list');
     else 
        echo 'no';
     exit();
}

//查看
if($ac=='look_info'){
    $teacher_info   = $this->teacher_mobile_qx();
    $look_id = $_GPC['look_id'];
	$result  = pdo_fetch("select * from ".tablename('lianhu_look')." where look_id=:lid ",array(":lid"=>$look_id) );
	if($result['voice']){
		$out['voice'] = $this->echoVoiceUrl($result['voice']);
	}
	if($result['images']){
		$out['imgs'] = $this->decodeLineImgs($result['images'],1);
	}
	$out['text']    = $result['content'];
	$out['errcode'] = 0;
	outJson($out);
}
//教师重发消息
if($ac=='tea_re_send'){
	//发送模板消息
    $class_student         = D('student');
    $class_sendRecord      = D('sendRecord');
    $class_base            = D('base');
    $teacher_info          = $this->teacher_mobile_qx();

    $student_id            = $_GPC['student_id'];
    $rid                   = $_GPC['rid'];
    
    $record_re             = $class_sendRecord->dataEdit($rid);
    $student_info          = $class_student->getStudentInfo($student_id);
    $openids               = $class_student->returnEfficeOpenid($student_info,3);
    $url                   = $_W['siteroot'].'app/'.$this->createMobileUrl("sendRecord",array('record_id'=>$rid,"student_id"=>$student_id ) );
    if($record_re['record_title']){
        $title = str_ireplace('[学生姓名]',$student_info['student_name'],$record_re['record_title']);
    }else{
        $title = $student_info['student_name'].'的家长您好，您有一个班级通知，请查看';    
    }
   $first   = $title;
   $key2    = $teacher_info['teacher_realname']; 
   $key4    = $record_re['record_intro'];
   $remark  = "点击查看";
   $mu_info = $this->decodeMsg1($first,'教师',$key2,$key4 ,$remark);     
   $this->class_base->student_id = $student_id;
   foreach ($openids as $key => $v) {
        if($v){
            $this->class_base->sendTplNotice($v,$mu_info['mu_id'],$mu_info['data'],$url);
        }
    }   
    outJson(array('errcode'=>0));
}
//教师的发送记录
if($ac=='tea_msg_send_list'){
     $teacher_info          = $this->teacher_mobile_qx();
     $class_sendRecord      = D('sendRecord');
     $class_look            = D('look');
     $pager                 = $_GPC['pager'];
     $params[":record_type"] = 4;
     $params[":mobile_uid"]  = $uid;
     $result                 = $class_sendRecord->dataList($params,$pager);
     $list                   = $result['list'];
     if($list)
        include $this->template('send_msg_content');
     else 
        echo 'no';
     exit();
}
//教师发送的作业记录
if($ac == 'tea_homework_history'){
     $teacher_info           = $this->teacher_mobile_qx();
     $class_sendRecord       = D('sendRecord');
     $class_look             = D('look');
     $pager                  = $_GPC['pager'];
     $where                  = "(record_type=5 || record_type= 7)";
     $params[":teacher_id"]  = $teacher_info['teacher_id'];
     $result                 = $class_sendRecord->dataList($params,$pager,$where);
     $list                   = $result['list'];
     if($list){
         foreach ($list as $key => $value) {
            $homework           = C("homework")->findHomeWork($value);
            $list[$key]['hid']  = $homework['homework_id'];
         }
        include $this->template('send_msg_content');
     }else{
        echo 'no';
     }
     exit();
}

//回复校长信箱的
if($ac == 're_message_content'){
        $in_type     = $this->judePortType();
        $content     = $_GPC['content'];
        $message_id  = $_GPC['message_id'];
        if(!$content || !$message_id)       
            outJson(array('errcode'=>1,'msg'=>'请输入回复内容') );
        $in['content']      = $content;
        $in['message_id']   = $message_id;
        $in['send_uid']     = $uid;
        if($in_type['type'] == 'teacher'){
            $in['teacher_id'] = $in_type['info']['teacher_id'];
            $in['type']       = 2;
        }elseif($in_type['type'] == 'student'){
            $in['student_id'] = $in_type['info']['student_id'];
            $in['type']       = 2;
        }else{
            outJson(array('errcode'=>1,'msg'=>'非允许登录人员') );
        }
        $class_message = D('message');  
        $content_id    = $class_message -> addMessageContent($in);
        $info          = $class_message->getContentInfo($content_id);
        $avatar        = $this->class_base->mobileGetAvatarByUid($info['send_uid']);
        outJson(array('errcode'=>0,'info'=>$info,'avatar'=>$avatar ) );
}
//教师的删除操作
if($ac=='tea_delete'){
     $teacher_info  = $this->teacher_mobile_qx();
     $type          = $_GPC['type'];
     if($type=='line'){
         pdo_delete("lianhu_line",array("line_id"=>$_GPC['id']));
     }
    echo json_encode(array('errcode'=>0));
    exit();
}
if($ac=='send_msg_line'){
    $teacher_info   = $this->teacher_mobile_qx();
    $queue_ids      = $_GPC['queue_ids'];
    if(!$queue_ids){
		return false;
	}
	$queue_id_arr = explode(',',$queue_ids);
    $end_time = date("H:i:s",time());		
    foreach ($queue_id_arr as $key => $value) {
		if($value){
			$result   = $this->sendAllMsg($value);
			$out_list[$value] = array("end_time"=>$end_time,'status'=>2,'result'=>$result);
		}
	}
	outJson($out_list);
}
if($op=='line_like'){
    $in_type            = $this->judePortType();
    $send_id            = $_GPC['send_id'];   
    if(!$this->zanLine($send_id)){
        $in_type           =$this->judePortType();
        if($in_type['type']=='teacher'){
            $in['teacher_id'] = $in_type['info']['teacher_id'];
        }else{
            $in['student_id'] = $in_type['info']['student_id'];
        }          
       $in['send_id']   = $send_id;
       $in['uid']       = $uid;
       $in['add_time']  = time();    
       pdo_insert("lianhu_send_like",$in);
       $send_re         = pdo_fetch("select * from {$table_pe}lianhu_send where send_id=:id",array(":id"=>$send_id));
       $like_num        = $send_re['send_like']+1;
       pdo_update('lianhu_send',array('send_like'=>$like_num),array('send_id'=>$send_id));
     }
    $lan_name = D('line')->getLineZanName($send_id);
    exit($lan_name);         
}
if($op=='huifu'){
    $in_type           =$this->judePortType();
    if($in_type['type']=='teacher'){
         $class_id  = $_GPC['class_id'];
         $in['teacher_id'] = $in_type['info']['teacher_id'];
    }else{
        $class_id   = getClassId();  
        $in['student_id'] = $in_type['info']['student_id'];
    }                             
     $send_id                = $_GPC['send_id'];   
     $content                = $_GPC['content'];   
     $in['send_id']          = $send_id;
     $in['comment_uid']      = $uid;
     $in['comment_text']     = $content;
     $in['add_time']         = time();
     pdo_insert('lianhu_send_comment',$in);  
     $list             = D('line')->getLineComment($send_id);
     foreach ($list as $key => $value) {
         $html .="<p onclick='deleteComment({$value['comment_uid']},{$value['comment_id']})' id='comment_{$value['comment_id']}' >{$value['nickname']}:{$value['comment_text']}</p>";
     }
     exit($html);
}
if($op=='line_change'){
     $in_type    =$this->judePortType();
     $send_id    =$_GPC['send_id'];
     $ac         =$_GPC['ac'];
    if($ac=='line_pass'){
        if($in_type['type']!='teacher')
            $out=array('errcode'=>1,'msg'=>'没有权限');
        $up['send_status']  =1;
        pdo_update("lianhu_send",$up,array('send_id'=>$send_id) );
        $out=array('errcode'=>0,'msg'=>'审核成功');
        echo json_encode($out);
    }
     if($ac=='like'){
         if(!$this->zanLine($send_id)){
             $in_type         = $this->judePortType();
             if($in_type['type']=='teacher'){
                 $in['teacher_id'] = $in_type['info']['teacher_id'];
             }else{
                 $in['student_id'] = $in_type['info']['student_id'];
             }
             $in['send_id']   = $send_id;
             $in['uid']       = $uid;
             $in['add_time']  = time();    
             pdo_insert("lianhu_send_like",$in);
             $send_re         =pdo_fetch("select * from {$table_pe}lianhu_send where send_id=:id",array(":id"=>$send_id));
             $like_num        =$send_re['send_like']+1;
             pdo_update('lianhu_send',array('send_like'=>$like_num),array('send_id'=>$send_id));
             echo json_encode(array('errcode'=>0,msg=>''));        
         }
     }
     if($ac=='delete'){
         if($in_type['type']=='student')
             $where['send_uid'] =$uid;
         $where['send_id']      =$send_id;
         $result                =pdo_update("lianhu_send",array('send_status'=>3),$where);
         if(!$result)  echo json_encode(array('errcode'=>1,msg=>'删除失败'));          
         else          echo json_encode(array('errcode'=>0,msg=>''));              
     }
     exit();
}
if($op=='line_all'){
    $in_type      =$this->judePortType();
    if($in_type['type']=='teacher'){
        $class_id =$_GPC['class_id'];
    }else{
        $class_id =getClassId();   
    }                             
    $pager        =$_GPC['page'];
    $list         =$this->getLineList($pager,10,$class_id);
    if(empty($list)){
         echo 'all';
         exit();
     }
     $class_student=D("student");
     include $this->template('line_content');
     exit();
}
if($op=='line' && $_GPC['home_work']=='home_work'){
     $student_info = $this->mobile_from_find_student();
     $class_id     = getClassId();
     $pager        = $_GPC['page'];
     $start        = ($pager-1)*20;
     $news_list    = pdo_fetchall("select * from {$table_pe}lianhu_homework where class_id={$class_id} and status=1 order by add_time desc limit {$start},20");
     $count        = count($news_list);
     if($count < $pagesize)		$arr['done']='yes';
     if($count>0){
		$arr['list'] ='yes';
        foreach ($news_list as $key => $value) {
            $add                         = D('teacher')->teacherImg($value['teacher_id']);
            $value['teacher_realname']   = $value['teacher_realname']?$value['teacher_realname']:"管理员";
            $html.='
       		<ul>
            <li class="box" >
            		<div class="author">
                    		<a href="#"><img src="'.$add.'"></a>
                            <p class="author_name">'.$value['teacher_realname'].$this->courseName($row['course_id']).'</p>
                            <p class="author_time">时间：'.date("Y-m-d H:i:s",$row['add_time'] ).'</p>
                    </div>
                            <div class="topic" style="margin-top:-10px;">
                                    <a href="'.$this->createMobileUrl('line_article',array('hid'=>$row['homework_id'] )).'">
                                            <p>'.$this->clear_html_short($row['content']).'</p>
                                    </a>
                                <div onclick="displayImage(this)">
                                    '.$this->decodeLineImgs($row['img']).'
                                    <div class="clear"></div>
                                </div>                                    
                            </div>
                       </li> </ul>';
        }
        $arr        ='';
        $arr['html']=$arr;
     }
     echo json_encode($arr);
     exit();
}
if($op=='line' && $_GPC['home_work']!='home_work'){
    $student_info  =$this->mobile_from_find_student();
	$typeid        =$_GPC['type_id'];
	$news_list     =pdo_fetchall("select line.*,tea.teacher_realname from {$table_pe}lianhu_line line left join {$table_pe}lianhu_teacher tea on tea.teacher_id=line.teacher_id  where line.class_id=:cid and line.status=1 and  line_type={$typeid} order by line.addtime desc {$sql_limit}",array(':cid'=>$student_info['class_id']));	
	$count=count($news_list);
	if($count < $pagesize)
		$arr['done']='yes';
	if($count>0){
		$arr['list']='yes';
		foreach ($news_list as $key => $value) {
			$arr['list_con'][$key]['url']   = $this->createMobileUrl('line_article',array('op'=>$value['line_id']));
			$arr['list_con'][$key]['title'] = $value['line_title'];
			$arr['list_con'][$key]['content']=$this->clear_html_short($value['line_content']);
			$arr['list_con'][$key]['teacher_realname']=$value['teacher_realname']?$value['teacher_realname']:"管理员";
			$arr['list_con'][$key]['time']=date("Y-m-d H:i:s",$value['addtime']);
			$arr['list_con'][$key]['num']=$value['line_look'];
            $add = D('teacher')->teacherImg($value['teacher_id']);
            $html  .='<UL >
                <LI class="box" >
                        <div class="author">
                                <a href="#"><img src="'.$add.'"></a>
                                <p class="author_name">'.$arr['list_con'][$key]['teacher_realname'].'</p>
                                <p class="author_time">时间：'.$arr['list_con'][$key]['time'].'</p>
                        </div>
                            <div class="topic">
                                <p>'.$arr['list_con'][$key]['content'].'</p>
                            </div>
                        <div class="click_hf">
                            <a class="zan" style="color:#ff0033";href="javascript:;">
                                <i class="fa fa-heart"></i>
                        </a>
                            <span  >'.$arr['list_con'][$key]['num'].'</span>
                        </div>
                </LI>           
                </UL>';
		}
        $arr        ='';
        $arr['html']=$arr;
	}
	echo json_encode($arr);
    exit();
}
if($op=='appointment'){
    $student_info =$this->mobile_from_find_student();
	$where=" appointment_type_limit=0 || (appointment_type_limit=1 && appointment_grade_class like '%{$student_info['grade_id']}%' ) || (appointment_type_limit=2 && appointment_grade_class like '%{$student_info['class_id']}%' ) ";
	$app_result   =pdo_fetch("select * from {$table_pe}lianhu_appointment where ($where) and  appointment_id=:id",array(':id'=>$_GPC['appointment_id']));
	if(!$app_result){ echo json_encode(array('msg'=>'无此预约'));exit();}
	if(empty($app_result['appointment_mutex'])){
		#无限制
		$join_num    =pdo_fetchcolumn("select count(*) num  from {$table_pe}lianhu_applist where appointment_id={$app_result['appointment_id']} and status !=2");	
		if($join_num>=$app_result['appointment_max_num']){echo json_encode(array('msg'=>'已经满员啦'));exit();}
	}else{
		#有限制
			$arr        =unserialize($app_result['appointment_mutex']);
			$active_arr =explode('||', $arr['content']);
			$join_num   =pdo_fetchcolumn("select count(*) num  from {$table_pe}lianhu_applist where appointment_id={$app_result['appointment_id']} and status !=2 ");
			if($join_num>=$arr['num']){echo json_encode(array('msg'=>'您加入的项目达到限制了！'));exit();}
			$join_num   =pdo_fetchcolumn("select count(*) num  from {$table_pe}lianhu_applist where appointment_id={$app_result['appointment_id']} and status !=2 and content like :con",array(':con'=>"%{$_GPC['active']}%"));	
			foreach ($active_arr as $key => $value) {
				list($active_list[$key]['name'],$active_list[$key]['max'])=explode('--', $value);
				if($active_list[$key]['name']==$_GPC['active']){
			      if($join_num>=$active_list[$key]['max']){echo json_encode(array('msg'=>'此项目已经满员啦！'));exit();}
				}
			}
	}
	#all pass
	pdo_update('lianhu_appointment',array('appointment_join_num'=>$app_result['appointment_join_num']+1),array('appointment_id'=>$app_result['appointment_id']));
	pdo_insert('lianhu_applist',array('appointment_id'=>$app_result['appointment_id'],'student_id'=>$student_info['student_id'],'addtime'=>TIMESTAMP,'content'=>$_GPC['active'],'uniacid'=>$_W['uniacid'],'school_id'=>$school_id));
	echo json_encode(array('status'=>'yes'));
    exit();
}
if($ac=='student_score_list'){
    $student_info  =$this->mobile_from_find_student();
	$class_id      =$_GPC['cid'];
	$course_id     =$_GPC['course_id'];
	$scorejilv_id  =$_GPC['scorejilv_id'];
	$list          =pdo_fetchall("select * from {$table_pe}lianhu_scorelist where course_id=:course_id and ji_lv_id=:ji_lv_id and class_id=:class_id",array(':course_id'=>$course_id,':ji_lv_id'=>$scorejilv_id,':class_id'=>$class_id));
	echo json_encode(array('status'=>"yes",'student_score_list'=>$list));	
    exit();
}
exit();