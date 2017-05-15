<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>班级圈-<?php  echo $class_name;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">   
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/line_css.css?<?php echo TIMESTAMP;?>">
    <link href="http://cdn.bootcss.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
     <script src="<?php echo MODULE_URL;?>style/js/modernizr.js"></script>
     <script src="<?php echo MODULE_URL;?>style/js/jquery.lazyload.js"></script>
     <script src="<?php echo MODULE_URL;?>style/js/main.js"></script>
	 <style type="text/css">
#header { 
    width: 90%;
    height: 40px;
	vertical-align:middle;
	line-height:40px;
	float:left;
    overflow: hidden;
	left:10%;
	top:3px;
	box-shadow:none;
	background:#fff;
    }
    #top-line{
    height:0;

    }
    .line1{
    color:#009ffb;
    }
    .no_pass{color:#ff0033;display: inline-block;width: 100%;text-align:center;position: relative;top:-20px;font-size: 1.2em;font-weight: 700}
    .pass{    
        font-size: 1.8em;
        float: right;
        position: relative;
        top: -25px;
        right: 40px;
    }
</style>
</head>
<body style="background:#efefef;">
    <div class="top-wrap2" style='position:fixed; width:100%;box-shadow: 3px 3px 3px rgba(0,0,0,0.2);background:#fff;'>
	<div id="top-line2"></div>
			<?php  if($op=='list' ) { ?>
                <a href="<?php  echo $this->createMobileUrl('send_line',array("class_id"=>$_GPC['class_id']));?>" style='color:#009ffb '> 
                    <div class='fn-right fn-text-center' style=' float:left; font-size:1.1em; line-height:40px; filter:alpha(opacity=50); width:10%; text-align:right;'  >
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;</div>
                </a>
            <?php  } ?>
                <?php  if($in_type['type'] !='teacher') { ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('right_nav', TEMPLATE_INCLUDEPATH)) : (include template('right_nav', TEMPLATE_INCLUDEPATH));?>
                <?php  } else { ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_right_nav', TEMPLATE_INCLUDEPATH)) : (include template('tea_right_nav', TEMPLATE_INCLUDEPATH));?>
                <?php  } ?>
        </div>
     </div>
    <section style='background:#fff;'>
    <div class="wrap" id="list" style="margin-top:55px; margin-bottom:60px;">
        <?php  $class_student=D("student");?>
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
            <?php  $fanid=$this->class_base->mobileGetFanidByUid($row['send_uid']);?>
            <?php  $student_id = $class_student->getStudentIdByFanid($fanid,$class_id);?>
            <?php  $student_info = $class_student->getStudentInfo($student_id);?>
      		<ul id='list_id_<?php  echo $row['send_id'];?>'>
             <li class="box" >
            		<div class="author">
                    		<a href="#"><img src="<?php  echo $row['avatar'];?>"></a>
                            <p class="author_name"><?php  echo $student_info['student_name'];?>（<?php  echo $row['relation'];?>）</p>
                            <?php  if($uid==$row['send_uid']  || $in_type['type']=='teacher' ) { ?>
                            <?php  if($in_type['type']!='teacher') { ?>
                               <span class='no_pass'><?php  if($row['send_status']==2) { ?>审核中<?php  } ?></span>
                            <?php  } ?>
                            <?php  if($in_type['type']=='teacher' && $row['send_status']==2) { ?>
                               <a href="javascript:;" class="pass " data-send='<?php  echo $row['send_id'];?>' id="pass<?php  echo $row['send_id'];?>" >
                                 <i class="fa fa-check" aria-hidden="true" style="color:#00ff00"></i>
                               </a>                            
                            <?php  } ?>
                               <a href="javascript:;" class="close delete" data-send='<?php  echo $row['send_id'];?>' >
                                  <img src="<?php echo MODULE_URL;?>/style/images/close.png">
                               </a>
                            <?php  } ?>
                    </div>
                        <div class="topic">
                            <p><?php  echo $row['send_content'];?></p>
                            <div onclick='displayImage(this)'>
                                <?php  echo $this->decodeLineImgs($row['send_image']);?>
                                <div class='clear'></div>
                             </div>
                            <p class="author_time"><?php  echo date("m-d H:i",$row['add_time']);?></p>
                        </div>
                    <div class="click_hf">
                        <div class='line_jian_tou'><i class="fa fa-sort-asc"></i></div>
                        <?php  $zan_have=$this->zanLine($row['send_id']);?>
                        <a href="javascript:;" class="zan" id="zan_<?php  echo $row['send_id'];?>" data-send='<?php  echo $row['send_id'];?>' style="<?php  if($zan_have==1) { ?>color:#07E<?php  } else { ?>color:#333<?php  } ?>">
                            <i class="fa fa-heart-o"></i>
                       </a>
                       <span id="like_num_<?php  echo $row['send_id'];?>" class='like_name'><?php  echo $this->getLineZanName($row['send_id']);?>
                       </span>
                        <div  class='comment huifu' data-id='<?php  echo $row['send_id'];?>'><i class="fa fa-comment-o"></i></div>
                        <div class='comment_list_line' id="comment_list_line<?php  echo $row['send_id'];?>">
                         <?php  $comment_list=$this->getLineComplete($row['send_id']);?>
                         <?php  if($comment_list ) { ?>
                            <?php  if(is_array($comment_list)) { foreach($comment_list as $val) { ?>
                                <span><?php  echo $val['nickname'];?>:</span><?php  echo $val['comment_text'];?><br>
                            <?php  } } ?>
                         <?php  } ?>
                         </div>
                    </div>
            </li>           
            </ul>      
        <?php  } } ?>
    </div>
        <?php  if($list) { ?>
         <h1 id='add_msg' style="text-align:center; background:#efefef; ">正在加载...</h1>  
        <?php  } else { ?>
         <h1 id='add_msg' style="text-align:center">暂无...</h1>  
	    <?php  } ?>
    </section>

