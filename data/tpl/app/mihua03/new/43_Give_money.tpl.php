<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '需要缴费记录';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<body>
<div class="container" id="container">
    <div class="cell">
    <div class="hd">
        <h1 class="page_title">需要缴费记录</h1>
    </div>
    </div>
<div class="weui_cells weui_cells_access">
        <?php  if(is_array($arr)) { foreach($arr as $row) { ?>
        <a class="weui_cell" href="<?php  echo $this->createMobileUrl('give_money_order',array('name'=>$row['limit_module']));?>">
            <div class="weui_cell_bd weui_cell_primary">
                <p><?php  echo $row['name'];?>:<?php  echo $row['money'];?>元</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>
        <?php  } } ?>
      <?php  if(!$arr) { ?>
        <a class="weui_cell" href="">
            <div class="weui_cell_bd weui_cell_primary">
                <p>暂无缴费</p>
            </div>
            <div class="weui_cell_ft">
            </div>
        </a>              
      <?php  } ?>
</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>