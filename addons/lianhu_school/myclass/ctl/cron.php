<?php 
namespace myclass\ctl;

class cron {

    //转发至各个公众号
    public function getUseUniacidList(){
        $list = pdo_fetchall("select uniacid from ".tablename('lianhu_school')." where status=1 group by uniacid ");
        return $list;
    }
    //处理msg_queue
    public function sendMsgQueue($class_site){
        global $_W;
        if(!$_W['uniacid']){
            return ;
        }
        $begin_time = time()-12*3600;
        $this->fixUniacid();
        //先处理本公众号50条
        $jia_yun_queue = cache_load("jia_yun_queue_select".$_W['uniacid']);
        if($jia_yun_queue){
            $have_send_queue_ids = implode(',',$jia_yun_queue);
            $where               = " and queue_id not in (".$have_send_queue_ids.") ";
            if(count($jia_yun_queue)>400){
                $jia_yun_queue = array_slice($jia_yun_queue,-50);
            }
        }else{
                $where = '';
        }
        $uniacid_list = pdo_fetchall("select queue_id from ".tablename('lianhu_msg_queue')."          
                                      where queue_status =1 and uniacid =".$_W['uniacid']." and add_time >= ".$begin_time." ".$where." order by add_time asc limit 50 "); 
        if($uniacid_list){
            foreach ($uniacid_list as $key => $value) {
                $jia_yun_queue[] = $value['queue_id'];
                cache_write("jia_yun_queue_select".$_W['uniacid'],$jia_yun_queue);
            }
            foreach ($uniacid_list as $key => $value) {
                $class_site->sendAllMsg($value['queue_id']);
            }
        }
    }
    //主进程记录
    public function mainRecord(){
        //模板消息
        $begin_time     = time()-12*3600;
        $uniacid_list   = pdo_fetchall("select uniacid from ".tablename('lianhu_msg_queue')."          
                                        where queue_status =1  and add_time >= ".$begin_time." group by uniacid  "); 
       //自主对接机器
       $card_by_self_all_uniacid = cache_load('card_by_self_all_uniacid');
       //电子学生证
       $class_login = Au("studentCard/login");
       if($class_login){
            $card_uniacid_list = pdo_fetchall("select uniacid from ".tablename('lianhu_studentcard')."   group by uniacid  "); 
       }
       foreach ($uniacid_list as $key => $value) {
            $card_by_self_all_uniacid[] = $value['uniacid'];
       }
       foreach ($card_uniacid_list as $key => $value) {
            $card_by_self_all_uniacid[] = $value['uniacid'];
       }
       $need_list = array_unique($card_by_self_all_uniacid);
       return $need_list;
    }
    //修复没有uniacid 
    public function fixUniacid(){
        $begin_time   = time()-24*3600;
        $uniacid_list  = pdo_fetchall("select * from ".tablename('lianhu_msg_queue')."          
                                       where queue_status=1 and uniacid=0 and add_time >= ".$begin_time."  order by add_time asc limit 20 ");         
        $class_shool  = D("school");
        if(!$uniacid_list){
            return false;
        }
        foreach ($uniacid_list as $key => $value) {
            if($value['school_id']){
                $class_shool->school_id = $value['school_id'];
                $re = $class_shool->getSchoolInfo();
                if($re['uniacid']){
                    pdo_update("lianhu_msg_queue",array("uniacid"=>$re['uniacid']),array("queue_id"=>$value['queue_id']));
                }
            }
        }
    }
    //找出需要发送的学校
    public function getCourseTeacher(){
        global $_W;
        $list       = D("school")->getActiveSchool();
        $school_ids = D("school")->needSendMsgToTeacher($list);
        if($school_ids){
            foreach ($school_ids as $key => $value) {
                C("teacher")->use_class->school_id = $value;
                $list = C("teacher")->getAllList();
                foreach ($list as $key => $value) {
                    $teacher_ids[] = $value['teacher_id'];
                }
            }
        }
        return $teacher_ids;
    }
    public function getTeacherCourse($teacher_id,$class_site){
        global $_W;
        $teacher_info               = D("teacher")->edit(array("teacher_id"=>$teacher_id));
        $time_result 				= pdo_fetch("select * from ".tablename('lianhu_set')." where keyword='course_time' and school_id=".$teacher_info['school_id']."  order by set_id  desc ");
        $time_result['content'] 	= unserialize($time_result['content']);
        $time_result['begin_time'] 	= $time_result['content']['begin_time'];
        $time_result['end_time'] 	= $time_result['content']['end_time'];
        $today  = $class_site->decodeTodayWeek();
        $tomorr = $today==7 ? 1:$today+1;
        $teacher_class = D("newSyllabus")->getTeacherSyllabus($teacher_info['teacher_id'],$tomorr);
        if($teacher_class){
        $teacher_class = sortArr($teacher_class,'day_sort','min');
            foreach ($teacher_class as $key => $value) {
                $class_courses[$value['class_id']][] = $value;
            }
            foreach ($class_courses as $key => $value) {
                $name = $class_site->classGradeName($key).'-'.$class_site->className($key);
                foreach ($value as $k => $v) {
                    if($v['tea_room_id']){
                        $address = "在".D("teaRoom")->getTeaNum($v['tea_room_id']);
                    }else{
                        $address = false;
                    }
                    $str .= $name."第".$v['day_sort']."节，在".$time_result['begin_time'][$v['day_sort']]."-".$time_result['end_time'][$v['day_sort']]."间，".$address."上".D("course")->courseName($rw['course_id'])."\r\n";
                }
            }
            D("school") ->school_id    = $teacher_info['school_id'];
            $result 	               = D("school")->getSchoolInfo();   
            $_SESSION['school_name']   = $result['school_name'];
            $class_msg = D("msg");
            $class_msg->in_class_base  = $class_site->class_base;
            $mu_info   = $class_msg->decodeSchoolMsg("明天上课提醒","系统",$str,'');
            $record_url = $_W['siteroot'].'/app/index.php?i='.$_W['uniacid'].'&c=entry&week='.$tomorr.'&do=Tea_today_course&m=lianhu_school&teacher_id='.$teacher_id;
            $openid     = D("teacher")->getTeacherOpenid($teacher_id);
            if($openid){
                D("msg")->insertMsgQueueMu($openid,$mu_info['data'],$mu_info['mu_id'],$record_url,$que_num);                   
            }
        }
    }
    //处理
    public function doSendToTeacher($class_site){
        $teacher_ids = $this->getCourseTeacher();
        if($teacher_ids){
            foreach ($teacher_ids as $key => $value) {
                $this->getTeacherCourse($value,$class_site);
            }
        }
    }
    /*
    自动复发
    public function reSendMsgQueue($class_site){
        exit();
        global $_W;
        $class_look         = D('look');
        $class_cronRe       = D('cronRe');
        $class_recordQueue  = D('recordQueue');
        if(!$_W['uniacid']){
            return ;
        }
        //12
        $begin_time         = time()-12*3600;
        $end_time           = time()-3*3600+10;
        $need_begin_time    = D('cron')->getBeginTime()+3600*12;
        if($begin_time < $need_begin_time){
            $begin_time = $need_begin_time;
        }
        if($begin_time>=$end_time){
            return;
        }
        $list         = pdo_fetchall("select * from ".tablename('lianhu_send_record')."          
                                       where add_time >= ".$begin_time." and add_time<=".$end_time." and  uniacid != ".$_W['uniacid']." group by uniacid order by add_time asc limit 10 ");    

        $uniacid_list = pdo_fetchall("select * from ".tablename('lianhu_send_record')."          
                                       where add_time >= ".$begin_time." and add_time<=".$end_time." and  uniacid = ".$_W['uniacid']." order by add_time asc limit 20 "); 
        //一次执行20条
        $g = 0;
        foreach ($uniacid_list as $key => $value) {
            $class_look->record_id = $value['record_id'];
            if($value['student_teacher']==1){
                $student_arr = explode(',',$value['student_ids']);
            }elseif($value['student_teacher']==2){
                $student_arr = explode(',',$value['teacher_ids']);
            }
           foreach($student_arr as $k=>$student_id){
                $look_info        = $value['student_teacher'] == 2 ? $class_look->teacherHaveLook($student_id):$class_look->studentHaveLook($student_id);
                if(!$look_info){
                    $have_to_send = $value['student_teacher'] == 2 ? $class_cronRe->findTea($value['record_id'],$student_id):$class_cronRe->findStu($value['record_id'],$student_id);
                    if(!$have_to_send){
                        if($g>=20){
                            break;
                        }else{
                            $g++;
                            $in['record_id']        = $value['record_id'];
                            if($value['student_teacher']==2){
                                $in['teacher_id']   = $student_id;
                            }else{
                                $in['student_id']   = $student_id;
                            }
                            $class_cronRe->add($in);
                            
                            $queue_num              = $class_recordQueue->findQueueNum($value['record_id']);
                            $params[":queue_num"]   = $queue_num;
                            $params[":use_type"]    = $value['student_teacher'];
                            $params[":student_id"]  = $student_id;
                            $where_str              = S("fun",'composeParamsToWhere',array($params));
                            $queue_id = pdo_fetchcolumn("select queue_id from  ".tablename('lianhu_msg_queue')." where ".$where_str." ",$params);
                            if($queue_id){
                                $class_site->sendAllMsg($queue_id);
                            }
                        }
                    }
                }
            }
        }
        $have_send = array();
        foreach ($list as $key => $value) {
            if($value['uniacid']!=$_W['uniacid']){
                unset($list[$key]);
                if(!in_array($value['uniacid'],$have_send)){
                    $url  = $_W['siteroot'].'/app/index.php?i='.$value['uniacid'].'&c=entry&do=cron&m=lianhu_school';   
                    file_get_contents($url);
                    $have_send[] = $value['uniacid'];
                }
            }
        }      
    }
    */


}