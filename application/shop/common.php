<?php

function moneyStr($index){
    $arr = [
        1 => 'amoney',
        2 => 'bmoney',
        3 => 'cmoney'
    ];
    return $arr[$index];
}

function recordType($index){
    $arr = [
        1 => '购物消费',
        2 => '转账',
    ];
    return $arr[$index];
}

/**
 * 返回值封装
 * @param $flag
 * @param string $msg
 * @return \think\response\Json
 */
function returnRes($flag, $msg = ''){
    return $flag ? json(msg(1, '', $msg.'成功')) : json(msg(0, '', $msg.'失败'));
}

/**
 * 生成订单号
 * @param string $str
 * @return string
 */
function makeNO($str = 'MJ'){
    return $str . mt_rand(0000000, 9999999) . time();
}

