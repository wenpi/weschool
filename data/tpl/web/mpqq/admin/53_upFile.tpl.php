<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group fileupload fileupload-new " id="up_file_area">
    <label class="col-md-2 control-label">上传文件</label>
    <span class="fileupload-exists">更换</span>
    <input type="file" name='other_imgup' id='other_imgup' class='btn green' />
    <span class="fileupload-preview font-red"></span>
</div>
<div class="form-group">
    <label class="col-md-2 control-label">上传结果</label>
    <div class="col-sm-10 font-red" id='Here'> </div>
</div>
<script src="<?php echo MODULE_URL;?>style/js/ajaxfileupload.js"></script> 
<script>
    $(function(){
        $("#up_file_area").on("change","#other_imgup",function(e){
            var url = '<?php  echo $this->createWebUrl("fileUp");?>';
            var filename = 'other_imgup';
            imgup(url,filename,'Here');           
            $(this).clone().replaceAll(file=this);
        });
    });
    function imgup(url,filename,img_gx){
        $.ajaxFileUpload({
            url:url,
            type:"POST",
            fileElementId:filename,
            data:{
              'filename':''+filename+''
            },
            secureuri:false,
            dataType:'text', 
            success:function(data){ 
                $('#'+img_gx+'').html(data);
            }                               
        });
    } 
</script>	
<style>
    .fileupload-exists .fileupload-new,
    .fileupload-new .fileupload-exists {
        display: none;
    }
    .fileupload-inline .fileupload-controls {
        display: inline;
    }
    .fileupload-new .input-append .btn-file {
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
    }
    .thumbnail-borderless .thumbnail {
        padding: 0;
        border: none;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }
    .fileupload-new.thumbnail-borderless .thumbnail {
        border: 1px solid #ddd;
    }
</style>