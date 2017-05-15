<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>消息提示</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="家校互联" name="description" />
<meta content="zhuhuan" name="author" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>admin/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo MODULE_URL;?>admin/js/js.js" ></script>
 <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<link href="<?php echo MODULE_URL;?>/assets/pages/css/error.min.css" rel="stylesheet" type="text/css" />
</head>
        <?php  if($status=='follow') { ?>
            <style>
                .follow_bg{
                    width:100%;
                    height:100%;
                    background:url('<?php echo MODULE_URL;?>images/follow.png') center fixed no-repeat ;
                    background-size:100% ; 
                }
                #follow_text{
                    position:fixed;
                }
            </style>
            <script>
                $(function(){
                    w_width = $(window).width();
                    w_height = $(window).height();
                    $("#follow_bg").width(w_width);
                    $("#follow_bg").height(w_height);
                    margin_left = w_width*0.25;
                    margin_top  = w_height*0.1;
                    img_width   = w_width*0.5;
                    $("#follow_img").css("margin-left",margin_left);
                    $("#follow_img").css("margin-top",margin_top);
                    $("#follow_img").css("width",img_width);
                });
            </script>
          <body style="background-color:#fff ">
                    <div class="follow_bg" id="follow_bg">
                        <img src='<?php  echo $_W['attachurl'];?><?php  echo $config['follow_code'];?>'  id="follow_img" >
                 </div>

       <?php  } else { ?>
    <body class="page-404-full-page" style="background-color:#fff ">
        <div class="row">
            <div class="col-md-12 page-404">
                     <div class="number <?php  if($status=='成功') { ?>font-green<?php  } else { ?>font-red<?php  } ?>"><?php  echo $status;?></div>
                    <div class="details">
                        <h3><?php  echo $msg;?></h3>
                        <p>
                            <br/>
                            <?php  if($url) { ?>
                            <a href="<?php  echo $url;?>" class="alert-link">如果你的浏览器没有自动跳转，请点击此链接</a>
                            <script type="text/javascript">
                                setTimeout(function () {
                                    location.href = "<?php  echo $url;?>";
                                }, 3000);
                            </script>
                            <?php  } else { ?>
                                [<a href="javascript:history.go(-1);" class="alert-link">点击这里返回上一页</a>] &nbsp;
                            <?php  } ?>
                    </div>
            </div>
        </div>
        <?php  } ?>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    </body>
</html>