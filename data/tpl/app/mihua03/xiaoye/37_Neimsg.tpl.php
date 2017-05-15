<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
    <div  id='list'>
        <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/Neimsg_content', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/Neimsg_content', TEMPLATE_INCLUDEPATH));?>
    </div>
    <div id="add_msg" class="add_msg"></div>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
  </div>
   <script>
    var pager    = 1;
    $(function(){
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                if(pager==0) return false;
                pager++;       
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('Neimsg')?>',
                type:'post',
                data:{page:pager,ac:'ajax' },
                dataType:'text',
                async:'false',
                success:function(html){
                        if(html=='done' ){
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
</body>
</html>
