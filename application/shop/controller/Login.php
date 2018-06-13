<?php

namespace app\shop\controller;
use app\common\model\User;
use think\Controller;

class Login extends Controller
{
    /**
     * 登录
     */
    public function index()
    {
        $data = $this->request->param();
        $res = $this->validate($data, [
            ['tel', 'require', '请输入用户名'],
            ['password', 'require', '请输入密码'],
        ]);
        if($res !== true){
            return json(msg(0, '', $res));
        }
        $where['tel'] = $data['tel'];
        $where['password'] = newMd5($data['password']);
        $user = User::where($where)->field('id, status')->find();
        if($user){
            if($user->status != 1){
                return json(msg(0, '', '登录失败, 该账号已被停封'));
            }
            $user->last_login_time = date('Y-m-d H:i:s');
            $user->save();
            session('user_id', $user->id);
            return json(msg(1, '', '登录成功'));
        }else{
            return json(msg(0, '', '登录失败,账号或密码错误'));
        }
    }


    /**
     * 退出登录
     */
    public function logout()
    {
        session(null);
        return json(msg(1));
    }

    /**
     * 注册
     */
    public function register(){
        $data = $this->request->param();
        $res = $this->validate($data, [
            ['tel', 'require|number|length:11', '请输入手机号|请输入11位数的手机号|请输入11位数的手机号'],
            ['password', 'require|min:6', '请输入密码|密码不得低于6位数'],
            ['confirm_password', 'require|confirm:password', '请输入确认密码|两次输入的密码不同'],
        ]);
        if($res !== true){
            return json(msg(0, '', $res));
        }
        $have_reg = User::where('tel', $data['tel'])->find();
        if($have_reg){
            return json(msg(0, '', '该手机已被注册'));
        }
        $user = new User();
        $flag = $user->allowField(['id', 'tel', 'password'])->save($data);
        if($flag){
            session('user_id', $user->id);
            return json(msg(1, '', '注册成功'));
        }
        return json(msg(0, '', '注册失败'));
    }

}