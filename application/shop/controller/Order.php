<?php

namespace app\shop\controller;

use app\common\model\{Order as OrderModel, MoneyRecord};
use think\Db;
class Order extends Base
{
    public function index()
    {
        $where['uid'] = $this->user->id;
        $where['status'] = ['neq', -1];
        $res = OrderModel::where($where)->with('info')->order('id desc')->select();
        return json(msg(1, $res));
    }

    /**
     * 在购物车里面提交
     * @return \think\response\Json
     */
    public function cartSubmit()
    {
        $ids = $this->request->param();
        if (empty($ids['id']) || !is_array($ids['id'])) {
            return json(msg(0, '', '非法参数'));
        }
        $res = $this->user->address()->find();
        if (empty($res)) {
            return json(msg(-1, '', '请先添加收货地址'));
        }
        session('tmp_user_cart', json_encode($ids['id']));
        return json(msg(1, '', '提交成功, 进入订单界面'));
    }


    /**
     * 取消订单
     * @return \think\response\Json
     */
    public function cancelOrder()
    {
        $rule = [
            ['id', 'require|regex:/^[1-9]\d*$/', '请填写订单ID|请填写订单ID']
        ];
        $data = $this->checkParam($rule);
        $where['id'] = $data['id'];
        $where['status'] = 0;
        $order = $this->user->orderList()->where($where)->find();
        if(empty($order)){
            return json(msg(0, '', '订单不存在'));
        }
        $order->status = -1;
        $order->cancel_date = date('Y-m-d H:i:s');
        $flag = $order->save();
        return returnRes($flag, '取消订单');
    }

    /**
     * 确认收货
     * @return \think\response\Json
     */
    public function getOrder()
    {
        $rule = [
            ['id', 'require|regex:/^[1-9]\d*$/', '请填写订单ID|请填写订单ID']
        ];
        $data = $this->checkParam($rule);
        $where['id'] = $data['id'];
        $where['status'] = 2;
        $order = $this->user->orderList()->where($where)->find();
        if(empty($order)){
            return json(msg(0, '', '订单不存在'));
        }
        $order->status = 3;
        $order->get_date = date('Y-m-d H:i:s');
        $flag = $order->save();
        return returnRes($flag, '订单收货');
    }


    /**
     * 商品结算获取信息
     * @return \think\response\Json
     */
    public function getChooseGoods()
    {
        $where = [];
        $where['id'] = ['in', json_decode(session('tmp_user_cart'))];
        $goods = $this->user->cart()->where($where)->with(['pro', 'proSku'])->select();
        if(empty($goods)){
            return json(msg(0, '', '没有选择商品'));
        }
        $address = $this->user->address()->where('is_default', 1)->find();
        if(empty($address)){
            return json(msg(-1, '', '没有选择默认地址'));
        }
        $arr['goods'] = $goods;
        $arr['address'] = $address;
        $arr['__token__'] = $this->request->token();
        return json(msg(1, $arr));
    }


    /**
     * 获取订单详情
     * @return \think\response\Json
     */
    public function getOrderDetail()
    {
        $rule = [
            ['id', 'require|regex:/^[1-9]\d*$/', '请填写订单ID|请填写订单ID']
        ];
        $data = $this->checkParam($rule);
        $where['id'] = $data['id'];
        $where['status'] = ['neq', -1];
        $order = $this->user->orderList()->where($where)->with('info')->find();
        if(empty($order)){
            return json(msg(0, '', '订单不存在'));
        }
        return json(msg(1, $order));
    }


    public function orderPay()
    {
        $rule = [
            ['__token__', 'require', '验证码不能为空'],
            ['pay_way', 'require|in:1', '请选择支付方式|非法支付方式']
        ];
        $data = $this->checkParam($rule);
        if ($data['__token__'] != session('__token__')) {
            session('__token__', mt_rand(1, 1000000));
            return json(msg(0, '', '请不要重复提交'));
        }
        $this->request->token();
        $address = $this->user->address()->where('is_default', 1)->find();
        if (empty($address)) {
            return json(msg(0, '', '收货地址不存在'));
        }
        //判断防止重复提交

        //1.生成订单,
        $flag = $this->_mkOrder();
        if(is_string($flag)){
            return json(msg(-1, '', $flag));
        }
        //2.扣款
        $flag2 = $this->_pay($flag);
        if(is_string($flag2)){
            return json(msg(0, '', $flag2));
        }
        //3.返回信息
        if($flag2 === true){
            return json(msg(1));
        }else{
            return json(msg(0, '', '支付失败'));
        }
    }


