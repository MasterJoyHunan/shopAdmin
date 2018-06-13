<?php

namespace app\vueapi\controller;

use app\common\model\{
    User
};

class Member extends Base
{
    /**
     * 获取会员列表
     * @return \think\response\Json
     */
    public function index()
    {
        $data = $this->request->param('tel');
        $where = [];
        if (!empty($data)) {
            $where['tel'] = $data;
        }
        $data = $this->request->param();
        $page = $data['pageSize'] ?? 10;
        $field = "id, tel, status, add_time, last_login_time, true_name, amoney";
        $res = User::getListByWhere($where, $page, $field, 'id desc');
        return json(msg(1, $res));
    }

    /**
     * 修改会员状态
     * @return \think\response\Json
     */
    public function changeStatus()
    {
        $rule = [
            ['id', 'require|regex:/^[1-9]\d*$/', '请输入正确的ID|请输入正确的ID'],
            ['status', 'require|in:0,1', '请选择是否封停|请选择是否封停']
        ];
        $data = $this->checkParam($rule);
        $user = User::where('id', $data['id'])->find();
        if (empty($user)) {
            return json(msg(0, '', '用户不存在'));
        }
        if ($user->status == $data['status']) {
            return json(msg(0, '', '已经是该状态,无法继续修改'));
        }
        $user->status = $data['status'];
        $flag = $user->save();
        return returnRes($flag, '修改会员状态');
    }
}