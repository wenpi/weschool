<?php defined('IN_IA') or exit('Access Denied');?>    <div class="z_dpt56">
        以下回复此消息
    </div>

    <form method="post" action="<?php  echo $this->createMobileUrl("peopleReply");?>">
            <input type="hidden" name="type" value="<?php  echo $type;?>">
            <input type="hidden" name="id"   value="<?php  echo $id;?>">
            <div  class='hide' id='img_value'></div>
            <div class="z_dpt6">
            <div class="weui_cell_ft" id='weui_cell_ft_num'>图片上传&nbsp;&nbsp;&nbsp;&nbsp;<span class='num'>0</span>/<span class='all_num'>0</span></div>
            <div class="z_dpt62" >
                <label for="z_fl"  id="chooseImage" >+</label>
                <div id='weui_uploader_files'>
                </div>
                <div style="clear:both"></div>
            </div>
            </div>
            <div class="z_dpt7">
                <p class="z_dpt61">文字内容</p>
                <p class="z_dpt72">
                    <textarea  placeholder="家长回复内容！" rows="3" name="content"  ></textarea>
                </p>
            </div>
            <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/only_voice', TEMPLATE_INCLUDEPATH));?>
            <div class="z_dpt5">
                <input type="submit"  name="submit" value="点击回复">
            </div>
    </form>
    <?php  if($look_info['images'] || $look_info['content'] || $look_info['voice']) { ?>
        <div class="z_dpt56" style=" background-color: #fff;color: rgba(255,153,0,1);">
            此条消息回复历史
        </div>      
        	<div class="z_dp">
                     <div class="z_dpt4">
                        <p><?php  echo myHtmlspecialchars_decode($look_info['content']);?></p>
                    </div>
                    <div id="">
                    <?php  if($look_info['voice']) { ?>
                            <audio preload="auto" controls>
                                <source src="<?php  echo $this->imgFrom($look_info['voice']);?>" />
                            </audio>
                    <?php  } ?>   	
                    </div>
                    <div class="z_dpt3" id="img_list">
                            <?php  $urls =  $this->decodeLineImgsToArr($look_info['images']);?>
                                <?php  if($urls) { ?>
                                    <?php  if(is_array($urls)) { foreach($urls as $val) { ?>
                                    <img src="<?php  echo $val;?>" style="margin-top:10px;" onclick="displayImage('img_list','<?php  echo $val;?>')">
                                    <?php  } } ?>
                                <?php  } ?>           
                    </div>            

            </div>

    <?php  } ?>
<script>
    var images = {
        localId: [],
        serverId: []
    };
    document.querySelector('#chooseImage').onclick = function () {
        $("#weui_uploader_files").html('');
        images.localId='';
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
        if (images.localId.length == 0) {
            alert('请先选择图片');
            return;
        }
        $("#img_value").html('');
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
        $('#weui_uploader_files').prepend("<label class='weui_uploader_file background_img' style='background-image:url("+img_src+")'> </label> ");
    }
    function insertValue(value){
        $("#img_value").prepend("<input type='hidden' name='img_value[]' value='"+value+"' >");
    }
</script>


