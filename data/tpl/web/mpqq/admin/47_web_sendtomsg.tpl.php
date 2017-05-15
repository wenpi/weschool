<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p>  消息队列处理界面（直到提示完成请勿关闭)</p>
                            </div>
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> 消息队列处理界面 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th>昵称</th>
                                                <th>手机号</th>
                                                <th>发送类别</th>
                                                <th>添加时间</th>
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
                                                        <tr data-id='<?php  echo $item['queue_id'];?>' data-status='<?php  echo $item['queue_status'];?>'>
                                                            <td><?php  if(!$_GPC['teacher']) { ?>
                                                                    <?php  $fanid = $class_base->openi2fanid($item['openid']); ?>
                                                                    <?php  echo $info['student_name'];?>-<?php  echo $class_student->getRelation($item['student_id'],$fanid);?>
                                                                <?php  } else { ?>
                                                                    <?php  $uid = $class_base->openid2uid($item['openid']); ?>
                                                                    <?php  $info = D('teacher')->wechatUidGet($uid);?>
                                                                    <?php  echo $info['teacher_realname'];?>
                                                                <?php  } ?>
                                                            </td>
                                                            <td><?php  echo $item['mobile'];?></td>
                                                            <td><?php  if($item['queue_type']== 1) { ?>模板消息<?php  } ?><?php  if($item['queue_type']== 2) { ?>客服消息<?php  } ?><?php  if($item['queue_type']== 3) { ?>短信<?php  } ?></td>
                                                            <td><?php  echo date("Y-m-d H:i:s",$item['add_time']);?></td>
                                                            <td class='end_time'><?php  if($item['end_time'] ) { ?><?php  echo date("Y-m-d H:i:s",$item['end_time']);?><?php  } ?></td>
                                                            <td class='status'><?php  if($item['queue_status'] ==1) { ?>未发送<?php  } ?><?php  if($item['queue_status'] ==2) { ?>已经发送<?php  } ?><?php  if($item['queue_status'] ==3) { ?><span style='color:#ff0033'>发送失败</span><?php  } ?></td>
                                                        </tr>
                                                    <?php  } } ?>
                                                </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
        </div>
        </div>
 <script>
    var page       = 0;
    var xid        = 0;
    var count      = <?php  echo $count;?>;
    var limit_send = 15;
    var could_send = new Array();
    $(function(){
      if(count>0){
        if(confirm("确认将进入发送进程，未发送完请勿关闭此网页")){
              getNextSend();
          }
      }else{
          alert("没有需要发送的");
          return false;  
    }
    });
    function getNextSend(){
       var send = false;
       var this_limit_send = 0;
       var queue_ids = '';
       all_list = $('#queue_line').find("tr");
       $.each(all_list,function(i,e){
           if($(this).attr('data-status')==1){
               if(this_limit_send<limit_send){
                    queue_id   = $(this).attr("data-id");
                    queue_ids += queue_id+',';
                    could_send[queue_id] = $(this);
                    send         = true;
                    this_limit_send ++;
                }
           }
       });
       if(!send){
           alert("已经全部发送完毕！");     
           return false;
       }else{
           ajaxUp(queue_ids);
       }
    }
    function ajaxUp(queue_ids){
        $.ajax({
          type:"POST",
          url:'<?php  echo $this->createWebUrl("ajax");?>',            
          async:'false',
          dataType:'json',
          data:{queue_ids:queue_ids,ac:'send_msg_line'},
          success:function(dataJson){
              changeStatus(dataJson);
          } 
      });
    }    
    function changeStatus(dataJson){
        $.each(dataJson,function(i,e){
            obj = could_send[i];
            obj.find(".end_time").html(e.end_time);     
            obj.attr('data-status',e.status);
            if(e.status==2){
                    obj.find(".status").html('发送成功');     
            }else if(status==3){
                    obj.find(".status").html('<span style="color:#ff0033">发送失败</span>'); 
            }
        });
        could_send = new Array();
        getNextSend();
    }
</script>       
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>