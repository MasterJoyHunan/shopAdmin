<?php

namespace app\shop\controller;

use app\common\model\{
    Cart as CartModel, Product, ProductSku
};

class Cart extends Base
{
    /**
     * 所有购物车
     */
    public function index()
    {
        $res = CartModel::where('uid', $this->user->id)->with(['pro', 'proSku'])->select();
        return json(msg(1, $res));
    }


    /**
     * 加入购物车
     */
    public function addToCart()
    {
        $rule = [
            ['pro_id', 'require|regex:/^[1-9]\d*$/', '请选择商品ID|请选择商品ID'],
            ['num', 'require|regex:/^[1-9]\d*$/', '请输入数量|请输入数量'],
            ['buy_now', 'require|in:0,1', '请选择购买方式|请选择购买方式'],
        ];
        $data = $this->checkParam($rule);
        $where['id'] = $data['pro_id'];
        $where['status'] = 1;
        $product = Product::where($where)->with('sku')->find();
        if (!$product) {
            return json(msg(0, '', '商品不存在'));
        }
        if (intval($data['pro_sku_id']) > 0) {
            $sku = $product->sku()->where('id', $data['pro_sku_id'])->find();
            if (empty($sku)) {
                return json(msg(0, '', '请选择商品的属性不存在'));
            }
            if ($sku->stock - $data['num'] < 0) {
                return json(msg(0, '', '请选择商品库存不足'));
            }
        } else {
            if (count($product->sku) > 0) {
                return json(msg(0, '', '请选择商品的属性'));
            }
            if ($product->stock - $data['num'] < 0) {
                return json(msg(0, '', '请选择商品库存不足'));
            }
        }
        $where = [];
        $where['pro_id'] = $data['pro_id'];
        $where['pro_sku_id'] = $data['pro_sku_id'];
        $where['uid'] = $this->user->id;
        $cart = CartModel::where($where)->find();
        if ($cart) {
            // 如果是立即购买的话
            if (!empty($data['buy_now'])) {
                if ($cart->num == $data['num']) {
                    $flag = true;
                } else {
                    $cart->num = $data['num'];
                    $flag = $cart->save();
                }
            } else {
                $cart->num += $data['num'];
                $flag = $cart->save();
            }
        } else {
            $cart = new CartModel();
            $data['uid'] = $this->user->id;
            $flag = $cart->allowField(['id', 'uid', 'pro_id', 'pro_sku_id', 'num'])->save($data);
        }
        if ($data['buy_now']) {
            session('tmp_user_cart', json_encode([0 => $cart->id]));
        }
        return returnRes($flag, '更新购物车');
    }


    /**
     * 修改购物车的数量
     * @return \think\response\Json
     */
    public function changeCartNumber()
    {
        $rule = [
            ['cart_id', 'require|regex:/^[1-9]\d*$/', '请输入购物车的ID|请输入购物车的ID'],
            ['type', 'require|in:0,1', '请选择加减购物车|请选择加减购物车']
        ];
        $data = $this->checkParam($rule);
        //判断购物车存不存在
        $my_cart = $this->user->cart()->where('id', $data['cart_id'])->find();
        if (empty($my_cart)) {
            return json(msg(0, '', '该商品不在您的购物车内'));
        }
        //判断有没有库存
        if ($my_cart->pro_sku_id == 0) {
            $pro = Product::where('id', $my_cart->pro_id)->find();
            if (empty($pro)) {
                return json(msg(0, '', '该商品不存在'));
            }
            if ($data['type'] == 0) {
                //减购物车
                if ($my_cart->num - 1 <= 0) {
                    return json(msg(0, '', '不能再减了'));
                }
                $my_cart->num--;
            } else {
                //加购物车
                if ($pro->stock == 0 || $pro->stock < $my_cart->num + 1) {
                    return json(msg(0, '', '该商品库存不足'));
                }
                $my_cart->num++;
            }
        } else {
            $pro = ProductSku::where('id', $my_cart->pro_sku_id)->find();
            if (empty($pro)) {
                return json(msg(0, '', '该商品不存在'));
            }
            if ($data['type'] == 0) {
                //减购物车
                if ($my_cart->num - 1 <= 0) {
                    return json(msg(0, '', '不能再减了'));
                }
                $my_cart->num--;
            } else {
                //加购物车
                if ($pro->stock == 0 || $pro->stock < $my_cart->num + 1) {
                    return json(msg(0, '', '该商品库存不足'));
                }
                $my_cart->num++;
            }
        }
        $flag = $my_cart->save();
        return returnRes($flag, '更新购物车');
    }

    /**
     * 删除购物车
     * @return \think\response\Json
     */
    public function deleteCart()
    {
        $rule = [
            ['cart_id', 'require|regex:/^[1-9]\d*$/', '请输入购物车的ID|请输入购物车的ID'],
        ];
        $data = $this->checkParam($rule);
        $my_cart = $this->user->cart()->where('id', $data['cart_id'])->find();
        if (empty($my_cart)) {
            return json(msg(0, '', '该商品不在您的购物车内'));
        }
        $flag = $this->user->cart()->where('id', $data['cart_id'])->delete();
        return returnRes($flag, '删除购物车');
    }
}
