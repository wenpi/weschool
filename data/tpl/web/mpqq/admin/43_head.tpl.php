<?php defined('IN_IA') or exit('Access Denied');?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php  echo $title;?><?php  if($_W['uniaccount']['name']) { ?>--<?php  echo $_W['uniaccount']['name'];?><?php  } ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="家校互联" name="description" />
<meta content="zhuhuan" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo MODULE_URL;?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo MODULE_URL;?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo MODULE_URL;?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo MODULE_URL;?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo MODULE_URL;?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>admin/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo MODULE_URL;?>admin/js/js.js" ></script>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo MODULE_URL;?>/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
 <!-- END THEME LAYOUT STYLES -->
 <script src="<?php echo MODULE_URL;?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
 <!-- we7 -->
<?php  if(!in_array($left_nav,array('system_index_nav','system_set' ,'attence') ) && $we7_js!='no'  ) { ?>
 <script src="<?php echo MODULE_URL;?>admin/js/util.js"   type="text/javascript"></script>
 <script src="<?php echo MODULE_URL;?>admin/js/require.js"    type="text/javascript"></script>
 <?php  if(IMS_VERSION > 0.8) { ?>
    <script src="<?php echo MODULE_URL;?>admin/js/fileuploader.min.js" type="text/javascript"></script>
    <script src="<?php echo MODULE_URL;?>admin/js/config.1.0.min.js" type="text/javascript"></script>
 <?php  } else { ?>
     <script src="<?php echo MODULE_URL;?>admin/js/config.js" type="text/javascript"></script>
 <?php  } ?>
<?php  } ?>
 <script>
     function teacher_class_change(){
       class_obj=$('.class_s');
       var class_id_str='';
       $.each(class_obj,function(i,e){
             have_check=$(this).prop('checked');
             if(have_check){
                 class_id_str +=$(this).val()+',';
             }
       });   
          $.ajax({
           url:'<?php  echo $this->createWebUrl("ajax")?>',
           type:'post',
           dataType:'json',
           data:{ac:'teacher_class_change',class_str:class_id_str}, 
           success:function(obj){
               if(obj.status=='success'){
                   $("#course_list").html('');
                   $.each(obj.list,function(i,e){
                     $("#course_list").append("<input type='checkbox' class='box_type' value='"+e.course_id+"' name='course_id[]' >&nbsp;"+e.course_name+"&nbsp;&nbsp;&nbsp;&nbsp;");
                   });
               }
           }
       });
   }
   //审核通过
   function passThis(id,type){
       $.ajax({
           url:'<?php  echo $this->createWebUrl("ajax")?>',
           type:'post',
           dataType:'json',
           data:{id:id,type:type,ac:'pass'},
           success:function(obj){
               if(obj.errcode==0){
                   if(type=='line'){
                      queue_num =  $("#"+type+'_'+id).find('.queue_num').attr("data-queue");
                      location.href="<?php  echo $this->createWebUrl("sendToMsg")?>&que_num="+queue_num;
                   }
                   $("#"+type+'_status_'+id).html("审核通过");
                   $("#"+type+'_'+id).find('.red').remove();   
            }
           }
       });
   }
    //删除操作
     function deleteThis(id,type){
            $.ajax({
                url:'<?php  echo $this->createWebUrl("ajax")?>',
                type:'post',
                dataType:'json',
                data:{id:id,type:type,ac:'tea_delete'},
                success:function(obj){
                    if(obj.errcode==0){
                        alert("删除成功！");
                        $("#"+type+'_'+id).remove();   
                    }
                }
            });
   }
   function check_this(id){
       if($("#chebox_"+id).prop('checked'))
            $("#chebox_"+id).prop('checked',false);
       else
            $("#chebox_"+id).prop('checked',true);
   }
   function input_this(id){
       $("#input_"+id).focus();
   }
</script>
    <body class=" page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-fixed">