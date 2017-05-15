<?php 
		$result = $this->teacher_mobile_qx();
    	if($result){
            D('loginlog')->teaLoginLog();
			header("Location:".$this->createMobileUrl('teacenter'));
		}else{
			header("Location:".$this->createMobileUrl('teacher'));
		}
		