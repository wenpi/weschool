<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <title>消息发送-<?php  echo $_SESSION['school_name'];?></title>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common', TEMPLATE_INCLUDEPATH)) : (include template('common', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('tea_common', TEMPLATE_INCLUDEPATH)) : (include template('tea_common', TEMPLATE_INCLUDEPATH));?>
    <link href="<?php echo MODULE_URL;?>style/css/line_css.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo MODULE_URL;?>template/mobile/style/style_nav.css">
</head>
<div class="top-wrap">
        <div class="fn-clear tr-box top bg_yellow" >
            <div class='text_center white'>消息队列处理界面</div>
        </div>
 </div>  
<div class="main" style='margin-bottom:60px;'>
	<div class="panel-body table-responsive">
		<table class="table table-hover">
			<thead class="navbar-inner">
				<tr>
					<th>昵称</th>
					<th>发送类别</th>
					<th>结束时间</th>
					<th>状态</th>
				</tr>
			</thead>
			<tbody id="queue_line">
                <?php  $class_base    = D('base'); ?>
                <?php  $class_student = D('student'); ?>

				<?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <?php  if($item['student_id']) { ?>
                        <?php  $info = $class_student->getStudentInfo( $item['student_id']); ?>
                    <?php  } ?>
                <?php  $fanid = $class_base->openi2fanid($item['openid']); ?>
            	<tr data-id='<?php  echo $item['queue_id'];?>' data-status='<?php  echo $item['queue_status'];?>'>
					<td><?php  echo $info['student_name'];?>-<?php  echo $class_student->getRelation($item['student_id'],$fanid);?> </td>
                    <td><?php  if($item['queue_type']== 1) { ?>模板消息<?php  } ?><?php  if($item['queue_type']== 2) { ?>客服消息<?php  } ?><?php  if($item['queue_type']== 3) { ?>短信<?php  } ?></td>
					<td class='end_time'><?php  if($item['end_time'] ) { ?><?php  echo date("Y-m-d H:i:s",$item['end_time']);?><?php  } ?></td>
					<td class='status'><?php  if($item['queue_status'] ==1) { ?>未发送<?php  } ?><?php  if($item['queue_status'] ==2) { ?>已经发送<?php  } ?><?php  if($item['queue_status'] ==3) { ?><span style='color:#ff0033'>发送失败</span><?php  } ?></td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
	</div>
</div>
<link href="<?php echo MODULE_URL;?>style/css/weui.min.css" rel="stylesheet" type="text/css" />
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../new/tea_footer', TEMPLATE_INCLUDEPATH)) : (include template('../new/tea_footer', TEMPLATE_INCLUDEPATH));?>
<script>
    var page=0;
    var xid=0;
    var count=<?php  echo $count;?>;
    $(function(){
      if(count>0){
        if(confirm("确认将进入发送进程，未发送完请勿关闭此网页")){
              xid=setInterval("getNextSend()",1000);
          }
      }else{
          alert("没有需要发送的");
          return false;  
    }
    });
    function getNextSend(){
       var send=false;
       all_list=$('#queue_line').find("tr");
       $.each(all_list,function(i,e){
           if($(this).attr('data-status')==1){
               ajaxUp($(this).attr("data-id"),$(this));
               send=true;
               return false;
           }
       });
       if(!send){
           clearInterval(xid);
           alert("已经全部发送完毕！");    
           location.href="<?php  echo $this->createMobileUrl("teacenter");?>"; 
       }
    }
    function ajaxUp(queue_id,obj){
        $.ajax({
          type:"POST",
          url:'<?php  echo $this->createMobileUrl("ajax");?>',            
          async:'false',
          dataType:'json',
          data:{queue_id:queue_id,ac:'send_msg_line'},
          success:function(dataJson){
              changeStatus(dataJson.status,dataJson.end_time,obj);
          } 
      });
    }    
    function changeStatus(status,end_time,obj){
        obj.find(".end_time").html(end_time);     
        obj.attr('data-status',status);
        if(status==2){
            obj.find(".status").html('发送成功');     
       }else if(status==3){
            obj.find(".status").html('<span style="color:#ff0033">发送失败</span>'); 
       }
    }
</script>