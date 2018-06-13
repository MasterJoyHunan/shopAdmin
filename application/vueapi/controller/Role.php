<?php

namespace app\vueapi\controller;

use app\common\model\AdminUser;
use app\common\model\Node;
use app\common\model\Role as RoleModel;
use app\common\model\UserType;

class Role extends Base
{
    /**
     * 角色列表
     * @return mixed|\think\response\Json
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $data = $this->request->param();
        $page = $data['pageSize'] ?? 10;
        $field = 'id, role_name';
        $res = RoleModel::getListByWhere([], $page, $field);
        return json(msg(1, $res));
    }

    /**
     * 添加角色
     * @return mixed|\think\response\Json
     */
    public function roleAdd()
    {
        $rule = [
            ['role_name', 'require', '请输入合法的角色名']
        ];
        $data = $this->checkParam($rule);
        $flag = RoleModel::create(['role_name' => $data['role_name']]);
        return returnRes($flag, '添加');
    }

    /**
     * 编辑角色
     * @return mixed|\think\response\Json
     */
    public function roleEdit()
    {
        $rule = [
            ['id', 'require|number|gt:0', '请输入合法的ID'],
            ['role_name', 'require', '请输入合法的角色名'],
        ];
        $data = $this->checkParam($rule);
        $flag = RoleModel::where('id', $data['id'])->update(['role_name' => $data['role_name']]);
        return returnRes($flag, '修改');
    }

    /**
     * 删除角色
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function roleDel()
    {
        $id = $this->request->param('id');
        if ($id == 1) {
            return json(msg(0, '', '超级管理员不允许删除'));
        }
        $res = AdminUser::get(['role_id' => $id]);
        if ($res) {
            return json(msg(0, '', '有人正在使用该角色,无法删除'));
        }
        $flag = RoleModel::destroy($id);
        return returnRes($flag, '删除');
    }

    /**
     * 分配权限
     * @return \think\response\Json
     */
    public function giveAccess()
    {
        $data = $this->request->param();
        if ($data['id'] == 1) {
            return json(msg(0, '', '请不要操作超级管理员'));
        }
        $node = new Node();
        if ($this->request->isGet()) {
            $nodeStr = $node->getNodeInfo($data['id']);
            return json(msg(1, $nodeStr));
        } elseif ($this->request->isPost()) {
            $flag = RoleModel::where('id', $data['id'])->update(['rule' => $data['rule']]);
            return returnRes($flag, '分配权限');
        }
    }

    /**
     * 更新权限缓存
     */
    public function __destruct()
    {
        updateAuthCache();
    }

}