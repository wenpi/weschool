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
                          <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">搜索</span>
                                                    <span class="caption-helper">给出条件，筛选学生</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <form action="<?php  echo $this->createWebUrl('aloneCourseList',array('ac'=>'student','op'=>'add'))?>" onsubmit="return upDate()" method="post" class="form-horizontal">
                                                      <?php  $result = schoolGradeClass(); ?>
                                                        <div class="form-group ">
                                                           <label class="control-label col-md-3">年级</label>
                                                             <div class="col-md-4">
                                                                        <select name="grade_id" class="form-control" id="school_grade_list"   onchange="onChangeGrade()" >
                                                                            <option value='0'>全部</option>
                                                                            <?php  if(is_array($grade_list)) { foreach($grade_list as $row) { ?>
                                                                                <option value='<?php  echo $row['grade_id'];?>' <?php  if($_GPC['grade_id'] ==$row['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                                                                            <?php  } } ?>
                                                                         </select>
                                                             </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">班级</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control school_class_list"  name="class_id" class="form-control"  >
                                                                    <option value="0">全部</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                         <div class="form-group">
                                                            <label class="control-label col-md-3">姓名</label>
                                                            <div class="col-md-4">
                                                                <input name='student_name' class="form-control"  id='student_name' value="<?php  echo $_GPC['student_name'];?>">
                                                            </div>
                                                        </div>	
                                                        <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-2 col-md-10">
                                                                        <input type="submit" name="submit" class="btn blue" value="确认搜索">
                                                                    </div>
                                                                </div>
                                                        </div>   
                                                </form>
                                              </div>
                             </div>          
                            <form action="<?php  echo $this->createWebUrl('aloneCourseList',array('ac'=>'student','op'=>'add','id'=>$id))?>" method="post" class="form-horizontal">
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box green">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-cogs"></i><?php  echo $course_info['course_name'];?>-- 搜索到的结果 </div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body flip-scroll">
                                                <table class="table table-bordered table-striped table-condensed flip-content">
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th>学生名</th>
                                                            <th>班级-年级</th>
                                                            <th>授权课时数</th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="search_result">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                                <input type="hidden" name="er" value="up" >
                                                <input type="submit" name="submit" class="btn red" value="确认提交">
                                </div>
                            </form>
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
                  <script>
                    function strin(student_info){
                        str = "  <tr id='student_list_id_"+student_info.student_id+"'><td>"+student_info.student_name+"</td><td>"+student_info.grade_class_name+"</td><td><input type='text' name='up["+student_info.student_id+"]' value='<?php  echo $course_info['nums'];?>'></td><td  style='text-align:center;'  >"+
                        " <div  class='btn blue' onclick='deleteThisTd("+student_info.student_id+")'> <i class='fa fa-edit'></i>移出</div> </td> </tr>";
                        return str;
                    }
                    function upDate(){
                        class_id        = $("#class_id").val();
                        student_name    = $("#student_name").val();
                        grade_id        = $("#school_grade_list").val();
                        $.ajax({
                            url:'<?php  echo $this->createWebUrl("aloneCourseList",array("ac"=>"student","op"=>"add","er"=>"search"))?>',
                            data:{class_id:class_id,student_name:student_name,grade_id:grade_id},
                            type:"post",
                            dataType:"json",
                            success:function(obj){
                                $.each(obj,function(i,e){
                                    str = strin(e);
                                    $("#search_result").append(str);
                                });
                            }
                        })
                        return false;
                    }
                    function deleteThisTd(student_id){
                        $("#student_list_id_"+student_id).remove();
                    }
                  </script>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/right', TEMPLATE_INCLUDEPATH)) : (include template('../admin/right', TEMPLATE_INCLUDEPATH));?>
                </div>
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('../admin/footer', TEMPLATE_INCLUDEPATH)) : (include template('../admin/footer', TEMPLATE_INCLUDEPATH));?>
                </body>
            </html>