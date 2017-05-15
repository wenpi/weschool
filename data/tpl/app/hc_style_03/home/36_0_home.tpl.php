<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?> 
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/slide', TEMPLATE_INCLUDEPATH)) : (include template('common/slide', TEMPLATE_INCLUDEPATH));?>
<link href="./themes/hc_style_03/style/mobile_12.css" rel="stylesheet" type="text/css" />
<style>
body {
    font: {
        $_W['styles']['fontsize']
    }
    {
        $_W['styles']['fontfamily']
    }
    ;
    color: {
        if empty($_W['styles']['fontcolor'])
    }
    #333 {
        else
    }
    {
        $_W['styles']['fontcolor']
    }
    {
        /if
    }
    ;
    padding:0;
    margin:0;
    background-image:url('<?php  if(!empty($_W['styles']['indexbgimg'])) { ?><?php  echo $_W['styles']['indexbgimg'];?><?php  } ?>');
    background-size:cover;
    background-color: {
        if empty($_W['styles']['indexbgcolor'])
    }
    #F9F9F9 {
        else
    }
    {
        $_W['styles']['indexbgcolor']
    }
    {
        /if
    }
    ;
    {
        $_W['styles']['indexbgextra']
    }
}

a {
    color: {
        $_W['styles']['linkcolor']
    }
    ;
    text-decoration:none;
}

{
    $_W['styles']['css']
}
</style>
<script>
require(['jquery'], function($) {
    $('i').addClass("img-rounded");
});
</script>
<div id="cate8">
    <div class="mainmenu">
        <ul class="wz08menu">
            <?php  if(is_array($navs)) { foreach($navs as $key => $nav) { ?>
            <li>
                <a href="<?php  echo $nav['url'];?>">
                    <div class="wz08img">
                        <div class="wzico">
                            <?php  if(!empty($nav['icon'])) { ?>
                            <img src="<?php  echo $_W['attachurl'];?><?php  echo $nav['icon'];?>" /> <?php  } else { ?>
                            <i class="fa <?php  echo $nav['css']['icon']['icon'];?>" style="<?php  echo $nav['css']['icon']['style'];?>"></i> <?php  } ?>
                        </div>
                        <div class="menutitle"><?php  echo $nav['name'];?></div>
                    </div>
                </a>
            </li>
            <?php  } } ?>
        </ul>
    </div>
</div>
<div class="homexx"></div>
<div class="homelist" style="clear: both;">
    <?php  $result = modulefunc('site', 'site_article', array (
  'module' => 'site',
  'func' => 'site_article',
  'commend' => '1',
  'ishot' => 'true',
  'assign' => 'result',
  'return' => 'true',
  'limit' => 10,
  'index' => 'iteration',
  'multiid' => 0,
  'uniacid' => 36,
  'acid' => 0,
)); ?> <?php  if(is_array($result['list'])) { foreach($result['list'] as $row) { ?>
    <a href="<?php  echo $row['linkurl'];?>">
        <dl class="item">
            <dt>
                <?php  if($row['thumb']) { ?>
                <img src="<?php  echo $row['thumb'];?>" /> <?php  } else { ?>
                <img src="./themes/hc_style_03/style/images/nopic.png" /> <?php  } ?>
            </dt>
            <dd>
                <h3><?php  echo $row['title'];?></h3>
                <p><?php  echo $row['description'];?></p>
               <time><?php  echo date('Y-m-d', $row['createtime'])?></time>
            </dd>
        </dl>
    </a>
    <?php  } } ?>
</div>
<div style="clear: both;"></div>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('footer', TEMPLATE_INCLUDEPATH)) : (include template('footer', TEMPLATE_INCLUDEPATH));?>
