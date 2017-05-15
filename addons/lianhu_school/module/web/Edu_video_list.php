<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'line_edu';
		$left_nav     = 'edu_video_list';
		$title        = '视频管理';  
		$sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'在线课堂'),
            array('fun_str'=>'edu_video_list','fun_name'=>'视频管理'),
		);
        $top_action = array(
            array('action_name'=>'视频列表','action'=>'edu_video_list' ),
            array('action_name'=>'添加新的视频','action'=>'edu_video_list','arr'=>array('ac'=>'new') ),
        );
        $page_name    = '视频列表';
        if($ac=='new'){
            $page_name    = '添加新的视频';
        }  
        $class_eduList   = D('eduVideoList');
        $cclass_eduList  = C('eduVideoList');
        $class_eduClass  = D('eduVideoClass');

        $class_params[":class_level"]     = 1;
        $class_params[":status"]          = 1;
        $top_video_class_list             = $class_eduClass->dataList($class_params);
        $class_list                       = $top_video_class_list['list'];
        if($class_list){
                $class_params[":class_level"] = 2;
                foreach ($class_list as $key => $value) {
                    $class_params[":pid"]     = $value['class_id'];
                    $result                   = $class_eduClass->dataList($class_params);
                    $class_list[$key]['list'] = $result['list'];
                }           
        }else{
                $this->myMessage("请先添加视频分类",$this->createWebUrl('edu_video_class'),'错误');
        }
        if($ac=='list'){
            $params = false;
            if($_GPC["class_id"]){
                $params[":class_id"] = $_GPC['class_id'];
            }
            if($_GPC["status"]){
                $params[":status"]  = $_GPC['status'];
            }            
            $video_result       = $class_eduList->dataList($params);
            $video_list         = $video_result['list'];
            $we7_js             = 'no';
        }
        if($ac=='new'){
            if($_GPC['submit']){
                if($_GPC['list_src_type']==2){
                    $_GPC['list_src_content'] = $_GPC['list_src_content2'];
                }
                $in = getNewUpdateData($_GPC,$class_eduList);
                $class_eduList->dataAdd($in);
                $this->myMessage("添加视频",$this->createWebUrl('edu_video_list'),'成功');
            }
        }
        if($ac=='edit'){
            $id     = $_GPC['id'];
            $result = $class_eduList->dataEdit($id);
            if($_GPC['submit']){
                if($_GPC['list_src_type']==2){
                    $_GPC['list_src_content'] = $_GPC['list_src_content2'];
                }
                $in = getNewUpdateData($_GPC,$class_eduList);      
                $class_eduList->dataEdit($id,$in);
                $this->myMessage('修改成功',$this->createWebUrl('edu_video_list'),'成功');					
            }    
        }
        if($ac=='delete'){
            $id               = $_GPC['id'];
            $where["list_id"] = $id;
            $class_eduList->delete($where);
            $this->myMessage('删除成功',$this->createWebUrl('edu_video_list'),'成功');					
        }
        include $this->template('../admin/edu_video_list');
		exit();
