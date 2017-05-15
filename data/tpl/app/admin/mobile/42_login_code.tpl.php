<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8"/>
<title><?php  echo $title;?><?php  if($_W['uniaccount']['name']) { ?>--<?php  echo $_W['uniaccount']['name'];?><?php  } ?></title>
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
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout2/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
 <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css">
<body class=" login">
    <div class="content">
            <form class="login-form" action="<?php  echo $this->createMobileUrl('adminlogin')?>" method="post">
              <div class="logo">
                <a href="index.html">
                    <img src="<?php echo MODULE_URL;?>logo.png" alt="" style="width:150px;"/> 
                </a>
             </div>
             <div class="login_code">
                 <img src='<?php  echo $img_url;?>'>
             </div>
             <div class="login_text font-red-flamingo font-lg ">
                 扫码登录
             </div>
            </form>
    </div>
        <div class="copyright"> <?php  echo S('base','getKeywordContent',array('yeas'))?> ©<?php  echo S('base','getKeywordContent',array('copyright'))?></div>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?php echo MODULE_URL;?>assets/pages/scripts/login.min.js" type="text/javascript"></script>
</body>
<style>
    .login{
	background-color:#364150!important;
	background-image: url(<?php echo MODULE_URL;?>/images/home-banner.jpg);
	background-repeat: no-repeat;
	background-position: center top;
	height: 100%;
}
.login_code img{
   margin:10px 70px 0;
   height:200px;
}
.login_text{
    font-size: 1.2em;
    text-align: center;
}
.login .logo{margin:60px auto 0;padding:15px;text-align:center}
.login .content{
-webkit-border-radius:7px;-moz-border-radius:7px;-ms-border-radius:7px;-o-border-radius:7px;
	border-radius:7px;
	width:400px;
	overflow:hidden;
	position:relative;
	background-image: url(<?php echo MODULE_URL;?>/images/login_bg.png);
	margin-right: auto;
	margin-bottom: 10px;
	margin-left: auto;
	padding-top: 100px;
	padding-right: 30px;
	padding-bottom: 100px;
	padding-left: 30px;
	background-repeat: no-repeat;
	background-position: center top;
}
.login .content h3{color:#4db3a5;text-align:center;font-size:28px;font-weight:400!important}
.login .content h4{color:#555}.login .content .hint{color:#999;padding:0;margin:15px 0 7px}
.login .content .forget-form,.login .content .login-form{padding:0;margin:0;margin-top:80px;}
.login .content .form-control{background-color:#dde3ec;height:43px;color:#8290a3;border:1px solid #dde3ec}
.login .content .form-control:active,.login .content .form-control:focus{border:1px solid #c3ccda}
.login .content .form-control::-moz-placeholder{color:#8290a3;opacity:1}
.login .content .form-control:-ms-input-placeholder{color:#8290a3}
.login .content .form-control::-webkit-input-placeholder{color:#8290a3}
.login .content select.form-control{padding-left:9px;padding-right:9px}
.login .content .forget-form,.login .content .register-form{display:none}
.login .content .form-title{font-weight:300;margin-bottom:25px}
.login .content .form-actions{clear:both;border:0;padding:25px 30px;margin-left:-30px;margin-right:-30px}
.login .content .form-actions>.btn{margin-top:-2px}.login-options{margin-top:30px;margin-bottom:30px;overflow:hidden}
.login-options h4{float:left;font-weight:600;font-size:15px;color:#7d91aa!important}
.login-options .social-icons{float:right;padding-top:3px}
.login-options .social-icons li a{border-radius:15px!important;-moz-border-radius:15px!important;-webkit-border-radius:15px!important}.login .content .form-actions .checkbox{margin-left:0;padding-left:0}.login .content .forget-form .form-actions{border:0;margin-bottom:0;padding-bottom:20px}.login .content .register-form .form-actions{border:0;margin-bottom:0;padding-bottom:0}.login .content .form-actions .btn{
	margin-top:1px;
	font-weight:600;
	padding-top: 10px;
	padding-right: 20px;
	padding-bottom: 10px;
	padding-left: 20px;
	background-color: #00CCFF;
}.login .content .form-actions .btn-default{font-weight:600;padding:10px 25px!important;color:#6c7a8d;background-color:#fff;border:none}.login .content .form-actions .btn-default:hover{background-color:#fafaff;color:#45b6af}.login .content .forget-password{font-size:14px;float:right;display:inline-block;margin-top:10px}.login .content .check{color:#8290a3}.login .content .rememberme{margin-left:8px}.login .content .create-account{margin:0 -40px -30px;padding:15px 0 17px;text-align:center;background-color:#6c7a8d;-webkit-border-radius:0 0 7px 7px;-moz-border-radius:0 0 7px 7px;-ms-border-radius:0 0 7px 7px;-o-border-radius:0 0 7px 7px;border-radius:0 0 7px 7px}.login .content .create-account>p{margin:0}.login .content .create-account p a{font-weight:600;font-size:14px;color:#c3cedd}.login .content .create-account a{display:inline-block;margin-top:5px}.login .copyright{
	text-align:center;
	padding:10px;
	color:#7a8ca5;
	font-size:13px;
	background-color: #FFFFFF;
	vertical-align: bottom;
	margin-top: 0;
	margin-right: auto;
	margin-left: auto;
	position:absolute;
	bottom:0;
	width: 100%;
}
@media (max-width:440px){.login .content,.login .logo{margin-top:10px}.login .content{width:280px}.login .content h3{font-size:22px}.forget-password{display:inline-block;margin-top:20px}.login-options .social-icons{float:left;padding-top:3px}.login .checkbox{font-size:13px}}
</style>
<script>
    var val_id;
    function ajax_content(){
        $.ajax({
            url:'<?php  echo $this->createMobileUrl('LoginCode')?>',
            type:'post',
            data:{ac:'check',code_value:'<?php  echo $code_value;?>' },
            dataType:'json',
            success:function(obj){
                if(obj.errcode==0){
                    clearInterval(val_id);
                    window.location.href=obj.url;                    
                }
            }    
        });
    }
    $(function(){
       val_id =  setInterval("ajax_content()",1000);
    });
</script>
</html>
