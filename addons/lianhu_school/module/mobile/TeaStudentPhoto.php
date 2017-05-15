<?php 
    $teacher_info = $this->teacher_mobile_qx(); 
    $student_name = $teacher_info['teacher_realname'];
    $page_title   = '学生相册';
    $model 	      = $_GPC['model'] ? $_GPC['model'] :"class";
    if($model=='class'){
        $result = $this->student_standard('no');	
    }else{
        $result = $this->student_standard();	 
    }
    $do_in 	 	  = 1;
    if($model=='someone'){
        	if($_GPC['token'] != $_COOKIE['form_token'] && $_GPC['submit']){
				$do_in = 0;
			}
 			$token        = $this->class_base->tokenForm();
			if($_GPC['submit'] && $do_in==1){
                $img_arrs           = $_POST['img_value'];
                if($img_arrs){
                    foreach ($img_arrs as $key => $value) {
                        $img = $this->getWechatMedia($value);
                        if($img){
                            $img_in[]= $img;
                        }else{
                            $img_in[] = $up_file_name; 
                        }
                    }
                    $arr['photo_list'] = implode(',',$img_in);
                    $arr['title']      = $_GPC['title'];
                    $arr['student_id'] = $_GPC['sid'];
                    $arr['db_admin_id']= $teacher_info['admin_id'];
                    C('studentPhoto')->use_class->add($arr);
                    $this->myMessage("添加成功",$this->createMobileUrl("teain"),"成功");
                }
			}
    }