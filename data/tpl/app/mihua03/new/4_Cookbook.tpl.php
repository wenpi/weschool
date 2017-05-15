<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '校园食谱';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
  <link rel="apple-touch-icon"  href="<?php echo MODULE_URL;?>/style/app/images/logo.ico">
  <link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
<body>
<div class="container" id="container">
    <div class="cell">
    <div class="hd">
        <h1 class="page_title">校园食谱</h1>
    </div>
    </div>
		<?php  echo htmlspecialchars_decode($result['cookbooK_breakfast']); ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>