    /**
     * 订单列表支付
     * @return \think\response\Json
     */
    public function payOrder()
    {
        $rule = [
            ['id', 'require|regex:/^[1-9]\d*$/', '请填写订单ID|请填写订单ID'],
            ['pay_way', 'require|in:1', '请选择支付方式|非法支付方式']
        ];
        $data = $this->checkParam($rule);
        $where['id'] = $data['id'];
        $where['status'] = 0;
        $order = $this->user->orderList()->where($where)->find();
        if(empty($order)){
            return json(msg(0, '', '订单不存在'));
        }
        $flag = $this->_pay($order);
        if(is_string($flag)){
            return json(msg(0, '', $flag));
        }
        //3.返回信息
        if($flag === true){
            return json(msg(1));
        }else{
            return json(msg(0, '', '支付失败'));
        }
    }


    /**
     * 生成订单
     * @return $this|string
     */
    private function _mkOrder()
    {
        $address = $this->user->address()->where('is_default', 1)->find();
        $where['id'] = ['in', json_decode(session('tmp_user_cart'))];
        $pro = $this->user->cart()->where($where)->with(['pro', 'proSku'])->select();
        // 判断是否还有库存
        $money = 0;
        $arr = [];
        foreach ($pro as $k => $v){
            if(!empty($v->proSku)){
                if($v->proSku->stock - $v->num < 0){
                    return '有些商品库存不足';
                }
                $money += $v->proSku->price * $v->num;
                $arr[$k]['pro_id'] = $v->pro->id;
                $arr[$k]['pro_ext_id'] = $v->proSku->id;
                $arr[$k]['name'] = $v->pro->title;
                $arr[$k]['name_ext'] = $v->proSku->name;
                $arr[$k]['price'] = $v->proSku->price;
                $arr[$k]['img'] = $v->proSku->img;
                $arr[$k]['num'] = $v->num;
            }else{
                if($v->pro->stock - $v->num < 0){
                    return '有些商品库存不足';
                }
                $money += $v->pro->price * $v->num;
                $arr[$k]['pro_id'] = $v->pro->id;
                $arr[$k]['pro_ext_id'] = 0;
                $arr[$k]['name'] = $v->pro->title;
                $arr[$k]['name_ext'] = '';
                $arr[$k]['price'] = $v->pro->price;
                $arr[$k]['img'] = $v->pro->img;
                $arr[$k]['num'] = $v->num;
            }
        }
        $data['post_name'] = $address->name;
        $data['post_tel'] = $address->tel;
        $data['post_address'] = "{$address->province},{$address->city},{$address->area},{$address->address}";
        $data['money'] = $money;
        $data['amount'] = $money;
        $data['reduce'] = 0;
        $data['no'] = makeNO();
        $data['postage'] = 0;
        $data['pay_way'] = 1;
        $data['uid'] = $this->user->id;
        $order = OrderModel::create($data);
        $flag = $order->info()->saveAll($arr);
        Db::startTrans();
        if($order && $flag){
            Db::commit();
            //删除购物车
            $where = [];
            $where['id'] = ['in', json_decode(session('tmp_user_cart'))];
            $this->user->cart()->where($where)->delete();
            return $order;
        }
        Db::rollback();
        return '生成订单失败';
    }


    /**
     * 支付订单
     * @param $order
     * @return bool|string
     */
    private function _pay($order)
    {
        if($this->user->amoney - $order->amount < 0){
            return '积分不足';
        }
        Db::startTrans();
        $flag = MoneyRecord::addRecord($this->user, -$order->amount, 1, 1, '支付订单扣款');
        $order->status = 1;
        $order->pay_date = date('Y-m-d H:i:s');
        $flag2 = $order->save();
        if($flag && $flag2){
            Db::commit();
            return true;
        }
        Db::rollback();
        return false;
    }
}