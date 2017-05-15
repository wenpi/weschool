<?php 
	require(IA_ROOT.'/framework/library/phpexcel/PHPExcel.php');
	$this->checkAdminWeb();
	$admin_result = D('admin')->judeAdminType();
	$left_top     = 'school_base_set';
	$left_nav     = 'student_set';
	$title        = '学生设置';  
	$sidebar_list = array(
		array('fun_str'=>'adminindex','fun_name'=>'系统首页'),
		array('fun_str'=>'student','fun_name'=>'学生设置'),
	);
	$top_action = array(
		array('action_name'=>'学生列表','action'=>'student' ),
		array('action_name'=>'添加学生','action'=>'student','arr'=>array('ac'=>'new') ),
	);
	$page_name    = '学生列表';
	if($ac=='new'){
		$page_name    = '添加学生';
	}

	$admin       = $this->teacher_qx('no');
	$class_list  = $this->teacher_main();
	if($admin == 'teacher'){
		foreach ($class_list as $key => $value) {
			$teacher_class_arr[$key] = $value['class_id'];
		}
	}
	$class_grade 	 = D('grade');
	$class_student 	 = D('student');
	$grades 		 = $class_grade->gradeClass();
	$grade_list  	 = $class_grade->getThisAdminGradeList();
	$school_id 		 = getSchoolId();
	foreach ($grade_list as $key => $value) {
		$grade_ids[] = $value['grade_id'];
	}
	$grade_id_str    = implode(',',$grade_ids);
	if($admin!='teacher'){
		$class_list  =  D('classes')->getThisAdminClassList();
	}
	$we7_js = 'no';
	if($ac=='list'){
				$where = " and student.grade_id in (".$grade_id_str.") ";
				if($_GPC['grade_id']){
					$where 			.= " and student.grade_id=:gid";
                    $params[':gid']  = $_GPC['grade_id'];
					$register['grade_id'] = $_GPC['grade_id']; 
				}
                if(!$_GPC['class_id'] && $admin=='teacher'){
                    $teacher_class_str = implode(',',$teacher_class_arr);
 					$where 			  .= " and student.class_id in ({$teacher_class_str})";
                }
				if($_GPC['class_id']>0){
					$where 			.= " and student.class_id=:cid";
                    $params[':cid']  = $_GPC['class_id'];
					$register['class_id'] = $_GPC['class_id']; 
				}
				if($_GPC['student_name']){
					$where 					.= " and student.student_name like :student_name ";
                    $params[':student_name'] = '%'.$_GPC['student_name'].'%';
                }
				if($_GPC['mobile']){
					$where 					.= " and student.parent_phone = :parent_phone ";
                    $params[':parent_phone'] = $_GPC['mobile'];
                }
				if($_GPC['card']){
					$where 					.= " and (student.rfid = :rfid or  student.rfid1 = :rfid or student.rfid2 = :rfid)";
                    $params[':rfid'] 		 = $_GPC['card'];
                }
				if($_GPC['status']){
					$where 				.= " and student.status=:status";
                    $params[':status']   = $_GPC['status'];
				}else{
					$where        .= " and student.status !=:st ";
					$params[':st'] = 2;
				}
                $student_school_uniacid = " student.school_id={$school_id}  ";
				$total  		 		=  pdo_fetchcolumn("select count(student_id) from ".$table_pe."lianhu_student student where  student.school_id={$school_id}  {$where}   ",$params);
                $num    		 		=  $total;
                if($_GPC['print_code']==1 || $_GPC['excel'] || $_GPC['print_bd_code']==1 || $_GPC['excel_no']==1){
					if($_GPC['excel_no']==1){
						$where .= " and uid=0 and uid1=0 and uid2=0 ";
					}
 				    $list  = pdo_fetchall("select student.*,grade.grade_name,class.class_name from {$table_pe}lianhu_student student 
										  left join {$table_pe}lianhu_grade grade on grade.grade_id=student.grade_id 
										  left join {$table_pe}lianhu_class class on class.class_id=student.class_id 
                                          where {$student_school_uniacid}  {$where}  ",$params);
					if($_GPC['excel'] || $_GPC['excel_no']){
								$objPHPExcel = new PHPExcel();
								$objPHPExcel->getProperties()->setCreator("家校通")->setLastModifiedBy("家校通")->setTitle("Office 2007 XLSX Test Document")->setSubject("Office 2007 XLSX Test Document")->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")->setKeywords("office 2007 openxml php")->setCategory("report file");
									$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '学生')->setCellValue('B1', '班级')->setCellValue("C1",'年级')->setCellValue("D1",'系统账号')->setCellValue("E1",'学号')->setCellValue("F1",'卡号')->setCellValue("G1",'电话');
									$i=2;
									foreach ($list as $kv=> $v) {
										$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $v['student_name'])->setCellValue('B' . $i, $v['class_name'])
										->setCellValue('C' . $i, $v['grade_name'])->setCellValue('D' . $i, $v['student_passport'])->setCellValue('E' . $i, $v['xuehao'])->setCellValue('F' . $i, $v['rfid'])
										->setCellValue('G' . $i, $v['parent_phone']);
										$i++;
									}
									$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold(true);
									$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
									$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
									$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
									$objPHPExcel->getActiveSheet()->setTitle('学生列表');		
									$objPHPExcel->setActiveSheetIndex(0);
									$base_name = "student_list".time().'.xlsx';
									$file_name = MODULE_ROOT.'/file/'.$base_name;
									$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
									$objWriter->save($file_name);
									header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
									header('Content-Disposition: attachment;filename="'.$base_name.'"');
									header('Cache-Control: max-age=0');
									readfile($file_name);
									exit;
					}
				}else{
                    $list =	pdo_fetchall("select student.*,grade.grade_name,class.class_name from {$table_pe}lianhu_student student 
										  left join {$table_pe}lianhu_grade grade on grade.grade_id=student.grade_id 
										  left join {$table_pe}lianhu_class class on class.class_id=student.class_id 
                                          where  {$student_school_uniacid}  {$where} {$sql_limit} ",$params);
					// foreach ($list as $key => $value) {
					// 	$up['rfid'] = hexdec($value['rfid']);
					// 	D("student")->edit(array("student_id"=>$value['student_id']),$up);
					// }
					
                }
			}
			//电子学生证
			$class_studentCard = Au('studentCard/login');
			if($class_studentCard){
				$class_studentCard->checkAndAdd("login_passport","login_passport char(40)");
			}

			if($ac=='new'){
				if($_GPC['submit']){
                    if($admin=='teacher'){
                      if(!in_array($_GPC['class_id'],$teacher_class_arr)){
							$this->myMessage("您只能编辑您班级下的学生",'','错误');
						}
					}
					$in['class_id'] 	= intval($_GPC['class_id']);
                    $in['grade_id'] 	= D('classes')->getClassGradeId($_GPC['class_id']);
					if(!$in['class_id']|| !$in['grade_id']){
						$this->myMessage("学生必须要有年级和班级",'','错误');
					}
					$_GPC['student_img']= getImgToUrl($_GPC['student_img'],$this);
					$in['student_name'] = $_GPC['student_name'];
					$in['student_img']  = $_GPC['student_img'];
					$in['parent_name']  = $_GPC['parent_name'];
					$in['parent_phone'] = $_GPC['parent_phone'];
					$in['xuehao'] 		= $_GPC['xuehao'];
					$in['address'] 		= $_GPC['address'];
					$in['student_link'] = $_GPC['student_link'];
                    $in['rfid'] 		= str_ireplace("\r\n",'',$_GPC['rfid']) ;
                    $in['rfid1'] 		= str_ireplace("\r\n",'',$_GPC['rfid1']) ;
                    $in['rfid2'] 		= str_ireplace("\r\n",'',$_GPC['rfid2']) ;
					// if( (strlen($in['rfid']) !=0 && strlen($in['rfid'])<9) ||  (strlen($in['rfid1'])!=0 && strlen($in['rfid1'])<9) || (strlen($in['rfid2'])!=0 && strlen($in['rfid2'])<9) ){
					// 		$this->myMessage("卡长度小于9位",'','错误');
					// }
					$in['active_rfid']  = $_GPC['active_rfid'];
					$in['ic_card']  	= $_GPC['ic_card'];
                    $in['sms_status']   = $_GPC['sms_status'];
					$id 				= $class_student->add($in);
					if(D('school')->getSchoolParams('much_class')){
						$class_ctl_student 				= C('student');
						$class_ctl_student ->student_id = $id;
						$class_ctl_student ->addFuClass($_GPC['fu_class_id']);
					}
					$up['student_passport'] = $in['class_id'].$id;
					$class_student->edit(array('student_id'=>$id),$up);
					//电子学生卡
					if($class_studentCard){
						$msg = Au("studentCard/action")->studentAddEdit($id,$_GPC['studentCardLogin'],$_GPC['studentCardPwd'],$_GPC['studentCardPassport']);
 					}
					$this->myMessage('新增成功'.$msg,$this->createWebUrl('student', array('op' => 'student','class_id'=>$_GPC['rclass_id'],'grade_id'=>$_GPC['rgrade_id'])),'成功');
				}
			}
			if($ac=='edit'){
				$id 	= intval($_GPC['id']);
				$result = $class_student->edit(array("student_id"=>$id));
				//电子学生卡
				if($class_studentCard){
					$card_re = $class_studentCard->findByStudent($id);
					$result['studentCardLogin'] = $card_re['login_name'];
					$result['studentCardPwd'] 	= $card_re['login_pwd'];
					$result['studentCardPassport'] 	= $card_re['login_passport'];
				}
				$class_classStudent   		= D('classStudent');
				$where[":student_id"] 		= $id; 
				$find_re 			  		= $class_classStudent->dataList($where);
				$result['fu_class_num'] 	= $find_re['count'];
				$result['fu_class_list'] 	= $find_re['list'];
				if($_GPC['submit']){
                    if($admin=='teacher'){
                        if(!in_array($_GPC['class_id'],$teacher_class_arr)){
							$this->myMessage("您只能编辑您班级下的学生",'','错误');
						}
					}
					$in['class_id']     = intval($_GPC['class_id']);
					$in['grade_id']     = pdo_fetchcolumn("select grade_id from {$table_pe}lianhu_class where class_id=:class_id",array(':class_id'=>$in['class_id']));
					if(!$in['class_id']|| !$in['grade_id']){
						$this->myMessage("学生必须要有年级和班级",'','错误');
					}
					$_GPC['student_img']= getImgToUrl($_GPC['student_img'],$this);
					$in['student_name'] = $_GPC['student_name'];
					$in['student_img']  = $_GPC['student_img'];
					$in['parent_name'] 	= $_GPC['parent_name'];
					$in['xuehao']  		= $_GPC['xuehao'];
					$in['address'] 		= $_GPC['address'];
					$in['student_link'] = $_GPC['student_link'];					
					$in['parent_phone'] = $_GPC['parent_phone'];
					$in['fanid'] 		= $_GPC['fanid'];
					$in['student_uid'] 	= $_GPC['student_uid'];
					if(!$in['fanid']){
						$in['uid'] 		= 0;
					}
					$in['fanid1'] 		= $_GPC['fanid1'];
					if(!$in['fanid1']){
						$in['uid1'] 	= 0;
					}
					$in['fanid2'] 		= $_GPC['fanid2'];
					if(!$in['fanid2']){
						$in['uid2'] 	= 0;
					}
					$in['status'] 		= $_GPC['status'];	
                    $in['rfid'] 		= str_ireplace("\r\n",'',$_GPC['rfid']) ;
                    $in['rfid1'] 		= str_ireplace("\r\n",'',$_GPC['rfid1']);
                    $in['rfid2'] 		= str_ireplace("\r\n",'',$_GPC['rfid2']);	
					// if( (strlen($in['rfid'])!=0 && strlen($in['rfid'])!=10) ||  (strlen($in['rfid1'])!=0 && strlen($in['rfid1'])!=10) || (strlen($in['rfid2'])!=0 && strlen($in['rfid2'])!=10) ){
					// 		$this->myMessage("卡长度不等于10位",'','错误');
					// }					
                    $in['sms_status']   = $_GPC['sms_status'];
					if($result['fanid'] && !$_GPC['fanid']){
							$class_student->invalidRelation($id,$result['fanid']);
					}
					if($result['fanid1'] && !$_GPC['fanid1']){
							$class_student->invalidRelation($id,$result['fanid1']);
					}
					if($result['fanid2'] && !$_GPC['fanid2']){
							$class_student->invalidRelation($id,$result['fanid2']);	
					}
					if(!$_GPC['fanid'] && !$_GPC['fanid1'] && !$_GPC['fanid2']){
							$class_student->deleteAllRelation($id);
					}
					$in['active_rfid']  = $_GPC['active_rfid'];
					$in['ic_card']  	= $_GPC['ic_card'];
					$class_student->edit(array('student_id'=>$id),$in);
					//多班级
					if(D('school')->getSchoolParams('much_class')){
						$class_ctl_student = C('student');
						$class_ctl_student ->student_id = $id;
						$class_ctl_student ->addFuClass($_GPC['fu_class_id']);
					}
					if($class_studentCard){
						if($class_studentCard){
							$msg = Au("studentCard/action")->studentAddEdit($id,$_GPC['studentCardLogin'],$_GPC['studentCardPwd'],$_GPC['studentCardPassport']);
						}
					}
					$this->myMessage('修改成功'.$msg,$this->createWebUrl('student', array('op' => 'student','class_id'=>$_GPC['rclass_id'],'grade_id'=>$_GPC['rgrade_id'])),'成功');
				}
			}	
			if($ac=='delete'){
				$id         = intval($_GPC['id']);
				$result     = pdo_fetch("select * from {$table_pe}lianhu_work where student_id=:id",array(':id'=>$id));
				if(!$result){
					$class_mstudent = M("student");
					if($class_mstudent){
						$class_mstudent->deleteStatus($id);
					}
					pdo_delete('lianhu_student',array('student_id'=>$id));
					if($class_studentCard){
							$msg = $class_studentCard->dataDelete($id);
					}
					$this->myMessage('删除成功'.$msg,$this->createWebUrl('student', array('op' => 'student','class_id'=>$_GPC['rclass_id'],'grade_id'=>$_GPC['rgrade_id'])),'成功');
				}else{
					$this->myMessage('已有数据，无法删除',$this->createWebUrl('student', array('op' => 'student','class_id'=>$_GPC['rclass_id'],'grade_id'=>$_GPC['rgrade_id'])),'错误');
				}
			}	

			$pager = pagination($total,$page,$pagesize);
			include $this->template('../admin/web_student');
			exit();
