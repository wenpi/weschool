<?php 
    $head_file = '../../wap/block/head';
    $title     = '效果展示';
    $class_block = C('block');

    if($_GPC['id'] ){
        $id         = $_GPC['id'];
        $result     = $class_block->use_class->edit(array('block_id'=>$id));
        $html       = decodeWapBlockHtml($result['block_html']);
        $js         = $result['block_js'] ? base64_decode($result['block_js']):'';
        $css        = $result['block_css'] ? base64_decode($result['block_css']):'';
        $title      = $result['block_name'].$result['block_intro'];
    }
    if($_GPC['ids'] ){
        $ids        = $_GPC['ids'];
        $id_arr     = explode(',',$ids);
        foreach ($id_arr as $key => $value) {
            $result      = $class_block->use_class->edit(array('block_id'=>$value));
            $html       .=  decodeWapBlockHtml($result['block_html']);
            $js         .= $result['block_js'] ? base64_decode($result['block_js']):'';
            $css        .= $result['block_css'] ? base64_decode($result['block_css']):'';
        }
    }
    include $this->template('../../wap/block/display');
    exit();