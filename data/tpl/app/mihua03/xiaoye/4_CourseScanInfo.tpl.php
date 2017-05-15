<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<body>
<div class="z_main" >
	<div class="tx-t">
		<p1><?php  echo $result['course_name'];?></p1>
        <p2>课时数：<?php  echo $result['nums'];?></p2> <p2>发布时间：</p2><p2><?php  echo date("Y-m-d",$result['add_time'])?></p2>
	</div>
	<div class="tx-m" id = 'html_content'>
        	<?php  echo myHtmlspecialchars_decode($result['course_contet']);?>
	</div>
</div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>