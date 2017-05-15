<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = $class_info['class_name'].'新闻列表' ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>/style/js/jquery.min.js"></script>
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
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
