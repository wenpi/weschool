<?php
#此类处理缴费页面的问题

class money{
	public $uid; 		//微信用户uid
	public $fanid; 		//微信用户fanid
	public $openid; 	//微信用户openid
	public $student_id; //学生id
	public $do_action;  //传进来的欲限制的模块动作
	public $uniacid;
	public $money_limit=array();
	public $money_record_last=array();

	public function __construct($do_action){
		global $_W,$_GPC;
		$this->do_action = lcfirst($do_action);
		$this->uid       = getMemberUid();
		$this->openid    = $_W['openid'];
		$this->uniacid   = $_W['uniacid'];
		if($this->uid){
			$student_id      = $this->uid_to_studentId();
		}
		if($student_id){
			$this->student_id=$student_id;
		}
	}
	public function uid_to_studentId(){
		if($_SESSION['student_id']){
			return $_SESSION['student_id'];
		}
		$uid 		 = $this->uid;
		$fanid 		 = D("base")->mobileGetFanidByUid($uid);
		$this->fanid = $fanid;
		$student_id  = pdo_fetchcolumn("select student_id from ".tablename('lianhu_student')." where uniacid=:uniacid and school_id=:sid and (uid=:uid or uid1=:uid1 or uid2=:uid2) ",
					  array(':uniacid'=>$this->uniacid,':sid'=>$_SESSION['school_id'],':uid'=>$uid,':uid1'=>$uid,':uid2'=>$uid));
		if(!$student_id){
			$student_id  = pdo_fetchcolumn("select student_id from ".tablename('lianhu_student')." where uniacid=:uniacid and school_id=:sid and (fanid=:fanid or fanid1=:fanid1 or fanid2=:fanid2) ",
						  array(':uniacid'=>$this->uniacid,':sid'=>$_SESSION['school_id'],':fanid'=>$fanid,':fanid1'=>$fanid1,':fanid2'=>$fanid2));
		}
		return $student_id;
	}
	#获取相应缴费规则
	public function get_money_limit($much=false){
		global $_GPC;
		$student_info  = pdo_fetch("select class_id,grade_id from ".tablename('lianhu_student')." where student_id = :sid ",
		 			   array(':sid'=>$this->student_id));
		if(!$student_info){
			return false;
		}
		$class_id = $student_info['class_id'];
		$grade_id = $student_info['grade_id'];
		$where_str= " and  (school_limit_type =0 or ( school_limit_type=1 and ( grade_ids like '{$grade_id}%,' or grade_ids like '%,{$grade_id},%'  or grade_ids like '%,{$grade_id}' or grade_ids={$grade_id}   )  ) 
					  or   (school_limit_type =2  and ( class_ids like '{$class_id}%,' or class_ids like '%,{$class_id},%'  or class_ids like '%,{$class_id}' or class_ids={$class_id}   ) )   ) ";
		if($_GPC['lid']){
			$result   = pdo_fetch("select * from ".tablename('lianhu_money_limit')." where  school_id=:sid and limit_id = :limit_id and  status=1  {$where_str} order by add_time desc  ",
						array(':sid'=>$_SESSION['school_id'],':limit_id'=>$_GPC['lid'] ));
			
		}else{
			$limit_module = " limit_module = :limit_module or limit_module like :limit_module1 or limit_module like :limit_module2 or limit_module like :limit_module3  ";
			$arr = array(
				":limit_module" => $this->do_action,
				":limit_module1"=> $this->do_action.',%',
				":limit_module2"=> '%,'.$this->do_action.',%' ,
				":limit_module3"=> '%,'.$this->do_action,
				':sid' 			=> $_SESSION['school_id'],
			);
			if(!$much){
				$result   	  = pdo_fetch("select * from ".tablename('lianhu_money_limit')." where  school_id=:sid and (".$limit_module.") and  status=1  {$where_str} order by add_time desc  ", $arr);
			}else{
				$result   	  = pdo_fetchall("select * from ".tablename('lianhu_money_limit')." where  school_id=:sid and (".$limit_module.") and  status=1  {$where_str}   ", $arr);
				return $result;
			}
						
		}
		$this->money_limit = $result;
	}
	#获取最后一次缴费历史
	public function last_money_record(){
		$limit_id 				= $this->money_limit['limit_id'];
		$params["student_id"] 	= $this->student_id;
		$params["limit_id"] 	= $limit_id;
		$params["status"] 		= 1;
		$result 			    = D("moneyRecord")->edit($params);
		$this->money_record_last = $result;	
	}
	public function lastSmsMoneyRecord($phone ){
		$limit_id = $this->money_limit['limit_id'];
		$result   = pdo_fetch("select * from ".tablename("lianhu_money_record")." where 
							  limit_id=:lid and status=1 and school_id=:sid and mobile=:mobile 
							   order by addtime desc",
							  array(':lid'=>$limit_id,':sid'=>$_SESSION['school_id'],':mobile'=>$phone ));
		$this->money_record_last=$result;	
	}
	// 是否收费判断
	// true 不需收费 false 需收费
	public function money_judge(){
		//没有绑定学生不执行收费
		$student_id = $this->uid_to_studentId();
		if(!$student_id){
			return true;
		}
		$this->get_money_limit();
		if(empty($this->money_limit) || $this->money_limit['limit_much'] < 0.001){
			return true;
		}	
		$old_money_limit = $this->money_limit;
		$group_id 		 = $this->money_limit['group_id'];

		if($group_id){
			$group_limit_list = D("moneyLimit")->getListByXiao($group_id);
		}else{
			$group_limit_list[] = $old_money_limit;
		}
		foreach ($group_limit_list as $key => $value) {
			$result = $this->judeGroup($value);
			if($result){
				return true;
			}
		}
		return false;
	}
	//jude一系列
	public function judeGroup($money_limit){
		$this->money_limit = $money_limit;
		//判断特殊设定
		$student_id = $this->uid_to_studentId();
		$result = D("moneySpec")->getNeedPay($money_limit['limit_id'],$student_id);
		if($result['reduce_money'] >= $this->money_limit['limit_much']){
			return true;
		}		
		$this->last_money_record();
		if($money_limit['limit_type']==1 && $this->money_record_last){
			return true;
		}
		if($this->money_limit['limit_type']==2){
			$next_need_time=$this->money_record_last['addtime']+3600*24*365;
			if($next_need_time >= TIMESTAMP){
    			return true;
			}
		}
		if($this->money_limit['limit_type']==3){
			$next_need_time=$this->money_record_last['addtime']+3600*24*31;
			if($next_need_time>=TIMESTAMP){
				return true;
			}
		}

		return false;		
	}
	//短信收费
	public function judeSmsMoney($parent_phone){
		$this->get_money_limit();
		if(empty($this->money_limit))	
			return true;
		$this->lastSmsMoneyRecord($parent_phone);
		if($this->money_limit['limit_type']==1 && $this->money_record_last) 
			return true;
		if($this->money_limit['limit_type']==2){
			$next_need_time=$this->money_record_last['addtime']+3600*24*365;
			if($next_need_time >= TIMESTAMP) 
			 return true;
		}
		if($this->money_limit['limit_type']==3){
			$next_need_time=$this->money_record_last['addtime']+3600*24*31;
			if($next_need_time>=TIMESTAMP) 
				return true;
		}
		return false;		
	}
	#生成订单，返回订单参数
	#不做其他逻辑判断
	public function money_to_order(){
		global $_W;
		$student_info = pdo_fetch("select * from ".tablename('lianhu_student')." where student_id=:sid ",array(":sid"=>$this->student_id));
		$this->get_money_limit();
		$result = D("moneySpec")->getNeedPay($this->money_limit['limit_id'],$student_info['student_id']);
		if($result['reduce_money']){
				$this->money_limit['limit_much'] -= $result['reduce_money'];
		}				
		$uid 		  = getMemberUid();
		$fanid 		  = D('base')->mobileGetFanidByUid($uid );
		if($this->money_limit){
			$in['uniacid']   = $this->uniacid;
			$in['school_id'] = $_SESSION['school_id'];
			$in['limit_id']  = $this->money_limit['limit_id'];
			$in['limit_much']= $this->money_limit['limit_much'];
			$in['student_id']= $this->student_id;
			$in['fan_id']    = $fanid;
			$in['addtime']   = TIMESTAMP;
			$in['status']    = 0;
			$in['class_id']  = $student_info['class_id'];
			$in['grade_id']  = $student_info['grade_id'];
			$in['mobile'] 	 = $student_info['parent_phone'];
			pdo_insert('lianhu_money_record',$in);
			$insert_id=pdo_insertid();
			$params=array(
				'tid' 		=> $insert_id,
				'ordersn' 	=> "MMD".$insert_id,
				'title' 	=> $this->money_limit['limit_name'],
				'fee' 		=> $this->money_limit['limit_much'],
				'user' 		=> $this->uid,
				);
			return $params;
		}else{
			return false;
		}
	}

}