<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/head', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/head', TEMPLATE_INCLUDEPATH));?>
<script src="<?php echo MODULE_URL;?>/template/xiaoye/js/load.js"></script>
<body>
<div class="z_main">
<div class="line_head_img" <?php  if($class_info['line_img']) { ?> style="background-image: url(<?php  echo $_W['attachurl'];?><?php  echo $class_info['line_img'];?>)" <?php  } ?>>
</div>
<ul id="list">
    <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/line_content', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/line_content', TEMPLATE_INCLUDEPATH));?>
</ul>
 <a href="<?php  echo $this->createMobileUrl('send_line',array('class_id' => $_GPC['class_id'] ) )?>">
    <div class="send_line">
        <img src='<?php echo MODULE_URL;?>/template/xiaoye/upimg/send.png'>
    </div>
 </a>
    <h1 id='add_msg' style="text-align:center;color:#333;font-size:1.5em;margin-top:10px;">...</h1>  
  <div class="pinglun hidden" id="comment_area" style="height:200px;width: 100%">
        <div class="pinglun1">
            <form action="<?php  echo $this->createMobileUrl("line")?>" onsubmit="return false">
                <input class="pinglun11" type="text"   name='content' id='content' >
                <div class="pinglun12"><a href=""><img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jpp.png"></a></div>
                <a href="javascript:;" class="pinglun13" id="send_comment">评论</a>
            </form>
        </div> 
    </div>
</div>
<script>
    $(function(){
        $("#send_comment").click(function(){
              content = $('#content').val();
              if(!content){
                  alert("请输入内容");
                  return false;
              }
              $('#comment_area').hide();
              $('.caidan').show();
              $('#content').val('');
              $("#comment_list_line"+send_id).show();
              $("#people_"+send_id).show();
              ajaxComment(send_id,content,'huifu','comment_list_line');       
        });
        $("#close_comment").click(function(){
            $("#comment_area").hide();
        });
        $("#list").click(function(){
            $("#comment_area").hide();
            $('.caidan').show();
        })        
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('jsweixin', TEMPLATE_INCLUDEPATH)) : (include template('jsweixin', TEMPLATE_INCLUDEPATH));?>
<?php  $footer_center='cdc'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/line_js', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/line_js', TEMPLATE_INCLUDEPATH));?>
</body>
</html>
