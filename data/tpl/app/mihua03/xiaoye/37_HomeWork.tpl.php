<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
    <div class="z_main" id='list'>
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/HomeWork_ajax', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/HomeWork_ajax', TEMPLATE_INCLUDEPATH));?>
    </div>
    <h1 id='add_msg' style="text-align:center;color:#333;font-size:1em;margin-top:10px;">...</h1>  
<script>
    var pager=1;
    $(function(){
        $(window).scroll(function(){
            if ($(document).height() - $(this).scrollTop() - $(this).height() < 100){
                pager++;                     
                $.ajax({
                url:'<?php  echo $this->createMobileUrl('homeWork')?>',
                type:'post',
                data:{page:pager,ac:'ajax'},
                dataType:'html',
                success:function(html){
                        if(html=='yes'){
                            $("#add_msg").html('已查看全部');
                        }else{
                            $('#list').append(html);   
                        }
                }
                });
            }
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
