<?php defined('IN_IA') or exit('Access Denied');?><div>
      <label class="label-form" for="message">照片</label>
      <br>
      <div class="weui_uploader_bd">
      <ul  class="weui_uploader_files" id='weui_uploader_files'></ul>
      <div class="weui_uploader_input_wrp">
        <span class="weui_uploader_input"  id="chooseImage"  accept="image/*" multiple=""></span>
      </div>
      </div>
      <div style='clear:both'></div>
      <div  class='hide' id='img_value'> </div>  
     <div id='uploadImg' style='margin-bottom:5px;margin-left:10px;display:inline;'></div>
</div>	 
<script>
  var images = {
      localId: [],
      serverId: []
    };
    document.querySelector('#chooseImage').onclick = function () {
      images.localId='';
      $('#img_list').html('');
      wx.chooseImage({
        success: function (res) {
          images.localId = res.localIds;
          $.each(images.localId,function(i,e){
              insertImg(e);
          });
            uploadImg();
        }
      });
    };
  function uploadImg(){
      $("#img_value").html('');
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