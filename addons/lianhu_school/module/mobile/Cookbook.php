<?php 
   $result         =  $this->mobile_from_find_student();
   $student_name   = $result['student_name'];
   $page_title     = '食谱';
   $mu_str     	   = $this->school_info['mu_str'];
   
   if($mu_str!='xiaoye'){
       	$where["xiaoye"]    = 0;
        $where['school_id'] = getSchoolId();
		$result 			= C('cookbook')->use_class->edit($where);
   }else{
       $duan       = $_GPC['duan'] ? $_GPC['duan']:2;
       $out_times  = C('cookbook')->timeToThree();
       $time_begin = $out_times['duan'][$duan]['begin_unix'];
       $time_end   = $out_times['duan'][$duan]['end_unix'];
       $cookbook_class_arr = C('cookbook')->cookbookCLass();
   }

   
