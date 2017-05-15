<?php
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'aloneCourse';
		$left_nav     = 'aloneCourseList';
		$title        = '课程管理';  
		$sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'独立课程'),
            array('fun_str'=>'aloneCourseList','fun_name'=>'课程管理'),
		);
        $top_action = array(
            array('action_name'=>'课程列表','action'=>'aloneCourseList' ),
            array('action_name'=>'添加课程','action'=>'aloneCourseList','arr'=>array('ac'=>'new') ),
        );
        $page_name    = '课程列表';
        if($ac=='new'){
            $page_name    = '添加课程';
        }        
        $class_courseScan = C('courseScan');
        $class_list       = C('courseClass')->getUseList();
        $teacher_list     = C('teacher')->getAllList();

        if($ac=='list'){
            $class_courseScan->class_id      = $_GPC['class_id'];
            $class_courseScan->status        = $_GPC['status'];
            $class_courseScan->search_name   = $_GPC['search_name'];
            $listre   = $class_courseScan->getList($_GPC['page']);
            $list = $listre['list'];
        }elseif($ac=='new'){
            if($_GPC['submit']){
                $_GPC['buy_end'] = strtotime($_GPC['buy_end']);
                $in        = getNewUpdateData($_GPC,$class_courseScan->use_class);
                $course_id = $class_courseScan->use_class->add($in);
                //登记教师
                $teacher_ids = $_GPC['teacher_ids'];
                C('courseTeacher')->course_id = $course_id;
                C('courseTeacher')->addList($teacher_ids);
                $this->myMessage("添加课程",$this->createWebUrl('aloneCourseList'),'成功');
            }
        }elseif($ac=='edit'){
            $id                           = $_GPC['id'];
            $result                       = $class_courseScan->edit($id);
            C('courseTeacher')->course_id = $id; 
            $course_teacher_ids           = C('courseTeacher')->getCourseList();
            foreach ($course_teacher_ids as $key => $value) {
                $teacher_ids[] = $value['teacher_id'];
            }
            if($_GPC['submit']){

                $_GPC['buy_end'] = strtotime($_GPC['buy_end']);
                $in = getNewUpdateData($_GPC,$class_courseScan->use_class);
                $class_courseScan->use_class->edit(array('course_id'=>$id),$in); 
                C('courseTeacher')->deleteCourseTeacherList();
                $teacher_ids = $_GPC['teacher_ids'];
                C('courseTeacher')->addList($teacher_ids);             
                $this->myMessage('修改成功',$this->createWebUrl('aloneCourseList'),'成功');					
            }    
        }elseif($ac=='delete'){
            $id     = $_GPC['id'];
            $result = $class_courseScan->delete($id);
            $this->myMessage('删除成功',$this->createWebUrl('aloneCourseList'),'成功');					
        }elseif($ac == 'code'){
            if($_GPC['qrcode_num']){
                $top_action_two = array(
                        array('action_name'=>'扫码历史','action'=>'aloneCourseList','arr'=>array('ac'=>'code','id'=>$_GPC['id']) ),
                );
                $top_action  = array_merge($top_action,$top_action_two);
                $page_name   = '扫码历史';

                C('courseQrcode')->course_id = $_GPC['id'];
                $re   = C('courseQrcode')->findQr($_GPC['qrcode_num']);
                $list = C('courseDelete')->getList($re['qrcode_id']);

                $course_info = C('courseScan')->edit($re['course_id']);
                include $this->template('../admin/AloneCourseListScan');
                exit();
            }else{
                $id = $_GPC['id'];
                C('courseQrcode')->course_id = $id;
                $course_info = C('courseScan')->edit($id);
                $qrlist      = C('courseQrcode')->createAllQr();
            }
        }elseif($ac=='student'){
            $top_action_two = array(
                    array('action_name'=>'学生列表','action'=>'aloneCourseList','arr'=>array('ac'=>'student','id'=>$_GPC['id']) ),
                    array('action_name'=>'添加学生','action'=>'aloneCourseList','arr'=>array('ac'=>'student','op'=>'add','id'=>$_GPC['id']) ),
            );
            $top_action  = array_merge($top_action,$top_action_two);
            $page_name   = '学生列表';

            $id          = $_GPC['id'];
            $course_info = C('courseScan')->edit($id);
            if($op=='add'){
                if($_GPC['er'] == 'search'){
                    $grade_id = $_GPC['grade_id'];
                    $class_id = $_GPC['class_id'];
                    $student_name = $_GPC['student_name'];
                    if($grade_id){
                        $params[":grade_id"] = $grade_id;
                    }   
                    if($class_id){
                        $params[":class_id"] = $class_id;
                    }
                    if($student_name){
                        $params[":student_name"] = $student_name;
                    }

                    D('student')->each_page = 1000;
                    $re = D('student')->getList($params);
                    foreach ($re['list'] as $key => $value) {
                        $value['grade_class_name']     = $this->gradeName($value['grade_id']).'-'.$this->className($value['class_id']);
                        $re['list'][$key] = $value; 
                    }
                    outJson($re['list']);
                }elseif($_GPC['er']=='up'){
                    $up_list = $_GPC['up'];
                    $in["course_id"]  = $id;
                    foreach ($up_list as $key => $value) {
                        $in['student_id'] = $key;
                        $in["use_num"]    = $value;
                        $in["status"]     = 1;
                        C('courseStudent')->add($in);
                    }
                    $this->myMessage("授权成功",$this->createWebUrl('aloneCourseList',array('id'=>$id,'ac'=>'student')),'成功');
                }elseif($_GPC['er']=='change'){
                    $in["course_id"]  = $_GPC['course_id'];
                    $in['student_id'] = $_GPC['student_id'];
                    $in["use_num"]    = $_GPC['num'];
                    C('courseStudent')->change($in);
                    outJson(array('errcode'=>0));
                }else{
                    $page_name  = '添加学生';
                    $grade_list = D('grade')->getThisAdminGradeList();
                    $class_list = D('classes')->getThisAdminClassList();
                    include $this->template('../admin/AloneCourseListAdd');
                }
                exit();              
            }else{
                $we7_js      = 'no';
                C('courseStudent')->course_id = $id;
                $list = C('courseStudent')->getCourseList();
                foreach ($list as $key => $value) {
                    $list[$key]['student_info']         = D('student')->edit(array('student_id'=>$value['student_id']));
                    $list[$key]['grade_class_name']     = $this->gradeName($list[$key]['student_info']['grade_id']).'-'.$this->className($list[$key]['student_info']['class_id']);
                }
            }
        }elseif($ac=='buyHistoryList'){
            $top_action_two = array(
                    array('action_name'=>'缴费记录','action'=>'aloneCourseList','arr'=>array('ac'=>'buyHistoryList','id'=>$_GPC['id']) ),
            );            
            $top_action  = array_merge($top_action,$top_action_two);
            $page_name   = '缴费记录';
            $id          = $_GPC['id'];
            $course_info = C('courseScan')->edit($id);
            $record_list = C('courseScan')->moneyEndList($id);
            $we7_js      = 'no';
        }
        include $this->template('../admin/AloneCourseList');
		exit();
