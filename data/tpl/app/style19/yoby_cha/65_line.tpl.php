<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php  echo $row['hd_title'];?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <base href="<?php  echo $yobyurl;?>">
    <link rel="stylesheet" href="weui/weuix.min.css"/>
    <script src="weui/zepto.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>

<body>

<script type="text/javascript" src='http://res.wx.qq.com/open/js/jweixin-1.0.0.js'></script>
<?php 
$wx = $_W['account']['jssdkconfig'];
$wx['url'] ='http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;
?>

<?php  if($op == "failed") { ?>
Failed!!
<?php  } else if($op == "ok") { ?>

    <?php  if(($type == "DEV" || $type == "LINE" ) ) { ?>
        <div class="main">
            <form action="" method="post" class="form-horizontal form">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group">
                            <?php  var_dump($type) ?>
                        </div>
                        <div class="form-group">
                            <?php  var_dump($instance) ?>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                <input type="hidden" name="id" value="<?php  echo $id;?>" />
                                <input type="hidden" value="check_once" name="op" />
                                <input type="hidden" value="<?php  echo $uid;?>" name="uid" />
                                <input type="hidden" value="<?php  echo $type;?>" name="type" />
                                <input name="submit" type="submit" value="检查" class="btn btn-primary span3 btn-sm" />
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    <?php  } else { ?>
    <?php  } ?>

<?php  } else if($op == "redirect") { ?>
<script>
    window.location.href = "<?php  echo $redirect; ?>";
</script>
<?php  } else { ?>
<input class="btn btn-primary btn-lg" id="btnScan" type="submit" value="扫码" name="submit"></td>
<script>
    var appIdstr = "<?php  echo $wx['appId'];?>";
    var timestampstr = "<?php  echo $wx['timestamp'];?>";
    var nonceStrstr = "<?php  echo $wx['nonceStr'];?>";
    var signaturestr = "<?php  echo $wx['signature'];?>";
    wx.config({
        debug: true,
        appId: appIdstr,
        timestamp: timestampstr,
        nonceStr: nonceStrstr,
        signature: signaturestr,
        jsApiList: [
            'scanQRCode'
        ]
    });
    wx.ready(function () {
        //扫描二维码
    });

    document.getElementById("btnScan").onclick = function fun() {
        wx.scanQRCode({
            needResult: 1,//0是微信处理,1是结果
            desc: '我们自己来处理结果',
            scanType: ["qrCode", "barCode"],
            success: function (res) {
                var result = res.resultStr;
                var urlx = "<?php  echo $_W['siteroot'];?>app/index.php?keyword=" + urlencode(result) + "&c=entry&do=line&i=<?php  echo $weid;?>&m=yoby_cha&id=<?php  echo $id;?>";
                window.location.href = urlx;
            }
        });
    };
</script>
<?php  } ?>
</body>

</html>