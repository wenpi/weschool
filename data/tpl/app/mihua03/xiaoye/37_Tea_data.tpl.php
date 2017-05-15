<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaHead', TEMPLATE_INCLUDEPATH));?>
<body>
	<div class="main">
    	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
        <ul class="wdzl">
            <li class="wd">
                <p>教师姓名</p>
                <input type="text" value="<?php  echo $result['teacher_realname'];?>" name="teacher_realname">
            </li>
            <li class="wd">
                <p>手机号码</p>
                <input type="text" value='<?php  echo $result['teacher_telphone'];?>' name="teacher_telphone">
            </li>
            <li class="wd">
                <p>电子邮箱</p>
                <input type="text"  value='<?php  echo $result['teacher_email'];?>'  name="teacher_email">
            </li>
		</ul>
		<div class="ewm">
			<p>个人头像</p>
			<div class="ew-p">
			<div id='img_list' class="img_list" style='margin-bottom:15px;'  >
                <div style=" background-image:url(<?php  if($result['teacher_img']) { ?> <?php  echo $this->imgFrom($result['teacher_img']);?> <?php  } else { ?> <?php  echo $school_logo;?> <?php  } ?>);" class="tea_data_img"></div>
                <div class="clear"></div>
            </div>
            <input type="hidden" name="img_value" id="img_value" value="<?php  echo $result['teacher_img'];?>">
		</div>
			<input class="byc" type="button" value="选择照片" id='chooseImage'>
		</div>
		<div class="jsewm">
			<div class="jss">教师微信二维码</div>
		<div class="ewm ttt">
			<div class="eww-p">
                <div id='img_list_qr' class="img_list" style='margin-bottom:15px;'  >
                    <div style="background-image:url(<?php  if($result['weixin_code']) { ?> <?php  echo $this->imgFrom($result['weixin_code']);?> <?php  } else { ?> <?php  echo $school_logo;?> <?php  } ?>);" class="tea_data_img"></div>
                    <div class="clear"></div>
                </div>
                <input type="hidden" name="img_value_qr" id="img_value_qr" value="<?php  echo $result['weixin_code'];?>">
		   </div>
			<input class="byc " type="button" value="选择照片" id='chooseImage_qr' >
		</div>
		</div>
		<div class="mf"><a href="#"><input type="submit"  name="submit" value="提交" /></a></div>
        </form>

		<?php  $center_class = 'cde'?>
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newTeaFooter', TEMPLATE_INCLUDEPATH));?>
    </div>
</body>
<script>
    $(function(){
        $("#chooseImage").click(function(){
            chooseImage('img_list','img_value','uploadImg');
        });
        $("#chooseImage_qr").click(function(){
            chooseImage('img_list_qr','img_value_qr','uploadImg_qr');
        });
    });
    var images = {
        localId: [],
        serverId: []
    };    

    function chooseImage(img_id_name,value_id_name,up_id_name){
            images.localId='';
            wx.chooseImage({
            count: 1, 
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
                                    insertImg(img_value,img_id_name);
                                }
                        });             
                    }else{
                        insertImg(img_data,img_id_name);
                    }
                });
                uploadImg(value_id_name,up_id_name);
            }
         });       
    } 
    function uploadImg(value_id_name,up_id_name){
        if (images.localId.length == 0) {
            alert('请先选择图片');
            return;
        }
        var i = 0, length = images.localId.length;
        images.serverId = [];
        function upload() {
            wx.uploadImage({
                localId: images.localId[i],
                success: function (res) {
                i++;
                images.serverId.push(res.serverId);
                insertValue(res.serverId,value_id_name);
                if (i < length) {
                        upload();
                }
            },
            fail: function (res) {
                    alert("上传错误，请重试!");
            }
          });
        }
        upload();     
    }

    function insertImg(img_src,id_name){
        $('#'+id_name+'').html("<div class='tea_data_img' style=' background-image:url("+img_src+");'></div>");
    }
    function insertValue(value,id_name){
        $("#"+id_name+"").val(value);
    }

</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
</html>
