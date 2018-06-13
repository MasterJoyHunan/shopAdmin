<?php

namespace app\vueapi\controller;

use app\common\model\AdminUser;
use think\Controller;
use org\Verify;

class Login extends Controller
{

    // 登录页面
    public function index()
    {
        $user = AdminUser::where('id', session('id'))->with('role')->field('user_name, real_name as true_name, role_id')->find();
        return json(msg(1, $user));
    }

    // 登录操作
    public function doLogin()
    {
        $data = $this->request->param();
        $result = $this->validate($data, [
            ['user_name', 'require', '用户名不能为空'],
            ['password', 'require', '密码不能为空'],
//            ['code', 'require', '验证码不能为空']
        ]);
        if(true !== $result){
            return json(msg(0, '', $result));
        }

        /*$verify = new Verify();
        if (!$verify->check($data['code'])) {
            return json(msg(-2, '', '验证码错误'));
        }*/

        $userModel = new AdminUser();
        $hasUser = $userModel->where('user_name', $data['user_name'])->find();
        if(empty($hasUser)){
            return json(msg(0, '', '管理员不存在'));
        }

        if(newMd5($data['password']) != $hasUser['password']){
            return json(msg(0, '', '密码错误'));
        }

        if(1 != $hasUser['status']){
            return json(msg(0, '', '该账号被禁用'));
        }

        // 获取该管理员的角色信息
        session('username', $data['user_name']);
        session('id', $hasUser['id']);
        session('role', $hasUser->role->role_name);  // 角色名
        session('role_id', $hasUser['role_id']);

        // 更新管理员状态
        $param = [
            'login_times' => $hasUser['login_times'] + 1,
            'last_login_ip' => request()->ip(),
        ];

        if(!$hasUser->save($param)){
            return json(msg(-6, '', '更新数据失败'));
        }
        return json(msg(1, url('index/index'), '登录成功'));
    }

    // 验证码
    public function checkVerify()
    {
        $verify = new Verify();
        $verify->imageH = 32;
        $verify->codeSet = '0123456789';
        $verify->imageW = 100;
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->useCurve = false;
        $verify->fontSize = 14;
        return $verify->entry();
    }

    // 退出操作
    public function logOut()
    {
        session('username', null);
        session('id', null);
        session('role', null);  // 角色名
        session('role_id', null);  // 角色名
        return json(msg(1, '', '退出成功'));
    }
}