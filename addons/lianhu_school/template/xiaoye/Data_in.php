<?php
$this->checkAdminWeb();
$admin_result = D('admin')->judeAdminType();
$left_top     = 'school_msg';
$left_nav     = 'data_in';
$title        = '数据导入';  
$sidebar_list = array(
	array('fun_str'=>'','fun_name'=>'学校信息'),
	array('fun_str'=>'data_in','fun_name'=>'数据导入'),
);
if($admin_result['admin']=='teacher'){
	$top_action = array(
		array('action_name'=>'导入成绩' ,'action'=>'data_in','arr'=>array('ac'=>'score') ),
		array('action_name'=>'编辑成绩' ,'action'=>'Score_list' ),
	);
	$page_name = '导入成绩';
}else{
	$top_action = array(
		array('action_name'=>'导入年级','action'=>'data_in','arr'=>array('ac'=>'grade' ) ),
		array('action_name'=>'导入班级' ,'action'=>'data_in','arr'=>array('ac'=>'class') ),
		array('action_name'=>'导入教师' ,'action'=>'data_in','arr'=>array('ac'=>'teacher' ) ),
		array('action_name'=>'导入学生' ,'action'=>'data_in','arr'=>array('ac'=>'student') ),
		array('action_name'=>'补充学生资料' ,'action'=>'data_in','arr'=>array('ac'=>'student_data' ) ),
		array('action_name'=>'补充教师资料' ,'action'=>'data_in','arr'=>array('ac'=>'teacher_data' ) ),
		array('action_name'=>'导入成绩' ,'action'=>'data_in','arr'=>array('ac'=>'score') ),
		array('action_name'=>'考试记录' ,'action'=>'data_in','arr'=>array('ac'=>'score_list_jilv') ),
		array('action_name'=>'新建考试记录' ,'action'=>'data_in','arr'=>array('ac'=>'score_list_jilv','op'=>'create' ) ),
	);
	$page_name = '导入年级';
	if($ac=='class'){
		$page_name = '导入班级';
	}elseif($ac=='teacher'){
		$page_name = '导入教师';
	}elseif($ac=='student'){
		$page_name = '导入学生';
	}elseif($ac=='student_data'){
		$page_name = '补充学生资料';
	}elseif($ac=='teacher_data'){
		$page_name = '补充教师资料';
	}elseif($ac=='score'){
		$page_name = '导入成绩';
	}elseif($ac=='score_list_jilv' && $_GPC['op']=='create'){
		$page_name = '新建考试记录';
	}elseif($ac=='score_list_jilv'){
		$page_name = '考试记录';
	}
}
require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
$school_id 	   = getSchoolId();
$class_student = D('student');
$teacher 	   = $this->teacher_qx('no');
$ac 	 	   = $ac=='list' ? 'grade': $ac;

