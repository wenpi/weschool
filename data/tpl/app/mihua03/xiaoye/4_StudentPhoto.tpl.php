<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
<body>
<div class="z_main">
        <div class="header">
            <span> <a href="<?php  echo $this->createMobileUrl('home' )?>"><i class="fa fa-bars" aria-hidden="true"></i></a> </span>
            <span> 学生相册</span>
            <span> <a href="<?php  echo $this->createMobileUrl('sendStudentPhoto' )?>">发布</a> </span>
        </div> 
        <ul id="list" style="margin-top:120px;">
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/student_photo_content', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/student_photo_content', TEMPLATE_INCLUDEPATH));?>
        </ul>
       <h1 id='add_msg' style="text-align:center;color:#333;font-size:1.5em;margin-top:10px;">...</h1>  
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/student_photo_js', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/student_photo_js', TEMPLATE_INCLUDEPATH));?>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
