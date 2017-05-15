<?php 
$title         = '学校新闻';
if($_GPC['cid']){
    $article_class = wapArticleClass(100,2,$_GPC['cid']);
}else{
    $article_class = wapArticleClass(100,1);
}
