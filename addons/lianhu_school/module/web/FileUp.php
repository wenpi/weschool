<?php
  
	set_time_limit(360);
	$filename                       = strip_tags($_POST['filename']);
    $out_name                       = $_FILES[$filename]['name'];
    $ar     = explode('.',$out_name);
    $type   = end($ar); 
    $could_arr = array("png","jpg","jpeg","gif",'mp3','doc','docx','xlsx','xls','ppt','pptx','pdf');
    if(!in_array($type,$could_arr)){
        $msg['out'] = "不在许可上传范围内";
    }else{
        $imgOption['upload_dir']        = $this->insertDir();
        $imgOption['file_name']         = time().random(4,true).'.'.$type;
        $imgOption['accept_file_types'] = '/\.(gif|jpe?g|png|mp3|doc|docx|xlsx|pdf|ppt|pptx|xls)$/i';
        $imgOption['max_file_size']     = 10000000;//10M
        $imgOption['param_name']        = $filename;
        $result                         = new \myclass\ctl\uploadHandler($imgOption,false);
        $out                            = $result->post(false);
        $outArray = $out[0];
        if($outArray->error){
                $msg['out']=$outArray->error;
        }else{
                $url  = str_ireplace(ATTACHMENT_ROOT,$_W['attachurl_local'],$imgOption['upload_dir']).$outArray->name;
                $text = "<a href='".$url."'>".$out_name."&nbsp;上传成功，复制本段到编辑框，并可以改成您想要的文件名称</a>";
                $msg['out']= $text;
        }
    }

    echo $msg['out'];
    exit();
?>