<?php defined('IN_IA') or exit('Access Denied');?><script type='text/javascript' src='<?php echo MODULE_URL;?>/style/js/jquery.min.js'></script>
<script type='text/javascript' src='<?php echo MODULE_URL;?>style/js/main.js'></script>
<script>
     //编辑教师时，改变班级时课程相应改变
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
                     $("#course_list").append("<input type='checkbox' value='"+e.course_id+"' name='course_id[]' >&nbsp;"+e.course_name+"&nbsp;&nbsp;&nbsp;&nbsp;");
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

</script>
<style>
.clear{
    clear:both;
}
.title{
    width:100%;
    height:2em;
    line-height: 2em;
    font-size: 1.2em;
    font-weight: 700;
}
.red{
	color:#ff0033;
}
.school_name{
	color:#ff0033;
	width: 100%;
	text-align: center;
}
.record_list{
    list-style:none;
}
.record_list li{
    min-width:10%;
    margin-right:10px;
    float: left;
    margin-bottom: 10px;
}
#a标签提示
.red{color:red;}
.hei_se{color:#333;}
.a_use_title{text-decoration: none;}
.hover_point:hover{cursor:pointer}
</style>
<div class="school_name">当前学校为：<?php  echo $_SESSION['school_name'];?></div>
