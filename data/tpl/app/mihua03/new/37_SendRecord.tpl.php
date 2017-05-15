<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body ontouchstart >
<div class="container" id="container">
    <div class="article">
    <div class="bd">
        <article class="weui_article"> 
            <h1><?php  if($record_re['record_title']) { ?> <?php  echo $record_re['record_title'];?> <?php  } else { ?><?php  echo $record_re['record_intro'];?><?php  } ?></h1>
            <section>
                <h1 class="line_title">
                    &nbsp;&nbsp;发布时间:<?php  if($record_re['add_time']) { ?><?php  echo date("m-d H:i:s",$record_re['add_time'])?><?php  } else { ?><?php  echo date("m-d H:i:s",$record_re['addtime'])?><?php  } ?>
                </h1>
            </section>

            <?php  if($record_re['imgs']) { ?>
                <?php  $imgs = unserialize($record_re['imgs']);?>
                <?php  if($imgs) { ?>
                     <?php  $img_list =S("fun",'decodeImgs',array($imgs ,$this->module['config']['qiniu_url'] )); ?>
                     <?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
                        <img src='<?php  echo $row;?>' style="width:90%;margin-left:5%;margin-top:10px;">
                     <?php  } } ?>
                <?php  } ?>               
            <?php  } ?>
            <?php  if($record_re['voice']) { ?>
                <br>
                <br>
                <div style="width:100%;text-align:center">
                    <?php  echo  $this->echoVoiceUrl($record_re['voice']);?>
                </div>    
                <br>
            <?php  } ?>            
            <section>
                    <?php  echo htmlspecialchars_decode($record_re['record_content']);?>
            </section>
            <?php  if($record_re['url']) { ?>
                <div>
                    <a href='<?php  echo $record_re['url'];?>'>点击查看详情</a>
                </div>
            <?php  } ?>
        </article>
    <?php  $type = 1;?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/reply', TEMPLATE_INCLUDEPATH)) : (include template('../new/reply', TEMPLATE_INCLUDEPATH));?>
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
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>