<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>班级公告-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>班级公告</div>
        </div>
 </div>  
<div class="main" style='margin-bottom:60px;'>
	<?php  if($ac=='list') { ?>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>选择班级</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><a href="<?php  echo  $this->createMobileUrl('Tea_line',array('ac'=>'new','cid'=>$item['class_id']))?>"><?php  echo $item['grade_name'];?>--<?php  echo $item['class_name'];?></a></td>
                    
					<td>
                        <a href="<?php  echo $this->createMobileUrl('Tea_line',array('ac'=>'new','cid'=>$item['class_id']))?>">新增</a>&nbsp;&nbsp;&nbsp;
						<a href="<?php  echo $this->createMobileUrl('Tea_line',array('ac'=>'old','cid'=>$item['class_id']))?>">查看</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	<?php  } ?>
	<?php  if($ac=='old') { ?>
		<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>标题</th>
					<th>发布老师</th>
					<th>类型</th>
					<th>查看数</th>
					<th>状态</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr id="line_<?php  echo $item['line_id'];?>">
					<td><?php  echo $item['line_title'];?></td>
					<td><?php  if($item['teacher_realname']) { ?><?php  echo $item['teacher_realname'];?><?php  } else { ?>管理员<?php  } ?></td>
					<td><?php  echo $line_type_cfg[$item['line_type']];?></td>
					<td><?php  echo $item['line_look'];?></td>
					<td><?php  if($item['status'] ==1) { ?>正常<?php  } else if($item['status']==2) { ?>审核中<?php  } else { ?>关闭<?php  } ?></td>
					<td>
						<a href="<?php  echo $this->createMobileUrl('Tea_line',array('ac'=>'edit','lid'=>$item['line_id']))?>">编辑</a>
						<span class='btn btn-default btn-sm red ' onclick="deleteThis('<?php  echo $item['line_id'];?>','line')"  >删除</span>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>
	</div>
	<?php  } ?>
	<?php  if($ac=='new' || $ac=='edit') { ?>
	<form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
		<input type="hidden" name="cid"   value='<?php  echo $class['class_id'];?>' />
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php  if($ac=='new') { ?>新增<?php  } else { ?>修改<?php  } ?>
			</div>
			<div class="panel-body">
				<div class="tab-content">
				<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
					<div class="col-sm-9 col-xs-10">
						<input type='text' value='<?php  echo $result['line_title'];?>' name='line_title' class='form-control' >
					</div>	
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>类型</label>
					<div class="col-sm-9 col-xs-10">
						<select name='line_type'  class='form-control' >
							<?php  if(is_array($line_type_cfg)) { foreach($line_type_cfg as $key => $list) { ?>
								<option value='<?php  echo $key;?>' <?php  if($result['line_type']==$key) { ?> selected <?php  } ?>><?php  echo $list;?></option>
							<?php  } } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>消息内容</label>
					<div class="col-sm-9 col-xs-10">
						<textarea class='form-control' name='line_content' style="height:200px;"><?php  echo $result['line_content'];?></textarea>
					</div>
				</div>	
                <div  class='hide' id='voice_value'></div>     
				<div class='form-group'>
					<div id='img_list'>
						<div class='clear'></div>
					</div>
					<div  class='hide' id='img_value'>
						
					</div>
					<div class='clear'></div>
				</div>
				 <div class='form-group'>
					<div class="button button-primary button-rounded button-small" style='margin-left:10px;' id="chooseImage">
					选择图片
					</div>
        		 </div>
                <div class='form-group'>
                    <div class="button button-primary button-rounded button-small" style='margin-bottom:5px;margin-left:10px;' onclick='chooseVoice()'>开始录音</div>
                    <div id='uploadVoice' style='margin-bottom:5px;margin-left:10px;display:inline;' ></div>
                </div>   										
				<?php  if($ac=='edit') { ?>
					<div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>状态</label>
					<div class="col-sm-9 col-xs-10">
					<select name='status'  class='form-control'>
							<option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>正常</option>
							<option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
					</select>
					</div>							
					</div>
				<?php  } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
			<div class="col-sm-9 col-xs-10">
				<input type="hidden" value="<?php  echo $token;?>"  name='token'>
				&nbsp;&nbsp;<input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
			</div>
			</div>
		</div>		
	</form>	
    <div class='voice_display' id='voice_display'>
        <div class='micro_voice_ico' ><i class="fa fa-microphone"></i><br>录音中...</div>
        <div id='voice_stop' class='button button-highlight button-rounded button-small'>停止录音</div>
     </div>		
	<?php  } ?>
</div>
<script>
 $(function(){
	 	<?php  if($result['imgs']) { ?>
			<?php  $img_list = json_decode($result['imgs'],1);?>
			<?php  if(is_array($img_list)) { foreach($img_list as $row) { ?>
				insertImg(' <?php  echo $this->imgFrom($row);?>','img_list');
				insertValue('<?php  echo $row;?>','img_value');
			<?php  } } ?>
		<?php  } ?>
        $("#chooseImage").click(function(){
            chooseImage('img_list','img_value','uploadImg');
        });
    });
    var images = {
        localId: [],
        serverId: []
    }; 
  // 3 智能接口
  var voice = {
    localId: '',
    serverId: ''
    };       
    function chooseImage(img_id_name,value_id_name,up_id_name){
         images.localId='';
            wx.chooseImage({
            count: 9, 
            success: function (res) {
                images.localId = res.localIds;
                $.each(images.localId,function(i,e){
                    insertImg(e,img_id_name);
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
          }else{
              $("#"+up_id_name+"").html("上传成功");
          }
        },
        fail: function (res) {
           alert(JSON.stringify(res));
        }
      });
    }
    upload();     
  }
 function chooseVoice () {
    wx.startRecord({
      cancel: function () {
          alert('您拒绝授权录音');
      }
    });
    $("#voice_display").show();
  }
  //停止录音
   document.querySelector('#voice_stop').onclick = function () {
    wx.stopRecord({
      success: function (res) {
        voice.localId = res.localId;
        $("#voice_display").hide();
        uploadVoice();
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });
  } 
 //上传录音
 function uploadVoice() {
    if (voice.localId == '') {
      return;
    }
    wx.uploadVoice({
      localId: voice.localId,
      success: function (res) {
        $("#uploadVoice").html("上传录音成功");
        insertVoiceValue(res.serverId);
        voice.serverId = res.serverId;
      }
    });
  };
    function insertImg(img_src,id_name){
        $('#'+id_name+'').prepend("<div style='background-size:cover; height:150px; width:180px;background-image:url("+img_src+");float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
    }
    function insertValue(value,id_name){
          $('#'+id_name+'').prepend("<input type='text' name='"+id_name+"[]' value='"+value+"' >");
    }    
    function insertVoiceValue(value){
        $("#voice_value").html("<input type='hidden' name='voice_value' value='"+value+"' >");
    }    	
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>