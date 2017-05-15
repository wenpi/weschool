    function onChangeGrade(){
          var grade_id  = $("#school_grade_list").val();
          var select_class_obj     = $(".school_class_list");

          select_class_obj.html('<option value="0">全部</option>');

          $.each(list[grade_id],function(i,e){
              select_class_obj.append("<option value='"+e.class_id+"'>"+e.class_name+"</option>");
          });
    }  

    //反转input checkbox 的状态
    function change_check_status(input_name){
        now_status=$('input[name="'+input_name+'"]:checked').val();
        if(now_status){
            $('input[name="'+input_name+'"]').removeAttr('checked');
             teacher_class_change();
        }else{
            $('input[name="'+input_name+'"]').prop("checked",true);
            teacher_class_change();
        }
    }
    //全选
    function allSelect(class_name){
        if($("."+class_name+"").prop("checked")){
            $("."+class_name+"").prop("checked",false);
        }else{
            $("."+class_name+"").prop("checked",true);
        }
    }
   //视频设置界面
   //视频模式的变换
   function  videoChange(obj){
	   val = $(obj).val();
	   if(val==1){
		   $("#video_html_content").hide();
		   $("#video_url").show();
		   $("#passport_password").hide();
	   }
	   if(val==2){
		   $("#video_html_content").show();
		   $("#video_url").hide();		   
		   $("#passport_password").hide();
	   }
 	   if(val==3){
		   $("#passport_password").show();
		   $("#video_url").hide();		   
		   $("#video_html_content").hide();
	   }      
   }