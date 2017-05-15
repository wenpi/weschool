<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/21
 * Time: 3:46
 */
class wxpay extends WeiXinPay
{
    public function __construct()
    {
        parent::__construct();
    }

    //统一下单
    public function meepoUnifiedorder($product_id,$out_trade_no,$total_fee,$refund_fee){
        $params = array();
        $params['appid'] = $this->wxpay['appid'];
        $params['mch_id'] = $this->wxpay['mch_id'];
        $params['time_stamp'] = TIMESTAMP;
        $params['nonce_str'] = random(32);
        $params['product_id'] = $product_id;

        $params['sign'] = $this->bulidSign($params);
        $out_refund_no = random(32);
        $params['out_trade_no'] = $out_trade_no;
        $params['out_refund_no'] = $out_refund_no;
        $parmas['total_fee'] = $total_fee;
        $params['refund_fee'] = $refund_fee;
        $params['op_user_id'] = $this->wxpay['mch_id'];



    }

}