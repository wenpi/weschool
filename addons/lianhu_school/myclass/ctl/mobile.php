<?php 
namespace myclass\ctl;

class mobile extends common{
    public $school_id;
    public $mu_str;

    public function __construct(){
        $this->use_class = D('mobile');
        $this->mu_str    = D('school')->getSchoolInfo('mu_str');        
    }
    //判断现在应该用哪个模板的img【学生端_底部】
    public function studentButtonImg($keyword){
        $student_nav = $this->use_class->student_nav;
        foreach ($student_nav as $key => $value) {
            if($value['keyword']==$keyword){
                return $value['xiaoyeimg'];
            }
        }
    }
    public function teacherButtonImg($keyword){
        $student_nav = $this->use_class->teacher_nav;
        foreach ($student_nav as $key => $value) {
            if($value['keyword']==$keyword){
                return $value['xiaoyeimg'];
            }
        }
    }
    //判断现在应该用哪个模板img【学生端-导航】
    public function studentIndexImg($keyword){
        $student_index_nav = $this->use_class->student_index_nav;
        foreach ($student_index_nav as  $value) {
            foreach ($value['list'] as  $val) {

                if($val['keyword']==$keyword){
                    return $val['img'];
                }
            }
        }        
    }
    public function teacherIndexImg($keyword){
        $student_index_nav = $this->use_class->teacher_index_nav;
        foreach ($student_index_nav as  $value) {
            foreach ($value['list'] as  $val) {

                if($val['keyword']==$keyword){
                    return $val['img'];
                }
            }
        }        
    }

    //判断现在应该用哪个模板other【学生端-导航】
    public function studentIndexOther($keyword){
        $student_index_nav = $this->use_class->student_index_nav;
        foreach ($student_index_nav as  $value) {
            foreach ($value['list'] as  $val) {
                if($val['keyword']==$keyword && $val['xiaoyekeyword'] ){
                    return $val['xiaoyekeyword'];
                }
            }
        }        
        return $keyword;
    }    
   
}