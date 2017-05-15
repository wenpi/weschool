<?php defined('IN_IA') or exit('Access Denied');?><link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<style>
    .weui_uploader_input_wrp{
        width: 150px;
        height: 150px;
    }
    .weui_cells{
        font-size: 2em;
        width: 94%;
        margin-left: 2%;
    }
    .weui_uploader_file{
        width: 150px;
        height: 150px;        
    }
    .weui_loading_leaf:before{
		width:48.84px;
    	height:3.48px;
    }
    .weui_icon_toast:before{
	font-size:200px;
    }
</style>

<div class="weui_cells weui_cells_form">
    <div class="weui_cell">
        <div class="weui_cell_bd weui_cell_primary">
            <div class="weui_uploader">
                <div class="weui_uploader_bd">
                    <ul class="weui_uploader_files" id='weui_uploader_files'>
                    </ul>
                </div>
            </div>
            <div class="weui_uploader" id="isshowvd" style="display: none;">
                <div class="weui_uploader_bd">
                    <ul class="weui_uploader_files" id='weui_uploader_files'>
                    	<li class='weui_uploader_file' style='background-image:url("../addons/lianhu_school/images/bofanganniu.png");'></li>
                    </ul>
                    <input id="upvideo" type="file" accept="video/*" style=" width:150px;height:77px;display: none;">
                    <input id="hdvideo" type="hidden" name="hdvideo">
                </div>
            </div>
            <div id='img_value' style="display: none"></div>
            </div>
        </div>
</div>
<div class="imgvdmenlist" style="background:#f5f5f5;height:150px;font-size: 40px;color: #949494;">
       <div style="height:150px;width:150px; float: left;margin:0 30px;text-align: center;" id="chooseImage">
        <img src="../addons/lianhu_school/images/addimg.png" style="width:60px; height:60px; padding:10px;display: block;margin: 0 auto;" />
        <span>图片</span>
       </div>
       <?php  if($video!='no') { ?>
       <div style="height:150px; width:150px;float: left;text-align: center;" id="chooseVideo">
            <img src="../addons/lianhu_school/images/addvd.png" style="width:60px; height:60px; padding:10px;display: block;margin: 0 auto;" />
            <span>视频</span>
       </div>
       <?php  } ?>
</div>
<div id="loadingToast" class="weui_loading_toast" style="display: none;">
    <div class="weui_mask_transparent"></div>
    <div class="weui_toast" style="width:40%;height:30%; left:35%;top:35%;">
        <div class="weui_loading">
            <div class="weui_loading_leaf weui_loading_leaf_0"></div>
            <div class="weui_loading_leaf weui_loading_leaf_1"></div>
            <div class="weui_loading_leaf weui_loading_leaf_2"></div>
            <div class="weui_loading_leaf weui_loading_leaf_3"></div>
            <div class="weui_loading_leaf weui_loading_leaf_4"></div>
            <div class="weui_loading_leaf weui_loading_leaf_5"></div>
            <div class="weui_loading_leaf weui_loading_leaf_6"></div>
            <div class="weui_loading_leaf weui_loading_leaf_7"></div>
            <div class="weui_loading_leaf weui_loading_leaf_8"></div>
            <div class="weui_loading_leaf weui_loading_leaf_9"></div>
            <div class="weui_loading_leaf weui_loading_leaf_10"></div>
            <div class="weui_loading_leaf weui_loading_leaf_11"></div>
        </div>
        <p class="weui_toast_content" style="font-size: 45px;">视频上传中</p>
    </div>
</div>
<div id="toast" style="display: none;">
    <div class="weui_mask_transparent"></div>
    <div class="weui_toast" style="width:40%;height:25%; left:35%;top:35%;">
        <i class="weui_icon_toast"></i>
        <p class="weui_toast_content" style="font-size: 45px;">已完成</p>
    </div>
</div>
<script>
var isspimg=1;
$(function(){
	var $loadingToast = $('#loadingToast');
	$("#chooseVideo").click(function(){
		if(isspimg==2){
			  alert('每次只能选择视频或者图片');
			return false;
		}
		if(isspimg==3){
			  alert('已经选择视频正在上传！');
			return false;
		}
		if(isspimg==4){
			  alert('已经选择视频并上传成功！');
			return false;
		}
		$('#upvideo').click();
	})
	
	$('#upvideo').change(function(){
		var formData = new FormData();
		formData.append('file', $('#upvideo')[0].files[0]);
		var size=$('#upvideo')[0].files[0].size;
		var maxsize=20*1024*1024;
		if(size>maxsize){
			alert('视频大小不能超过20M');
			return false;
		}
		isspimg=3;
		$('#loadingToast').show();
		$.ajax({
		    url: '<?php  echo $this->createMobileUrl('uploadvd')?>',
		    type: 'POST',
		    cache: false,
		    data: formData,
		    processData: false,
		    contentType: false,
		    dataType: 'json',
		    success: function (result) {
		    	if(result.status==2){
		    		isspimg=4;
		    		$("#isshowvd").show();
		    		$('#hdvideo').val(result.filename);
		    		$('#loadingToast').hide();
		    		 $('#toast').show();
		                setTimeout(function () {
		                    $('#toast').hide();
		               }, 2000);
		    	}else{
		    		$('#loadingToast').hide();
		    		isspimg=1;
		    		alert(result.msg);
		    	}
		    }
		});
		
	});
});

  var images = {
    localId: [],
    serverId: []
  };

  document.querySelector('#chooseImage').onclick = function () {
	if(isspimg==3 || isspimg==4){
		  alert('每次只能选择视频或者图片');
		  return false;
     }
    $('#weui_uploader_files').html('');
	isspimg=2;
    images.localId='';
    $('#img_list').html('');
    wx.chooseImage({
      success: function (res) {
        images.localId = res.localIds;
        $.each(images.localId,function(i,e){
            insertImg(e);
        });
          $("#uploadImg").html("上传");
          uploadImg();
      }
    });
  };
function uploadImg(){
     $("#img_value").html('');
     $("#weui_cell_ft_num").find('.num').html('');
     if (images.localId.length == 0) {
        alert('请先选择图片');
        return;
    }
    var i = 0, length = images.localId.length;
    $("#weui_cell_ft_num").find('.all_num').html(length);
    images.serverId = [];
    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          i++;
          images.serverId.push(res.serverId);
          insertValue(res.serverId);
          if (i < length) {
             $("#weui_cell_ft_num").find('.num').html(i);
             upload();
          }else{
             $("#weui_cell_ft_num").find('.num').html(length);
          }
        },
        fail: function (res) {
           alert(JSON.stringify(res));
        }
      });
    }
    upload();     
  }
function insertImg(img_src){
    $('#weui_uploader_files').prepend(" <li class='weui_uploader_file' style='background-image:url("+img_src+")'></li>");
}
function insertValue(value){
    $("#img_value").prepend("<input type='hidden' name='img_value[]' value='"+value+"' >");
}
</script>