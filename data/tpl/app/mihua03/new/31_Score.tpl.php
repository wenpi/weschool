<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '考试成绩';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
<body>
<div class="container" id="container">
<div class="cell">
<div class="hd">
    <h1 class="page_title">考试成绩</h1>
</div>
</div>
<div class="weui_cells weui_cells_access">
        <?php  if(is_array($list)) { foreach($list as $row) { ?>
        <a class="weui_cell" href="<?php  echo $this->createMobileUrl('score',array('ac'=>'listall','op'=>$row['scorejilv_id']))?>">
            <div class="weui_cell_bd weui_cell_primary">
                <p><?php  echo $row['scorejilv_name'];?></p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <?php  } } ?>
</div>
    <?php  if($ac=='listall') { ?>
        <div class="weui_cells weui_cells_form">
                <div class="weui_cell weui_cell_warn">
                    <div class="weui_cell_hd"><label for="" class="weui_label">总分：</label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <input class="weui_input" value="<?php  echo $all_score;?>分" readonly >
                    </div>
                    <div class="weui_cell_ft">
                    </div>
                </div>
                 <?php  if(is_array($score_list)) { foreach($score_list as $row) { ?>
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label for="" class="weui_label"><?php  echo $row['course_name'];?></label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <input class="weui_input" readonly value="<?php  echo $row['score'];?>分">
                    </div>
                </div>
                <?php  } } ?>

            </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>