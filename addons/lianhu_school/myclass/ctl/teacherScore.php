<?php 
namespace myclass\ctl;
//教师积分获取
class teacherScore extends common{
    public $begin_time;
    public $end_time;
    public $class_homework;
    public $class_line;
    public $class_article;
    public $class_loginlog;
    public $class_work;

    public function setScoreBase($school_id){
        $class_homework = D("homework");
        $class_article  = D("article");
        $class_line     = D("line");
        $class_loginlog = D("loginlog");
        $class_work     = D("work");
        $class_homework->school_id = $school_id;
        $class_homework->setBase();
        $class_line->school_id     = $school_id;
        $class_line->setBase();
        $class_article->school_id  = $school_id;
        $class_article->setBase();
        $class_loginlog->school_id = $school_id;
        $class_loginlog->setBase();
        $class_work->setBase();
        $this->class_homework = $class_homework;
        $this->class_article  = $class_article;
        $this->class_loginlog = $class_loginlog;
        $this->class_line     = $class_line;
        $this->class_work     = $class_work;
    }
    public function getScore($teacher_id,$begin_time,$end_time){
        $class_homework = $this->class_homework;
        $class_line     = $this->class_line;
        $class_article  = $this->class_article;
        $class_loginlog = $this->class_loginlog;
        //时间段内作业积分量
        $class_homework->teacher_id     = $teacher_id;
        $homework_num                   = $class_homework->getTeacherHomeworkJiFen($begin_time,$end_time);
        $homework_jifen                 = $homework_num*$class_homework->day_base;
        $out_list['homework_num']       = $homework_num;
        $out_list['homework_jifen']     = $homework_jifen;
        //时段内班级圈积分量
        $line_num                       = $class_line->getTeacherHomeworkJiFen($teacher_id,$begin_time,$end_time);
        $line_jifen                     = $line_num*$class_line->day_base;
        $out_list['line_num']           = $line_num;
        $out_list ['line_jifen']        = $line_jifen;
        //时间段内文章发布量
        $class_article->teacher_id      = $teacher_id;
        $article_num                    = $class_article->getTeacherLineJiFen($begin_time,$end_time);
        $article_jifen                  = $article_num*$class_article->day_base;
        $out_list['article_num']        = $article_num;
        $out_list['article_jifen']      = $article_jifen;       
        //时间段内学生记录的发布量
        $class_work                     = $this->class_work;
        $class_work->teacher_id         = $teacher_id;
        $work_num                       = $class_work->getTeacherWorkJiFen($begin_time,$end_time);
        $work_jifen                     = $work_num*$class_work->day_base;
        $out_list['work_num']           = $work_num;
        $out_list['work_jifen']         = $work_jifen;         
        //时间段内登录次数
        $class_loginlog->teacher_id     = $teacher_id;
        $loginlog_num                   = $class_loginlog->getTeacherLoginJiFen($begin_time,$end_time);
        $loginlog_jifen                 = $loginlog_num*$class_loginlog->day_base;
        $out_list['loginlog_num']       = $loginlog_num;
        $out_list['loginlog_jifen']     = $loginlog_jifen;  
        
        $out_list['all_num']            = $homework_jifen+$line_jifen+$article_jifen+$loginlog_jifen+$work_jifen;
        return $out_list;
    }
    //作业积分详情
    public function homeworkList($teacher_id,$begin_time,$end_time){
        $class_homework                 = $this->class_homework;
        $class_homework->teacher_id     = $teacher_id;
        $list           = $class_homework->getHomeworkList($begin_time,$end_time);
        $time_date_list = S("system",'ArrGroupAddTime',array($list));
        $list = '';
        foreach($time_date_list as  $row){
            $count = count($row);
            if($count > $class_homework->day_much){
                $num = $class_homework->day_much;
            }else{
                $num = $count;
            }
            $list['num']['time'][]  = $row;
            $list['num']['num'][] = $num;
            $all_num += $num;
        }       
        $list["all"]   = $class_homework->day_base*$all_num;
        $list['score'] = $class_homework->day_base;
        return $list;
    }
    //班级圈积分量
    public function lineList($teacher_id,$begin_time,$end_time){
        $class_line     = $this->class_line;
        $list           = $class_line->getTeacherLineList($teacher_id,$begin_time,$end_time);
        $time_date_list = S("system",'ArrGroupAddTime',array($list));
        $list = '';
        foreach($time_date_list as  $row){
            $count = count($row);
            if($count>$class_line->day_much){
                $num = $class_line->day_much;
            }else{
                $num = $count;
            }
            $list['num']['time'][] = $row;
            $list['num']['num'][]  = $num;
            $all_num += $num;
        }
        $list["all"]   = $class_line->day_base*$all_num;
        $list['score'] = $class_line->day_base;
        return $list;
    }
    //文章积分量
    public  function articleList($teacher_id,$begin_time,$end_time){
        $class_article             = $this->class_article;
        $class_article->teacher_id = $teacher_id;
        $list                      = $class_article->getArticleList($begin_time,$end_time);
        $time_date_list            = S("system",'ArrGroupAddTime',array($list));

        $list = '';
        foreach($time_date_list as  $row){
            $count    = count($row);
            if($count > $class_article->day_much){
                $num  = $class_article->day_much;
            }else{
                $num  = $count;
            }
            $list['num']['time'][] = $row;
            $list['num']['num'][]  = $num;            
            $all_num += $num;
        }     
        $list["all"]   = $class_article->day_base*$all_num;
        $list['score'] = $class_article->day_base;
        return $list;
    }
    //登录次数
    public function loginList($teacher_id,$begin_time,$end_time){
        $class_loginlog = $this->class_loginlog;
        $class_loginlog->teacher_id = $teacher_id;
        $list           = $class_loginlog->getTeacherLoginList($begin_time,$end_time);
        $time_date_list = S("system",'ArrGroupAddTime',array($list));
        $list           = '';
        foreach($time_date_list as  $row){
            $count = count($row);
            if($count>$class_loginlog->day_much){
                $num = $class_loginlog->day_much;
            }else{
                $num = $count;
            }
            $list['num']['time'][] = $row;
            $list['num']['num'][]  = $num;   
            $all_num += $num;
        }
        $list["all"]   = $class_loginlog->day_base*$all_num;
        $list['score'] = $class_loginlog->day_base;
        return $list;
    }




}