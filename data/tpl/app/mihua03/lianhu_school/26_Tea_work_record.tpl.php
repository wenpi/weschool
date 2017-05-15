<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>学生记录-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<body>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>学生记录-<?php  if($model=='class') { ?>班级列表<?php  } else if($model=='student') { ?>选择学生<?php  } else if($model=='someone') { ?>发送<?php  } ?></div>
        </div>
 </div> 
<div class="main">
	<?php  if($model!='someone') { ?>
	<div class="panel-body table-responsive">
		<?php  if($model=='class') { ?>
		<table border="1"  bordercolor="#ccc" cellpadding="5"  cellspacing="0" class="table table-bordered"  style="border-collapse:collapse;width:100%">
			<tbody>
				<?php  if(is_array($result)) { foreach($result as $item) { ?>
				<tr>
					<td >
                        <a href="<?php  echo $this->result_result($item,$model,'url','tea_work_record');?>">
                            <span style='display:inline-block;width:60%'><?php  echo $this->classGradeName($item)?>-<?php  echo $this->className($item);?>&nbsp;&nbsp;>> </span>
						</a>
                    </td>
				</tr>
				<?php  } } ?>
				<?php  if($model!='class') { ?>
				<tr>
					<td><a href="javascript:;" onclick="window.history.back() ">返回</td>
				</tr>
				<?php  } ?>
			</tbody>
		</table>
		<?php  } ?>
		<?php  if($model=='student') { ?>
        <?php  $class_student = D('student');?>
			<ul>
                <?php  $g =0;?>
				<?php  if(is_array($result)) { foreach($result as $key => $item) { ?>
					<li style='float:left;width:30%;text-align:center;height:25px;line-height:25px;box-shadow: 3px 3px 3px rgba(0,0,0,0.2);border:1px solid #fff;<?php  if($g%3 ==0) { ?> margin-left:5%<?php  } ?>'>
                        <?php  $g++;?>
						<?php  $have_parent  =$class_student->returnEfficeOpenid($item,3);?>
						<?php  if(!$have_parent['f_openid']  && !$have_parent['s_openid'] && !$have_parent['t_openid']) { ?>
						<span class='red'>
							<?php  echo $this->result_result($item,$model,'name','work');?>
						</span>
						<?php  } else { ?>
						<a href="<?php  echo $this->result_result($item,$model,'url','tea_work_record');?>" class="Tstudentname">
							<?php  echo $this->result_result($item,$model,'name','work');?>
					    </a>
						<?php  } ?>
					</li>
				<?php  } } ?>
			</ul>
		<?php  } ?>
	</div>
	<?php  } ?>
	<?php  if($model=='someone') { ?>
	<div class="panel panel-info">
	<div class="panel-body ">
	<form   method="post"  id="form1">
		<div class="panel panel-default">
			<div class="panel-heading">
				添加新的记录【<?php  echo $result['student_name'];?>】
			</div>
			<div class="panel-body">
				<div class="tab-content">
			    <div class='form-group'>
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">记录名类型</label>
			   		<select name='jilv_class'  class='form-control span2' style='width:80%;margin-left:5%'>
						   <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
						   	<option value='<?php  echo $row['class_id'];?>'><?php  echo $row['class_name'];?></option>
						   <?php  } } ?>
					   </select>
			    </div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">记录名</label>
					
						<input type="text" name="word" id="word" class="form-control" style='width:80%;margin-left:5%'/>
						<input type="hidden" name="sid"  class="form-control" value='<?php  echo $_GPC['sid'];?>' />
					
				</div>
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">文字描述内容</label>
					
						<textarea name='content' class='form-control' style='width:80%;margin-left:5%'></textarea>
					
				</div>
                 <div  class='hide' id='voice_value'></div>     
				<div class="form-group">
					<label class="col-xs-12 col-sm-3 col-md-2 control-label">点评照片</label>
                    <div id='img_list' style='margin-bottom:5px;'>
                    </div>
                    <div style='clear:both'></div>
                    <div  class='hide' id='img_value'> </div>  
                           <div class="button button-action button-rounded button-small" style='margin-bottom:5px;margin-left:10px;' id="chooseImage">选择照片</div>
                           <div id='uploadImg' style='margin-bottom:5px;margin-left:10px;display:inline;'></div>
				</div>	
                <div class='form-group'>
                    <div class="button button-primary button-rounded button-small" style='margin-bottom:5px;margin-left:10px;' onclick='chooseVoice()'>开始录音</div>
                    <div id='uploadVoice' style='margin-bottom:5px;margin-left:10px;display:inline;' ></div>
                </div>                
				</div>
			</div>
		</div>		
		<div class="form-group col-sm-12">
			<input type="hidden" value="<?php  echo $token;?>"  name='token'>
            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
		</div>
	</form>	
</div>

<div class="panel panel-default">
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th  style="width:15%;text-align:center;">教师</th>
					<th style="width:15%;text-align:center;">类型</th>
					<th style="width:70%;text-align:center;">图片</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<?php $teacher=$item['teacher_realname'] ? $item['teacher_realname'] :'管理员';?>
				<tr>
					<td><?php  echo $item['teacher_realname'];?></td>
					<td><a href="<?php  echo  $this->createMobileUrl('sendContent',array('type'=>'work_record','id'=>$item['work_id']));?>"><?php  echo $item['class_name'];?></a></td>
					<td>
                        <?php  if($item['img'] ) { ?>
                        <div class="list_bg" style="background-image:url(<?php  echo $this->imgFrom($item['img'])?>);">
                        </div>
                        <?php  } ?>
                    </td>
				</tr>

				<tr style="border-bottom:1px solid #efefef; text-align:left; ">
				    <td style="height:20px; font-size:14px; color:#CCC" colspan=3>时间：<?php  echo date("m-d H:i:s",$item['addtime']);?></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
	</div>
</div>
<style>
    .list_bg{
        width:180px; height:150px; margin:0 auto ; text-align:center;
        background-repeat:no-repeat;
        background-position: center;
        background-size:100% 100%;
    }
</style>
<script>
 $(function(){
        //insertImg('<?php  echo $this->imgFrom($result['img']);?>','img_list');
        insertValue('<?php  echo $result['img'];?>','img_value');
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
            count: 1, 
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
    function insertImg(img_src,id_name){
        $('#'+id_name+'').html("<div style='background-size:cover; height:150px; width:180px;background-image:url("+img_src+");float:left;margin-left:2%;overflow: hidden; margin-bottom:5px;'></div>");
    }
    function insertValue(value,id_name){
          $('#'+id_name+'').html("<input type='text' name='"+id_name+"' value='"+value+"' >");
    }    
	
</script>
<?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/voice', TEMPLATE_INCLUDEPATH)) : (include template('../new/voice', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
 <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>