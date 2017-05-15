<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html ng-app='new_app'>
<head>
 <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title><?php  if($student_name) { ?><?php  echo $student_name;?>-<?php  } ?><?php  echo $page_title;?>-<?php  echo $_SESSION['school_name'];?></title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=52c98799d98f668ebe11f46d655abd82"></script>
    <script src="<?php echo MODULE_URL;?>/web/default/js/jquery.min.js"> </script>
</head>
 <body>
        <div id="allmap">

        </div>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>
 </body>
 </html>
   <script type="text/javascript">
   $(function(){
       width  = $(window).width();
       height = $(window).height();
       $("#allmap").height(height);
       $("#allmap").width(width);
   });
	// 百度地图API功能
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(<?php  echo $list[0]['baidu_lon'];?>,<?php  echo $list[0]['baidu_lat'];?>);
	map.centerAndZoom(point, 15);
	// 编写自定义函数,创建标注
	function addMarker(point,begin,end){
	  var marker = new BMap.Marker(point);
	  map.addOverlay(marker);
      if(end){
          marker.setAnimation(BMAP_ANIMATION_BOUNCE);
          var label = new BMap.Label("停留点",{offset:new BMap.Size(20,-10)});
	      marker.setLabel(label);
      }
      if(begin){
          var label = new BMap.Label("时段内起点",{offset:new BMap.Size(20,-10)});
	      marker.setLabel(label);
      }
	}
    <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
        <?php  if($key ==0) { ?>
            begin=true;
        <?php  } else { ?>
            begin=false;
        <?php  } ?>
        <?php  if($list[$key+1] ) { ?>
            end = false;
        <?php  } else { ?>
            end = true;
        <?php  } ?>
        var point =  new BMap.Point(<?php  echo $row['baidu_lon'];?>,<?php  echo $row['baidu_lat'];?>) ;
		addMarker(point,begin,end);
    <?php  } } ?>
</script>