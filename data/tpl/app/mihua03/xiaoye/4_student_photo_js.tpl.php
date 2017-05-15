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
                url:'<?php  echo $this->createMobileUrl('studentPhoto')?>',
                type:'post',
                data:{page:pager,ac:'ajax' },
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
    });
   </script>
    