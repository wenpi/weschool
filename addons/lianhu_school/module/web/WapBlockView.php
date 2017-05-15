<?php 
    $head_file = '../wap/block/head';
    $title     = '效果展示';
    $class_block= C('block');
    if($_GPC['id'] && $ac=='some'){
        $id         = $_GPC['id'];
        $result     = $class_block->use_class->edit(array('block_id'=>$id));
        $html       = $result['block_html'] ? base64_decode($result['block_html']):'';
        $html       = str_ireplace('{AUI_URL}',MODULE_URL,$html);
        $js         = $result['block_js'] ? base64_decode($result['block_js']):'';
        $css        = $result['block_css'] ? base64_decode($result['block_css']):'';
        $title      = $result['block_name'].$result['block_intro'];
    }
    if($_GPC['ids'] ){
        $ids        = $_GPC['ids'];
        $id_arr     = explode(',',$ids);
        foreach ($id_arr as $key => $value) {
            $result      = $class_block->use_class->edit(array('block_id'=>$value));
            $phtml       = $result['block_html'] ? base64_decode($result['block_html']):'';
            $html       .= str_ireplace('{AUI_URL}',MODULE_URL,$phtml);
            $js         .= $result['block_js'] ? base64_decode($result['block_js']):'';
            $css        .= $result['block_css'] ? base64_decode($result['block_css']):'';
        }
    }
    include $this->template('../wap/block/display');
    exit();