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
                <div class='row'>
                    <?php  if($ac=='list') { ?>
                            <div class="col-md-12 col-sm-12">
                                    <div class="panel panel-info">
                                    <div class="panel-heading">筛选</div>
                                    <div class="panel-body">
                                        <form action="./index.php" method="get" class="form-horizontal" role="form">
                                            <input type="hidden" name="c" value="site" />
                                            <input type="hidden" name="a" value="entry" />
                                            <input type="hidden" name="m" value="lianhu_school" />
                                            <input type="hidden" name="do" value="scoreStudent" />
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <select name='gid' id="grade_id" class='form-control'>
                                                            <?php  if(is_array($grade)) { foreach($grade as $row) { ?>
                                                                    <option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id']==$gid ) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>			
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择班级</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <select name='class_id' id="class_id" class='form-control'>
                                                            <option value='0'>不选择</option>
                                                            <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                                    <option value='<?php  echo $row['class_id'];?>' <?php  if($row['class_id']==$_GPC['class_id'] ) { ?> selected <?php  } ?>><?php  echo $row['class_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>	
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>选择考试</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <select name='jilv_id' id="jilv_id" class='form-control'>
                                                            <?php  if(is_array($score_jilv_list)) { foreach($score_jilv_list as $row) { ?>
                                                                    <option value='<?php  echo $row['scorejilv_id'];?>'  <?php  if($row['scorejilv_id']==$ji_lv_id ) { ?> selected <?php  } ?>><?php  echo $row['scorejilv_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">选择课程</label>
                                                    <div class="col-sm-9 col-xs-8">
                                                        <select name='course_id' id="course_id" class='form-control'>
                                                        <option value='0'>全部</option>
                                                            <?php  if(is_array($new_out_course_arr)) { foreach($new_out_course_arr as $row) { ?>
                                                                    <option value='<?php  echo $row['course_id'];?>'  <?php  if($row['course_id']==$_GPC['course_id'] ) { ?> selected <?php  } ?>><?php  echo $row['course_name'];?></option>
                                                            <?php  } } ?>
                                                        </select>
                                                    </div>
                                                </div>	

                                            <div class="form-group">
                                                <div class="col-sm-5 col-xs-5"></div>
                                                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                                                    <button class="btn btn-default" type="button">总记录数：<?php  echo $total;?></button>
                                                    <input type='submit'name='excel' class="btn btn-default" type="button" value='导出'>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="portlet box red">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i>成绩统计 </div>
                                            </div> 
                                </div> 
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column table-light"  id="sample_3" >
                                            <thead class="navbar-inner">
                                                <tr>
                                                    <th style="width:50px;">学生</th>
                                                    <th style="width:60px">班级</th>
                                                    <?php  if(is_array($out_course_arr)) { foreach($out_course_arr as $row) { ?>
                                                    <th style="width:50px;"><?php  echo $row['course_name'];?></th>
                                                    <?php  } } ?>
                                                    <th style="width:50px;">总分</th>
                                                    <th style="width:50px;">排名</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>各科总分：</td>
                                                    <td></td>
                                                    <?php  if(is_array($out_course_arr)) { foreach($out_course_arr as $row) { ?>
                                                        <td ><?php  echo $course_all[$row['course_id']];?></td>
                                                    <?php  } } ?>
                                                    <td></td>
                                                    <td></td>
                                                </tr>

                                                <?php  if(is_array($out_list)) { foreach($out_list as $key => $item) { ?>
                                                    <tr>
                                                        <td><?php  echo $item['student_name'];?></td>
                                                        <td><?php  echo $item['class_name'];?></td>
                                                            <?php  if(is_array($out_course_arr)) { foreach($out_course_arr as $row) { ?>
                                                                <td><?php  if($item['course_ids'][$row['course_id']]>0 ) { ?> <?php  echo $item['course_ids'][$row['course_id']];?> <?php  } else { ?>0<?php  } ?></td>
                                                            <?php  } } ?>
                                                        <td> <span class="label label-sm label-info"><?php  echo $item['all_score'];?></span></td>
                                                        <td><span class="label label-sm label-success"><?php  echo $key+1?></span></td>
                                                    </tr>
                                                <?php  } } ?>
                                            </tbody>
                                        </table>
                                    </div>                               
                            </div>   
                            <?php  echo $pager;?>
                            <script>
                                    var html="<option value='0'>不选择</option>";
                                    $(function(){
                                        <?php  if($_GPC['class_id'] && $_GPC['jilv_id']) { ?>
                                            ajax_up(<?php  echo $_GPC['class_id'];?>,<?php  echo $_GPC['jilv_id'];?>);
                                        <?php  } ?>

                                        <?php  if($_GPC['class_id'] && !$_GPC['jilv_id']) { ?>
                                            ajax_up(<?php  echo $_GPC['class_id'];?>,0);
                                        <?php  } ?> 
                                        <?php  if(!$_GPC['class_id'] && !$_GPC['jilv_id']) { ?>
                                            ajax_up(0,0);
                                        <?php  } ?>
                                    <?php  if(!$_GPC['class_id'] && $_GPC['jilv_id']) { ?>
                                            ajax_up(0,<?php  echo $_GPC['jilv_id'];?>);
                                        <?php  } ?>                                                      
                                        $('#grade_id').change(function(){
                                            ajax_up(0,0);
                                        });
                                    });
                                    function ajax_up(first_class_id,first_jilv_id){
                                            var gid=$('#grade_id').val();
                                            $.ajax({
                                                type:'post',
                                                url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'class_list'))?>',
                                                data:{gid:gid},
                                                dataType:'json',
                                                success:function(obj){
                                                    $('#class_id').html(" ");
                                                    $('#class_id').html(html);
                                                    if(obj.success){
                                                        $.each(obj.list,function(i,e){
                                                            if(first_class_id>0 && first_class_id==e.class_id){
                                                                $('#class_id').append("<option value='"+e.class_id+"' selected >"+e.class_name+"</option>");
                                                            }else{
                                                                $('#class_id').append("<option value='"+e.class_id+"'>"+e.class_name+"</option>");
                                                            }
                                                        });
                                                    }
                                                }
                                            });	

                                            $.ajax({
                                                type:'post',
                                                url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'jilv_list'))?>',
                                                data:{gid:gid},
                                                dataType:'json',
                                                success:function(obj){
                                                    $('#jilv_id').html(" ");
                                                    if(obj.success){
                                                        $.each(obj.list,function(i,e){
                                                            if(first_jilv_id>0 && first_jilv_id==e.scorejilv_id){
                                                                $('#jilv_id').append("<option value='"+e.scorejilv_id+"' selected >"+e.scorejilv_name+"</option>");
                                                            }else{
                                                                $('#jilv_id').append("<option value='"+e.scorejilv_id+"'>"+e.scorejilv_name+"</option>");
                                                            }                               
                                                        });
                                                    }
                                                }
                                            });
                                            
                                    }
                            </script>
                            
                        <?php  } ?>
                        <?php  if($ac=='new' || $ac=='edit') { ?>
                            <div class="main">
                            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php  if($ac=='create') { ?>新增<?php  } else { ?>修改<?php  } ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                        <div class="form-group">
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>记录（如：月考，期中考试等）</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="scorejilv_name" id="scorejilv_name" class="form-control" value='<?php  echo $result['scorejilv_name'];?>' />
                                                <?php  if($op=='edit') { ?>
                                                <input type="hidden" name="jilv_id"  class="form-control" value='<?php  echo $result['scorejilv_id'];?>' />
                                                <?php  } ?>
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
                                            <div class="col-sm-10">
                                                <?php  if($op=='edit') { ?>
                                                <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                    <?php  if($row['grade_id'] ==$result['grade_id']) { ?> <?php  echo $row['grade_name'];?> <?php  } ?>
                                                <?php  } } ?>
                                                <?php  } else { ?>
                                                    <select name='grade_id' class="form-control">
                                                <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                            <option value='<?php  echo $row['grade_id'];?>' <?php  if($row['grade_id'] ==$result['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                <?php  } } ?>
                                                    </select>
                                                <?php  } ?>

                                            </div>	
                                        </div>
                                            <div class='form-group'>
                                            <label class=" col-md-2 control-label"><span style='color:red'>*</span>状态</label>
                                            <div class="col-sm-10">
                                            <select name='status'  class="form-control" >
                                                    <option value='1' <?php  if(1 ==$result['status']) { ?> selected <?php  } ?>>正常</option>
                                                    <option value='3' <?php  if($result['status']==3 ) { ?> selected <?php  } ?>>关闭</option>
                                            </select>
                                            </div>							
                                            </div>
                                        </div>
                                    </div>
                                </div>		
                                <div class="form-group col-sm-12">
                                    <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                                </div>
                            </form>
                        </div>		
                        <?php  } ?>                        
                    </div>
                </div>
              </div>
            </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
     </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/table_script', TEMPLATE_INCLUDEPATH)) : (include template('../admin/table_script', TEMPLATE_INCLUDEPATH));?>         
    </body>
    </html>