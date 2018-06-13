<?php
// 应用公共文件
defined('ADMIN_STATUS') || define('ADMIN_STATUS', [0 => '停封', 1 => '正常']); //管理员状态
/**
 * 统一返回信息
 * @param $status
 * @param $data
 * @param $msg
 * @return array
 */
function msg($status, $data = '', $msg = '')
{
    return compact('status', 'data', 'msg');
}

/**
 * md5加密
 * @param $str
 * @return string
 */
function newMd5($str)
{
    return md5('masterjoy//.' . $str);
}

/**
 * 获取树结构
 * @param $arr
 * @param $index
 * @return array
 */
function getTree($arr, $index)
{
    $tree = [];
    foreach ($arr as $k => $v) {
        if ($v[$index] != 0) {
            $arr[$v[$index]]['children'][] = &$arr[$k];
        }else{
            $tree[] = &$arr[$k];
        }
    }
    return $tree;
}
