<?php 
		$this->checkAdminWeb();
		$admin_result = D('admin')->judeAdminType();
		$left_top     = 'wap_admin';
		$left_nav     = 'article_list';
		$title        = '文章列表';  
		$sidebar_list = array(
				array('fun_str'=>'','fun_name'=>'官网管理'),
				array('fun_str'=>'article_list','fun_name'=>'文章列表'),
		);
		$top_action = array(
			array('action_name'=>'文章列表','action'=>'article_list'),
			array('action_name'=>'添加新的文章','action'=>'article_list','arr'=>array('ac'=>'new') ),
		);
        $page_name    = '文章列表';
        if($ac=='new'){
            $page_name    = '添加新的文章';
        }


        $class_article  = D("article");
        $class_list     = C('articleClass')->getCLassList();

        if($ac =='list'){
		    $pagesize       = 20;
		    $page           = $_GPC['page']?$_GPC['page']:1;
            $start_num      = ($page-1)*$pagesize;
            if($_GPC['class_id']){
                $params[":class_id"] = $_GPC['class_id'];
            }
            if($_GPC['status']){
                $params[":status"]   = $_GPC['status'];
            }else{
                 $params[":status"] = array("!=",-1);
            }
            $params[":uniacid"]     = $_W['uniacid'];
            $params[":school_id"]   = getSchoolId();
            $where = S("fun","composeParamsToWhere",array($params));
            foreach ($params as $key => $value) {
                if(is_array($value)){
                    $params[$key] = $value[1];
                }
            }
            $total = pdo_fetchcolumn("select count(*) num from ".tablename('lianhu_article_list')." where ".$where." ",$params);    
            $list  = pdo_fetchall("select *  from ".tablename('lianhu_article_list')." where ".$where." order by list_id desc limit ".$start_num.",".$pagesize." ",$params);
            $pager = pagination($total,$page,$pagesize);
        }
        if($ac=='new'){
            if($_GPC['submit']){
                $in['class_id']         = $_GPC['class_id'];
                $in['article_title']    = $_GPC['article_title'];
                $in['article_intro']    = $_GPC['article_intro'];
                $in['class_sort']       = $_GPC['class_sort'];
                $in['artice_img']       = $_GPC['artice_img'];
                $in['article_content']  = $_GPC['article_content'];
                $in['status']           = $_GPC['status'];
                $class_article->addArticle($in);
                $this->myMessage('新增成功',$this->createWebUrl('article_list'),'成功');
            }
        }
        if($ac=='edit'){
            $id     = $_GPC['id']; 
            $result = $class_article->editArticle($id);
            if($_GPC['submit']){
                $in['class_id']         = $_GPC['class_id'];
                $in['article_title']    = $_GPC['article_title'];
                $in['article_intro']    = $_GPC['article_intro'];
                $in['class_sort']       = $_GPC['class_sort'];
                $in['artice_img']       = $_GPC['artice_img'];
                $in['article_content']  = $_GPC['article_content'];
                $in['status']           = $_GPC['status'];
                $result = $class_article->editArticle($id,$in);
                $this->myMessage('修改成功',$this->createWebUrl('article_list'),'成功');
            }
        }
        if($ac=='delete'){
            $id = $_GPC['id'];
            $class_article->deleteArticle($id);
            $this->myMessage('删除成功',$this->createWebUrl('article_list'),'成功');
        }
        include $this->template('../admin/web_article_list');
        exit();        