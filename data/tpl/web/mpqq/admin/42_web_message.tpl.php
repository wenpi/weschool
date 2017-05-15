<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>消息提示</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="家校互联" name="description" />
<meta content="zhuhuan" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo MODULE_URL;?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo MODULE_URL;?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>admin/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo MODULE_URL;?>admin/js/js.js" ></script>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
 <!-- END THEME LAYOUT STYLES -->
 <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

    <body class="page-sidebar-closed-hide-logo page-container-bg-solid page-header-fixed page-sidebar-fixed">
    <link href="<?php echo MODULE_URL;?>/assets/pages/css/error.min.css" rel="stylesheet" type="text/css" />
     </head>
    <body class=" page-404-full-page">
        <div class="row">
            <div class="col-md-12 page-404">
                <div class="number font-red"><?php  echo $status;?></div>
                <div class="details">
                    <!--<h3>Oops! You're lost.</h3>-->
                    <p><?php  echo $msg;?>
                        <br/>
                        <?php  if($url) { ?>
						<a href="<?php  echo $url;?>" class="alert-link">如果你的浏览器没有自动跳转，请点击此链接</a>
						<script type="text/javascript">
							setTimeout(function () {
								location.href = "<?php  echo $url;?>";
							}, 3000);
						</script>
                        <?php  } else { ?>
                        	[<a href="javascript:history.go(-1);" class="alert-link">点击这里返回上一页</a>] &nbsp; [<a href="./?c=site&a=entry&do=adminindex&m=lianhu_school" class="alert-link">首页</a>]
                        <?php  } ?>
                </div>
            </div>
        </div>
        <!--[if lt IE 9]>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/respond.min.js"></script>
            <script src="<?php echo MODULE_URL;?>/assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo MODULE_URL;?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>