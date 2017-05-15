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
            <!--结束公共头部-->
                <div class='row'>
                     <div class="col-md-12">
                         <?php  if($ac=='list') { ?>
                         <?php  if($model !='someone') { ?>
                            <?php  if($model =='grade') { ?>
                                <?php  $page = '年级列表';?>
                                <?php  $intro ='请选择学生所在的年级'; ?>
                                <?php  $color ='green';?>
                            <?php  } else if($model =='class') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='请选择学生所在的班级'; ?>
                                <?php  $color ='yellow-casablanca';?>
                            <?php  } else if($model =='student') { ?>
                                <?php  $page = '学生列表';?>
                                <?php  $intro ='填写具体的分数'; ?>
                                <?php  $color ='blue';?>
                            <?php  } ?>
                                <div class="note note-info">
                                    <h4 class="block"><?php  echo $page;?></h4>
                                    <p><?php  echo $intro;?></p>
                                </div> 
                              <div class="row" >
                                <?php  if($model =='student' ) { ?>
                                    <form   action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                            <div class="form-body form-actions ">
                                                    <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" ><span class="required" aria-required="true"> * </span>选择课程</label>
                                                    <div class="col-md-10">
                                                        <select name='course_id' onchange="ajax_up()" id="course_id" class="form-control">
                                                            <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                                                                <option value='<?php  echo $row['course_id'];?>'><?php  echo $row['course_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>                                             
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-2 control-label" ><span class="required" aria-required="true"> * </span>选择考试记录</label>
                                                    <div class="col-md-10">
                                                       <select name='scorejilv_id' onchange="ajax_up()" id="scorejilv_id" class="form-control">
                                                            <?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
                                                                <option value='<?php  echo $row['scorejilv_id'];?>'><?php  echo $row['scorejilv_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                        <div class="form-control-focus"> </div>
                                                    </div>
                                                </div>  
                                          	<div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type='hidden' value='<?php  echo $_GPC['cid'];?>' name='class_id'>
                                                        <input type="submit" name="submit" class="btn blue" value="确认"></button>
                                                    </div>
                                                </div>
                                             </div>                                            
                                        </div>
                                <?php  } ?>
                                <div  id='score_list'>
                                <?php  if(is_array($result)) { foreach($result as $item) { ?>
                                <div class="col-md-2 col-sm-2 col-xs-6">
                                    <div class="color-demo tooltips" >
                                        <?php  if($model !='student') { ?>
                                        <a href="<?php  echo $this->result_result($item,$model,'url','score_list');?>&aw=1">
                                        <?php  } ?>
                                             <div  onclick="input_this(<?php  echo $item['student_id'];?>)"  class="color-view bg-<?php  echo $color;?> bg-font-<?php  echo $color;?> bold uppercase"><?php  echo $this->result_result($item,$model,'name','score_list');?> </div>
                                           <?php  if($model =='student') { ?>
                                                <div class=" bg-white c-font-14 sbold">
                                                     <input id="input_<?php  echo $item['student_id'];?>" type="text" class="col-md-12  " style="margin-bottom:10px;" name='score[<?php  echo $item['student_id'];?>]' placeholder="填写成绩"> </div>
                                           <?php  } else { ?>
                                                <div class="color-info bg-white c-font-14 sbold"> 点击选择 </div>
                                           <?php  } ?>
                                        <?php  if($model !='student') { ?>
                                            </a>
                                        <?php  } ?>
                                    </div>
                                </div>
                                <?php  } } ?>                       
                             </div>                       
                             </div>                       
                         <?php  } ?>
 
                        <?php  } ?>
                        <?php  if($model=='student') { ?>
                            </form>
                            <script>
                                $(function(){
                                    ajax_up();
                                });
                                    function ajax_up(){
                                        var cid=<?php  echo $_GPC['cid'];?>;
                                        var course_id=$('#course_id').val();
                                        var scorejilv_id=$('#scorejilv_id').val();
                                        $.ajax({
                                            type:'post',
                                            url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'student_score_list'))?>',
                                            data:{cid:cid,course_id:course_id,scorejilv_id:scorejilv_id},
                                            dataType:'json',
                                            success:function(obj){
                                                if(obj.status=='yes'){
                                                    $("#score_list").find('input').attr("data-id",0);
                                                    $.each(obj.student_score_list,function(i,e){
                                                        $('input[name="score['+e.student_id+']"]').val(e.score);
                                                		$('input[name="score['+e.student_id+']"]').attr("data-id",1);
                                                    });
                                                    $.each($("#score_list").find('input'),function(i,e){
                                                        if($(this).attr('data-id')!=1)
                                                                $(this).val(0);
                                                    });                                                   
                                                }
                                            }
                                        });								
                                    }
                            </script>
                        <?php  } ?>

                    </div>
                </div>
            <!--开始公共尾部-->
              </div>
            </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
    </body>
    </html>