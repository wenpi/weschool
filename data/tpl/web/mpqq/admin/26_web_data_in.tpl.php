<?php defined('IN_IA') or exit('Access Denied');?>   <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/head', TEMPLATE_INCLUDEPATH)) : (include template('../admin/head', TEMPLATE_INCLUDEPATH));?>
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/header', TEMPLATE_INCLUDEPATH)) : (include template('../admin/header', TEMPLATE_INCLUDEPATH));?>
        <div class="page-container">
        <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/left', TEMPLATE_INCLUDEPATH)) : (include template('../admin/left', TEMPLATE_INCLUDEPATH));?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <h1 class="page-title"> <?php  echo $_SESSION['school_name'];?>
                            <small> <?php  echo $title;?> </small>
                    </h1>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/sidebar', TEMPLATE_INCLUDEPATH)) : (include template('../admin/sidebar', TEMPLATE_INCLUDEPATH));?>
                    <?php  if($ac == 'grade' || $ac=='list') { ?>
                            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    导入年级，如果存在同名则不会导入
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择文件，只支持Excel2003</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" id="file" />
                                            <input type="hidden" name="ac"  class="form-control" value='grade' />
                                            <input type="hidden" name="op"  class="form-control" value='new' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>年级名所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="grade_name" id="grade_name" class="form-control" value='A' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>从第几行开始导入</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="begin_in" id="begin_in" class="form-control" value='2' />
                                        </div>
                                    </div>								
                                    </div>
                                </div>
                            </div>		
                            <div class="form-group col-sm-12">
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                            </div>
                        </form>
                    <?php  } ?>
                    <?php  if($ac=='class') { ?>
                            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    导入班级名，年级则自动识别系统里的年级名，一一对应
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择文件，只支持Excel2003</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" id="file" />
                                            <input type="hidden" name="ac"  class="form-control" value='class' />
                                            <input type="hidden" name="op"  class="form-control" value='new' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>年级名所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="grade_name" id="grade_name" class="form-control" value='A' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>班级名所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="class_name" id="class_name" class="form-control" value='B' />
                                        </div>
                                    </div>				
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>从第几行开始导入</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="begin_in" id="begin_in" class="form-control" value='2' />
                                        </div>
                                    </div>								
                                    </div>
                                </div>
                            </div>		
                            <div class="form-group col-sm-12">
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                            </div>
                        </form>
                    <?php  } ?>
                    <?php  if($ac=='student') { ?>
                            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    导入学生，班级则自动识别系统里的班级名(更多信息请到学生管理里补全)，一一对应
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择文件，只支持Excel2003</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" id="file" />
                                            <input type="hidden" name="ac"  class="form-control" value='student' />
                                            <input type="hidden" name="op"  class="form-control" value='new' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择年级</label>
                                        <div class="col-sm-10">
                                            <select name='grade_id' id="grade_id" class='form-control'>
                                                <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                        <option value='<?php  echo $row['grade_id'];?>'>【<?php  echo $row['grade_name'];?>】</option>
                                                <?php  } } ?>
                                            </select>
                                        </div>
                                    </div>               
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>班级名所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="class_name" id="class_name" class="form-control" value='A' />
                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>学生姓名所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="student_name" id="student_name" class="form-control" value='B' />
                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <label class="col-md-2 control-label"><span style='color:red'>*</span>学生学号所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="student_code" id="student_code" class="form-control" value='C' />
                                        </div>
                                    </div>	
                                     <div class="form-group">
                                        <label class="col-md-2 control-label"><span style='color:red'>*</span>家长联系电话（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mobile" id="mobile" class="form-control" value='D' />
                                        </div>
                                    </div> 
                                     <div class="form-group">
                                        <label class="col-md-2 control-label"><span style='color:red'>*</span>是否启用短信（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="mobile_use" id="mobile_use" class="form-control" value='E' />
                                            <div class="help-block">1或者0；1为发送，0为不发送</div>
                                        </div>
                                    </div>                                                                        											
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>从第几行开始导入</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="begin_in" id="begin_in" class="form-control" value='2' />
                                        </div>
                                    </div>								
                                    </div>
                                </div>
                            </div>		
                            <div class="form-group col-sm-12">
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                            </div>
                        </form>
                    <?php  } ?>
                    <?php  if($ac=='score') { ?>
                            <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" id="form1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    导入成绩，（单课程），根据系统里的学号一一对应；
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择班级</label>
                                        <div class="col-sm-10">
                                            <select name='class_id' id="class_id" class='form-control'>
                                                <?php  if(is_array($class_list)) { foreach($class_list as $row) { ?>
                                                        <option value='<?php  echo $row['class_id'];?>'>【<?php  echo $row['grade_name'];?>】<?php  echo $row['class_name'];?></option>
                                                <?php  } } ?>
                                            </select>
                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择课程</label>
                                        <div class="col-sm-10">
                                            <select name='course_id'id="course_id" class='form-control'>
                                                <?php  if(is_array($course_list)) { foreach($course_list as $row) { ?>
                                                        <option value='<?php  echo $row['course_id'];?>'><?php  echo $row['course_name'];?></option>
                                                <?php  } } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择考试</label>
                                        <div class="col-sm-10">
                                            <select name='jilv_id'id="jilv_id" class='form-control'>
                                                <?php  if(is_array($jilv_list)) { foreach($jilv_list as $row) { ?>
                                                        <option value='<?php  echo $row['scorejilv_id'];?>'><?php  echo $row['scorejilv_name'];?></option>
                                                <?php  } } ?>
                                            </select>
                                        </div>
                                    </div>													
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>选择文件，只支持Excel2003</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="file" id="file" />
                                            <input type="hidden" name="ac"  class="form-control" value='score' />
                                            <input type="hidden" name="op"  class="form-control" value='new' />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>学号所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="student_code" id="student_code" class="form-control" value='A' />
                                        </div>
                                    </div>	
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>成绩所在的列为（A或者B或者C......）(大写，单个)</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="score" id="score" class="form-control" value='B' />
                                        </div>
                                    </div>												
                                    <div class="form-group">
                                        <label class=" col-md-2 control-label"><span style='color:red'>*</span>从第几行开始导入</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="begin_in" id="begin_in" class="form-control" value='2' />
                                        </div>
                                    </div>								
                                    </div>
                                </div>
                            </div>		
                            <div class="form-group col-sm-12">
                                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
                            </div>
                        </form>
                        <script>
                            $(function(){
                                ajax_up();
                                $('#class_id').change(function(){
                                    ajax_up();
                                });
                            });
                            function ajax_up(){
                                    var cid=$('#class_id').val();
                                    $.ajax({
                                        type:'post',
                                        url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'course_list'))?>',
                                        data:{cid:cid},
                                        dataType:'json',
                                        success:function(obj){
                                            $('#course_id').html(" ");
                                            if(obj.success){
                                                $.each(obj.list,function(i,e){
                                                    $('#course_id').append("<option value='"+e.course_id+"'>"+e.course_name+"</option>");
                                                });
                                            }else{
                                                $('#course_id').html("<option value='0'>没有考试记录或者考试记录不在两个月内，无法上传</option>");
                                            }
                                        }
                                    });	
                                    $.ajax({
                                        type:'post',
                                        url:'<?php  echo $this->createWebUrl('ajax',array('ac'=>'jilv_list'))?>',
                                        data:{cid:cid},
                                        dataType:'json',
                                        success:function(obj){
                                            $('#jilv_id').html(" ");
                                            if(obj.success){
                                                $.each(obj.list,function(i,e){
                                                    $('#jilv_id').append("<option value='"+e.scorejilv_id+"'>"+e.scorejilv_name+"</option>");
                                                });
                                            }else{
                                                $('#jilv_id').html("<option value='0'>没有考试记录或者考试记录不在两个月内，无法上传</option>");
                                            }
                                        }
                                    });							
                            }
                        </script>
                    <?php  } ?>
            <?php  if($ac=='score_list_jilv') { ?>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/score_list_jilv', TEMPLATE_INCLUDEPATH)) : (include template('../admin/score_list_jilv', TEMPLATE_INCLUDEPATH));?>
            <?php  } ?>
        </div>
        </div>
         <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
        </div>
     <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
         </body>
    </html>