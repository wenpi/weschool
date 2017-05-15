<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
            <?php  if($ac!='print_reply') { ?>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <?php  } ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                 <?php  if($ac!='print_reply') { ?>
                    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                 <?php  } ?>
                <?php  if($ac =='add' ) { ?>
                     <div class="row">
                         <div class="col-md-12">
                               <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 报修详情</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                   <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form2"  >
                                  <div class="portlet-body form">
                                        <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span> 标题</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" name="repair_title" id="repair_title" class="form-control" value='<?php  echo $result['repair_title'];?>' readonly />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>
                                         <div class="form-group  form-md-line-input">
                                            <label class="col-md-2 control-label">申请处理部门</label>
                                            <div class="col-sm-10 ">
                                                <input type="text" class="form-control" value='<?php  echo $result['department_name'];?>' readonly />
                                                <div class="form-control-focus"> </div>
                                            </div>
                                        </div>                                       
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">详细内容</label>
                                            <div class="col-sm-10">
                                                <textarea name="repair_content" class="form-control" rows="3" readonly ><?php  echo $result['repair_content'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">图像</label>
                                            <div class="col-sm-10">
                                                <?php  $imgs = json_decode($result['repair_img'],1);?>
                                                <?php  if(is_array($imgs)) { foreach($imgs as $row) { ?>
                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="mt-card-item">
                                                            <div class="mt-card-avatar mt-overlay-1 mt-scroll-down">
                                                                <img src="<?php  echo $this->imgFrom($row)?>" style="width:100%" />
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                <?php  } } ?>
                                            </div>
                                        </div>				
                                  </div>    
                                  </form>
                             </div>                                  
                        </div>
                        <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"> 添加回复</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">详细内容</label>
                                            <div class="col-sm-10">
                                                <textarea name="reply_content" class="form-control" rows="3" autofocus></textarea>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-2 control-label">处理部门</label>
                                            <div class="col-sm-10">
                                                 <select id="select_selectsplitter3" class="form-control" name="admin_id"  >
                                                       <?php  if(is_array($repair_list)) { foreach($repair_list as $row) { ?>
                                                        <optgroup label="<?php  echo $row['department_name'];?>">
                                                            <?php  if(is_array($row['admin_list'])) { foreach($row['admin_list'] as $v) { ?>
                                                                <option value="<?php  echo $row['department_id'];?>_<?php  echo $v['admin_id'];?>"><?php  echo $v['admin_name'];?></option>
                                                            <?php  } } ?>
                                                        </optgroup>
                                                       <?php  } } ?>
                                                    </select>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">图像</label>
                                            <div class="col-sm-10">
                                                <?php  echo tpl_form_field_multi_image('reply_img','');?>
                                            </div>
                                        </div>				
                                        <div class='form-group'>
                                            <label class="col-md-2 control-label"><span class="required" aria-required="true"> * </span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status' class="form-control"  >
                                                    <option value='1' >已经收到反馈</option>
                                                    <option value='2' >修复成功</option>
                                                    <option value='3' >无法修复</option>
                                            </select>
                                            </div>							
                                      </div>
                                      <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <input type="submit" name="submit" class="btn blue" value="确认">
                                                    </div>
                                                 </div>
                                      </div>                                                                                
                                    </form>
                                  </div>    
                             </div>            
                      </div>        
                          <div class="col-md-12">
                               <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-red">
                                        <i class="fa fa-cubes font-red"></i>
                                        <span class="caption-subject bold uppercase"> 处理历史</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                   <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form2"  >
                                    <?php  if(is_array($his_list)) { foreach($his_list as $row) { ?>
                                        <div class="portlet-body form">
                                            <div class="form-group  form-md-line-input">
                                                <label class="col-md-2 control-label">处理时间</label>
                                                <div class="col-sm-10 ">
                                                    <input type="text"  class="form-control" value='<?php  echo date("Y-m-d H:i",$row['reply_time'])?>' readonly />
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">详细内容</label>
                                                <div class="col-sm-10">
                                                    <textarea  class="form-control" rows="3" readonly ><?php  echo $row['reply_content'];?></textarea>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-2 control-label">处理部门</label>
                                                <div class="col-sm-10">
                                                    <input type="text"  class="form-control" value='<?php  echo $row['department_name'];?>-<?php  echo $row['admin_name'];?>' readonly />
                                                </div>
                                            </div>                                           
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">状态</label>
                                                <div class="col-sm-10">
                                                        <select readonly class="form-control"  >
                                                            <option value='1' <?php  if($row['status']==1) { ?>selected<?php  } ?> >已经收到反馈</option>
                                                            <option value='2' <?php  if($row['status']==2) { ?>selected<?php  } ?>  >修复成功</option>
                                                            <option value='3' <?php  if($row['status']==3) { ?>selected<?php  } ?>  >无法修复</option>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">图像</label>
                                                <div class="col-sm-10">
                                                    <?php  $imgs = json_decode($row['reply_img'],1);?>
                                                    <?php  echo tpl_form_field_multi_image('a',$imgs);?>
                                                </div>
                                            </div>	
                                          <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-2 col-md-10">
                                                        <a href="<?php  echo $this->createWebUrl("repairFix",array("ac"=>'delete_reply','reply_id'=>$row['reply_id'],'repair_id'=>$_GPC['id']))?>"  class="btn red" >删除此条回复</a>
                                                        <a target="_blank" href="<?php  echo $this->createWebUrl("repairFix",array("ac"=>'print_reply','reply_id'=>$row['reply_id'],'repair_id'=>$_GPC['id']))?>"  class="btn blue" >打印此条回复</a>
                                                    </div>
                                                </div>
                                         </div> 			
                                    </div>                                       
                                    <?php  } } ?>
                                  </form>
                             </div>                                  
                        </div>
                     </div>
                <?php  } ?>
                <!--打印-->
                <?php  if($ac=='print_reply') { ?>
                    <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div class="portlet box ">
                                    <div class="portlet-title">
                                        <div class="caption" style="color:#333">
                                            <i class="fa fa-cogs"></i><?php  echo $_SESSION['school_name'];?>、报修情况，回执条打印【打印时间： <?php  echo date("Y-m-d H:i",time());?>】 </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body flip-scroll">
                                        <table class="table  table-striped table-condensed flip-content">
                                            <thead class="flip-content">
                                                <tr>
                                                    <th class="numeric" > ID</th>
                                                    <th> 报修人 </th>
                                                    <th> 标题   </th>
                                                    <th> 内容    </th>
                                                    <th> 添加时间 </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php  $class_student = D('student');?>
                                                <tr>
                                                    <td> <?php  echo $item['repair_id'];?></td>
                                                    <td> 
                                                        <?php  if($item['teacher_id']) { ?> 
                                                        <i class="font-red">  教师：<?php  echo $this->teacherName($item['teacher_id']);?> </i>
                                                        <?php  } else { ?>
                                                            <?php  $student_info = $class_student->getStudentInfo($item['student_id']);?>
                                                            <?php  echo $this->gradeName($student_info['grade_id'])?>-<?php  echo $this->className($student_info['class_id'])?>-<?php  echo $student_info['student_name'];?>
                                                        <?php  } ?>
                                                    </td>
                                                    <td> <?php  echo $item['repair_title'];?></td>
                                                    <td> <?php  echo $item['repair_content'];?></td>
                                                    <td> <?php  echo date("Y-m-d H:i",$item['add_time']);?></td> 
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form2"  >
                                        <div class="portlet-body form">
                                            <div class="form-group  form-md-line-input">
                                                <label class="col-md-2 control-label">处理时间</label>
                                                <div class="col-sm-10 ">
                                                    <input type="text"  class="form-control" value='<?php  echo date("Y-m-d H:i",$reply_result['reply_time'])?>' readonly />
                                                    <div class="form-control-focus"> </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">详细内容</label>
                                                <div class="col-sm-10">
                                                    <textarea  class="form-control" rows="3" readonly ><?php  echo $reply_result['reply_content'];?></textarea>
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-2 control-label">处理部门</label>
                                                <div class="col-sm-10">
                                                    <input type="text"  class="form-control" value='<?php  echo $reply_result['department_name'];?>-<?php  echo $reply_result['admin_name'];?>' readonly />
                                                </div>
                                            </div>                                           
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">状态</label>
                                                <div class="col-sm-10">
                                                        <select readonly class="form-control"  >
                                                            <option value='1' <?php  if($reply_result['status']==1) { ?>selected<?php  } ?>  >已经收到反馈</option>
                                                            <option value='2' <?php  if($reply_result['status']==2) { ?>selected<?php  } ?>  >修复成功</option>
                                                            <option value='3' <?php  if($reply_result['status']==3) { ?>selected<?php  } ?>  >无法修复</option>
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">图像</label>
                                                <div class="col-sm-10">
                                                    <?php  $imgs = json_decode($reply_result['reply_img'],1);?>
                                                    <?php  echo tpl_form_field_multi_image('a',$imgs);?>
                                                </div>
                                            </div>	
                                    </div>                                       
                                  </form>                               
                            </div>
                        </div>
                        	<div class="v-h">
                                <input name="" id="ppppppp" type="hidden"  value="打印" onclick="javascript:window.print();">
                            </div>
                    <script type="text/javascript">
                        window.onload = function(){
                            document.getElementById('ppppppp').click();
                        }
                    </script>

                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> 报修列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th class="numeric" > ID</th>
                                                <th> 报修人 </th>
                                                <th> 报修部门 </th>
                                                <th> 标题   </th>
                                                <th> 内容    </th>
                                                <th> 添加时间 </th>
                                                <th> 最新处理时间 </th>
                                                <th> 最新处理状态 </th>
                                                <th> 最新处理部门-人员 </th>
                                                <th>  </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php  $class_student = D('student');?>
                                         <?php  if(is_array($list)) { foreach($list as $item) { ?>
                                            <tr>
                                                <td> <?php  echo $item['repair_id'];?></td>
                                                <td> 
                                                    <?php  if($item['teacher_id']) { ?> 
                                                      <i class="font-red">  教师：<?php  echo $this->teacherName($item['teacher_id']);?> </i>
                                                    <?php  } else { ?>
                                                        <?php  $student_info = $class_student->getStudentInfo($item['student_id']);?>
                                                        <?php  echo $this->gradeName($student_info['grade_id'])?>-<?php  echo $this->className($student_info['class_id'])?>-<?php  echo $student_info['student_name'];?>
                                                     <?php  } ?>
                                                </td>
                                                <td> <?php  echo $item['department_name'];?></td>
                                                <td> <?php  echo $item['repair_title'];?></td>
                                                <td> <?php  echo $item['repair_content'];?></td>
                                                <td><?php  echo date("Y-m-d H:i",$item['add_time']);?></td> 
                                                <td><?php  if($item['do_add_time']) { ?><?php  echo date("Y-m-d H:i",$item['do_add_time']);?><?php  } ?></td> 
                                                <td> <?php  echo $item['do_status'];?></td>
                                                <td> <?php  echo $item['do_partname'];?>-<?php  echo $item['do_admin_name'];?></td>
                                                <td style="text-align: center">
                                                    <a  href="<?php  echo $this->createWebUrl('repairFix', array('id' => $item['repair_id'],'ac'=>'add'))?> " class="btn blue">
                                                                <i class="fa fa-edit"></i> 回复 </a>
                                                    <a href="<?php  echo $this->createWebUrl('repairFix', array('id' => $item['repair_id'],'ac'=>'delete_repair'))?>" 
                                                        onclick="return confirm('此操作不可恢复，确认删除？');"
                                                        class="btn red" title="删除"><i class="fa fa-trash-o"></i>
                                                        删除
                                                    </a>  
                                                </td>         
                                            </tr>
                                        	<?php  } } ?>
                                        </tbody>
                                    </table>
                                        <?php  echo $pager;?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <script>
                            $(function(){
                                onChangeGrade(<?php  echo $_GPC['class_id'];?>);
                            });
                            var list = new Array();
                            <?php  if(is_array($result['grade'])) { foreach($result['grade'] as $row) { ?>
                                list[<?php  echo $row['grade_id'];?>] = new Array();
                                <?php  $i=0;?>
                                <?php  if(is_array($row['class'])) { foreach($row['class'] as $v) { ?>
                                    list[<?php  echo $row['grade_id'];?>][<?php  echo $i;?>]           = new Object();
                                    list[<?php  echo $row['grade_id'];?>][<?php  echo $i;?>].class_id   = "<?php  echo $v['class_id'];?>";
                                    list[<?php  echo $row['grade_id'];?>][<?php  echo $i;?>].class_name = "<?php  echo $v['class_name'];?>";
                                    <?php  $i++;?>
                                <?php  } } ?>
                            <?php  } } ?>
                            function onChangeGrade(class_id){
                                var grade_id             = $("#school_grade_list").val();
                                var select_class_obj     = $(".school_class_list");
                                select_class_obj.html('<option value="0">全部</option>');
                                $.each(list[grade_id],function(i,e){
                                    if(e.class_id == class_id){
                                        selected = 'selected';
                                    }else{
                                        selected ='';
                                    }
                                    select_class_obj.append("<option value='"+e.class_id+"' "+selected+"  >"+e.class_name+"</option>");
                                });
                            }
                        </script>                       
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
         <script src="<?php echo MODULE_URL;?>assets/global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js" type="text/javascript"></script>
         <script src="<?php echo MODULE_URL;?>assets/pages/scripts/components-bootstrap-select-splitter.min.js" type="text/javascript"></script>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
       </body>
    </html>