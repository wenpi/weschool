<?php defined('IN_IA') or exit('Access Denied');?>   <div class='comment_area hide'  id="comment_area">
    <input type='text' name='content' id='content' placeholder="发送评论......">
    <div class='button button-action button-rounded' id='send_comment'>发送</div>
 </div>
 <script>
     var send_id='';
     var content='';
     $(function(){
        $("#send_comment").click(function(){
              content=$('#content').val();
              if(!content)
              {
                  alert("请输入内容");
                  return false;
              }
              $('#comment_area').hide();
              $('#content').val('');
              ajaxComment(send_id,content,'huifu','comment_list_line');       
        });
     });
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