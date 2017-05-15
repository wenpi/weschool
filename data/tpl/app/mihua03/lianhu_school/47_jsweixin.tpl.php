<?php defined('IN_IA') or exit('Access Denied');?><script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
wx.config({
    debug: false,
    appId: "<?php  echo $signPackage['appId'];?>",
    timestamp:<?php  echo $signPackage['timestamp'];?>, 
    nonceStr: "<?php  echo $signPackage['nonceStr'];?>", 
    signature: "<?php  echo $signPackage['signature'];?>",
     jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'onVoicePlayEnd',
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
        'openCard'
      ]
});
</script>
<script>
    wx.ready(function () {
            <?php  if($not_hidden != 'yes') { ?>
                wx.hideOptionMenu();
            <?php  } ?>

        $('#scanQRCode1').click(function(){
                wx.scanQRCode({
                needResult: 1,
                desc: 'scanQRCode desc',
                success: function (res) {
                    var bar_code=res.resultStr;
                    window.location.href=bar_code+"&<?php  echo $type;?>";
                }
                });
                return false;
            });
    });
    wx.error(function(res){
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
        // alert("js权限获取错误，请设置，或者刷新页面重试");    
    });
</script>