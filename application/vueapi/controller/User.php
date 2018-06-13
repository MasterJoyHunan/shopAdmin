<?php

namespace app\vueapi\controller;

use app\common\model\{Role, AdminUser};

class User extends Base
{
    /**
     * 用户列表
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $data = $this->request->param();
        $where = [];
        if (!empty($data['user_name'])) {
            $where['user_name'] = ['like', '%' . $data['user_name'] . '%'];
        }
        $page = $data['pageSize'] ?? 10;
        $field = "id, user_name, real_name, login_times, last_login_ip, last_login_time,real_name, status, role_id";
        $res = AdminUser::getMapListByWhere($where, $page, 'role', $field);
        return json(msg(1, $res));
    }

    /**
     * 添加管理员
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function userAdd()
    {
        if ($this->request->isPost()) {
            $rule = [
                ['user_name', 'require|min:5', '请输入账号'],
                ['role_id', 'require', '请输入管理员角色'],
                ['password', 'require|min:6', '请输入密码'],
                ['real_name', 'require|min:2', '请输入真实姓名'],
                ['status', 'require|in:0,1', '请输入合法的状态'],
            ];
            $data = $this->checkParam($rule);
            $have_reg = AdminUser::where('user_name', $data['user_name'])->find();
            if($have_reg){
                return json(msg(0, '', '该用户名已经被注册'));
            }
            $data['password'] = newMd5($data['password']);
            $user = new AdminUser($data);
            $flag = $user->allowField(['user_name', 'role_id', 'password', 'real_name', 'status'])->save();
            return returnRes($flag, '创建用户');
        }
        $arr = [
            'role' => Role::all(),
            'status' => ADMIN_STATUS
        ];
        return json(msg(1, $arr));
    }

    /**
     * 编辑用户
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function userEdit()
    {
        $data = $this->request->param();
        if ($this->request->isPost()) {
            $user = AdminUser::where('id', $data['id'])->find();
            if (!$user) {
                return json(msg(0, '', '用户不存在'));
            }
            $data['password'] ? $user->password = $data['password'] : '';
            $data['real_name'] ? $user->real_name = $data['real_name'] : '';
            $user->status = $data['status'];
            $user->role_id = $data['role_id'];
            $flag = $user->save();
            return returnRes($flag, '修改用户信息');
        }
    }

    /**
     * 删除用户
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function userDel()
    {
        $id = $this->request->param('id');
        $user = AdminUser::get($id);
        if (empty($user)) {
            return json(msg(0, '', '不存在该用户'));
        }
        if ($user->id == 1) {
            return json(msg(0, '', '不能删除超级管理员'));
        }
        $flag = $user->delete();
        return returnRes($flag, '删除用户');
    }
}
