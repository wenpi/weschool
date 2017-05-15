<?php defined('IN_IA') or exit('Access Denied');?><?php  $page_title = '学生资料';?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/head', TEMPLATE_INCLUDEPATH)) : (include template('../new/head', TEMPLATE_INCLUDEPATH));?>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/style.css">
    <link rel="stylesheet" href="<?php echo MODULE_URL;?>style/css/buttons.css">
    <link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
  <script type='text/javascript' src='https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
<body>
<div class="container" id="container">
    <div class="cell">
    <div class="hd">
        <h1 class="page_title">我的资料</h1>
    </div>
    </div>
  <form class="form-signin" action=" " method="POST">
  <ul>
        <li>
            <label for="" class="listname">学生姓名：</label>
            <input type="mobile" id="" name=''  value='<?php  echo $result['student_name'];?>' readonly style="border:none;">
		</li>
		 <li>
            <label for="" class="listname">学生系统号：</label>
            <input type="text" id="" name=''   value='<?php  echo $result['student_passport'];?>' readonly style="border:none;">
       </li>
		<li>
            <label for="" class="listname">学生学号：</label>
            <input type="text" id="" name='' value='<?php  echo $result['xuehao'];?>' readonly style="border:none;">
       </li>
		<li>
            <label for="address" class="listname">学生地址：</label>
            <input type="text" id="address" name='address' class="form-control"   value='<?php  echo $result['address'];?>' >
        </li>
		 <li>      
            <label for="student_link" class="listname">联系方式：</label>
            <input type="text" id="student_link" name='student_link' class="form-control"   value='<?php  echo $result['student_link'];?>' >
       </li>
		<li>
            <label for="parent_name" class="listname">家长姓名：</label>
            <input type="text" id="parent_name" name='parent_name' class="form-control"   value='<?php  echo $result['parent_name'];?>' >
        </li>
		<li>
            <label for="parent_phone" class="listname">家长电话：</label>
            <input type="number" id="parent_phone" name='parent_phone' class="form-control"   value='<?php  echo $result['parent_phone'];?>' >
        </li>
		<li>
            <label for="relation" class="listname">关系：</label>
				<?php  $relation_list = $this->class_base->getRelation(); ?>
				<select name='relation' class="form-control" style="width:70.5%;-webkit-appearance: none;  ">
					<?php  if(is_array($relation_list)) { foreach($relation_list as $row) { ?>
                        <option value="<?php  echo $row;?>" <?php  if($row == $my_relation) { ?> selected <?php  } ?>><?php  echo $row;?></option>
					<?php  } } ?>
				</select>
        </li>        
		</ul>          
       <div id='img_list' style='margin-bottom:5px;'></div>
        <div style='clear:both'></div>
        <div  class='hide' id='img_value'>
        </div>  
         <div class='form-group'>
             <div class="button button-action button-rounded button-small" style='margin-bottom:5px;margin-left:10px;' id="chooseImage">选择照片</div>
             <div id='uploadImg' class="" style='margin-bottom:5px;margin-left:10px;'></div>
         </div>
        <button class="button button-raised button-caution" type="submit" ><i class="fa fa-user"></i>&nbsp;&nbsp;提交</button>
  </form>
 <script>
    $(function(){
        <?php  if($result['student_img']) { ?>
            insertImg('<?php  echo $this->imgFrom($result['student_img']);?>');
            insertValue('<?php  echo $result['student_img'];?>');
        <?php  } ?>
    });
    var images = {
        localId: [],
        serverId: []
    };    
    document.querySelector('#chooseImage').onclick = function () {
        images.localId='';
        wx.chooseImage({
        count: 1, 
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
          insertValue(res.serverId);
          if (i < length) {
             upload();
          }else{
              $("#uploadImg").html("上传成功");
            //   alert("上传成功!");
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
        $('#img_list').html("<div style='background-size:cover; background-image:url("+img_src+");width:150px;; height:150px;float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
    }
    function insertValue(value){
        $("#img_value").html("<input type='hidden' name='img_value' value='"+value+"' >");
    }
</script>   
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/footer', TEMPLATE_INCLUDEPATH));?>