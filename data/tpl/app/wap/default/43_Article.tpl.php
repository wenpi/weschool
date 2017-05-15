<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = $class_info['class_name'].'新闻列表' ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <?php  if($head_controller != 'no') { ?>
       <meta name="viewport" content="user-scalable=no"/>
    <?php  } ?>
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  if($teacher_name) { ?> <?php  echo $teacher_name;?>-<?php  } ?> <?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo MODULE_URL;?>/wap/default/css/css.css">
    <script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
</head>
<script>
        //加载图片
    function displayImage(id_name,img_current){
            var img_urls    = [];
            var img_current = img_current;
            var obj         = $("#"+id_name);
            if(obj.find('img').length>0){
                $.each(obj.find('img'),function(i,e){
                    img_urls.push($(this).attr('src'));
                });
            }
            if(obj.find('.wx_img_list').length>0){
                $.each(obj.find('.wx_img_list'),function(i,e){
                    img_urls.push($(this).attr('data-src'));
                });                
            }
            // img_urls.pop()
            wx.previewImage({
                current: img_current,
                urls: img_urls
            });
    }
    //首页显示切换学生

    function changeDisplay(id_name){
        obj = $("#"+id_name);
        if(obj.attr('data-dis')=='yes'){
            obj.hide();
            obj.attr('data-dis','no');
        }else{
            obj.show();
            obj.attr('data-dis','yes');
        }
    }
</script>
<body>
<div class="z_main">

    <?php  if(is_array($article_list)) { foreach($article_list as $row) { ?>
        <div class="tzz">
                <div class="top">
                    <div class="t-rq">
                        <p><?php  if($row['add_time']) { ?> <?php  echo date("m-d",$row['add_time'])?> <?php  } else { ?><?php  echo date("m-d",$row['addtime'])?><?php  } ?></p>
                    </div>
                        <div class="t-fb">
                            <p style="width: 100%;height: 40px;font-size:36px;overflow: hidden;white-space:nowrap; overflow:hidden; text-overflow:ellipsis; "><?php  echo $row['article_title'];?></p>
                        </div>
                </div>
                    <div class="tz-nr">
                        <a href="<?php  echo $this->createMobileUrl("wapContent",array('aid'=>$row['list_id']));?>">
                            <p class="p"><?php  echo S('fun','formatLimitContent',array($row['article_intro'],50));?>...</p>
                        </a>
                    </div>
                         <?php  if($row['img']) { ?>
                        <div class="tz-tp"  id='img_list_<?php  echo $row['msg_id'];?>'>
                             <img src="<?php  echo $_W['attachurl'];?><?php  echo $row['img'];?>" onclick="displayImage('img_list_<?php  echo $row['msg_id'];?>','<?php  echo $_W['attachurl'];?><?php  echo $row['img'];?>')" >
                        </div>                   
                         <?php  } ?>
                    <div class="tz-mm"></div>
           </div>
    <?php  } } ?>
  </div>
</body>
</html>
