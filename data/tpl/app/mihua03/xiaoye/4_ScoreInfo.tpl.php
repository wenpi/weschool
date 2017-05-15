<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<script>
    var d = {base : ""};
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/jquery.jqplot.min.js\"><\/script>");  
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/examples/syntaxhighlighter/scripts/shCore.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/examples/syntaxhighlighter/scripts/shBrushJScript.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/examples/syntaxhighlighter/scripts/shBrushXml.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.logAxisRenderer.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.canvasTextRenderer.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js\"><\/script>"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.categoryAxisRenderer.min.js\"><\/script>");  
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.barRenderer.min.js\"><\/script>");  
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.pointLabels.min.js\"><\/script>");  
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js\"><\/script>");  
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/plugins/jqplot.dateAxisRenderer.min.js\"><\/script>");  
    document.write("<link class=\"include\" rel=\"stylesheet\" type=\"text/css\" href=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/jquery.jqplot.min.css\" />");
    document.write("<link type=\"text/css\" rel=\"stylesheet\" href=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/examples/syntaxhighlighter/styles/shCoreDefault.min.css\" />");
    document.write("<link type=\"text/css\" rel=\"stylesheet\" href=\"<?php echo MODULE_URL;?>/template/xiaoye/js/jqplot/examples/syntaxhighlighter/styles/shThemejqPlot.min.css\" />"); 
    document.write("<script language=\"JavaScript\" type=\"text/javascript\" src=\"<?php echo MODULE_URL;?>/template/xiaoye/js/m_jqplot.js\"><\/script>"); 
</script>
<style>
    .jqplot-point-label{
        font-size: 1.5em;
    }
    .jqplot-xaxis-tick,.jqplot-axis{
        font-size: 1em;
    }
</style>
<body>
<div class="z_main">
 <div class="head-ks">
 <p><?php  echo $course_name;?>进退情况</p>
 </div>
	<div class="yy-zx" id='chart1'>

	</div>
<script type="text/javascript">
	var data       = [[ <?php  if(is_array($score_list)) { foreach($score_list as $row) { ?> <?php  echo $row['score'];?>, <?php  } } ?> ]];
	var data_max   = 100; //Y轴最大刻度
	var line_title = ["<?php  echo $course_name;?>}"]; //曲线名称
	var y_label    = "考试分数"; //Y轴标题
	var x_label    = "考试记录"; //X轴标题
	var x          = [ <?php  if(is_array($list)) { foreach($list as $row) { ?> '<?php  echo $row['scorejilv_name'];?>', <?php  } } ?> ]; //定义X轴刻度值
	var title      = "<?php  echo $course_name;?>最近五次考试"; //统计图标标题
	j.jqplot.diagram.base("chart1", data, line_title, "", x, x_label, y_label, data_max, 1);
</script>   

	<!--<div class="cj-p">
		<div class="cj-p-t">
			<p>模拟分数：如果我的语文考到</p>
			<div class="cjj">
				<input type="text" name="">
			</div>
			<span class="aaa">分</span>
		</div>
		<div class="yy-mm">
			<div class="y-m1">
			<p>班级排名</p>
            </div>
            			<div class="y-m2">
			<p>20名</p>
           <div class="y-m2-1">
           <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/hjt.png">
			   <span>5名</span>
            </div>
      
			
		</div>
		      			<div class="y-m3">
			<p>年级排名</p>
            </div>
                        			<div class="y-m4">
			<p>80名</p>
           <div class="y-m2-1">
           <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/hjt.png">
			   <span>20名</span>
            </div>
			
		</div>
	</div>
	</div>-->

	</div>
    <?php  $footer_type = 'center';?>
     <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>