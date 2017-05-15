<?php 
	$student_info 	  = $this->mobile_from_find_student();
    $student_name     = $student_info['student_name'];
    $page_title       = "添加相片";
    if($_GPC['submit']){
        $img_arrs = $_POST['img_value'];
        if($img_arrs){
            foreach ($img_arrs as $key => $value) {
                    $img_in[] = $this->getWechatMedia($value); 
            }
            $arr['photo_list'] = implode(',',$img_in);
            $arr['do_myself']  = 1;
            $arr['student_id'] = $student_info['student_id'];
            $arr['title']      = $_GPC['title'];
            C('studentPhoto')->use_class->add($arr);
            header("Location:".$this->createMobileUrl('StudentPhoto' ));
        }
    }
    if($_GPC['pic_url']){
        $arr['student_id'] = $student_info['student_id'];
        $arr['pic_url']    = $_GPC['pic_url'];
        D('lineStudentPhoto')->add($arr);
        $in['student_id'] = $student_info['student_id'];
        $in['photo_list'] = $_GPC['pic_url'];        
        $in['do_myself']  = 1;
        D('studentPhoto')->lineAdd($in);
        exit();
    }