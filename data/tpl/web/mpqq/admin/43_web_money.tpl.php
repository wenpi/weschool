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
                <?php  if($ac =='edit'|| $ac=='new' ) { ?>
                     <div class="row">
                    <div class="col-md-12">
                             <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-green-haze">
                                        <i class="icon-settings font-green-haze"></i>
                                        <span class="caption-subject bold uppercase"><?php  if($ac=='new') { ?>新增收费<?php  } else { ?>修改<?php  } ?> </span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                  <div class="portlet-body form">
                                    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1"  >
                                        <div class='form-group'>
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制类型</label>
                                            <div class="col-sm-10">
                                                <select name='school_limit_type' id="limit_type" class="form-control" >
                                                    <?php  if(is_array($appointment_limit)) { foreach($appointment_limit as $key => $row) { ?>
                                                        <option value='<?php  echo $key;?>' <?php  if($result['school_limit_type'] == $key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                    <?php  } } ?>
                                                </select>
                                            </div>	
                                        </div>	
                                        <div class="form-group">
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>限制具体</label>
                                            <div class="col-sm-10" id='limit_content' data-type='<?php  echo $limit_type;?>'>
                                                <?php  if($result['school_limit_type']==0) { ?>无<?php  } ?>
                                                <?php  if($result['school_limit_type']==1) { ?>
                                                    <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                        <input  name='grades[]' type='checkbox' value='<?php  echo $row['grade_id'];?>' <?php  if(in_array($row['grade_id'],$result['grade_ids'])) { ?> checked <?php  } ?>><?php  echo $row['grade_name'];?>&nbsp;&nbsp;
                                                    <?php  } } ?>
                                                <?php  } ?>
                                                <?php  if($result['school_limit_type']==2) { ?>
                                                    <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                        <?php  $grade_info = D('grade')->getGradeInfo($row['grade_id']);?>
                                                        <input name='class[]' type='checkbox' value='<?php  echo $row['class_id'];?>' <?php  if(in_array($row['class_id'],$result['class_ids'])) { ?> checked <?php  } ?>><?php  echo $grade_info['grade_name'];?>~<?php  echo $row['class_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php  } } ?>							
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>付费时间限制</label>
                                            <div class="col-sm-10">
                                                <select name='limit_type' id="limit_type" class="form-control" >
                                                        <?php  if(is_array($limit_type_arr)) { foreach($limit_type_arr as $key => $row) { ?>
                                                            <option value='<?php  echo $key;?>' <?php  if($result['limit_type']==$key) { ?> selected <?php  } ?>><?php  echo $row;?></option>
                                                        <?php  } } ?>
                                                </select>
                                            </div>	
                                        </div>	

                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>标题</label>
                                            <div class="col-sm-10">
                                                <input type='text' value='<?php  echo $result['limit_name'];?>' name='limit_name' class='form-control' >
                                                <?php  if($ac=='edit') { ?>
                                                <input type='hidden' value='<?php  echo $result['limit_id'];?>' name='limit_id'>
                                                <?php  } ?>
                                            </div>	
                                        </div>
                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>金额</label>
                                            <div class="col-sm-10">
                                                <input type='text' value='<?php  echo $result['limit_much'];?>' name='limit_much' class='form-control' >
                                            </div>	
                                        </div>
                                        
                                        <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>限制模块[可同时限制多个]</label>
                                            <div class="col-sm-10 mt-checkbox-inline ">
                                                <?php  if(is_array($student_fun_list)) { foreach($student_fun_list as $row) { ?>
                                                    <label class="mt-checkbox">
                                                    <input type='checkbox' value='<?php  echo $row['key'];?>' name='limit_module[]' <?php  if($result['limit_module']) { ?>   <?php  if(in_array($row['key'],$result['limit_module'])) { ?> checked <?php  } ?> <?php  } ?> ><?php  echo $row['name'];?>
                                                    <span></span>
                                                    </label>
                                                <?php  } } ?>
                                            </div>	
                                        </div>
                                            <div class='form-group form-md-line-input'>
                                            <label class="   col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status' class="form-control">
                                                    <option value='1' <?php  if($result['status']==1) { ?> selected <?php  } ?>>生效</option>
                                                    <option value='0' <?php  if($result['status']==0) { ?> selected <?php  } ?>>关闭</option>
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
                     </div>
                <?php  } ?>
                <?php  if($ac=='list') { ?>
                 <div class="row">
                        <div class="col-md-12">
                            <div class="note note-success">
                                <p>  收费管理列表 </p>
                            </div>
                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i> 收费管理列表 </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body flip-scroll">
                                    <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th > 名称</th>
                                                <th > 金额</th>
                                                <th >发布时间</th>
                                                <th >收费机制</th>
                                                <th >参与人数</th>
                                                <th >目前总额</th>
                                                <th >状态</th>
                                                <th >操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  if(is_array($list)) { foreach($list as $row) { ?>
                                                <tr>
                                                    <td><?php  echo $row['limit_name'];?></td>
                                                    <td><?php  echo $row['limit_much'];?></td>
                                                    <td><?php  if($row['addtime']) { ?><?php  echo date("Y-m-d H:i:s",$row['addtime'])?> <?php  } else { ?><?php  echo date("Y-m-d H:i:s",$row['add_time'])?><?php  } ?></td>
                                                    <td><?php  echo $limit_type_arr[$row['limit_type']]?></td>
                                                    <td><?php  echo $this->money_people_num($row['limit_id']);?></td>
                                                    <td><?php  echo $this->money_much($row['limit_id']);?></td>
                                                    <td> <?php  if($row['status']==1) { ?>生效<?php  } else { ?><span class="font-red">关闭</span><?php  } ?></td>
                                                    <td style="text-align: center">
                                                        <a href="<?php  echo $this->createWebUrl('money',array('id'=>$row['limit_id'],'ac'=>'edit','aw'=>1) )?>" class="btn blue"> <i class="fa fa-edit"></i>编辑</a>
                                                    <a href="<?php  echo $this->createWebUrl('moneylist',array('limit_id'=>$row['limit_id'],'ac'=>'list','aw'=>1) )?>" class="btn yellow"> <i class="fa fa-eye"></i>查看缴费</a></td>
                                                </tr>
                                            <?php  } } ?>                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
                    <script>
                        $(function(){
                            var grade_html='';
                                <?php  if(is_array($grade_list)) { foreach($grade_list as $key => $row) { ?>
                                    grade_html +="<input value='<?php  echo $row['grade_id'];?>' type='checkbox' onclick='checkbox(this)' name='grades[]'><?php  echo $row['grade_name'];?>&nbsp;&nbsp;";
                                <?php  } } ?>
                            var class_html='';
                            <?php  if(is_array($class_list)) { foreach($class_list as $key => $row) { ?>
                                <?php  $grade_info = D('grade')->getGradeInfo($row['grade_id']);?>
                                class_html +="<input value='<?php  echo $row['class_id'];?>' type='checkbox' onclick='checkbox(this)'name='class[]'><?php  echo $grade_info['grade_name'];?>~<?php  echo $row['class_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;";
                            <?php  } } ?>
                                var data_type=new Array();
                            $('#limit_type').change(function(){
                                var val=$(this).val();
                                    var limit_type=$('#limit_content').attr('data-type');
                                    limit_type=limit_type ? limit_type :0;
                                    data_type[limit_type]=$('#limit_content').html();
                                    $('#limit_content').attr('data-type',val);
                                    if(!data_type[val]){
                                        if(val==1){
                                            var content=grade_html;
                                        }else if(val==2){
                                            var content=class_html;
                                        }else if(val==0){
                                            var content='无';
                                        }
                                        $('#limit_content').html(content);
                                    }else{
                                        $('#limit_content').html(data_type[val]);
                                    }
                            });
                        });
                    function checkbox(obj){
                            if($(obj).is(":checked")){
                                $(obj).attr('checked','checked');
                            }else{
                                $(obj).attr('checked',false);
                            }
                        }
                    </script>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>