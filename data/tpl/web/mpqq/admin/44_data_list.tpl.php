<?php defined('IN_IA') or exit('Access Denied');?> <?php  $platform_list = D('platform')->getAllPlatform(); ?>
 <div class="col-md-6 col-sm-12 data_list" id='mp_list'>
        <div class="portlet light portlet-fit portlet-datatable ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">公众号列表</span>
               </div>
        </div>
        <div class="portlet-body">
            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                <thead>
                    <tr>
                        <th class="table-checkbox">
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_5 .checkboxes" data-key="platform"  onclick="powerCheckBox(this)" />
                                    <span></span>
                            </label>
                            </th>
                            <th> 公众号名 </th> 
                   </tr> 
            </thead>
            <tbody>
                <?php  if(is_array($platform_list)) { foreach($platform_list as $value) { ?>
                <tr class="odd gradeX">
                    <td>
                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes platform " value="<?php  echo $value['uniacid'];?>" name="platform_list[]" <?php  if($group_platform_list) { ?> <?php  if(in_array($value['uniacid'],$group_platform_list) ) { ?> checked <?php  } ?> <?php  } ?>/>
                            <span></span>
                    </label>
                    </td>
                    <td>  <?php  echo $value['name'];?></td>
                </tr>                                            
                <?php  } } ?>
            </tbody>
        </table>
        </div>
    </div>
  </div>
