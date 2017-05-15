<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white' style="width: 50%;float: left" ><?php  echo $page_title;?></div>
            <div  class='head_left_text datepicker'><?php  echo $time_date;?></div>
        </div>
 </div>  
<div class="main" style='margin-bottom:60px;'>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr style="color:#009ffb">
					<th>班级名</th>
					<th>到校</th>
					<th>离校</th>
					<th>异常</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><a href="<?php  echo $this->createMobileUrl('tea_ClassAttence',array("class_id"=>$item['class_id'],'time_date'=>$time_date));?>"><?php  echo $item['class_name'];?></a></td>
					<td><?php  echo $item['up'];?></td>
					<td><?php  echo $item['low'];?></td>
					<td><?php  echo $item['other'];?></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<div id="container"></div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>/template/xiaoye/css/default/default.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>/template/xiaoye/css/default/default.date.css">
    <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/picker.js"></script>
    <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/picker.date.js"></script>
    <script src="<?php echo MODULE_URL;?>/template/xiaoye/js/legacy.js"></script>
    <script type="text/javascript">
        var $input = $( '.datepicker' ).pickadate({
            formatSubmit: 'yyyy/mm/dd',
            container: '#container',
            closeOnSelect: true,
            closeOnClear: false,
            hiddenName:true,
            value:"<?php  echo date("d",$class_card->in_time)?> <?php  echo C('week')->date_num[date("n",$class_card->in_time)]?>月, <?php  echo date("Y",$class_card->in_time)?>",
            url:"<?php  echo $this->createMobileUrl("tea_attence")?>",
        })
    </script>
