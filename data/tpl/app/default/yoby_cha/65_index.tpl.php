<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php  echo $row['hd_title'];?></title>
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
 <base href="<?php  echo $yobyurl;?>">
  <link rel="stylesheet" href="weui/weuix.min.css"/>
 <script src="weui/zepto.js"></script>
<script>
 $(function(){

 $('#search_input').focus(function(){//获得焦点
 var $weuiSearchBar = $('#search_bar');
$weuiSearchBar.addClass('weui_search_focusing');
$('#search-fixed').addClass('search-fixed');
 });
 $('#search_input').blur(function(){//失去焦点
  var $weuiSearchBar = $('#search_bar');
                    $weuiSearchBar.removeClass('weui_search_focusing');
                    $('#search-fixed').removeClass('search-fixed');
                    if($(this).val()){
                        $('#search_text').hide();
                    }else{
                        $('#search_text').show();
                    }
 });
  $('#search_input').focus(function(){
 var $searchShow = $("#search_show");
                    if($(this).val()){
                        $searchShow.show();
                    }else{
                        $searchShow.hide();
                    }
 }); 
   $('#search_cancel').tap(function(){
   $("#search_show").hide();
                    $('#search_input').val('');
 }); 
  $('#search_clear').tap(function(){
$("#search_show").hide();
                    $('#search_input').val('');
 });
   
	$('#f').submit(function(){
  var touser = $('#search_input').val();
  if(empty(touser)){
    $.alert("亲,查找关键字不能为空");
    return false;
  }
});   
   
});


 </script> 
</head>

<body ontouchstart>

        
        <div class="weui_tab bg " style="height:55px;">
            <div class="weui_navbar">
                <div class="weui_navbar_item  f-green"  >
                 <a href="<?php echo $_W['siteroot'].'app/index.php?i='.$weid.'&c=entry&do=index&m=yoby_cha&id='.$id?>"><?php  echo $row['hd_title'];?></a>
                </div>
               
            </div>
        </div>

<div  id='search-fixed'>
        
        <div class="weui_search_bar" id="search_bar">
            <form id="f" class="weui_search_outer" action="<?php  echo $_W['siteroot'];?>app/index.php" method="get">
                <div class="weui_search_inner">
                    <i class="weui_icon_search"></i>
                    <input type="search" class="weui_search_input" id="search_input"  name="keyword" placeholder='<?php 
foreach($info as $k1){
  if($k1['isok']==1){
echo $k1['title']." ";
}
}
?>' value="<?php  echo $_GPC['keyword'];?>" />
                    <input type="hidden" name="c" value="entry" />    		
		<input type="hidden" name="do" value="index" />
		<input type="hidden" name="i" value="<?php  echo $_GPC['i'];?>" />
		<input type="hidden" name="m" value="yoby_cha" />
		<input type="hidden" name="id" value="<?php  echo $id;?>" />
                    <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                </div>
                <label for="search_input" class="weui_search_text" id="search_text">
                    <i class="weui_icon_search"></i>
                    <span><?php 
