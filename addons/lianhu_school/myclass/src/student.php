<?php
namespace myclass\src;

class student extends common {
    public  $class_id;
    public  $grade_id;
    public  $student_data; 
    public  $hash_add_str = 'asdas;#sdf';

    public function __construct(){
        $this->student_data    = array(
            array('key'=>'student_name','name'=>'学生姓名'),
            array('key'=>'parent_name','name'=>'联系人'),
            array('key'=>'parent_phone','name'=>'联系人电话'),
            array('key'=>'sms_status','name'=>'是否发送短信【大于0表示发送，等于0不发送】'),
            array('key'=>'rfid','name'=>'ID卡1'),
            array('key'=>'rfid1','name'=>'ID卡2'),
            array('key'=>'rfid2','name'=>'ID卡3'),
            array('key'=>'active_rfid','name'=>'有源卡值'),
        );
        
        $this->setGlobal();
        $this->setTable("lianhu_student");
    }
    
    public function _set($name,$value){
        $this->$name = $value;
    }
    public function add($arr){
        global $_W;
        $add_id = parent::add($arr);
        $middle_student = M('student');
        if($middle_student){
            $in['grade_id']     = $arr['grade_id'];
            $in['class_id']     = $arr['class_id'];
            $in['student_name'] = $arr['student_name'];
            $in['student_img']  = $_W['attachurl'].$arr['student_img'];
            $in['school_id']    = $this->school_id;
            $in['parent_name']  = $arr['parent_name'];
            $in['parent_mobile']= $arr['parent_phone'];
            $in['system_number']= $arr['student_passport'];
            $middle_student->action($add_id,$in);
        }
        return $add_id;
    }
    public function edit($where,$up=false){
        global $_W;
        if($this->school_id){
            $where['school_id'] = $this->school_id;
        }
        $result             = parent::edit($where,$up);
        $middle_student     = M('student');
        if($up && $middle_student && $result){
            $openids           = $this->returnEfficeOpenid($result,3);
            $result['openid1'] = $openids['f_openid'] ? $openids['f_openid']:"N";
            $result['openid2'] = $openids['s_openid'] ? $openids['s_openid']:"N";
            $result['openid3'] = $openids['t_openid'] ? $openids['t_openid']:"N";
            $result['student_img']    = $_W['attachurl'].$result['student_img'];
            $result['openid_student'] = $result['student_uid'] ? S("base","uid2openid",array($result['student_uid'])) :"N";
            $result['parent_mobile']  = $result['parent_phone']; 
            $result['system_number']  = $result['student_passport'];
            $middle_student->action($result['student_id'],$result);
        }
        return $result;
    }
    //student_name
    public function getStudentName($student_id){
        $this->field_str    = "student_name";
        $where["student_id"]= $student_id;
        $re = $this->edit($where);
        return $re['student_name'];
    }
    //学校学生列表
    public function getStudentlist(){
        $params[':school_id'] = $this->school_id;
        $params[":status"]    = 1;
        $where               .= " school_id =:school_id and status=:status ";
        $list                 = pdo_fetchall( "select *  from ".$this->table." where ".$where." ",$params );
        return $list;
    }
    //改正学生错乱[孤寂]
    public  function fixRight(){
        $class_classes = D('classes');
        $list = $this->getStudentlist();
        foreach ($list as $key => $value) {
            $grade_id = $class_classes->getClassGradeId($value['class_id']);
            $where['student_id'] = $value['student_id'];
            $up['grade_id']      = $grade_id;
            $this->edit($where,$up);
        }
    }
    //班级学生列表
    public function getClassStudentList(){
        $params[":status"]    = 1;
        $params[':class_id']  = $this->class_id;
        $where                = S("fun","composeParamsToWhere",array($params));
        $list                 = pdo_fetchall( "select *  from ".$this->table." where ".$where." ",$params );
        return $list;        
    }
    //学校学生人数总数
    //年级有效
    public function getStudentCount(){
        $params[':school_id'] = $this->school_id;
        $params[":status"]    = 1;
        $where               .= " student.school_id =:school_id and student.status=:status and  grade.school_id =:school_id and grade.status=:status ";
        $count                =  pdo_fetchcolumn( "select count(student_id) from ".$this->table." student left join ".tablename('lianhu_grade')." grade on student.grade_id = grade.grade_id
                                 where ".$where." ",$params );
        return $count;
    }
    //有绑定的学校总人数
    public function getBdStudentCount($all_student_list){
        $num = 0;
        foreach ($all_student_list as $key => $value) {
            if( $value['fanid']>0 || $value['fanid1']>0 || $value['fanid2']>0 ){
                $num++;
            }
        }
        return $num;
    }
    //年级_班级学生人数
    public function getGradeClassStudent(){
        if($this->grade_id){
            $params[":grade_id"] = $this->grade_id;
        }
        if($this->class_id){
            $params[":class_id"] = $this->class_id;
        }
        $params[":status"]       = 1;
        $params[":school_id"]    = $this->school_id;
        $where                   = S("fun","composeParamsToWhere",array($params) );
        $count                   = pdo_fetchcolumn( "select count(*) from ".$this->table." where ".$where." ",$params );
        $bangding_count          = pdo_fetchcolumn( "select count(*) from ".$this->table." where ".$where." and ( uid>0 or uid1>0 or uid2 >0 ) ",$params );
        $list                    = pdo_fetchall( "select  * from ".$this->table." where ".$where." ",$params );
        return array("list"=>$list,'count'=>$count,'bangding_count'=>$bangding_count);
    }
    //年级的学生毕业了
    public function resoveEndStudent($grade_id){
        $where['grade_id'] = $grade_id;
        $up['status' ]     = 2;
        pdo_update('lianhu_student',$up,$where);        
    }
    //根据绑定身份返回响应的头消息和尾部消息
    public function rebackHeadEndTextByRelation($openid,$student_id){
        $class_base     = new base();
        $uid            = base::openid2uid($openid);
        $fanid          = $class_base->mobileGetFanidByUid($uid);
        $relation_name  = $this->getRelation($student_id,$fanid);
        $student_info   = $this->getStudentInfo($student_id);
 		if($relation_name =='自己' ){
			$first_head = $student_info['student_name']."同学你好，";
            $end_head   = "self";
         }
        elseif($relation_name){
			$first_head = $student_info['student_name']."的".$relation_name.'您好,';
            $end_head   = 'elder';//长辈
        }
	    else{
			$first_head = $student_info['student_name']."的家长您好,";       
            $end_head   = 'elder';//长辈
        }
        return array('first'=>$first_head,'end'=>$end_head);
    }
    //孩子关系检重
    public function validStduentRelation($student_id,$relation_name){
        $where[':student_id']    = $student_id;
        $where[':status']        = 1;
        $where[':relation_name'] = $relation_name;
        $where_str               = fun::composeParamsToWhere($where);
        $result = pdo_fetch("select * from  ".tablename('lianhu_student_relation')." where ".$where_str." ",$where);
        if($result){
            return array('errcode'=>1);
        }else{
            return array('errcode'=>0);
        } 
    }
    //注销孩子关系
    public function invalidRelation($student_id,$fanid){
        pdo_update("lianhu_student_relation",array('status'=>0),array("student_id"=>$student_id,'fanid'=>$fanid));
    }
    //删除孩子的所有关系
     public function deleteAllRelation($student_id){
        pdo_delete("lianhu_student_relation",array("student_id"=>$student_id));
    }   
    //获取与孩子的关系
    public function getRelation($student_id,$fanid){
        $where[':student_id']    = $student_id;
        $where[':status']        = 1;
        $where[':fanid']         = $fanid;
        $where_str               = fun::composeParamsToWhere($where);
        $result = pdo_fetch("select relation_name from  ".tablename('lianhu_student_relation')." where ".$where_str." order by relation_id desc ",$where);
        return $result['relation_name'];
    }
    //fanid 和class_id找到孩子的名字
    public function getStudentIdByFanid($fanid,$class_id){
        //首先查找UID
        $where[':fanid']    = $fanid;
        $where[':status']   = 1;
        $where[':class_id'] = $class_id;
        $where_str          = fun::composeParamsToWhere($where);
        $student_id         = pdo_fetchcolumn("select student_id from  ".tablename('lianhu_student_relation')." where ".$where_str." ",$where);
        return $student_id;
    }
    //获取班级里的第一个角色
    public function getCLassFirstRelation($fanid,$class_id){
        $where[':fanid']    = $fanid;
        $where[':status']   = 1;
        $where[':class_id'] = $class_id;
        $where_str          = fun::composeParamsToWhere($where);
        $result = pdo_fetch("select relation_name from  ".tablename('lianhu_student_relation')." where ".$where_str." ",$where);
        return $result['relation_name'];
    }
    //更新与孩子关系
    public function updateRelation($student_id,$fanid,$relation){
        $up['relation_name']    = $relation; 
        $where['student_id']    = $student_id;
        $where['status']        = 1;
        $where['fanid']         = $fanid;
        pdo_update("lianhu_student_relation",$up,$where);
    }
    //绑定时绑定与孩子的关系
    public function insertStudentRelation($student_id,$relation_name,$fanid){
        $student_info   = $this->getStudentInfo($student_id);
        $in['uniacid']  = $student_info['uniacid'];
        $in['school_id']= $student_info['school_id'];
        $in['grade_id'] = $student_info['grade_id'];
        $in['class_id'] = $student_info['class_id'];
        $in['fanid']    = $fanid;
        $in['relation_name'] = $relation_name;
        $in['add_time'] = time();
        $in['student_id']= $student_id;
        pdo_insert('lianhu_student_relation',$in); 
    }
    //student_id获取信息
    public function getStudentInfo($student_id){
        $where[":sid"] = $student_id;
        $result = pdo_fetch("select * from ".$this->table." where student_id=:sid ",$where);
        return $result;
    }
    //获取学生绑定的openid
    public function returnEfficeOpenid($student,$num=1){
       if($student['fanid'] || $student['uid'] ){
            if($student['fanid']){
           		$openid  = S("base","fanid2openid",array($student['fanid']));
            }else{
           		$openid  = S("base","uid2openid",array($student['uid']));
            }
       }
       
       if($student['fanid1'] || $student['uid1'] ){
            if($student['fanid1']){
           		$openid1  = S("base","fanid2openid",array($student['fanid1']));
            }else{
           		$openid1  = S("base","uid2openid",array($student['uid1']));
            }
       }
       if($student['fanid2'] || $student['uid2'] ){
            if($student['fanid2']){
           		$openid2  = S("base","fanid2openid",array($student['fanid2']));
            }else{
           		$openid2  = S("base","uid2openid",array($student['uid2']));
            }
       }
       if($openid){
		   $f_openid = $openid;
	   }elseif(!$openid && $openid1) {
		   $f_openid = $openid1;
	   }elseif(!$openid && !$openid1 && $openid2){
		   $f_openid = $openid2;
	   }       
       if($f_openid){
           if($openid && $openid1){
		   		$s_openid = $openid1;
           }elseif($openid && !$openid1){
		   		$s_openid = $openid2;
           }elseif(!$openid && $openid1){
		   		$s_openid = $openid2;
           }
       }
      if($openid2 && $openid1 && $openid){
		    $t_openid = $openid2;
       }    
       if(!$f_openid && $student['sms_status']){
           $num      = 1;
           $f_openid = 'sms'; 
       }
       if($num==1){
         return array('f_openid'=>$f_openid);
       }elseif($num==2){
         return array('f_openid'=>$f_openid,'s_openid'=>$s_openid);
       }elseif($num==3){
         return array('f_openid'=>$f_openid,'s_openid'=>$s_openid,'t_openid'=>$t_openid);       
       }
    }   
    //家长绑定数
    public function studentBdCount($student){
        $hi = 0;
        if($student['fanid']){
            $hi++;
        }
        if($student['fanid1']){
            $hi++;				
        }
        if($student['fanid2']){
            $hi++;
        }        
        return $hi;
    }

    //获取学生二维码
    public function getStudentQrcode($student_id){
        global $_W;
        $student_info = $this->getStudentInfo($student_id);
        $hash_str     = sha1(md5($student_info['class_id'].$student_info['grade_id'].$student_info['xuhao'].$this->hash_add_str));
        $arr          = array("hash"=>$hash_str,"sid"=>$student_id);
        $url          = D('base')->createMobileUrl('studentlLive',$arr);
        $base_dir     = D('base')->createAttaFile();
        $file_name    = $base_dir.time().rand(111111,999999).'.png';   
        \QRcode::png($_W['siteroot'].'app/'.$url,$file_name,'',10,2);
        $up_file_name = str_ireplace(ATTACHMENT_ROOT,'',$file_name);
        return $_W['siteroot'].'attachment/'.$up_file_name;
    }
}