if( $teacher== 'teacher' && $ac=='grade'){
    $ac='score';
}
if($_GPC['op']=='new'){
	$begin_in=intval($_GPC['begin_in']) ? intval($_GPC['begin_in']):2;
	$success=0;
	$imgtype=pathinfo($_FILES['file']['name']); 
	if($imgtype['extension'] !='xls'){
		$this->myMessage('上传的文件格式不对，请检查','','错误'); 

	}
	$file_name=$this->file_upload($_FILES['file'],'application/vnd.ms-excel');
	if($file_name['success']!=true){
		var_dump($file_name);
		exit("上传失败");
	}else{
		$upload_file_name=ATTACHMENT_ROOT.'/'.$file_name['path'];
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load($upload_file_name);
		$currentSheet = $objPHPExcel->getSheet(0);
		/**取得最大的列号*/
		$allColumn = $currentSheet->getHighestColumn(); 			
		/**取得一共有多少行*/
		$allRow = $currentSheet->getHighestRow(); 		
	}
}
$school_uniacid=" and ".$this->where_uniacid_school;
if($ac=='grade'){
	//管理员权限
	$this->teacher_qx();
	if($op=='new'){
		$grade_name = strtoupper($_GPC['grade_name']);
		if(empty($grade_name)){
			$this->myMessage('没有设置列','','error');
		}
		$class_grade    = D('grade');
		for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				   if($currentColumn ==$grade_name){
				   		if(empty($val)){
							continue;
						}
				   		$grade_name_from_excel = (string)$val;
						$grade_name_from_excel = str_replace("\t",'',$grade_name_from_excel);
						$where 	 			   = array('grade_name'=>$grade_name_from_excel);
					    $where['school_id'] = getSchoolId();
						$have_or_not 	= $class_grade->edit($where);
				   		if(!$have_or_not){
							  $class_grade->addGrade('',$grade_name_from_excel);
							  $success++;
						}else{
							$error_in .="{$grade_name_from_excel}插入失败,";
						} 
				   }
			}
		}
	}
}
if($ac=='class'){
    #导入班级
	$this->teacher_qx();//管理员权限
	if($op=='new'){
		$class_name=strtoupper($_GPC['class_name']);
		$grade_name=strtoupper($_GPC['grade_name']);
		$in_arr=array();
		if(empty($grade_name) || empty($class_name) ){
			$this->myMessage('没有设置列','','错误');
		}
			for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				/**从第A列开始输出*/
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				   if($currentColumn == $grade_name){
				   		if(empty($val)){
							   continue;
						}
				   		$grade_name_from_excel  = (string)$val;
				   		$grade_id 				= pdo_fetchcolumn("select grade_id from {$table_pe}lianhu_grade where grade_name=:name {$school_uniacid} ",array(':name'=>$grade_name_from_excel));
				   		if(!$grade_id){
							$error_in .="没有找到年级：{$grade_name_from_excel}插入失败,";
							continue;
						}else{
							$in_arr[$currentRow]['grade_id'] = $grade_id;
						}
				   }
				   if($currentColumn == $class_name){
				   		if(empty($val)){
							continue;
						}
				   		$class_name_from_excel 			   = (string)$val;
						$class_name_from_excel 			   = str_replace("\t",'',$class_name_from_excel);
				   		$have_or_not           			   = pdo_fetch("select class_id from {$table_pe}lianhu_class where class_name=:name {$school_uniacid} ",array(':name'=>$class_name_from_excel));
						$in_arr[$currentRow]['class_name'] = $class_name_from_excel;
				   }
				}
		}
		foreach ($in_arr as $key => $value) {
			if($value['grade_id'] && $value['class_name']){
				$result 			= D("classes")->findClassByInfo($value['grade_id'],$value['class_name']);
				if(!$result){
					$success++;
					D('classes')->add($value);
				}else{
					$error_in .="该班级名已经存在：{$value['class_name']}插入失败,";
				}
			}
		}
	}	
}
if($ac=='teacher'){
	$this->teacher_qx();//管理员权限
	$class_admin = D('admin');
	if($op == 'new'){
		$teacher_realname   = strtoupper($_GPC['teacher_realname']);
		$teacher_telphone 	= strtoupper($_GPC['teacher_telphone']);
		$passport 			= strtoupper($_GPC['passport']);
		$password       	= strtoupper($_GPC['password']);
		$in_arr 			= array();
		if(empty($teacher_realname) || empty($teacher_telphone)||empty($passport)||empty($password) ){
			$this->myMessage('没有设置列','','error');		
		}
		for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				/**从第A列开始输出*/
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				   if($currentColumn == $teacher_realname){
				   		if(empty($val)){
							   continue;
						}
						$in_arr[$currentRow]['teacher_realname'] = (string)$val;
						$in_arr[$currentRow]['teacher_realname'] = str_replace("\t",'',$in_arr[$currentRow]['teacher_realname']);
				   }
				   if($currentColumn == $teacher_telphone){
				   		if(empty($val)){
						   continue;
						}
						$in_arr[$currentRow]['teacher_telphone'] = (string)$val;				   		
						$in_arr[$currentRow]['teacher_telphone'] = str_replace("\t",'',$in_arr[$currentRow]['teacher_telphone']);
				   }
				   if($currentColumn == $password){
					   if(empty($val))
						   	continue;
					   $in_arr[$currentRow]['password']    = (string)$val;
					   $in_arr[$currentRow]['password'] = str_replace("\t",'',$in_arr[$currentRow]['password']);
				   }
				   if($currentColumn==$passport){
				   		if(empty($val))
						   	continue;
					    $result = $class_admin->getJiaAdmin((string)$val);
						if(!$result){
							  $in_arr[$currentRow]['passport']   = (string)$val;
					   		  $in_arr[$currentRow]['passport'] = str_replace("\t",'',$in_arr[$currentRow]['passport']);
						}
				   }
				}
		}		
		if($in_arr){
			foreach ($in_arr as $key => $value){
				if($value['teacher_realname'] && $value['teacher_telphone'] && $value['passport'] && $value['password']){
					$in['teacher_realname'] 	= $value['teacher_realname'];
					$in['teacher_telphone'] 	= $value['teacher_telphone'];
					$in['school_id'] 			= $school_id;
					$in['uniacid'] 				= $_W['uniacid'];
					$passport  					= $value['passport'];
					$password  					= $value['password'];
					$user_in['passport'] 	    = $passport;
					$user_in['password']        = $password;
					$user_in['db_group_id']     = 0;
					$user_in['data_group_id']   = 0;
					$user_in['admin_img']       = $value['teacher_img'];
					$user_in['admin_name']      = $value['teacher_realname'];
					$user_id 				    = $class_admin->addJiaAdmin($user_in);
					$in['admin_id'] 		    = $user_id;
					$in['addtime']      	    = TIMESTAMP;
					$in['have_up'] 		 	    = 1;					
					pdo_insert('lianhu_teacher',$in);
					$teacher_id 			    = pdo_insertid();
					$class_admin->updateJiaAdmin($user_id,'teacher_id',$teacher_id);
					$success++;
				}else{
					$error_in .= "错误的数据：【姓名：".$value['teacher_realname']."、电话：".$value['teacher_telphone']."、账号：".$value['passport']."、密码：".$value['password']."】<br>";
				}
			}
		}else{
			$error_in = "没有找到可以插入的教师数据";
		}
	}	
}
if($ac=='student'){
    #导入学生
    $class_list = $this->teacher_main();
    $grade_list = pdo_fetchall("select * from {$table_pe}lianhu_grade where status=1 {$school_uniacid} order by grade_id desc ");
	if($op=='new'){
		$class_name   = strtoupper($_GPC['class_name']);
		$student_name = strtoupper($_GPC['student_name']);
		$student_code = strtoupper($_GPC['student_code']);
		$mobile       = strtoupper($_GPC['mobile']);
		$mobile_use   = strtoupper($_GPC['mobile_use']);
		$in_arr=array();
		if(empty($class_name) || empty($student_name)||empty($student_code) ){
			$this->myMessage('没有设置列','','错误');
		}
		for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				/**从第A列开始输出*/
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				   if($currentColumn == $class_name){
				   		if(empty($val)){
						   continue;
						}
				   		$class_name_from_excel = (string)$val;
						$class_name_from_excel = str_replace("\t",'',$class_name_from_excel);
				   		$class_re 			   = pdo_fetch("select grade_id,class_id from {$table_pe}lianhu_class where class_name=:name and grade_id=:gid {$school_uniacid} ",array(':name'=>$class_name_from_excel,':gid'=>$_GPC['grade_id']));
				   		if(!$class_re){
							$error_in .="没有找到该班级：{$class_name_from_excel}插入失败,";
							continue;
						}else{
							$in_arr[$currentRow]['class_id']=$class_re['class_id'];
							$in_arr[$currentRow]['grade_id']=$class_re['grade_id'];
						}
				   }
				   if($currentColumn == $student_name){
				   		if(empty($val)){
						   continue;
						}
				   		$student_name_from_excel 			 = (string)$val;
						$student_name_from_excel 			 = str_ireplace("\r",'',$student_name_from_excel);
						$student_name_from_excel 			 = str_ireplace("\n",'',$student_name_from_excel);
						$student_name_from_excel 			 = str_ireplace("\t",'',$student_name_from_excel);
						$in_arr[$currentRow]['student_name'] = $student_name_from_excel;				   		
				   }
				   if($currentColumn == $mobile){
					   if(empty($val)){
						   	continue;
					   }
						$mobile_from_excel 					= (string)$val;
						$mobile_from_excel = str_replace("\t",'',$mobile_from_excel);
						$in_arr[$currentRow]['parent_phone']= $mobile_from_excel;	
				   }
				   if($currentColumn == $mobile_use){
					   if(empty($val))
						   	continue;
						$sms_status_from_excel	= (int)$val;
						$sms_status_from_excel	= str_replace("\t",'',$sms_status_from_excel);
						$in_arr[$currentRow]['sms_status'] 	= $sms_status_from_excel;	
				   }				   
				   if($currentColumn==$student_code){
				   		if(empty($val)){
						   	continue;
						}
				   		$student_code_from_excel = (string)$val;
						$student_code_from_excel = str_replace("\t",'',$student_code_from_excel);
				   		$have_or_not             = pdo_fetch("select student_id from {$table_pe}lianhu_student where xuehao=:xuehao {$school_uniacid} ",array(':xuehao'=>$student_code_from_excel));
				   		if($have_or_not){
							   $error_in 		.= "该学号已经存在：{$student_code_from_excel}插入失败,";
							   continue;
						}else{
							$in_arr[$currentRow]['xuehao'] = $student_code_from_excel;
						}
				   }
				}
		}
		foreach ($in_arr as $key => $value) {
			if($value['xuehao'] && $value['class_id']){
				$insert_id = D('student')->add($value);;
				$success++;
				pdo_update('lianhu_student',array('student_passport'=>$value['class_id'].$insert_id),array('student_id'=>$insert_id));				
			}else{
				$error_in.= "{$value['xuehao']}----{$value['class_id']}--关系不存在&nbsp;&nbsp;&nbsp;";
			}
		}
	}	
}
if($ac=='student_data'){
	if($op=='new'){
		$student_data_type   = $_GPC['student_data_type'];
		$student_data 		 = strtoupper($_GPC['student_data']);
		$student_code 		 = strtoupper($_GPC['xuehao']);
		$in_arr 			 = array();
		if(!$student_data || !$student_code){
				$this->myMessage('全都需要设置','','错误');
		}
		for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				   if($currentColumn == $student_data){
				   		if(empty($val))
						   continue;
				   		$student_data_from_excel						= (string)$val;
						$student_data_from_excel 						= str_replace("\t",'',$student_data_from_excel);
						$in_arr[$currentRow]['student_data']			= $student_data_from_excel;				   		
				   }
				   if($currentColumn==$student_code){
				   		if(empty($val))
						   	continue;
				   		$student_code_from_excel = $val;
				   		$have_or_not             = pdo_fetch("select student_id from {$table_pe}lianhu_student where xuehao=:xuehao {$school_uniacid} ",array(':xuehao'=>$student_code_from_excel));
				   		if(!$have_or_not){
							   $error_in 		.= "该学号不存在：{$student_code_from_excel}插入失败,";
							   continue;
						}else{
								$in_arr[$currentRow]['student_id'] = $have_or_not['student_id'];
						}
				   }
				}			
		}
		if($in_arr){
			foreach ($in_arr as $key => $value) {
				$params[$student_data_type] = $value['student_data'];
				$where['student_id'] 		= $value['student_id'];
				pdo_update("lianhu_student",$params,$where);
				$success++;
			}
		}
	}	
}
if($ac=='teacher_data'){
	if($op=='new'){
		$teacher_data_type   = $_GPC['teacher_data_type'];
		$teacher_data 		 = strtoupper($_GPC['teacher_data']);
		$passport    		 = strtoupper($_GPC['passport']);
		$in_arr 			 = array();	
		if(!$passport || !$teacher_data){
				$this->myMessage('全都需要设置','','错误');
		}		
		for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/

				   if($currentColumn == $teacher_data){
				   		if(empty($val))
						   continue;
				   		$student_data_from_excel						= (string)$val;
						$student_data_from_excel 						= str_replace("\t",'',$student_data_from_excel);
						$in_arr[$currentRow]['teacher_data']			= $student_data_from_excel;				   		
				   }
				   if($currentColumn==$passport){
				   		if(empty($val))
						   	continue;
				   		$student_code_from_excel = $val;
				   		$have_or_not  = D('admin')->getJiaAdmin($student_code_from_excel);
				   		
						if(!$have_or_not || !$have_or_not['teacher_id']){
							   $error_in 		.= "该账号不存在或者不是教师账号：{$student_code_from_excel}插入失败,";
							   continue;
						}else{
								$in_arr[$currentRow]['teacher_id'] = $have_or_not['teacher_id'];
						}
				   }
				}			
		}
		if($in_arr){
			foreach ($in_arr as $key => $value) {
				$params[$student_data_type] = $value['teacher_data'];
				$where['teacher_id'] 		= $value['teacher_id'];
				pdo_update("lianhu_teacher",$params,$where);
				$success++;
			}
		}		
	}
}
if($ac=='score'){
    #导入成绩
    $class_list=$this->teacher_main(1);//获取老师，已经授课老师的班级列表
	if($op=='new'){
		$class_id  = $_GPC['class_id'];
		$course_id = $_GPC['course_id'];
		$grade_id    = pdo_fetchcolumn("select grade_id from {$table_pe}lianhu_class where class_id=:cid",array(':cid'=>$class_id));
		$course_name = pdo_fetchcolumn("select course_name from {$table_pe}lianhu_course where course_id=:cid ",array(':cid'=>$course_id));
		$teahcer_re  = pdo_fetch("select * from {$table_pe}lianhu_teacher where 
        (course_id ={$course_id} or course_id like '{$course_id},%' or course_id like '%,{$course_id},%' or course_id like '%,{$course_id}'   ) 
        and teacher_other_power like :power {$school_uniacid} ",array(":power"=>"%{$class_id}%"));
		if(!$course_name || !$teahcer_re){
			$this->myMessage('没有找到课程或者没有找到负责次班级此课程的老师无法导入！','','错误');
		}
		$student_code = strtoupper($_GPC['student_code']);
		$score        = strtoupper($_GPC['score']);
		$in_arr       = array();
		if(empty($score) || empty($student_code)){
			$this->myMessage('没有设置列','','错误');
		}
		for($currentRow = $begin_in;$currentRow <= $allRow;$currentRow++){
				/**从第A列开始输出*/
				for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				   $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();
                   /**ord()将字符转为十进制数*/
				   if($currentColumn ==$student_code){
				   		if(empty($val)){
							   continue;
						}
				   		$student_code_from_excel = $val;
				   		$student_re              = pdo_fetch("select student_id,student_name from {$table_pe}lianhu_student where xuehao=:code  and class_id=:cid  ",array(':code'=>$student_code_from_excel,':cid'=>$class_id));
				   		if(!$student_re){
							   $error_in .= "{$student_code_from_excel}插入失败,";
							   continue;
						}else{ 
							$in_arr[$currentRow]['student_id']=$student_re['student_id'];
						}
				   }
				   if($currentColumn==$score){
				   		$score_from_excel             = intval($val);
						$in_arr[$currentRow]['score'] = $score_from_excel;				   		
				   }
				}
		}
		$class_scoreList = D('scoreList');
		foreach ($in_arr as $key => $value) {
			if($value['score'] && $value['student_id']){
					$where["course_id"] = $course_id;
					$where["class_id"]  = $class_id;
					$where["ji_lv_id"]  = $_GPC['jilv_id'];
					$where['student_id']= $value['student_id'];
					$result 			= $class_scoreList->edit($where);
					if($result){
						$up["score"] = $value['score'];
						$class_scoreList->edit($where,$up);
					}else{
						$value['addtime']    = TIMESTAMP;
						$value['uid'] 	     = $_W['uid'];
						$value['course_id']  = $course_id;
						$value['class_id']   = $class_id;
						$value['grade_id']   = $grade_id;
						$value['ji_lv_id']   = $_GPC['jilv_id'];
						$value['teacher_id'] = $teahcer_re['teacher_id'];
						$class_scoreList->add($value);
					}
					$success++;
			}
		}
	}	
}
if($op == 'new'){
	$message="成功插入 ".$success." 个;<br>".$error_in;
}
if($ac=='score_list_jilv'){
    $this->teacher_qx(); //管理员权限
	if($op=='list'){
		$total               = pdo_fetchcolumn("select count(*) num from {$table_pe}lianhu_scorejilv where status !=2  {$school_uniacid} ");
		$school_uniacid_jilv = " and jilv.uniacid={$_W['uniacid']} and jilv.school_id={$school_id}";
		$list                = pdo_fetchall("select jilv.*,grade.grade_name from {$table_pe}lianhu_scorejilv jilv 
										left join {$table_pe}lianhu_grade grade on grade.grade_id=jilv.grade_id where jilv.status !=2  {$school_uniacid_jilv} order by addtime  {$sql_limit}");
	}elseif($op=='edit'){
		if($_GPC['submit']){
			$in['status']  			= $_GPC['status'];
			$in['scorejilv_name']   = $_GPC['scorejilv_name'];
			pdo_update('lianhu_scorejilv',$in,array('scorejilv_id'=>$_GPC['jilv_id']));
			$this->myMessage('更新成功',$this->createWebUrl('data_in', array('ac' => 'score_list_jilv','op'=>'list','aw'=>$aw)),'成功');
		}
		$result 	= pdo_fetch("select * from {$table_pe}lianhu_scorejilv where scorejilv_id=:id ",array(':id'=>$_GPC['jilv_id']));
		$grade_list=pdo_fetchall("select * from {$table_pe}lianhu_grade where status=1 {$school_uniacid} ");
	}elseif($op=='create'){
		$grade_list=pdo_fetchall("select * from {$table_pe}lianhu_grade where status=1 {$school_uniacid}");
		if($_GPC['submit']){
			$in['status']  			= $_GPC['status'];
			$in['scorejilv_name']   = $_GPC['scorejilv_name'];
			$in['grade_id'] 		= $_GPC['grade_id'];
			$in['addtime'] 			= TIMESTAMP;
			$in['uniacid'] 			= $_W['uniacid'];
			$in['school_id'] 	    = $school_id;				
			pdo_insert('lianhu_scorejilv',$in);
			$this->myMessage('新增成功',$this->createWebUrl('data_in', array('ac' => 'score_list_jilv','op'=>'list','aw'=>$aw)),'成功');
		}
	}elseif($op=='delete'){
		if($_GPC['jilv_id']){
			$where['scorejilv_id'] = $_GPC['jilv_id'];
			$where['school_id']    = $school_id;
			pdo_delete('lianhu_scorejilv',$where);
			$this->myMessage('删除',$this->createWebUrl('data_in', array('ac' => 'score_list_jilv','op'=>'list','aw'=>$aw)),'成功');
		}
	}
}
	include $this->template('../admin/web_data_in');
	exit();
	