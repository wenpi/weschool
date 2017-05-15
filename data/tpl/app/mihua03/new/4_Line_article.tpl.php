<?php defined('IN_IA') or exit('Access Denied');?><?php  $student_name = $student_info['student_name'] ?>
<?php  $page_title   = $intro.$class_name?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body ontouchstart >
<div class="container" id="container">
    <div class="article">
    <div class="bd">
        <article class="weui_article">
            <h1 class="article_title">
                <?php  if($home_work==1) { ?>
                <?php  echo date("m-d",$result['add_time']);?>日<?php  echo $result['course_name'];?>作业
                <?php  $imgs = unserialize($result['img']);?>
                <?php  } else if($record==1) { ?>
                    <?php  echo $result['word'];?>
                    <?php  $imgs[] = $result['img']?>
                <?php  } else { ?>
                    <?php  echo $result['line_title'];?>
                    <?php  $imgs = json_decode($result['imgs'],1);?>
                <?php  } ?>
            </h1>
            <section>
                <h1 class="line_title">
                    发布:<?php  if($result['teacher_name']) { ?><?php  echo $result['teacher_name'];?><?php  } else { ?>管理员<?php  } ?>
                    &nbsp;&nbsp;发布时间:<?php  if($result['add_time']) { ?><?php  echo date("m-d H:i:s",$result['add_time'])?><?php  } else { ?><?php  echo date("m-d H:i:s",$result['addtime'])?><?php  } ?>
                </h1>
            </section>
            <?php  if($imgs) { ?>
            <div onclick='displayImage(this)' >
                <?php  $img_list = S("fun",'decodeImgs',array($imgs ,$this->module['config']['qiniu_url'] )); ?>
                      <?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
                            <img src='<?php  echo $row;?>' style="width:60%;margin-left:20%;margin-top:10px;"  >
                     <?php  } } ?>
            </div>
            <?php  } ?>
            <?php  if($result['voice']) { ?>
            <div class="voice_class">
                <?php  echo  $this->echoVoiceUrl($result['voice']);?>
            </div>    
            <?php  } ?>   
            <section>
                <?php  if($home_work==1) { ?><span class="home_work_title">作业内容：</span><?php  } ?>
                  <?php  echo htmlspecialchars_decode($result['content']);?>
                  <?php  echo htmlspecialchars_decode($result['line_content']);?>
            </section>
        </article>
    </div>
    </div>
    </div>
    <div class="page-content loading-mask" id="new-stack">
      <div class="loading-icon">
        <div class="navbar-button-icon icon ion-load-d"></div>
      </div>
    </div>
    <style>
        .home_work_title{
            font-weight:700;
        }
        .weui_article h1{
            font-weight:700;
        }
        .article_title{
            text-align:center;
        }
        .voice_class{
            width:100%;
            text-align:center;
            margin-top:20px;
            margin-bottom:10px
        }
        .line_title{
            font-size:0.7em !important;
            color:#7093DB;
        }
    </style>
    <script>
    function displayImage(obj){
        var img_urls=[];
        var img_current='';
            if($(obj).find('img').length>0){
                    img_current = $(obj).find('img').eq(0).attr('src');
                    $.each($(obj).find('img'),function(i,e){
                        img_urls.push($(this).attr('src'));
                    });
            }
            img_urls.pop()
            wx.previewImage({
            current: img_current,
            urls: img_urls
            });
    }
    </script>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
