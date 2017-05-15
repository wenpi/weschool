<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-login', TEMPLATE_INCLUDEPATH)) : (include template('common/header-login', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="./resource/mpqq/help.css">
<div class="help">
    <div class="heading">
        <div class="head-top">
            <img class="logo" src="./resource/mpqq/images/logo_beta.png">
            <div class="link">
                 <a href="/">首页</a>
                <a href="<?php  echo url('user/login');?>" target="_blank">登陆</a>
                <a href="<?php  echo url('user/register');?>" target="_blank">注册</a>
            </div>
        </div>    
      
    </div>

    <div class="content">
    <div class="container_bd">
    <div class="announcement_box public_notice_content">

    <?php  if($do == 'list') { ?>
    <ol class="breadcrumb">
        
        <li><a href="./index.php"><i class="fa fa-home"></i>系统首页</a></li>
        <li><a href="<?php  echo url('article/news-show/list');?>">新闻列表</a></li>
        <li class="active"><?php  if(!$cateid) { ?>所有新闻<?php  } else { ?><?php  echo $categroys[$cateid]['title'];?><?php  } ?></li>
    </ol>
 


    <div class="notice_set clearfix" style="visibility: visible;">

 <?php  if(is_array($categroys)) { foreach($categroys as $categroy) { ?>
   <div class="notice_head notice_item" id="notice_avatar" data-acc-type="5">
            <div class="notice_item_inner ui_loading">

                <a href="<?php  echo url('article/news-show/list', array('cateid' => $categroy['id']));?>" class="notice_head_a <?php  if($cateid == $categroy['id']) { ?>active<?php  } ?> "><?php  echo $categroy['title'];?></a></div>

            </div>
 <?php  } } ?>      


        </div>
    <div class="table_x" style="visibility: visible;">
        <h2 class="notice_display_head">新闻列表</h2>
         <div class="table_size ui_loading_animation" style="height: 550px; transition: height 300ms; overflow: hidden;">
                                <table class="ui_table notice_tb" id="notice_tb">
                                    <tbody class="notice_tb_bd">
                             <?php  if(is_array($data)) { foreach($data as $da) { ?>
                            <tr class="notice_tr">
                                <td class="notice_content">
                                <a href="<?php  echo url('article/news-show/detail', array('id' => $da['id']));?>" class="notice_content_a ell"><?php  echo $da['title'];?>...</a>
                                </td>
                                <td class="notice_data"><?php  echo date('Y-m-d', $da['createtime']);?></td>
                            </tr>
                            <?php  } } ?>
   </tbody>
                                </table>



        </div>


        <div class="panel-body">
            <ul>
                <?php  if(is_array($data)) { foreach($data as $da) { ?>
                <li style="
    text-indent: 1em;
    line-height: 2.5em;
">
                    <a href="<?php  echo url('article/news-show/detail', array('id' => $da['id']));?>"><?php  echo $da['title'];?>...</a><span class="date"><?php  echo date('Y-m-d', $da['createtime']);?></span></li>
                <?php  } } ?>
            </ul>
        </div>
    </div>
    <?php  } ?>
    <?php  if($do == 'detail') { ?>
    <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-home"></i>系统首页</a></li>
        <li class="active"><a href="<?php  echo url('article/news-show/list');?>">新闻列表</a></li>
        
    </ol>
    <div class="inner">
        <h3 class="announcement_title"><?php  echo $news['title'];?></h3>
                <div class="small text-center text-muted">
                <span><?php  echo date('Y-m-d H:i', $news['createtime']);?></span>
                <span>阅读：<?php  echo $news['click'];?>次</span>
                <span>作者：<?php  echo $news['author'];?></span>
                <span>来源：<?php  echo $news['source'];?></span>
            </div>
        </div>
    <div id="content" style="
    padding: 60px 70px;
">
            <?php  echo $news['content'];?>
        </div>
  
    <?php  } ?>
      </div>
</div>
       
   
</div>

<!-- end of container -->

 <div class="footer" id="footer">
        <p>Copyright © 1998-2016 Tencent. All Rights Reserved. </p>
        <p>腾讯公司 版权所有</p>
    </div>

</div>
</body><style type="text/css" id="16968150000"></style></html>