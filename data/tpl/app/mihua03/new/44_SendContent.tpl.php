<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
<script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body ontouchstart >
<div class="container" id="container">
    <div class="article">
    <div class="bd">
        <article class="weui_article"> 
            <h1><?php  echo $result['title'];?></h1>
            <h3 style="color:#777">发布时间：<?php  echo date("Y-m-d H:i:s",$result['add_time'])?></h3>
            <?php  if($result['imgs']) { ?>
                <?php  $imgs = unserialize($result['imgs']);?>
                <?php  if($imgs) { ?>
                     <?php  $img_list =S("fun",'decodeImgs',array($imgs ,$this->module['config']['qiniu_url'] )); ?>
                     <?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
                        <img src='<?php  echo $row;?>' style="width:90%;margin-left:5%;margin-top:10px;">
                     <?php  } } ?>
                <?php  } ?>               
            <?php  } ?>
            <?php  if($result['img']) { ?>
                <img src='<?php  echo $this->imgFrom($result['img'])?>' style="width:90%;margin-left:5%;margin-top:10px;">
            <?php  } ?>
            <?php  if($result['voice']) { ?>
                <br>
                <br>
                <div style="width:100%;text-align:center">
                    <?php  echo  $this->echoVoiceUrl($result['voice']);?>
                </div>    
                <br>
            <?php  } ?>            
            <section>
                    <?php  echo htmlspecialchars_decode($result['content']);?>
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
	<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>