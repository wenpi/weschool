<?php

set_time_limit(0);
//更新具体文件
if($ac=='update_file'){
	$file_id 		= $_GPC['file_id'];
	$value   		= pdo_fetch("select * from ".tablename('lianhu_file_cache')." where file_id=:fid ",array(":fid"=>$file_id) );
	$file_content 	= base64_decode($value['file_content']);
	if(!file_exists(MODULE_ROOT.$value['file_local'])){
			 mkdirs(MODULE_ROOT.$value['file_local']);
			 chmod(MODULE_ROOT.$value['file_local'],0777);
	}
	if(file_exists(MODULE_ROOT.$value['file_local'].$value['file_name'])){
		if(is_writable(MODULE_ROOT.$value['file_local'].$value['file_name'])){
			$hander       = fopen(MODULE_ROOT.$value['file_local'].$value['file_name'],'w');						
			fwrite($hander,$file_content);
			$result 	  = fclose($hander);
			if($result){
				$this->class_base->updateFileVersion($value['file_name'],$value['file_local'],$value['version']);
				$out =  array('status'=>2,'msg'=>'更新成功');
				echo json_encode($out);
				exit();
			}
		}
	}else{
			$hander       = fopen(MODULE_ROOT.$value['file_local'].$value['file_name'],'w');						
			fwrite($hander,$file_content);
			$result 	  = fclose($hander);
			if($result){
				$this->class_base->updateFileVersion($value['file_name'],$value['file_local'],$value['version']);
				$out =  array('status'=>2,'msg'=>'更新成功');
				echo json_encode($out);
				exit();
			}		
	}
	$out =  array('status'=>1,'msg'=>'更新失败，请检查权限');
	echo json_encode($out);
}
//上传更新列表
if($ac=='updateSort'){
	$sort 			= $_GPC['sort']? $_GPC['sort'] :0 ;
	if(!$_SESSION['time_str']){
		$_SESSION['time_str'] = time();
	}
	$every_page = 50;
	$this->class_base->every_page = $every_page ;
	$file_list      = $this->class_base->getFileVersionList($sort);
	if($file_list){
		$base_url    	 	= 'system/updateFileList';	
		$params['list'] 	= json_encode($file_list);
		$params['time_str'] = $_SESSION['time_str'];
		$this->askCenter($base_url,$params);	
		echo json_encode(array("next_sort"=>$sort+$every_page));
	}else{
		echo json_encode(array("status"=>'done'));
	}
}
//获取更新列表
if($ac=='getFileList'){
		$base_url    				= 'system/updateFile';	
		$params['time_str'] 		= $_SESSION['time_str'];
		$list 						= $this->askCenter($base_url,$params);	
		if($list['arr']){
			foreach ($list['arr'] as $key => $value) {
				$in['file_id'] 		= $value['id'];
				$in['file_name'] 	= $value['file_name'];
				$in['file_content'] = $value['file_content'];
				$in['file_local'] 	= $value['file_local'];
				$in['version']  	= $value['version'];
				pdo_insert('lianhu_file_cache',$in);
				$list['arr'][$key]['file_content']='';
			}
		}
		echo json_encode(array("list"=> $list['arr'] ));
}
exit();
