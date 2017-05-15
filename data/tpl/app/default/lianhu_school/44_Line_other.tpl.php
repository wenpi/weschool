<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  if($op=='home_work') { ?>班级作业<?php  } else { ?><?php  echo $op;?><?php  } ?>-<?php  echo $class_name;?></title>
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/line_css.css">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
     <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <script src="<?php echo MODULE_URL;?>style/js/modernizr.js"></script>
     <script src="<?php echo MODULE_URL;?>style/js/jquery.lazyload.js"></script>
     <script src="<?php echo MODULE_URL;?>style/js/main.js"></script>
</head>
<body>
    <div class="top-wrap2" style='position:fixed;'>
    </div>
    <section style='background:#fff;'>
    <div class="wrap" id="list" style="margin-top:40px;">
        <?php  if($op=='home_work') { ?>
         <?php  if(is_array($news_list)) { foreach($news_list as $row) { ?>
          <ul>
            <li class="box" style="border-bottom:1px solid #efefef;" >
            		<div class="author">
                    		<a href="#"><img src="<?php  if($row['teacher_id']) { ?><?php  echo $_W['attachurl'];?><?php  echo $this->getTeacherImg($row['teacher_id']);?><?php  } else { ?><?php echo MODULE_URL;?>icon.jpg<?php  } ?>"></a>
                            <p class="author_name"><?php  if($row['teacher_realname']) { ?><?php  echo $row['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?>(<?php  echo $this->courseName($row['course_id']);?>)</p>
                            <p class="author_time" style="left:0;">时间：<?php  echo date("Y-m-d H:i:s",$row['add_time']);?></p>
                    </div>
                            <div class="topic" style='margin-top:-10px;'>
                                    <a href='<?php  echo $this->createMobileUrl('line_article',array('hid'=>$row['homework_id']));?>'>
                                            <p><?php  echo $this->clear_html_short($row['content']);?>......</p>
                                    </a>
                                <div onclick='displayImage(this)'>
                                    <?php  echo $this->decodeLineImgs($row['img']);?>
                                    <div class='clear'></div>
                                </div>   
                                <?php  if($row['voice']) { ?>
                                <br>
                                <div>
                                    <?php  echo  $this->echoVoiceUrl($row['voice']);?>
                                 </div>    
                                 <?php  } ?>                             
                            </div>
            </li>           
            </ul> 
            <?php  } } ?>
        <?php  } else { ?>
        <?php  if(is_array($news_list)) { foreach($news_list as $row) { ?>
      		<ul>
            <li class="box"  style="border-bottom:1px solid #efefef;">
            		<div class="author">
                    		<a href="#"><img src="<?php  if($row['teacher_id']) { ?><?php  echo $_W['attachurl'];?><?php  echo $this->getTeacherImg($row['teacher_id']);?><?php  } else { ?><?php echo MODULE_URL;?>icon.jpg<?php  } ?>"></a>
                            <p class="author_name"><?php  if($row['teacher_realname']) { ?><?php  echo $row['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></p>
                            <p class="author_time">时间：<?php  echo date("Y-m-d H:i:s",$row['addtime']);?></p>
                    </div>
                            <div class="topic" style='margin-top:-10px;' >
                        <a href='<?php  echo $this->createMobileUrl('line_article',array('aid'=>$row['line_id']));?>'>
                                <p><?php  echo $this->clear_html_short($row['line_content']);?>......</p>
                        </a>          
                        <?php  if($row['imgs']) { ?>                      
                             <div onclick='displayImage(this)'>
                                 <?php  $row['imgs'] = serialize(json_decode($row['imgs'],1));?>
                                 <?php  echo $this->decodeLineImgs($row['imgs']);?>
                                <div class='clear'></div>
                             </div>
                         <?php  } ?>
                             <?php  if($row['voice']) { ?>
                                <br>
                                <div>
                                    <?php  echo  $this->echoVoiceUrl($row['voice']);?>
                                 </div>    
                              <?php  } ?>  
                            </div>
            </li>           
            </ul>      
        <?php  } } ?>
        <?php  } ?>
    </div>
        <?php  if($news_list) { ?>
         <h1 id='add_msg' style="text-align:center">正在加载...</h1>  
        <?php  } else { ?>
         <h1 id='add_msg' style="text-align:center">暂无...</h1>  
	    <?php  } ?>
    </section>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('right_nav', TEMPLATE_INCLUDEPATH)) : (include template('right_nav', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript">
  function displayImage(obj){
      var img_urls=[];
      var img_current='';
        if($(obj).find('.lazy').length>0){
             img_current=$(obj).find('.lazy').attr('src');
             img_urls=[img_current];
        }
        if($(obj).find('div').length>0){
                img_current=$(obj).find('div').eq(0).attr('data-img');
                $.each($(obj).find('div'),function(i,e){
                    img_urls.push($(this).attr('data-img'));
                });
        }
        img_urls.pop()
        wx.previewImage({
        current: img_current,
        urls: img_urls
        });
  }
var pager=1;
$(function(){
	$(window).scroll(function(){
		if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
           pager++;                     
            $.ajax({
               url:'<?php  echo $this->createMobileUrl('ajax')?>',
               type:'post',
               data:{page:pager,op:'line',type_id:'<?php  echo $type;?>',home_work:'<?php  echo $op;?>'},
               dataType:'json',
               success:function(obj){
                    if(obj.done=='yes'){
                        $("#add_msg").html('没有啦');
                    }else{
                        $('#list').append(obj.html);   
                    }
               }
            });
		}
	});
})
</script>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</body>
</html>