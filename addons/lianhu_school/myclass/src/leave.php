<?php 
namespace myclass\src;

class leave extends common{
        public $leave_id        = 'leave_id';
        public $member_uid      = 'member_uid';
        public $student_id      = 'student_id';
        public $teacher_id      = 'teacher_id';
        public $class_id        = 'class_id';
        public $leave_reason    = 'leave_reason';
        public $time_date       = 'time_date';
        public $teacher_text    = 'teacher_text';
        public $leave_status    = 'leave_status';
        public $time_date_begin = 'time_date_begin';
        public $time_date_end   = 'time_date_end';
        public $leave_type      = 'leave_type';
        public $reply_time      = 'reply_time';
        public $leave_voice     = 'leave_voice';

        public function __construct(){
            $this->setTable('lianhu_leave');
            $this->setGlobal();
        }
        //获取教师的未审核的请假列表
        public function getTeacherNotDoList($teacher_id){
                $this->each_page       = 1000000;
                $params[":teacher_id"] = $teacher_id;
                $in_where              = " leave_status=1 ";
                $re                    = $this->getList($params,$in_where);
                $list                  = $re['list'];
                return $list;
        }
        //获取教师已经处理的请假列表
        public function getTeacherDoList($teacher_id,$pager){
		$pager  = $pager ? $pager :1;
                $params[":teacher_id"] = $teacher_id;
                $in_where              = " leave_status!=1 ";        
                $re                    = $this->getList($params,$in_where,$pager);        
                $list = $re['list'];
                return $list;
        }
        //获取一个学生的请假列表
        public function getStudentLeaveList($student_id){
                $this->each_page       = 1000000;
                $params[":student_id"] = $student_id;
                $re                    = $this->getList($params);
                $list                  = $re['list'];
                $class_base            = D('base');
                $class_student         = D('student');
                $class_teacher         = D('teacher');
                if($list){
                        foreach ($list as $key => $value) {
                               $fanid =  $class_base->mobileGetFanidByUid($value['member_uid']);
                               $list[$key]['relation'] = $class_student->getRelation($value['student_id'],$fanid);
                               if($value['teacher_id']){
                                       $list[$key]['teacher']  = $class_teacher->teacherName($value['teacher_id']);
                               }
                        }
                }
                return $list;
        }


}