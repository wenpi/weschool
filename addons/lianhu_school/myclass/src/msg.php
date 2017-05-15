<?php 
namespace myclass\src;

class msg{
    public $in_class_base;
	public $msg_student_id;
	public $every_page =20;
	
	//解析学校消息[学校通知]
	public function decodeSchoolMsg($first,$key2,$key4,$remark){
         $config    = $this->in_class_base->web_config;  
		 $mu_id 	= $config['msg'];
		 $mu_id01 	= $config['msg01'];
		 if($mu_id){
              $data=array(
				'first'   =>array('value'=>$first ,'color'=>'#ff9900'),//模板概要
				'keyword1'=>array('value'=>$_SESSION['school_name'],'color'=>'#173177'),//学校
				'keyword2'=>array('value'=>$key2,'color'=>'#173177'),//通知人
				'keyword3'=>array('value'=>date("Y-m-d H:i:s",TIMESTAMP),'color'=>'#173177'),//时间
				'keyword4'=>array('value'=>$key4,'color'=>'#173177'),//内容
				'remark'  =>array('value'=>$remark ,'color'=>'#ff9900'),//备注
              );			 
		 }elseif($mu_id01){
			  $mu_id=$mu_id01;
              $data=array(
				'first'   =>array('value'=>$first ,'color'=>'#ff9900'),
				'keyword1'=>array('value'=>$_SESSION['school_name'],'color'=>'#173177'),
				'keyword2'=>array('value'=>$key2."在".date("Y-m-d H:i:s",TIMESTAMP)."发布了".$key4,'color'=>'#173177'),
				'remark'  =>array('value'=>$remark ,'color'=>'#ff9900'),
              );				 
		 } 
		 return array("data"=>$data,'mu_id'=>$mu_id );		
	}
    //解析模板消息 第二条['班级消息']
    public function decodeMsg1($first,$key1,$key2,$key4,$remark){
         $config    = $this->in_class_base->web_config;  
 		 $mu_id1	= $config['msg1'];
		 $mu_id11 	= $config['msg11'];
		 if($mu_id1){
              $data=array(
				'first'   =>array('value'=>$first ,'color'=>'#ff9900'),
				'keyword1'=>array('value'=>$key1,'color'=>'#173177'),
				'keyword2'=>array('value'=>$key2,'color'=>'#173177'),
				'keyword3'=>array('value'=>date("Y-m-d H:i:s",TIMESTAMP),'color'=>'#173177'),
				'keyword4'=>array('value'=>$key4,'color'=>'#173177'),
				'remark'  =>array('value'=>$remark ,'color'=>'#ff9900'),
              );			 
		 }elseif($mu_id11){
			  $mu_id1 = $mu_id11;
              $data=array(
				'first'   =>array('value'=>$first ,'color'=>'#ff9900'),
				'keyword1'=>array('value'=>$key1,'color'=>'#173177'),
				'keyword2'=>array('value'=>$key2."在".date("Y-m-d H:i:s",TIMESTAMP)."发布了".$key4,'color'=>'#173177'),
				'remark'  =>array('value'=>$remark ,'color'=>'#ff9900'),
              );				 
		 } 
		 return array("data"=>$data,'mu_id'=>$mu_id1 );       
    }
	//打卡消息
	public function decodeMsgCard($title,$student_name,$time,$status,$remark){
		$config 	= $this->in_class_base->web_config; 
		$mu_id_card = $config['msg_card'];
		if($mu_id_card){
              $data=array(
				'first'     =>array('value'=>$title ,'color'=>'#ff9900'),//title
				'childName' =>array('value'=>$student_name,'color'=>'#173177'),//学生名
				'time'      =>array('value'=>$time,'color'=>'#173177'),//考勤状态
				'status'    =>array('value'=>$status,'color'=>'#173177'),//考勤状态
				'remark'    =>array('value'=>$remark ,'color'=>'#ff9900'),
              );			
			 return array("data"=>$data,'mu_id'=>$mu_id_card );       
		}
	}
	//作业消息
	public function decodeHomeWorkMsg($first,$name,$subject,$content,$remark){
		$config 	  = $this->in_class_base->web_config; 
		$homework_msg = $config['homework_msg'];
		if($homework_msg){
              $data = array(
					'first'   => array('value'=>$first ,'color'=>'#ff9900'),//title
					'name'	  => array('value'=>$name,'color'=>'#173177'),//学生名
					'subject' => array('value'=>$subject,'color'=>'#173177'),
					'content' => array('value'=>$content,'color'=>'#173177'),
					'remark'  => array('value'=>$remark ,'color'=>'#ff9900'),
              );	
			 return array("data"=>$data,'mu_id'=>$homework_msg );       
		}else{
			return $this->decodeMsg1($first,$name,$subject,$content,$remark);
		}
	}
	//家长私信消息
	public function decodeParentMsg($keyword1,$keyword3,$remark){
		$first 		  = "有学生家长给您发消息了";
		$config 	  = $this->in_class_base->web_config; 
		$parent_msg   = $config['parent_msg'];
		if($parent_msg){
              $data = array(
					'first'   	  => array('value'=>$first ,'color'=>'#ff9900'),//title
					'keyword1'	  => array('value'=>$keyword1,'color'=>'#173177'),//学生[家长]
					'keyword2' 	  => array('value'=>date("Y-m-d H:i:s",time()),'color'=>'#173177'),//
					'keyword3' 	  => array('value'=>$keyword3,'color'=>'#173177'),//
					'remark'  	  => array('value'=>$remark ,'color'=>'#ff9900'),//
              );	
			 return array("data"=>$data,'mu_id'=>$parent_msg );   			
		}
	}
	//教师信息消息
	public function decodeTeacherMsg($keyword1,$keyword3,$remark){
		$first 		  = "有老师给您发消息了";
		$config 	  = $this->in_class_base->web_config; 
		$teacher_msg   = $config['teacher_msg'];
		if($teacher_msg){
              $data = array(
					'first'   	  => array('value'=>$first ,'color'=>'#ff9900'),//title
					'keyword1'	  => array('value'=>$keyword1,'color'=>'#173177'),//老师
					'keyword2' 	  => array('value'=>date("Y-m-d H:i:s",time()),'color'=>'#173177'),//
					'keyword3' 	  => array('value'=>$keyword3,'color'=>'#173177'),//
					'remark'  	  => array('value'=>$remark ,'color'=>'#ff9900'),//
              );	
			 return array("data"=>$data,'mu_id'=>$teacher_msg );   			
		}		
	}
	//校内位置消息
	public function decodeSchoolLocus($key1,$key2){
		$first 		   = "您好，孩子的轨迹更新了！";
		$config 	   = $this->in_class_base->web_config; 
		$school_locus  = $config['school_locus'];		
		$remark 	   = '点击可以看今日校内移动轨迹';
		if($school_locus){
              $data = array(
					'first'   	  => array('value'=>$first ,'color'=>'#ff9900'),//title
					'keyword1'	  => array('value'=>$key1,'color'=>'#173177'),//姓名
					'keyword2' 	  => array('value'=>$key2,'color'=>'#173177'),//地点
					'keyword3' 	  => array('value'=>date("Y-m-d H:i:s",time()),'color'=>'#173177'),//
					'remark'  	  => array('value'=>$remark ,'color'=>'#ff9900'),//
              );	
			 return array("data"=>$data,'mu_id'=>$school_locus);   				
		}
	}
	//留言提醒
	public function emailMsg($title,$keyword1,$remark){
		$first 		   = $title;
		$config 	   = $this->in_class_base->web_config; 
		$email_msg     = $config['email_msg'];	
		if($email_msg){
              $data = array(
					'first'   	  => array('value'=>$first ,'color'=>'#ff9900'),//title
					'keyword1'	  => array('value'=>$keyword1,'color'=>'#173177'),//留言人
					'keyword2' 	  => array('value'=>date("Y-m-d H:i:s",time()),'color'=>'#173177'),//时间
					'remark'  	  => array('value'=>$remark ,'color'=>'#ff9900'),//
              );	
			 return array("data"=>$data,'mu_id'=>$email_msg);  			
		}
	}
	//设备电量提醒
	public function batteryMsg($student_name,$batter_num,$bianhao){
		$title = "您好，您孩子".$student_name."的电子学生证电量提醒";
		$config= $this->in_class_base->web_config; 
		$battery_num = $config['battery_num'];	
		$remark = '电子学生证所剩电量不足10%，请及时充电，以保证正常使用。';
		if($battery_num){
              $data = array(
					'first'   	  => array('value'=>$title ,'color'=>'#ff9900'),//title
					'keyword1'	  => array('value'=>$student_name,'color'=>'#173177'),//留言人
					'keyword2'	  => array('value'=>$bianhao,'color'=>'#173177'),//留言人
					'keyword3'	  => array('value'=>$batter_num.'%','color'=>'#173177'),//留言人
					'remark'  	  => array('value'=>$remark ,'color'=>'#ff9900'),//
              );	
			 return array("data"=>$data,'mu_id'=>$battery_num);  			
		}	
	}
	//生成消息队列识别
    public function createQueueNum(){
        do{
            $num    ="QUE".random('29');
            $result =pdo_fetch("select * from ".tablename('lianhu_msg_queue')." where queue_num=:num",array(":num"=>$num));
        }while( $result);
        return $num;
    }	
	//记录进消息队列(模板消息)
    public function insertMsgQueueMu($openid,$data,$mu_id,$url,$queue_num=false){
		global $_W;
		$in['openid']         = $openid;
        $in['queue_content']  = serialize($data);
        $in['url']            = $url;
        $in['mu_id']          = $mu_id;
        $in['add_time']       = time();
        $in['queue_type']     = 1;
        if(!$queue_num){
	         $in['queue_num']     = $this->createQueueNum();
		}else{
	         $in['queue_num']     = $queue_num;
		}
		$in['school_id'] 	  =  getSchoolId();
		//发送时用到禁删
		$in['uniacid'] 		  = $_W['uniacid'];
		$in['admin_uid']      = 0;
		$arr 				  = explode("&",$url);
		foreach ($arr as $key => $value) {
			$end_arr = explode('=',$value);
			if($end_arr[0]=='student_id'){
				$in["student_id"] 	  = $end_arr[1];
				break;
			}elseif($end_arr[0]=='teacher_id'){
				$in["teacher_id"] 	  = $end_arr[1];
				break;
			}
		}
        pdo_insert('lianhu_msg_queue',$in);
        return  $in['queue_num'];
    }
    //记录进消息队列(客服消息)
    public function insertMsgQueueKe($openid,$content,$queue_num=false){
		global $_W;
		if($this->msg_student_id){
        	$in['student_id'] = $this->msg_student_id;
		}
        $in['openid']         = $openid;
        $in['queue_content']  = serialize($content);
        $in['add_time']       = time();
        $in['queue_type']     = 2;
		$in['uniacid'] 		  = $_W['uniacid'];
		if(!$queue_num){
	         $in['queue_num']     = $this->createQueueNum();
		}else{
         	$in['queue_num']     = $queue_num;
		} 
        pdo_insert('lianhu_msg_queue',$in);
        return  $in['queue_num'];
    }    
    //记录进消息队列(短信消息)
    public function insertMsgQueueSms($mobile,$content,$queue_num=false){
		global $_W;
		if($this->msg_student_id){
        	$in['student_id'] = $this->msg_student_id;
		}
        $in['mobile']         = $mobile;
        $in['queue_content']  = serialize($content);
        $in['add_time']       = time();
        $in['queue_type']     = 3;
		$in['uniacid'] 		  = $_W['uniacid'];
        if(!$queue_num){
	         $in['queue_num']     = $this->createQueueNum();
		}else{
	         $in['queue_num']     = $queue_num;  
		} 
        pdo_insert('lianhu_msg_queue',$in);
        return  $in['queue_num'];
    }  

}