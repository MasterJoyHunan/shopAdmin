<?php

namespace app\vueapi\controller;

use app\common\model\{Express as ExpressModel};

class Express extends Base
{
    /**
     * 获取所有快递数据
     */
    public function index()
    {
        $field = 'id, name, tel, address, contact, contact_tel, sort';
        $data = $this->request->param();
        $where['status'] = 1;
        if(!empty($data['name'])){
            $where['name'] = ['like', "%{$data['name']}%"];
        }
        $data = ExpressModel::where($where)->field($field)->order('sort desc, id desc')->select();
        return json(msg(1, $data));
    }

    /**
     * 添加快递公司
     * @return \think\response\Json
     */
    public function addExpress()
    {
        $rule = [
            ['name', 'require', '请填写快递公司']
        ];
        $data = $this->checkParam($rule);

        $express = new ExpressModel($data);
        $res = $express->allowField(['name', 'tel', 'address', 'contact', 'contact_tel', 'sort'])->save();
        return returnRes($res, '添加快递公司');
    }


    /**
     * 修改快递公司
     * @return \think\response\Json
     */
    public function editExpress()
    {
        $rule = [
            ['id', 'require|number|egt:1', '请输入合法的ID|请输入合法的ID|请输入合法的ID'],
            ['name', 'require', '请填写快递公司']
        ];
        $data = $this->checkParam($rule);
        $express = ExpressModel::where('id', $data['id'])->find();
        if(empty($express)){
            return json(msg(0, '', '没有保存该快递公司,无法修改'));
        }
        $res = $express->allowField(['name', 'tel', 'address', 'contact', 'contact_tel', 'sort'])->save($data);
        return returnRes($res, '修改快递公司');
    }

    /**
     * 删除快递公司
     * @return \think\response\Json
     */
    public function delExpress()
    {
        $rule = [
            ['id', 'require|number|egt:1', '请输入合法的ID|请输入合法的ID|请输入合法的ID'],
        ];
        $data = $this->checkParam($rule);
        $where['id'] = $data['id'];
        $where['status'] = 1;
        $express = ExpressModel::where($where)->find();
        if(empty($express)){
            return json(msg(0, '', '没有保存该快递公司,无法修改'));
        }
        $express->status = -1;
        $res = $express->save();
        return returnRes($res, '删除快递公司');

    }
}