<script type="text/javascript">
  $(function() {
  $("img.lazy").lazyload({
			 effect: "fadeIn",
			 placeholder: "<?php echo MODULE_URL;?>/style/images/data.png",
			 threshold :200
			 });
  });
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
            if(pager==0) return false;
            pager++;       
            $.ajax({
               url:'<?php  echo $this->createMobileUrl('ajax')?>',
               type:'post',
               data:{page:pager,op:'line_all',class_id:<?php  echo $class_id;?> },
               dataType:'json',
               async:'false',
               success:function(obj){
                    if(obj.errcode==1){
                        $("#add_msg").html(obj.msg);
                        pager=0;
                    }else{
                        $('#list').append(obj.html);   
                    }
               }
            });
		}
	});
        
})
$(function(){
     $('.delete').on('click',function(){
        send_id=$(this).attr('data-send');
        line_ajax(send_id,'delete');
    });   
    $('.pass').on('click',function(){
        send_id=$(this).attr('data-send');
        line_ajax(send_id,'line_pass');
    });  
});
function line_ajax(send_id,ac){
             $.ajax({
               url:'<?php  echo $this->createMobileUrl('ajax')?>',
               type:'post',
               data:{send_id:send_id,op:'line_change',ac:ac},
               dataType:'json',
               success:function(obj){
                    if(obj.errcode==1){
                        $("#add_msg").html(obj.msg);
                    }else{
                         if(ac=='like'){
                             $("#zan_"+send_id).css('color','#ff0033');
                             num=$("#like_num_"+send_id).html();
                             $("#like_num_"+send_id).html(Number(num)+1);
                         }   
                         if(ac=='delete'){
                             $("#list_id_"+send_id).hide();
                         }      
                          if(ac=='line_pass'){
                             $("#pass"+send_id).hide();              
                         }                                              
                    }
               }
            });  
    }
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('comment_area', TEMPLATE_INCLUDEPATH)) : (include template('comment_area', TEMPLATE_INCLUDEPATH));?>
</body>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</html>