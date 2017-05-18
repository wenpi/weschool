<?php defined('IN_IA') or exit('Access Denied');?>    <form method="post" action="<?php  echo $this->createMobileUrl("peopleReply");?>">
     <input type="hidden" name="type" value="<?php  echo $type;?>">
     <input type="hidden" name="id"   value="<?php  echo $id;?>">
        <div class="hd" style="padding:0px 0px;">
            <h1 class="page_title">回复此条消息</h1> 
        </div>
            <div class="weui_cells weui_cells_form">
                    <div class="weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">
                            <div class="weui_uploader">
                                <div class="weui_uploader_hd weui_cell">
                                    <div class="weui_cell_bd weui_cell_primary">图片上传</div>
                                    <div class="weui_cell_ft" id='weui_cell_ft_num'><span class='num'>0</span>/<span class='all_num'>0</span></div>
                                </div>
                                <div  class='hide' id='img_value'>
                                </div>
                                <div class="weui_uploader_bd">
                                    <ul class="weui_uploader_files" id='weui_uploader_files'>
                                    </ul>
                                    <div class="weui_uploader_input_wrp">
                                        <span class="weui_uploader_input"  id="chooseImage"  accept="image/*" multiple=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="weui_cells_title">文字内容</div>
                <div class="weui_cells weui_cells_form">
                            <div class="weui_cell">
                                <div class="weui_cell_bd weui_cell_primary">
                                    <textarea class="weui_textarea" placeholder="请输入评论" rows="3" name="content"></textarea>
                                    <div class="weui_textarea_counter"></div>
                                </div>
                            </div>
                </div>
                <div class="weui_btn_area">
                    <div class="weui_btn weui_btn_plain_primary"  onclick='chooseVoice()'>开始录音</div>
                    <div id='uploadVoice' class="uploadVoice" ></div>
                </div>
                <div class="weui_btn_area">
                        <input type="submit" class="weui_btn weui_btn_primary" value="点击回复">
                </div>
                <div  class='hide' id='voice_value'></div>           

        </form>
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
                img_data = realImgDis(e);
                if(!img_data){
                    wx.getLocalImgData({
                            localId: e, 
                            success: function (res) {
                                var localData = res.localData; 
                                img_value = localData;
                                insertImg(img_value);
                            }
                    });             
                }else{
                    insertImg(img_data);
                }
        });
          $("#uploadImg").html("上传");
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
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/voice', TEMPLATE_INCLUDEPATH)) : (include template('../new/voice', TEMPLATE_INCLUDEPATH));?>
<style>
    .voice_display {
    position: fixed;
    top:0px;
    left:0px;
    width:100%;
    height:100%;
    z-index: 999;
    background-color:rgba(0,0,0,0.7);
    color:#fff;
    font-size: #fff;
    text-align: center;
    display: none;
}
.micro_voice_ico{
    margin-top:50%;
    width: 100%;
    height:50px;
    color:#fff;
    font-weight: 700;
}
.micro_voice_ico i{
    font-size:3em;
}
#voice_stop{
    margin: 30px auto;
    font-weight: 700;
}
.voice_div{
    margin-left:20px;
}
.no_play{
    display: inline-block;
    width: 60px!important;
    height: 18px;
    margin-bottom: 2px;
    margin-left: 2px;
}
</style>