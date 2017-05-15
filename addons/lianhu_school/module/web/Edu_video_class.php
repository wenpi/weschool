<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'line_edu';
		$left_nav     = 'edu_video_class';
		$title        = '在线课堂';  
		$sidebar_list = array(
            array('fun_str'=>'','fun_name'=>'在线课堂'),
            array('fun_str'=>'edu_video_class','fun_name'=>'视频分类'),
		);
        $top_action = array(
            array('action_name'=>'分类列表','action'=>'edu_video_class' ),
            array('action_name'=>'添加新的分类','action'=>'edu_video_class','arr'=>array('ac'=>'new') ),
        );
        $page_name    = '分类列表';
        if($ac=='new'){
            $page_name    = '添加新的分类';
        }        
        $class_eduClass = D('eduVideoClass');
        $params[":class_level"]     = 1;
        $top_video_class_list       = $class_eduClass->dataList($params);
        $top_video_class_list       = $top_video_class_list['list'];
		$grade_list                 = D('grade')->getSchoolList();

        if($ac=='list'){
            $list                       = $top_video_class_list;
            if($list){
                $params[":class_level"] = 2;
                foreach ($list as $key => $value) {
                    $params[":pid"]     = $value['class_id'];
                    $result             = $class_eduClass->dataList($params);
                    $list[$key]['list'] = $result['list'];
                    $list[$key]['next_count'] = $result['count'];
                }
            }
        }

        if($ac=='new'){
            if($_GPC['submit']){
                $arr['class_name']      = $_GPC['class_name'];        
                $arr['class_img']       = $_GPC['class_img'];        
                $arr['pid']             = $_GPC['pid'];        
                $arr['sort']            = $_GPC['sort'];        
                $arr['class_level']     = $_GPC['class_level'];        
                $arr['limit_display']   = $_GPC['limit_display'];        
                $arr['limit_content']   = $_GPC['limit_content'];        
                $arr['status']          = $_GPC['status'];        
                $class_eduClass->dataAdd($arr);
                $this->myMessage("添加分类",$this->createWebUrl('edu_video_class'),'成功');
            }
        }
        if($ac=='edit'){
            $id     = $_GPC['id'];
            $result = $class_eduClass->dataEdit($id);
            $limit_arr = explode(',',$result['limit_content']);
            if($_GPC['submit']){
                $arr['class_name']      = $_GPC['class_name'];        
                $arr['class_img']       = $_GPC['class_img'];        
                $arr['pid']             = $_GPC['pid'];        
                $arr['sort']            = $_GPC['sort'];        
                $arr['class_level']     = $_GPC['class_level'];        
                $arr['limit_display']   = $_GPC['limit_display'];        
                $arr['limit_content']   = $_GPC['limit_content'];        
                $arr['status']          = $_GPC['status'];          
                $class_eduClass->dataEdit($id,$arr);
                $this->myMessage('修改成功',$this->createWebUrl('edu_video_class'),'成功');					
            }    
        }
        if($ac=='delete'){
            $id     = $_GPC['id'];
            $where['class_id'] = $id;
            $result = $class_eduClass->delete($where);
            $this->myMessage('删除成功',$this->createWebUrl('edu_video_class'),'成功');					
        }
        include $this->template('../admin/edu_video_class');
		exit();