foreach($info as $k1){
  if($k1['isok']==1){
echo $k1['title']." ";
}
}
?></span>
                </label>
            </form>
            <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
        </div>
        
    </div> 
    <?php  if(!empty($row['is_m'])) { ?>
    <div class="bd" style="margin-top:10px">
   <div class='row '>
   <div class="col-33">
   &nbsp;
    </div>
   <div class="col-33">
    <a class="weui_btn weui_btn_plain_primary" href="javascript:;" id="qr"><span class="icon icon-42"></span>扫码</a>
    </div>
    <div class="col-33">
   <span class="icon icon-40 f20 f-green" onclick="$.alert('扫码支持条形码和二维码,例如图书条码关键字,二维码姓名关键字','帮助')"></span>
    </div>
    </div>
    </div> 
    <?php  } ?> 
 <?php   
            if(empty($list)){
            echo '<div class="weui_msg"><div class="notice"><p><i class="icon icon-18 f22"></i>暂无数据</p></div></div> ';
            
            }else{
            
            ?>      
         
<div class="weui_panel  weui_cells_access">
            <div class="weui_panel_hd">查询结果列表</div>
            
            <div class="weui_panel_bd">
            <?php  
            foreach($list as $k=> $v){
      if($k>0){
        echo ' 
<div class="ui-hr" data-title=""></div>
        ';}
        echo '<div class="weui_media_box weui_media_text">
          <p class="f14 " style="line-height:1.5">';
      foreach(json_decode($v['bl'],1) as $kk=>$v3){
      $ss  =($info[$kk]['title']=='手机号')?hidetel($v3):$v3;
      echo '<span class="bold">'.$info[$kk]['title'].'</span> : '.$ss.'<br/>';
      
        } 
        echo '</p></div>'; 
            ?>
          
        
        <?php  } ?>        
            </div>
            
        </div> 
<?php  if(!empty($pager)){   ?>         
<div class="p bg-gray" style="height:32px;">
   <?php  echo $pager;?>
</div>
<?php 
}
}
?>

	<script type="text/javascript" src='http://res.wx.qq.com/open/js/jweixin-1.0.0.js'></script>
	<?php 
$wx = $_W['account']['jssdkconfig'];
$wx['url'] ='http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ;
?> 
<script>
    var appIdstr = "<?php  echo $wx['appId'];?>";
    var timestampstr = "<?php  echo $wx['timestamp'];?>";
    var nonceStrstr = "<?php  echo $wx['nonceStr'];?>";
    var signaturestr = "<?php  echo $wx['signature'];?>";
wx.config({
	debug: false,
	appId: appIdstr,
	timestamp: timestampstr,
	nonceStr: nonceStrstr,
	signature: signaturestr,
		jsApiList: [
		'checkJsApi',
		'onMenuShareTimeline',
		'onMenuShareAppMessage','showMenuItems','hideOptionMenu','chooseImage','previewImage'
,'uploadImage','downloadImage' ,'scanQRCode'
	]
});
wx.ready(function () {
//要分享的数据
  var shareData = {
     title:"<?php  echo $row['hd_title'];?>",
    desc: "<?php  echo $row['hd_desc'];?>",
    link:"<?php  echo $wx['url'];?>" ,
    imgUrl:"<?php  echo tomedia($row['hd_img'])?>",
    type:'', // 分享类型,music、video或link，不填默认为link 分享给朋友
    dataUrl:'', // 如果type是music或video，则要提供数据链接，默认为空 分享给朋友
  };
wx.hideOptionMenu();
		wx.showMenuItems({
			menuList: [
			'menuItem:share:timeline', 
			'menuItem:share:appMessage',
			'menuItem:copyUrl',
			],
		});
//分享给朋友
wx.onMenuShareAppMessage({
      title: shareData.title,
      desc: shareData.desc,
      link: shareData.link,
      imgUrl:shareData.imgUrl,
      type: shareData.type,
    dataUrl: shareData.dataUrl,
      trigger: function (res) {//菜单
        
      },
      success: function (res) {//成功
        
      },
      cancel: function (res) {//取消
        
      },
      fail: function (res) {//失败
        alert(JSON.stringify(res));
      },
      complete:function(res){//完成
      
      },
    });	

//分享到朋友圈
    wx.onMenuShareTimeline({
      title:shareData.title+','+shareData.desc,
      link:shareData.link,
      imgUrl:shareData.imgUrl,
      trigger: function (res) {
        
      },
      success: function (res) {  
      
            
      },
      cancel: function (res) {
       
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      },
      complete:function(res){//完成
      	 //alert('完成');
      },
    });	
//扫描二维码 
document.querySelector('#qr').onclick = function () {
    wx.scanQRCode({
      needResult: 1,//0是微信处理,1是结果
      desc: '我们自己来处理结果',
      scanType: ["qrCode","barCode"],
      success: function (res) {
      var result = res.resultStr;
      var urlx = "http://weixin.yoby123.cn/app/index.php?keyword="+urlencode(result)+"&c=entry&do=index&i=<?php  echo $weid;?>&m=yoby_cha&id=<?php  echo $id;?>";
      window.location.href=urlx;
      }
    });
  };
});
</script>
</body>
</html>