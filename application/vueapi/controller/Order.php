<?php

namespace app\vueapi\controller;

use app\common\model\{Order as OrderModel, Express};

class Order extends Base
{
    private $field = 'id, uid, post_name, post_tel, post_address, money, postage, amount, payment, no, status, add_date, pay_date, send_date, get_date, cancel_date, express, express_no, pay_way, reduce';
    /**
     * 获取所有订单数据
     * @return \think\response\Json
     */
    public function index()
    {
        $data = $this->request->param();
        $page = $data['pageSize'] ?? 10;
        $where = [];
        if(!empty($data['status'])){
            $where['status'] = $data['status'];
        }
        $res = OrderModel::getListByWhere($where, $page, $this->field);
        return json(msg(1, $res));
    }

    /**
     * 获取订单详情
     * @return \think\response\Json
     */
    public function getOrderDetail()
    {
        $data = intval($this->request->param('id'));
        if(!$data){
            return json(msg(0, '', '请输入需要查询的ID'));
        }
        $res = OrderModel::where('id', $data)->with('info')->field($this->field)->find();
        $express = Express::where('status', 1)->order('sort desc')->column('name');
        $arr = [
            'order' => $res,
            'express' => $express
        ];
        return $res ? json(msg(1, $arr)) : json(msg(0, '', '没有该订单信息'));
    }

    /**
     * 发货
     */
    public function sendGoods()
    {
        $rule = [
            ['id', 'require|number|egt:1', '请输入合法的ID'],
            ['express', 'require', '请输入发货公司'],
            ['express_no', 'require', '请输入发货单号'],
        ];
        $data = $this->checkParam($rule);
        $res = OrderModel::where('id', $data['id'])->field($this->field)->find();
        if($res->status != 1){
            return json(msg(0, '', '定单状态错误,无法进行发货'));
        }
        $res->status = 2;
        $res->express = $data['express'];
        $res->express_no = $data['express_no'];
        $res->send_date = date('Y-m-d H:i:s');
        $flag = $res->save();
        return returnRes($flag, '发货');
    }

    /**
     * 用户自提
     */
    public function selfPickedUp()
    {
        $data = intval($this->request->param('id'));
        if(!$data){
            return json(msg(0, '', '请输入需要合法的ID'));
        }
        $res = OrderModel::where('id', $data)->field($this->field)->find();
        if($res->status != 1){
            return json(msg(0, '', '定单状态错误,无法进行自提'));
        }
        $res->status = 3;
        $res->express = '自提';
        $res->express_no = '自提';
        $res->send_date = date('Y-m-d H:i:s');
        $res->get_date = date('Y-m-d H:i:s');
        $flag = $res->save();
        return returnRes($flag, '自提');
    }


}
