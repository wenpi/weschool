<?php defined('IN_IA') or exit('Access Denied');?>
<!DOCTYPE HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<title><?php  echo $g_title;?></title>
	<link href="<?php echo MODULE_URL;?>assets/styles/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo MODULE_URL;?>assets/styles/menus.css" rel="stylesheet" type="text/css">
	<link href="<?php echo MODULE_URL;?>assets/styles/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo MODULE_URL;?>assets/styles/framework.css" rel="stylesheet" type="text/css">
	<link href="<?php echo MODULE_URL;?>assets/styles/skin.css" rel="stylesheet" type="text/css">
	<link href="<?php echo MODULE_URL;?>assets/styles/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo MODULE_URL;?>assets/styles/animate.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="<?php echo MODULE_URL;?>assets/scripts/jquery.js"></script>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>assets/scripts/jqueryui.js"></script>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>assets/scripts/custom.js"></script>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>assets/scripts/elink-framework.js"></script>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>assets/scripts/noty/packaged/jquery.noty.packaged.js"></script>
	<script type="text/javascript" src="<?php echo MODULE_URL;?>assets/scripts/jweixin-1.1.0.js"></script>
	<style type="text/css">*{font-family:"Microsoft YaHei",Arial,Helvetica,sans-serif,"宋体";}</style>
   <script>
        var jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || {};
        // 是否启用调试
        jssdkconfig.debug = false;
        jssdkconfig.jsApiList = [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard',
			'translateVoice',
            'openAddress'
        ];
        wx.config(jssdkconfig);
        var _TUTOR_URL = "<?php  echo $this->createMobileUrl('tutor')?>";
        var _follow = "<?php  echo intval($_W['fans']['follow'])?>";
        var _openid = "<?php  echo $_W['openid']?>";
        var _qrcode = "<?php  echo $_W['account']['qrcode']?>";
    </script>
    <script type="text/javascript" src="<?php echo MODULE_URL;?>public/libs/jquery_weui/jquery-weui.js"></script>
    <script src="<?php echo MODULE_URL;?>public/libs/jquery_weui/js/swiper.js"></script>
    <script src="<?php echo MODULE_URL;?>public/js/voice.js?t=<?php  echo time()?>"></script>
</head>