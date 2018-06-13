<?php
use app\common\model\Role;
/**
 * 权限检测
 * @param $rule
 * @return bool
 */
function authCheck($rule)
{
    $rule = strtolower($rule);
    $control = explode('/', $rule)['0'];
    if ($control == "login" || $control == "index") {
        return true;
    }
    if (in_array($rule, cache('auth')[session('role_id')])) {
        return true;
    }
    return false;
}

/**
 * 更新权限缓存
 * @throws \think\db\exception\DataNotFoundException
 * @throws \think\db\exception\ModelNotFoundException
 * @throws \think\exception\DbException
 */
function updateAuthCache()
{
    $res = Role::all();
    $arr = [];
    foreach ($res as $re){
        $arr[$re->id] = $re->getRoleInfo();
    }
    cache('auth', $arr);
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

