<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newHead', TEMPLATE_INCLUDEPATH));?>
<div class="z_main">
 <div class="head">
    <a href="<?php  echo $this->createMobileUrl('give_money') ?>" ><p>待缴费</p></a>
    <a href="<?php  echo $this->createMobileUrl('giveMoneyHistory') ?>" class="pp" ><p>已缴费</p></a>
    <a href="<?php  echo $this->createMobileUrl('moneyReback') ?>"><p>已退费</p></a>
 </div>
 <div id="firstpane" class="menu_list">
     <?php  if(is_array($list)) { foreach($list as $key => $row) { ?>
        <h3 class="jf">
            <p><?php  echo $key;?>年度</p>
            <img src="<?php echo MODULE_URL;?>/template/xiaoye/img/jt-x-s-h.png">
        </h3>   
        <div style="display:block" class="menu_body">
            <ul class="z_txx">
            <?php  if(is_array($row)) { foreach($row as $val) { ?>
                <li>
                     <label for="checkbox-21"><?php  echo date("m-d H:i",$val['addtime'])?></label>
                    <div class="z_txx2"><?php  echo $val['limit_name'];?>:<?php  echo $val['limit_much'];?>元</div>
                </li>
            <?php  } } ?>
            </ul>
        </div>
     <?php  } } ?>
    </div>
</div>
<script>
$(document).ready(function(){
	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane h3.jf").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.jf").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
});
</script>
  <?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH)) : (include template('../xiaoye/newStudentFooter', TEMPLATE_INCLUDEPATH));?>
</body>
</html>