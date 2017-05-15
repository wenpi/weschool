<?php defined('IN_IA') or exit('Access Denied');?> <?php  $result = schoolGradeClass(); ?>
 <div class="w-form padding">
          <form id="email-form" name="email-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>">
                <div class="separator-button-input"></div>
                <div>
                    <label class="label-form" for="node-10">选择年级</label>
                    <div class="separator-fields"></div>
                    <select name="grade_id" class="w-select input-form select" id="school_grade_list"   onchange="onChangeGrade()">
                        <option value="0">全部</option>
                        <?php  if(is_array($result['grade'])) { foreach($result['grade'] as $row) { ?>
                        <option value="<?php  echo $row['grade_id'];?>" <?php  if($grade_id == $row['grade_id']) { ?> selected <?php  } ?>><?php  echo $row['grade_name'];?></option>
                        <?php  } } ?>
                    </select>
                </div>
                <div>
                    <label class="label-form" for="node-10">选择班级</label>
                    <div class="separator-fields"></div>
                    <select class="w-select input-form select school_class_list" name="class_id" >
                        <!--<option value="0">全部</option>-->
                    </select>
                </div>
                <div>
                    <input name='submit' type='submit' class='w-clearfix w-inline-block small-button social twitter' value='确定'>
                </div>
            </form>
  </div>            
  <script>
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
    function onChangeGrade(){
          var grade_id  = $("#school_grade_list").val();
          var select_class_obj     = $(".school_class_list");

          select_class_obj.html('<option value="0">全部</option>');

          $.each(list[grade_id],function(i,e){
              select_class_obj.append("<option value='"+e.class_id+"'>"+e.class_name+"</option>");
          });
    }
  </script>