<?php defined('IN_IA') or exit('Access Denied');?>   <script>
    var pager    = 1;
    var send_id  = '';
    var content  = '';    
    $(function(){
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                if(pager==0) return false;
                pager++;       
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('line')?>',
                type:'post',
                data:{page:pager,ac:'line_all',class_id:<?php  echo $class_id;?> },
                dataType:'text',
                async:'false',
                success:function(html){
                        if(html =='all' ){
                            $("#add_msg").html("已经全部查看！");
                            pager=0;
                        }else{
                            $('#list').append(html);   
                        }
                    }
                });
            }
        });
        $( document ).on( "click", ".zan", function() {
            send_id=$(this).attr('data-send');
            ajaxComment(send_id,1,'line_like','like_num_');
            $("#like_num_"+send_id).show();
            $("#people_"+send_id).show();
            $('#zan_'+send_id).find('img').attr('src','<?php echo MODULE_URL;?>/template/xiaoye/img/dz.png');  
        } ); 
         $( document ).on( "click", ".huifu", function() {
            send_id=$(this).attr('data-id');
            $('#comment_area').show();
            $('.caidan').hide();
            $("#content").focus();
        });            
         $( document ).on( "click", ".delete", function() {
            if(confirm("确认删除吗？")){
                send_id = $(this).attr('data-send');
                line_ajax(send_id,'delete');
            }
        });   
         $( document ).on( "click", ".pass", function() {
            send_id=$(this).attr('data-send');
            line_ajax(send_id,'line_pass');
        }); 
    });
    function line_ajax(send_id,ac){
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('ajax')?>',
                type:'post',
                data:{send_id:send_id,op:'line_change',ac:ac},
                dataType:'json',
                success:function(obj){
                        if(obj.errcode==1){
                            $("#add_msg").html(obj.msg);
                        }else{
                            if(ac=='like'){
                                $("#zan_"+send_id).css('color','#ff0033');
                                num=$("#like_num_"+send_id).html();
                                $("#like_num_"+send_id).html(Number(num)+1);
                            }   
                            if(ac=='delete'){
                                $("#list_id_"+send_id).hide();
                            }      
                            if(ac=='line_pass'){
                                $("#pass"+send_id).hide();              
                            }                                              
                        }
                }
            });  
    }
     function ajaxComment(send_id,content,op,in_id){
         $.ajax({
             url:'<?php  echo $this->createMobileUrl("ajax");?>',
             type:'post',
             data:{op:op,send_id:send_id,content:content},
             dataType:'text',
             success:function(html){
                 $("#"+in_id+send_id).html(html);
             }
         });
    }
 
    function ajaxComment(send_id,content,op,in_id){
         $.ajax({
             url:'<?php  echo $this->createMobileUrl("ajax");?>',
             type:'post',
             data:{op:op,send_id:send_id,content:content},
             dataType:'text',
             success:function(html){
                 $("#"+in_id+send_id).html(html);
             }
         });
    }
   </script>
    