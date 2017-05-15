<?php defined('IN_IA') or exit('Access Denied');?><script>
 $(function(){
        $("#plus_img").click(function(){
            chooseImage('img_list','img_value');
        });
    });
    var images = {
        localId: [],
        serverId: []
    }; 
    function chooseImage(img_id_name,value_id_name){
         images.localId='';
            wx.chooseImage({
            count: 1, 
            success: function (res) {
                images.localId = res.localIds;
                uploadImg(value_id_name);
            }
         });       
   } 
    function uploadImg(value_id_name){
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
                images.serverId.push(res.serverId);
                upImgToChat(res.serverId);
            },
            fail: function (res) {
                alert("上传错误请重试");
            }
        });
        }
        upload();     
    }
    function upImgToChat(img_value){
        if(img_value){
            sendMsg(img_value,'img_value');
            $(".other_type_msg").hide();
        }
    }
</script>