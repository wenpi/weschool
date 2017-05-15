<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="z_main">		
		<div class="z_tx2">
		<div id="firstpane" class="menu_list">
			<?php  if(is_array($out_list)) { foreach($out_list as $row) { ?>
				<h3 class="menu_head current">
					<div class="z_tx28"><?php  echo $row['begin'];?>-<?php  echo $row['end'];?>&nbsp;学年度成绩</div>
					<div class="z_tx23"><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jiantou.png"></div>
				</h3>
				<div style="display:block" class="menu_body">
				<div class="kss-m">
					<?php  if(is_array($row['records'])) { foreach($row['records'] as $val) { ?>
						<a href="<?php  echo $this->createMobileUrl('score',array('ac'=>'listall','op'=>$val['scorejilv_id']))?>">
						<div ><?php  echo $val['scorejilv_name'];?></div>
						</a>
					<?php  } } ?>
					</div>
				</div>
			<?php  } } ?>
</div>
<script>
$(document).ready(function(){
	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane h3.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.menu_head").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
});
</script>
<!-- 代码部分end -->	
		</div>
		<div class="z_cc"></div>
       <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
	</div>
</body>
</html>
