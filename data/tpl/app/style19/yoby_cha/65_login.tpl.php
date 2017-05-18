<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php  echo $row['hd_title'];?></title>
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
 <base href="<?php  echo $yobyurl;?>">
  <link rel="stylesheet" href="weui/weuix.min.css"/>
 <script src="weui/zepto.js"></script>
</head>

<body>
<?php  if($op == "post") { ?>
<script>
    alert('wait for 3s to exit');
    setTimeout(function(){
        WeixinJSBridge.call('closeWindow');
    }, 3000);
</script>
<?php  } else if($op == "display") { ?>
<div class="main">
    <form action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">


            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名<span style="color:red;font-size:18px">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" name="user" class="form-control" value="<?php  echo $item['user'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">密码<span style="color:red;font-size:18px">*</span></label>
                    <div class="col-sm-8">
                        <input type="password" name="passwd" class="form-control" value="<?php  echo $item['passwd'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
                    <div class="col-sm-4">
                        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <input type="hidden" value="post" name="op">
                        <input name="submit" type="submit" value="提交" class="btn btn-primary span3 btn-sm" />
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<?php  } ?>
</body>

</html>