<div  class="col-md-6 col-sm-12 data_list" id='school_list'  >
         <div class="portlet light portlet-fit portlet-datatable ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">学校列表</span>
               </div>
            </div>
            <div class="portlet-body form">
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label">选择公众号</label>
                        <div class="col-md-10">
                        <select name="school_mp" id='school_mp' class="form-control" onchange="htmlGetSchool()">
                            <?php  if(is_array($platform_list)) { foreach($platform_list as $row) { ?>
                                <option value="<?php  echo $row['uniacid'];?>" <?php  if($result['data']== $row['uniacid']) { ?> selected  <?php  } ?> ><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                        </div>
                </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                            <tr>
                                <th class="table-checkbox">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_5 .checkboxes" data-key="platform"  onclick="powerCheckBox(this)" />
                                            <span></span>
                                    </label>
                                    </th>
                                    <th> 选择学校 </th> 
                        </tr> 
                    </thead>
                    <tbody id='school_school_list'>
                        <?php  if(is_array($school_list)) { foreach($school_list as $value) { ?>
                        <tr class="odd gradeX">
                            <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes platform " value="<?php  echo $value['school_id'];?>" name="school_list[]" <?php  if($re['school_list']) { ?> <?php  if(in_array($value['school_id'], $re['school_list'] ) ) { ?> checked <?php  } ?> <?php  } ?>/>
                                <span></span>
                            </label>
                            </td>
                            <td>  <?php  echo $value['school_name'];?></td>
                        </tr>                                            
                        <?php  } } ?>
                    </tbody>
                </table>               
            </div>
    </div>
</div>

<div  class="col-md-6 col-sm-12 data_list " id='grade_list' >
         <div class="portlet light portlet-fit portlet-datatable ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">年级列表</span>
               </div>
            </div>
            <div class="portlet-body form">
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label">选择公众号</label>
                        <div class="col-md-10">
                        <select name="grade_mp" id='grade_mp' class="form-control"  onchange="GradeHtmlGetSchool()" >
                            <?php  if(is_array($platform_list)) { foreach($platform_list as $row) { ?>
                                <option value="<?php  echo $row['uniacid'];?>" <?php  if($result['data']== $row['uniacid']) { ?> selected  <?php  } ?> ><?php  echo $row['name'];?></option>
                            <?php  } } ?>
                        </select>
                        </div>
                </div>
                <div class="form-group form-md-line-input">
                    <label class="col-md-2 control-label">选择学校</label>
                        <div class="col-md-10">
                        <select name="grade_school" id='grade_school' class="form-control"  onchange="htmlGetGrade()">
                            <?php  if(is_array($school_list)) { foreach($school_list as $row) { ?>
                                <option value="<?php  echo $row['school_id'];?>" <?php  if($result['school_data']== $row['school_id']) { ?> selected  <?php  } ?> ><?php  echo $row['school_name'];?></option>
                            <?php  } } ?>
                        </select>
                        </div>
                </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                        <thead>
                            <tr>
                                <th class="table-checkbox">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_5 .checkboxes" data-key="platform"  onclick="powerCheckBox(this)" />
                                            <span></span>
                                    </label>
                                    </th>
                                    <th> 选择年级 </th> 
                        </tr> 
                    </thead>
                    <tbody id='grade_grade_list'>
                        <?php  if(is_array($grade_list)) { foreach($grade_list as $value) { ?>
                        <tr class="odd gradeX">
                            <td>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="checkboxes platform " value="<?php  echo $value['grade_id'];?>" name="grade_list[]" <?php  if($re_grade_list) { ?> <?php  if(in_array($value['grade_id'], $re_grade_list ) ) { ?> checked <?php  } ?> <?php  } ?>/>
                                <span></span>
                            </label>
                            </td>
                            <td>  <?php  echo $value['grade_name'];?></td>
                        </tr>                                            
                        <?php  } } ?>
                    </tbody>
                </table>               
            </div>
    </div>
</div>
 <script>
        $(function(){
                $(".data_list").css("display","none");
                <?php  if($result['type'] ) { ?>
                    $("#<?php  echo $result['type'];?>_list").show();
                <?php  } ?>
        });
        function dataTypeChange(obj){
            type = $(obj).val();
            if(type!='all'){
                $(".data_list").css("display","none");
                $("#"+type+"_list").show();
                if(type=='school'){
                    htmlGetSchool();
                }    
                if(type=='grade'){
                    GradeHtmlGetSchool();
                    htmlGetGrade();
                }
            }
        }
        function powerCheckBox(obj){
            key_word = $(obj).attr('data-key');
            if($('.'+key_word).prop('checked'))
                    $('.'+key_word).prop('checked',false);
            else 
                    $('.'+key_word).prop('checked',true);
        }
        //获取学校列表
        function htmlGetSchool(){
            uniacid = $("#school_mp").val();
            getSchoolList(uniacid,'school_school_list');
        }
        //获取学校列表
        function GradeHtmlGetSchool(){
            uniacid = $("#grade_mp").val();
            getSchoolList(uniacid,'grade_school','grade');
            htmlGetGrade();
        }  
        //获取年级列表
        function htmlGetGrade(){
            school_id = $("#grade_school").val();
            getGradeList(school_id,"grade_grade_list");
        }
        //公众号请求学校列表
        function getSchoolList(uniacid,id_name,type){
            $.ajax({
                url:"<?php  echo $this->createWebUrl('ajax',array('ac'=>'get_school_list'))?>",
                data:{uniacid:uniacid},
                type:'get',
                dataType:'json',
                success:function(obj){
                    if(obj.errcode==1){
                        alert(obj.msg);
                    }else{
                        $("#"+id_name).html('');
                            $.each(obj.list,function(i,e){
                                if(type=='grade'){
                                    $("#"+id_name).append('<option value="'+e.school_id+'" >'+e.school_name+'</option>');
                                }else{
                                    $("#"+id_name).append('<tr class="odd gradeX"><td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">'+
                                    '<input type="checkbox" class="checkboxes platform " value="'+e.school_id+'" name="school_list[]" />'+
                                    '<span></span></label></td><td>'+e.school_name+'</td></tr>');
                                }
                            });
                    }
                }
            });
        }
        //学校获取年级
        function getGradeList(school_id,id_name){
            $.ajax({
                url:"<?php  echo $this->createWebUrl('ajax',array('ac'=>'get_grade_list'))?>",
                data:{school_id:school_id},
                type:'get',
                dataType:'json',
                success:function(obj){
                    if(obj.errcode==1){
                        alert(obj.msg);
                    }else{
                        $("#"+id_name).html('');
                        $.each(obj.list,function(i,e){
                            $("#"+id_name).append('<tr class="odd gradeX"><td><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">'+
                                '<input type="checkbox" class="checkboxes platform " value="'+e.grade_id+'" name="grade_list[]" />'+
                                '<span></span></label></td><td>'+e.grade_name+'</td></tr>');
                        });
                    }
                }
            });
        }

</script>